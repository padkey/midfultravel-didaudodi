<?php

namespace DDDD\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogPost extends Model
{
    const COL_ID = "id";
    const COL_TITLE = "title";
    const COL_IMAGE_BANNER = "image_banner";
    const COL_IMAGE_THUMBNAIL = "image_thumbnail";
    const COL_META_TITLE = "meta_title";
    const COL_META_THUMBNAIL = "meta_thumbnail";
    const COL_META_KEYWORDS = "meta_keywords";
    const COL_META_DESCRIPTION = "meta_description";
    const COL_META_INDEX = "meta_index";
    const COL_META_FOLLOW = "meta_follow";
    const COL_CANONICAL_TAG = "canonical_tag";
    const COL_ALT_THUMBNAIL = "alt_thumbnail";
    const COL_CONTENT_HEADER = "content_header";
    const COL_SHORT_DESCRIPTION = "short_description";
    const COL_CONTENT = "content";
    const COL_URL = "url";
    const COL_CREATED_AT = "created_at";
    const COL_AUTHOR_ID = "author_id";
    const COL_UPDATED_AT = "updated_at";
    const COL_IS_ACTIVE = "is_active";
    const COL_PUBLIC_DATE = "public_date";
    const COL_LOCALE_CODE = "locale_code";

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_post';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_ID,
        self::COL_URL,
        self::COL_TITLE,
    ];

    /**
     * BlogPost constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }


    /**
     * @return mixed
     */
    public function getId() {
        return $this->getAttribute(self::COL_ID);
    }

    /**
     * @return mixed
     */
    public function getUrl() {
        return $this->getAttribute(self::COL_URL);
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->getAttribute(self::COL_TITLE);
    }

    public function getImageThumbnail() {
        return $this->getAttribute(self::COL_IMAGE_THUMBNAIL);
    }

    public function getShortDescription() {
        return $this->getAttribute(self::COL_SHORT_DESCRIPTION);
    }

    public function getMetaDescription() {
        return $this->getAttribute(self::COL_META_DESCRIPTION);
    }

    public function getIsActive() {
        return $this->getAttribute(self::COL_IS_ACTIVE);
    }

    public function getCreatedAt() {
        return $this->getAttribute(self::COL_CREATED_AT);
    }

    public function getUpdatedAt() {
        return $this->getAttribute(self::COL_UPDATED_AT);
    }

    public function getSubject() {
        return $this->getAttribute(self::COL_TITLE);
    }

    public function getFullLink(): string
    {
        return env('WEBSITE_BASE_URL') . $this->getUrl();
    }

    /**
     * @param $pictures
     * @return mixed
     */
    public function getImageBannerAttribute($pictures)
    {
        return json_decode($pictures, true);
    }

    public function setImageBannerAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['image_banner'] = json_encode($pictures);
        }
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_category_relation',
            'blog_post_id', 'blog_category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function relatedPosts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_related_post',
            'blog_post_id', 'related_id');
    }
}
