<?php

namespace DDDD\CatalogProduct\Models;

use DDDD\EAVAttribute\Models\EavAttribute;
use DDDD\EAVAttribute\Repositories\EavAttributeValueRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogProductInt extends Model implements CatalogProductType
{

    protected $table = 'catalog_product_entity_int';
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
        if ($attribute->getAttributeType() == EavAttribute::TYPE_BOOLEAN) {
            return $this->getAttribute(self::COL_VALUE) == 1;
        }

        if ($attribute->getAttributeType() == EavAttribute::TYPE_SELECT) {
            return EavAttributeValueRepository::getValueById($this->getAttribute(self::COL_VALUE));
        }

        return $this->getAttribute(self::COL_VALUE);
    }

    public function getAttributeDefaultName()
    {
        /**
         * @var EavAttribute $attribute
         */
        $attribute = $this->eavAttribute()->first();
        return $attribute->getAttributeDefaultName();
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
