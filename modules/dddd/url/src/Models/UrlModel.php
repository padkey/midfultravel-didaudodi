<?php

namespace DDDD\Url\Models;

use DDDD\Blog\Models\BlogCategory;
use DDDD\Blog\Models\BlogPost;
use DDDD\Blog\Models\BlogTag;
use DDDD\Blog\Models\Video;
use DDDD\Blog\Models\Companion;
use DDDD\Blog\Models\Pages;
use DDDD\Tour\Models\Partnership;

use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Models\ProductTag;
use Illuminate\Database\Eloquent\Model;

class UrlModel extends Model
{
    const COL_ID = 'id';
    const COL_REQUEST_PATH = "request_path";
    const COL_ENTITY_TYPE = "entity_type";
    const COL_ENTITY_ID = "entity_id";
    const COL_TARGET_PATH = "target_path";
    const COL_REDIRECT_TYPE = "redirect_type";
    const ENTITY_TYPE_CUSTOM = "custom";
    const ENTITY_TYPE_CUSTOM_ID = 0;
    const NO_REDIRECT_TYPE = 0;

    const ENTITY_TYPE_CATALOG_PRODUCT = "catalog-product";
    const ENTITY_TYPE_CATALOG_CATEGORY = "catalog-category";
    const ENTITY_TYPE_BLOG_POST = "blog-post";
    const ENTITY_TYPE_BLOG_CATEGORY = "blog-category";
    const ENTITY_TYPE_PAGES = "pages";
    const ENTITY_TYPE_PRODUCT_TAG = "product-tag";
    const ENTITY_TYPE_BLOG_TAG = "blog-tag";
    const ENTITY_TYPE_TOUR = "tour";
    const ENTITY_TYPE_VIDEO = "video";
    const ENTITY_TYPE_COMPANION = "companion";
    const ENTITY_TYPE_PARTNERSHIP = "partnership";
    const ENTITY_TYPE_PARTNERSHIP_BRANCH = "partnership-branch";

    protected $primaryKey = self::COL_ID;

    const MAPPING_ENTITY = [
      self::ENTITY_TYPE_BLOG_POST => BlogPost::class,
      self::ENTITY_TYPE_BLOG_CATEGORY => BlogCategory::class,
      self::ENTITY_TYPE_PAGES => Pages::class,
      self::ENTITY_TYPE_CATALOG_PRODUCT => CatalogProduct::class,
      self::ENTITY_TYPE_CATALOG_CATEGORY => CatalogCategory::class,
      self::ENTITY_TYPE_PRODUCT_TAG => ProductTag::class,
      self::ENTITY_TYPE_BLOG_TAG => BlogTag::class,
      self::ENTITY_TYPE_TOUR => Partnership::class,
      self::ENTITY_TYPE_VIDEO => Video::class,
      self::ENTITY_TYPE_COMPANION => Companion::class,
      self::ENTITY_TYPE_PARTNERSHIP => PartnerShip::class,
      self::ENTITY_TYPE_PARTNERSHIP_BRANCH => PartnerShipBranch::class,

    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'url_manage';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_REQUEST_PATH,
        self::COL_TARGET_PATH,
        self::COL_REDIRECT_TYPE
    ];

    /**
     * @return Model
     */
    public function getEntityModel(): Model
    {
        /**
         * @var Model $model
         */
        $model = self::MAPPING_ENTITY[$this->getAttribute(self::COL_ENTITY_TYPE)];
        return $model::query()->findOrFail($this->getAttribute(self::COL_ENTITY_ID));
    }

    public function getFullRequestPath(): string
    {
        return env('WEBSITE_BASE_URL') . $this->getAttribute(self::COL_REQUEST_PATH);
    }
}
