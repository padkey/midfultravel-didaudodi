<?php

namespace DDDD\Banner\Models;

use DDDD\Blog\Models\Pages;
use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogProduct\Models\CatalogProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Banner extends Model
{
    const COL_ID = 'id';
    const COL_NAME = 'name';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banner';

    protected $casts = [
        'category_id' => 'json',
    ];

    /**
     * Get the items for the banner.
     */
    public function items(): HasMany
    {
        return $this->hasMany(BannerItems::class, 'banner_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogProduct::class,
            'banner_product',
            'banner_id', 'product_id'
        );
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogCategory::class,
            'banner_category',
            'banner_id', 'category_id'
        );
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(
            Pages::class,
            'banner_page',
            'banner_id', 'page_id'
        );
    }
}
