<?php

namespace DDDD\CatalogProduct\Models;

use DDDD\CatalogCategory\Models\CatalogCategory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class TextPromotionGroup extends Model
{
    protected $table = 'text_promotion_group';

    const COL_ID = 'id';
    const COL_URL = 'url';
    const COL_TEXT = 'text';
    const COL_ADDITIONAL_INFO = 'additional_info';

    /**
     * @return BelongsToMany
     */
    function products(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogProduct::class,
            'text_promotion_product',
            'text_promotion_group_id',
            'product_id'
        );
    }

    function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogCategory::class,
            'text_promotion_category',
            'text_promotion_group_id',
            'category_id'
        );
    }

}
