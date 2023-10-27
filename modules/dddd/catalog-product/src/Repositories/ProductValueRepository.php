<?php

namespace DDDD\CatalogProduct\Repositories;

class ProductValueRepository
{

    /**
     * @param $model
     * @param $value
     * @param $entityId
     * @param $attributeId
     * @return void
     */
    public function insertOrUpdateProductValue($model, $value, $entityId, $attributeId) {
        $model::query()->upsert(
            [
                'entity_id' =>  $entityId,
                'attribute_id' => $attributeId,
                'value' => $value
            ],
            ['entity_id', 'attribute_id'],
            ['value']
        );
    }

    /**
     * @param $model
     * @param $value
     * @param $entityId
     * @param $attributeId
     */
    function insertProductValue($model, $value, $entityId, $attributeId): void
    {
        $model::create([
            'value' => $value,
            'entity_id' => $entityId,
            'attribute_id' => $attributeId
        ]);
    }

    /**
     * @param $model
     * @param $value
     */
    function updateProductValue($model, $value): void
    {
        $model->update([
            'value' => $value
        ]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param integer $entityId
     * @param integer $attributeId
     * @return mixed
     */
    public function getAttributeProductValue($model, $entityId, $attributeId)
    {
        return $model::where('entity_id', $entityId)
            ->where('attribute_id', $attributeId)
            ->first();
    }

    /**
     * @param $model
     * @param $modelName
     * @param $entityId
     * @return mixed
     */
    public static function selectValueAttributeOfProduct($model, $modelName, $entityId)
    {
        return $model::where("{$modelName}.entity_id", $entityId)
            ->join('eav_attribute', 'eav_attribute.attribute_id', '=', "{$modelName}.attribute_id")
            ->select(
                'eav_attribute.*',
                "{$modelName}.value",
            )
            ->get();
    }
}
