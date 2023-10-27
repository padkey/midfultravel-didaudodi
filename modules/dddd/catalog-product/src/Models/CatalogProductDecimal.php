<?php

namespace DDDD\CatalogProduct\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogProductDecimal extends Model implements CatalogProductType
{
    protected $table = 'catalog_product_entity_decimal';
    protected $primaryKey = self::COL_VALUE_ID;
    protected $fillable = [
        self::COL_VALUE,
        self::COL_ENTITY_ID,
        self::COL_ATTRIBUTE_ID
    ];

    public function getValue()
    {
        return $this->getAttribute(self::COL_VALUE);
    }
}
