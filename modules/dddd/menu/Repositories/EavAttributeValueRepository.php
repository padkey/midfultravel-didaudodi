<?php

namespace DTV\EAVAttribute\Repositories;

use DTV\EAVAttribute\Models\EavAttributeValue;

class EavAttributeValueRepository
{
    public static function selectAttributeValueById($select = [], $attributeId)
    {
        return EavAttributeValue::where('attribute_id', $attributeId)
            ->select($select)
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getValueById($id) {
        return EavAttributeValue::query()->findOrFail($id)->value;
    }
}
