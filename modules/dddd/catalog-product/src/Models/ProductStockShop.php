<?php

namespace DDDD\CatalogProduct\Models;

use DDDD\Shop\Models\Province;
use DDDD\Shop\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductStockShop extends Model
{
    /**
     * @var string
     */
    protected $table = 'shop_stocks';

    const COL_PRODUCT_SKU = "product_sku";
    const COL_QUANTITY = "quantity";
    const COL_SHOP_ID = "shop_id";
    const COL_PROVINCE_ID = "province_id";

    public function shop(): HasOne
    {
        return $this->hasOne(Shop::class, Shop::COL_ID, self::COL_SHOP_ID);
    }

    /**
     * @return Shop
     */
    public function getShop(): Shop
    {
        /**
         * @var Shop $shop
         */
        $shop = $this->shop()->first();
        return $shop;
    }

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
}
