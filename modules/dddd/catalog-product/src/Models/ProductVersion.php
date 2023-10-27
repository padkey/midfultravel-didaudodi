<?php

namespace DDDD\CatalogProduct\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductVersion extends Model
{
    protected $table = 'product_version';

    const COL_ID = "id";
    const COL_DISPLAY_TITLE = "display_title";
    const COL_PRODUCT_ID = "product_id";
    const COL_POSITION = "position";
    const COL_PRODUCT_VERSION_GROUP_ID = "product_version_group_id";

    /**
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(
            CatalogProduct::class,
            CatalogProduct::COL_ENTITY_ID,
            self::COL_PRODUCT_ID
        );
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
    public function group(): HasOne
    {
        return $this->hasOne(
            ProductVersionGroup::class,
            ProductVersionGroup::COL_ID,
            self::COL_PRODUCT_VERSION_GROUP_ID
        );
    }

    /**
     * @return ProductVersionGroup
     */
    public function getGroup(): ProductVersionGroup
    {
        /**
         * @var ProductVersionGroup $productVersionGroup
         */
        $productVersionGroup = $this->group()->first();
        return $productVersionGroup;
    }
}
