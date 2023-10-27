<?php

namespace DDDD\CatalogCategory\Services;

use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogCategory\Models\CatalogCategoryValue;
use DDDD\CatalogCategory\Repositories\CatalogCategoryRepository;
use DDDD\CatalogCategory\Repositories\CatalogCategoryValueRepository;
use DDDD\EAVAttribute\Models\EavAttribute;
use DDDD\EAVAttributeRepositories\EavAttributeRelationRepository;
use DDDD\EAVAttribute\Repositories\EavAttributeRepository;
use DDDD\EAVAttribute\Models\EavAttributeGroup;
use DDDD\EAVAttribute\Services\EavAttributeService;
use Illuminate\Support\Facades\Log;

class CatalogCategoryService
{
    /**
     * @var CatalogCategoryRepository
     */
    private CatalogCategoryRepository $catalogCategoryRepository;

    /**
     * @var CatalogCategoryValueRepository
     */
    private CatalogCategoryValueRepository $catalogCategoryValueRepository;

    protected $eavAttributeService;

    /**
     * CatalogCategoryService constructor.
     * @param CatalogCategoryRepository $catalogCategoryRepository
     * @param CatalogCategoryValueRepository $catalogCategoryValueRepository
     */
    function __construct(
        CatalogCategoryRepository      $catalogCategoryRepository,
        CatalogCategoryValueRepository $catalogCategoryValueRepository,
        EavAttributeGroup $eavAttributeGroup,
        EavAttributeService $eavAttributeService
    ) {
        $this->catalogCategoryRepository = $catalogCategoryRepository;
        $this->catalogCategoryValueRepository = $catalogCategoryValueRepository;
        $this->eavAttributeGroup = $eavAttributeGroup;
        $this->eavAttributeService = $eavAttributeService;
    }

    /**
     * @param $form
     * @param $attributeGroupId
     * @param CatalogCategory $category
     */
    function selectCategoryValueWithAttributeGroup($form, EavAttributeGroup $attrGroup, CatalogCategory $category): void
    {
        $attributes =  $attrGroup->attributes()->get();
        foreach ($attributes as $attribute) {
            /**
             * @var EavAttribute $attribute
             */
            $attributeValue = $category->getCustomAttribute($attribute->getAttributeDefaultName());
            if ($attribute->getAttributeType() == EavAttribute::TYPE_SELECT && $attributeValue != null) {
                $defaultValue = $attributeValue["key"];
            } else {
                $defaultValue = $attributeValue;
            }

            EavAttributeService::selectAttributeInputForm($form,
                $attribute->getAttributeId(),
                $attribute->getAttributeType(),
                $attribute->getAttributeDefaultName(),
                $attribute->getIsRequire(),
                $defaultValue,
                $attribute->getAttributeTitle()
            );
        }
    }

    /**
     * Function is handle to update children count.
     */
    function updateChidrenCount(): void
    {
        $categories = CatalogCategory::all();
        foreach ($categories as $category) {
            $this->catalogCategoryRepository->injectChildrenCount($category);
        }
    }

    /**
     * @param $model
     */
    function createOrUpdateCategoryValue($model, $data): void
    {
        $attributes = $this->eavAttributeService->getAttributesByAttrSetId($model->attribute_set_id);
        foreach ($attributes as $value) {
            $attrName = $value['attribute_default_name'];
            if (!isset($data[$attrName])) {
                continue;
            }
            $this->switchAttributeCategoryValue($value['attribute_type'], $data[$attrName], $model, $value['attribute_id']);
        }
    }

    /**
     * @param $tableType
     * @param $value
     * @param $model
     * @param $attributeId
     */
    function switchAttributeCategoryValue($tableType, $value, $model, $attributeId): void
    {
        switch ($tableType) {
            case 'boolean':
                $this->createOrUpdate($model->entity_id, $attributeId, EavAttributeService::checkIsBool($value));
                break;
            case 'int':
            case 'text':
            case 'editor':
            case 'varchar':
            case 'decimal':
            case 'select':
                $this->createOrUpdate( $model->entity_id, $attributeId, $value);
                break;
            case 'image':
                if (!is_null($value)) {
                    $imageValue = $value->store('images', 'admin');
                    $this->createOrUpdate($model->entity_id, $attributeId, $imageValue);
                }
                break;
            case 'gallery':
                if (!is_null($value)) {
                    $this->handleInsertGallery($value, $model, $attributeId);
                }
                break;
            case 'multiple-select':
                $newValue = array_slice($value, 0, count($value) - 1);
                $this->createOrUpdate($model->entity_id, $attributeId, json_encode($newValue));
                break;
            default:
                Log::error("Catalog_category not match any type in system");
        }
    }

    /**
     * @param string $value
     * @param $entityId
     * @param $attributeId
     */
    public function createOrUpdate($entityId, $attributeId, $value = ''): void
    {
        $this->catalogCategoryValueRepository
            ->upsertCategoryValue($value, $entityId, $attributeId);
    }

    /**
     * @param $values
     * @param $model
     * @param $attributeId
     */
    protected function handleInsertGallery($values, $model, $attributeId): void
    {
        $imageArr = array();
        foreach ($values as $value) {
            $imageArr[] = $value->store('images', 'admin');
        }

        $categoryValue = CatalogCategoryValue::where('entity_id', $model->entity_id)->where('attribute_id', $attributeId);
        if ($categoryValue->exists()) {
            $value = array_merge(json_decode(($categoryValue->get())->toArray()[0]['value']), $imageArr);
            $this->catalogCategoryValueRepository->updateCategoryValue($categoryValue, json_encode($value));
        } else {
            $this->catalogCategoryValueRepository->insertCategoryValue(json_encode($imageArr), $model->entity_id, $attributeId);
        }
    }

    /**
     * @return void
     */
    public function injectLevelAndPathAllCategory(): void
    {
        $categories = CatalogCategory::all();
        foreach ($categories as $category) {
            $this->catalogCategoryRepository->injectLevelAndPath($category);
        }
    }
}

