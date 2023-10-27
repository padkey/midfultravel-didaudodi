<?php

namespace DDDD\CatalogProduct\Services;

use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Models\CatalogProductDecimal;
use DDDD\CatalogProduct\Models\CatalogProductInt;
use DDDD\CatalogProduct\Models\CatalogProductText;
use DDDD\CatalogProduct\Models\CatalogProductVarchar;
use DDDD\CatalogProduct\Repositories\ProductValueRepository;
use DDDD\EAVAttribute\Models\EavAttribute;
use DDDD\EAVAttribute\Models\EavAttributeGroup;
use DDDD\EAVAttribute\Services\EavAttributeService;
use Illuminate\Support\Facades\Log;

class ProductValueService
{
    /**
     * @var EavAttributeService
     */
    private EavAttributeService $eavAttributeService;

    /**
     * @var ProductValueRepository
     */
    private ProductValueRepository $productValueRepository;

    /**
     * CatalogProductValueService constructor.
     * @param EavAttributeService $eavAttributeService
     * @param ProductValueRepository $productValueRepository
     */
    function __construct(EavAttributeService $eavAttributeService, ProductValueRepository $productValueRepository)
    {
        $this->eavAttributeService = $eavAttributeService;
        $this->productValueRepository = $productValueRepository;
    }

    /**
     * @param $model
     */
    public function createOrUpdateProductValue($model, $data): void
    {
        $attributes = $this->eavAttributeService->getAttributesByAttrSetId($model->attribute_set_id);
        foreach ($attributes as $attribute) {
            /**
             * @var EavAttribute $attribute
             */
            $attrName = $attribute->getAttributeDefaultName();
            if (!isset($data[$attrName])) {
                continue;
            }
            $this->switchAttributeProductValue(
                $attribute->getAttributeType(),
                $data[$attrName],
                $model->entity_id,
                $attribute->getAttributeId()
            );
        }
    }

    /**
     * @param $tableType
     * @param $value
     * @param $entityId
     * @param $attributeId
     */
    function switchAttributeProductValue($tableType, $value, $entityId, $attributeId): void
    {
        switch ($tableType) {
            case 'boolean':
                $this->createOrUpdate(CatalogProductInt::class, EavAttributeService::checkIsBool($value), $entityId, $attributeId);
                break;
            case 'select':
            case 'int':
                $this->createOrUpdate(CatalogProductInt::class, $value, $entityId, $attributeId);
                break;
            case 'decimal':
                $this->createOrUpdate(CatalogProductDecimal::class, $value, $entityId, $attributeId);
                break;
            case 'image':
                if (!is_null($value)) {
                    $imageValue = $value->store(config('admin.upload.directory.image'), config('admin.upload.disk'));
                    $this->createOrUpdate(CatalogProductText::class, $imageValue, $entityId, $attributeId);
                }
                break;
            case 'text':
            case 'editor':
                $this->createOrUpdate(CatalogProductText::class, $value, $entityId, $attributeId);
                break;
            case 'varchar':
                $this->createOrUpdate(CatalogProductVarchar::class, $value, $entityId, $attributeId);
                break;
            case 'gallery':
                if (!is_null($value)) {
                    $this->handleInsertGallery($value, $entityId, $attributeId);
                }
                break;
            case 'multiple-select':
                $newValue = array_slice($value, 0, count($value) - 1);
                $this->createOrUpdate(CatalogProductVarchar::class, json_encode($newValue), $entityId, $attributeId);
                break;
            default:
                Log::error("Catalog_Product not match any type in system");
        }
    }

    /**
     * @param $model
     * @param string $value
     * @param $entityId
     * @param $attributeId
     */
    public function createOrUpdate($model, string $value = '', $entityId, $attributeId): void
    {
        $this->productValueRepository
            ->insertOrUpdateProductValue($model, $value, $entityId, $attributeId);
    }

    /**
     * @param $form
     * @param EavAttributeGroup $attrGroup
     * @param CatalogProduct $product
     */
    public function selectProductValueWithAttributeGroup($form, EavAttributeGroup $attrGroup, CatalogProduct $product): void
    {
        $attributes = $attrGroup->attributes()->get();
        foreach ($attributes as $attribute) {
            /**
             * @var EavAttribute $attribute
             */
            $modelProductEntity = $this::getModelProductEntityType($attribute->getAttributeType());
            $attrValueModel = $this->productValueRepository
                ->getAttributeProductValue(
                    $modelProductEntity,
                    $product->getId(),
                    $attribute->getAttributeId());
            EavAttributeService::selectAttributeInputForm(
                $form,
                $attribute->getAttributeId(),
                $attribute->getAttributeType(),
                $attribute->getAttributeDefaultName(),
                $attribute->getIsRequire(),
                $attrValueModel == null ? $attribute->getDefaultValue() : $attrValueModel->value,
                $attribute->getAttributeTitle());
        }
    }

    /**
     * @param $values
     * @param $entityId
     * @param $attributeId
     */
    protected function handleInsertGallery($values, $entityId, $attributeId): void
    {
        $imageArr = array();

        foreach ($values as $value) {
            $imageArr[] = $value->store(config('admin.upload.directory.image'), config('admin.upload.disk'));
        }
        $productValue = CatalogProductText::where('entity_id', $entityId)->where('attribute_id', $attributeId);
        if ($productValue->exists()) {
            $value = array_merge(json_decode(($productValue->get())->toArray()[0]['value']), $imageArr);
            $this->productValueRepository->updateProductValue($productValue, json_encode($value));
        } else {
            $this->productValueRepository->insertProductValue(CatalogProductText::class, json_encode($imageArr), $entityId, $attributeId);
        }
    }

    /**
     * @param $attributeType
     * @return string|null
     */
    public static function getModelProductEntityType($attributeType): ?string
    {
//         return match ($attributeType) {
//             'int', 'boolean', 'select' => CatalogProductInt::class,
//             'decimal' => CatalogProductDecimal::class,
//             'text', 'gallery', 'image', 'editor' => CatalogProductText::class,
//             'varchar', 'multiple-select' => CatalogProductVarchar::class,
//             default => null
//         };
        switch ($attributeType) {
            case 'int':
            case 'boolean':
            case 'select':
                return CatalogProductInt::class;
            case 'decimal':
                return CatalogProductDecimal::class;
            case 'text':
            case 'gallery':
            case 'image':
            case 'editor':
                return CatalogProductText::class;
            case 'varchar':
            case 'multiple-select':
                return CatalogProductVarchar::class;
            default:
                return null;
        }
    }
}
