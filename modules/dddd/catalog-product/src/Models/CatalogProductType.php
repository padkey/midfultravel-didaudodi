<?php

namespace DDDD\CatalogProduct\Models;

interface CatalogProductType {
    const COL_VALUE = 'value';
    const COL_VALUE_ID = 'value_id';
    const COL_ENTITY_ID = 'entity_id';
    const COL_ATTRIBUTE_ID = 'attribute_id';
    public function getValue();
}
