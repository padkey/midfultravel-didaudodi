<?php

namespace DDDD\EAVAttribute\Services;

use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\EAVAttribute\Models\EavAttribute;
use DDDD\EAVAttribute\Models\EavAttributeGroup;
use DDDD\EAVAttribute\Models\EavAttributeSet;
use DDDD\EAVAttribute\Repositories\EavAttributeValueRepository;
use Encore\Admin\Form;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EavAttributeService
{

    /**
     * @var EavAttributeSet
     */
    protected $eavAttributeSet;

    /**
     * @param EavAttributeSet $eavAttributeSet
     */
    public function __construct(EavAttributeSet $eavAttributeSet)
    {
        $this->eavAttributeSet = $eavAttributeSet;
    }

    /**
     * @param $attributeSetId
     * @return mixed
     */
    public function getAttributesByAttrSetId($attributeSetId)
    {
        $attrSet = $this->eavAttributeSet->findOrFail($attributeSetId);
        $attributes = collect([]);
        foreach ($attrSet->groups as $attrGroup) {
            /**
             * @var EavAttributeGroup $attrGroup
             */
            $attributes = $attributes->merge($attrGroup->attributes()->get());
        }
        return $attributes;
    }

    public function selectAttributeFormById($form, $attrGroup): void
    {
        $attributes = $attrGroup->attributes()->get();
        foreach ($attributes as $attribute) {
            /**
             * @var EavAttribute $attribute
             */
            EavAttributeService::selectAttributeInputForm(
                $form,
                $attribute->getAttributeId(), $attribute->getAttributeType(),
                $attribute->getAttributeDefaultName(), $attribute->getIsRequire(), $attribute->getDefaultValue(),
                $attribute->getAttributeTitle());
        }
    }

    /**
     * @param Form $form
     * @param integer $attributeId
     * @param string $dataType
     * @param $dataName
     * @param $isRequire
     * @param $defaultValue
     * @param $label
     * @return mixed|void
     */
    public static function selectAttributeInputForm($form, $attributeId, $dataType, $dataName, $isRequire, $defaultValue = '', $label = null)
    {
        switch ($dataType) {
            case 'int':
                return ($form->number($dataName, $label))->default($defaultValue == '' ? 0 : $defaultValue)
                    ->rules(EavAttributeService::checkIsRequire($isRequire, 'required'));
            case 'decimal':
                return ($form->currency($dataName, $label))->default($defaultValue)
                    ->symbol(CatalogProduct::CURRENCY_SYMBOL)
                    ->rules(EavAttributeService::checkIsRequire($isRequire, 'required'));
            case 'text':
                return ($form->textarea($dataName, $label))->default($defaultValue)
                    ->addElementClass("count-character")
                    ->rules(EavAttributeService::checkIsRequire($isRequire, 'required'));
            case 'varchar':
                return ($form->text($dataName, $label))->default($defaultValue)
                    ->addElementClass("count-character")
                    ->rules(EavAttributeService::checkIsRequire($isRequire, 'required'));
            case 'image':
                return ($form->image($dataName, $label))
                    ->disk(config('admin.upload.disk'))
                    ->attribute('data-initial-preview', $defaultValue == '' ? '' :
                        Storage::disk(config('admin.upload.disk'))->url($defaultValue));
            case 'boolean':
                return ($form->switch($dataName, $label))
                    ->default($defaultValue  == '' ? false : $defaultValue)
                    ->rules(EavAttributeService::checkIsRequire($isRequire, 'required'));
            case 'editor':
                $form->tmeditor($dataName, $label)
                    ->default($defaultValue);
                break;
            case 'gallery':
                if ($defaultValue != '') {
                    $initialPreviewConfig = [];
                    $items = json_decode($defaultValue);
                    foreach ($items as $key => $value) {
                        $initialPreviewConfig[] = (object)[
                            "caption" => $value,
                            "key" => $key,
                            "type" => "image",
                            "downloadUrl" => Storage::disk(config('admin.upload.disk'))->url($value)
                        ];
                    }
                    return ($form->multipleImage($dataName, $label)
                        ->options([
                            'initialPreview' => array_map(function ($item) {
                                return Storage::disk(config('admin.upload.disk'))->url($item);
                            }, $items),
                            'initialPreviewConfig' => $initialPreviewConfig
                        ])->removable()->uniqueName());
                } else {
                    return ($form->multipleImage($dataName, $label)->removable()->uniqueName());
                }
            case 'select':
                $values = EavAttributeValueRepository::selectAttributeValueById(['value', 'id'], $attributeId)
                    ->pluck('value', 'id')->toArray();
                $form->select($dataName, $label)->options($values)->default($defaultValue);
                break;
            case 'multiple-select':
                $values = EavAttributeValueRepository::selectAttributeValueById(['value', 'id'], $attributeId)
                    ->pluck('value', 'id')->toArray();
                $form->multipleSelect($dataName, $label)->options($values)->default(json_decode($defaultValue));
                break;
            default:
                // code
        }
    }

    public static function checkIsRequire($number, $rules = null): string
    {
        return $number === true ? $rules : '';
    }

    /*
     * function name: checkIsBool
     *
     * @param int
     * 1 = true && 0 = false
     * Output true or false
     */
    public static function checkIsBool($input)
    {
        if (is_string($input)) {
            return $input == 'on' ? 1 : 0;
        } else {
            return $input;
        }
    }

    /**
     * @throws Exception
     */
    public function checkAttributeRequireIsNull($request, $attributeSetId): void
    {
        $attributes = $this->getAttributesByAttrSetId($attributeSetId);
        foreach ($attributes as $attribute) {
            /**
             * @var EavAttribute $attribute
             */
            if ($attribute->getIsRequire() == false) {
                continue;
            }
            if (is_null($request[$attribute->getAttributeDefaultName()])) {
                throw new Exception(
                    "Verify require attribute, " .
                    $attribute->getAttributeDefaultName() .
                    " can not be empty.");
            }
        }
    }

    /**
     * @return Builder|Model
     */
    public function getAttributeSetProductDefault()//: Model|Builder
    {
        return $this->eavAttributeSet->newQuery()
            ->where(
                EavAttributeSet::COL_UID,
                CatalogProduct::DEFAULT_PRODUCT_VALUE['ENTITY_TYPE'])->firstOrFail();
    }

    /**
     * @return Builder|Model
     */
    public function getAttributeSetCategoryDefault()//: Model|Builder
    {
        return $this->eavAttributeSet->newQuery()
            ->where(
                EavAttributeSet::COL_UID,
                CatalogCategory::DEFAULT_CATEGORY_VALUE['ENTITY_TYPE'])->firstOrFail();
    }
}
