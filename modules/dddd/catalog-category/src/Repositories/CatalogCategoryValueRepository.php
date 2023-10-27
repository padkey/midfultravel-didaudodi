<?php

namespace DDDD\CatalogCategory\Repositories;

use DDDD\CatalogCategory\Models\CatalogCategoryValue;
use DDDD\EAVAttribute\Repositories\EavAttributeRelationRepository;
use DDDD\EAVAttribute\Models\EavAttributeGroup;

class CatalogCategoryValueRepository
{

    private CatalogCategoryValue $catalogCategoryValue;

    private $eavAttributeGroup;

    function __construct(
        CatalogCategoryValue $catalogCategoryValue,
        EavAttributeGroup $eavAttributeGroup
    ) {
        $this->catalogCategoryValue = $catalogCategoryValue;
        $this->eavAttributeGroup = $eavAttributeGroup;
    }

    public function upsertCategoryValue($value, $entity_id, $attribute_id) {
        $this->catalogCategoryValue
            ->newQuery()
            ->upsert([
                'value'         =>  $value,
                'entity_id'     =>  $entity_id,
                'attribute_id'  =>  $attribute_id
            ],
            ['entity_id', 'attribute_id'],
            ['value']);
    }

    function insertCategoryValue($value, $entity_id, $attribute_id)
    {
        $this->catalogCategoryValue::create([
                'value'         =>  $value,
                'entity_id'     =>  $entity_id,
                'attribute_id'  =>  $attribute_id
        ]);
    }

    function getAttrCategoryValues($attrIds, $entityId): array
    {
        return CatalogCategoryValue::where('catalog_category_value_entity.entity_id', $entityId)
           ->whereIn('catalog_category_value_entity.attribute_id', $attrIds)
            ->join('eav_attribute', 'eav_attribute.attribute_id', '=', 'catalog_category_value_entity.attribute_id')
            ->get()->toArray();
    }

    function updateCategoryValue($categoryValue, $value){
        $categoryValue->update([
            'value'  => $value
        ]);
    }
}
