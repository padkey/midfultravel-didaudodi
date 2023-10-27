<?php

namespace DDDD\CatalogProduct\Models;

use DDDD\EAVAttribute\Models\EavAttribute;
use DDDD\EAVAttribute\Models\EavAttributeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogProductVarchar extends Model implements CatalogProductType
{

    protected $table = 'catalog_product_entity_varchar';
    protected $primaryKey = self::COL_VALUE_ID;
    protected $fillable = [
        self::COL_VALUE,
        self::COL_ENTITY_ID,
        self::COL_ATTRIBUTE_ID
    ];

    public function getValue()
    {
        /**
         * @var EavAttribute $attribute
         */
        $attribute = $this->eavAttribute()->first();
        if ($attribute->getAttributeType() == EavAttribute::TYPE_MULTIPLE_SELECT) {
            return EavAttributeValue::query()->whereIn(
                EavAttributeValue::COL_ID,
                json_decode($this->getAttribute(self::COL_VALUE)))
                ->get();
        }
        return $this->getAttribute(self::COL_VALUE);
    }

    /**
     * @return HasOne
     */
    public function eavAttribute(): HasOne
    {
        return $this->hasOne(
            EavAttribute::class,
            EavAttribute::COL_ATTRIBUTE_ID,
            self::COL_ATTRIBUTE_ID);
    }
}
