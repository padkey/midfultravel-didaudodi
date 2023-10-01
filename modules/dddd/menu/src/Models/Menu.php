<?php

namespace DDDD\Menu\Models;

use DDDD\Blog\Models\Pages;
use DDDD\CatalogCategory\Models\CatalogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Menu extends Model
{

    const STYLE_OPTIONS = [
        'brand' => "Brand",
        'category' => "Category"
    ];

    const COL_ID = "id";
    const COL_NAME = "name";
    const COL_DESCRIPTION = "description";
    const COL_MENU_KEY = "menu_key";
    const COL_DISPLAY_STYLE = "display_style";
    const COL_DISPLAY_ORDER = "display_order";

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * Get the items for the banner.
     */
    public function items(): HasMany
    {
        return $this->HasMany(MenuItems::class, 'menu_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(
            CatalogCategory::class,
            'menu_category',
            'menu_id', 'category_id'
        );
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(
            Pages::class,
            'menu_page',
            'menu_id', 'page_id'
        );
    }
}
