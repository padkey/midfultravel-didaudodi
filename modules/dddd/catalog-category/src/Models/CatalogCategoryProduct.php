<?php

namespace DDDD\CatalogCategory\Models;

use DDDD\CatalogProduct\Models\CatalogProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogCategoryProduct extends Model
{
    protected $table = 'catalog_category_product';

    protected $fillable = ['category_id', 'product_id'];
    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(CatalogCategory::class, 'category_id', 'entity_id');
    }

    public function product(): BelongsTo
    {
       return $this->belongsTo(CatalogProduct::class, 'product_id', 'entity_id');
    }
}
