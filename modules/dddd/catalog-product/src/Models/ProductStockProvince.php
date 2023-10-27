<?php

namespace DDDD\CatalogProduct\Models;

use DDDD\Shop\Models\Province;
use DDDD\Shop\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductStockProvince extends Model
{
    protected $table = 'province_stocks';

    const COL_PRODUCT_ID = "product_id";
    const COL_PROVINCE_ID = "province_id";
    const COL_STOCK_STATUS_ID = "stock_status_id";
    const COL_STOCK_AVAILABLE = "stock_available";
    const COL_STOCK = "stock";

    const COL_SKU = "sku";

    const OUT_OF_STOCK_AVAILABLE = 'Subscription';

    public $incrementing = false;
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'province_id',
        'sku',
        'stock_available',
        'stock_status_id',
        'stock',
        'updated_at'
    ];

    public function isInStock(): bool
    {
        return !($this->getAttribute(self::COL_STOCK_AVAILABLE) == self::OUT_OF_STOCK_AVAILABLE);
    }
}
