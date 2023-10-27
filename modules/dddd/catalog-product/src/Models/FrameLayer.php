<?php

namespace DDDD\CatalogProduct\Models;

use DDDD\CatalogCategory\Models\CatalogCategory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class FrameLayer extends Model
{
    protected $table = 'frame_layer';

    const COL_ID = 'id';
    const COL_NAME = 'name';
    const COL_TYPE = 'type';
    const COL_IMAGE = 'image';
    const COL_START = 'start';
    const COL_END = 'end';

    /**
     * @return BelongsToMany
     */
    function products(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogProduct::class,
            'product_frame_layer',
            'frame_layer_id',
            'product_id'
        );
    }

    function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogCategory::class,
            'category_frame_layer',
            'frame_layer_id',
            'category_id'
        );
    }

}
