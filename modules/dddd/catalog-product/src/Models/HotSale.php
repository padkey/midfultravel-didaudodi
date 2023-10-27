<?php

namespace DDDD\CatalogProduct\Models;

//use DDDD\Blog\Models\TrailAuthorModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HotSale extends Model
{
    //use TrailAuthorModel;

    const MAP_TYPE_PRICE = [
      'origin' => 'Origin',
      'custom' => 'Custom'
    ];

    /**
     * @var string
     */
    protected $table = 'hot_sale';

    const COL_ID = 'id';
    const COL_CODE = 'code';
    const COL_NAME = 'name';
    const COL_COLOR = 'color';
    const COL_COLOR_TWO = 'color_two';
    const COL_COLOR_TEXT = 'color_text';
    const COL_IMAGE = 'image';
    const COL_LINK = 'link';
    const COL_IS_COUNT_DOWN = 'is_count_down';
    const COL_TIME_COUNT_DOWN = 'time_count_down';
    const COL_START = 'start';
    const COL_END = 'end';
    const COL_TYPE_PRICE_APPLY = 'type_price_apply';

    const COL_AUTHOR_UPDATE_ID = "author_update_id";
    const COL_AUTHOR_ID = "author_id";
    const COL_AUTHOR_NAME_EXT = "author_name";
    const COL_AUTHOR_UPDATE_NAME_EXT = "author_update_name";

    protected $appends = [
        self::COL_AUTHOR_NAME_EXT,
        self::COL_AUTHOR_UPDATE_NAME_EXT
    ];

    /**
     * @return BelongsToMany
     */
    function products(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogProduct::class,
            'product_hot_sale',
            ProductHotSale::COL_HOT_SALE_ID,
            ProductHotSale::COL_PRODUCT_ID
        );
    }
}
