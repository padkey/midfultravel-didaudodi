<?php

namespace DDDD\CatalogProduct\Models;

use DDDD\Shop\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductRaw extends Model
{
    /**
     * @var string
     */
    protected $table = 'raw_products';

    const COL_SKU = "sku";
    const COL_PRODUCT_ID = "product_id";
}
