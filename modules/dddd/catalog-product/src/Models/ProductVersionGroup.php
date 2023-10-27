<?php

namespace DDDD\CatalogProduct\Models;

//use DDDD\Blog\Models\TrailAuthorModel;
use DDDD\Shop\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductVersionGroup extends Model
{
    protected $table = 'product_version_group';
  //  use TrailAuthorModel;

    const COL_NAME = 'name';
    const COL_ID = 'id';
    const COL_POSITION = 'position';
    const COL_DISPLAY_TITLE = 'display_title';
    const COL_IS_DISPLAY_TITLE = 'is_display_title';

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
            'product_version',
            ProductVersion::COL_PRODUCT_VERSION_GROUP_ID,
            ProductVersion::COL_PRODUCT_ID
        );
    }

    /**
     * @return HasMany
     */
    function versions(): HasMany
    {
        return $this->hasMany(ProductVersion::class,
            ProductVersion::COL_PRODUCT_VERSION_GROUP_ID,
            self::COL_ID
        );
    }
}
