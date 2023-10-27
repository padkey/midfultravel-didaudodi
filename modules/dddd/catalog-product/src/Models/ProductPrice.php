<?php

namespace DDDD\CatalogProduct\Models;

use DDDD\Shop\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductPrice extends Model
{
    /**
     * @var string
     */
    protected $table = 'web_prices';

    const COL_SKU = "sku";
    const COL_PROVINCE_ID = "province_id";
    const COL_PRICE = "price";
    const COL_SPECIAL_PRICE = "sale_price";
    const COL_PROMOTION_ID = "promotion_id";

    /**
     * @return HasOne
     */
    public function province(): HasOne
    {
        return $this->hasOne(Province::class, Province::COL_ID, self::COL_PROVINCE_ID);
    }

    /**
     * @return Province
     */
    public function getProvince(): Province
    {
        /**
         * @var Province $province
         */
        $province = $this->province()->first();
        return $province;
    }

    public function getBasePrice()
    {
        return $this->getAttribute(self::COL_PRICE);
    }

    public function getSpecialPrice()
    {
        return $this->getAttribute(self::COL_SPECIAL_PRICE);
    }
}
