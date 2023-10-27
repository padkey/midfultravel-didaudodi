<?php

namespace DDDD\CatalogProduct\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductHotSale extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_hot_sale';

    const COL_DISPLAY_ORDER = 'display_order';
    const COL_PRICE_SOUTHERN_REGION = 'price_southern_region';
    const COL_PRICE_NORTHERN_RIGION = 'price_northern_region';
    const COL_PRODUCT_ID = 'product_id';
    const COL_HOT_SALE_ID = 'hot_sale_id';

    /**
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(CatalogProduct::class, CatalogProduct::COL_ENTITY_ID, self::COL_PRODUCT_ID);
    }

    /**
     * @return CatalogProduct
     */
    public function getProduct(): CatalogProduct
    {
        /**
         * @var CatalogProduct $product
         */
        $product = $this->product()->first();
        return $product;
    }

    /**
     * @return HasOne
     */
    public function hotsale(): HasOne
    {
        return $this->hasOne(HotSale::class, HotSale::COL_ID, self::COL_HOT_SALE_ID);
    }

    /**
     * @return HotSale
     */
    public function getHotsale(): HotSale
    {
        /**
         * @var HotSale $hotsale
         */
        $hotsale = $this->hotsale()->first();
        return $hotsale;
    }
}
