<?php

namespace DDDD\CatalogProduct\Models;

//use DDDD\Blog\Models\TrailAuthorModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductTag extends Model
{
    protected $table = 'product_tag';

   // use TrailAuthorModel;

    const PREFIX = 'the-san-pham';

    const COL_ID = 'id';
    const COL_TAG_KEY = 'tag_key';
    const COL_NAME = 'name';
    const COL_DESCRIPTION = 'description';
    const COL_META_TITLE = 'meta_title';
    const COL_META_DESCRIPTION = 'meta_description';
    const COL_META_KEYWORDS = 'meta_keywords';

    const COL_META_THUMBNAIL = 'meta_thumbnail';
    const COL_META_INDEX = "meta_index";
    const COL_META_FOLLOW = "meta_follow";
    const COL_CANONICAL_TAG = "canonical_tag";
    const COL_CREATED_AT = "created_at";
    const COL_UPDATED_AT = "updated_at";

    protected $fillable = [
        self::COL_ID,
        self::COL_TAG_KEY,
        self::COL_NAME,
        self::COL_DESCRIPTION,
        self::COL_META_TITLE,
        self::COL_META_DESCRIPTION,
        self::COL_META_KEYWORDS,
        self::COL_META_THUMBNAIL
    ];

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
            'product_tag_relation',
            'tag_id', 'product_id'
        );
    }

    public function getId()
    {
        return $this->getAttribute(self::COL_ID);
    }

    public function getTagKey()
    {
        return $this->getAttribute(self::COL_TAG_KEY);
    }

    public function getName()
    {
        return $this->getAttribute(self::COL_NAME);
    }

    public function getDescription()
    {
        return $this->getAttribute(self::COL_DESCRIPTION);
    }

    public function getMeteTitle()
    {
        return $this->getAttribute(self::COL_META_TITLE);
    }

    public function getMetaDescription()
    {
        return $this->getAttribute(self::COL_META_DESCRIPTION);
    }

    public function getMetaKeywords()
    {
        return $this->getAttribute(self::COL_META_KEYWORDS);
    }

    public function getMetaThumbnail()
    {
        return $this->getAttribute(self::COL_META_THUMBNAIL);
    }

    public function getSubject() {
        return $this->getAttribute(self::COL_NAME);
    }

    public function getFullLink()
    {
        return env('WEBSITE_BASE_URL') . "the-san-pham/" . $this->getTagKey();
    }
}
