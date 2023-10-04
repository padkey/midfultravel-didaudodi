<?php

namespace DDDD\Tour\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TourModel extends Model
{
    const COL_ID = "id";
    const COL_NAME = "name";
    const COL_IMAGE = "image";
    const COL_IMAGE_THUMBNAIL = "image_thumbnail";
    const COL_META_TITLE = "meta_title";
    const COL_META_THUMBNAIL = "meta_thumbnail";
    const COL_META_KEYWORDS = "meta_keywords";
    const COL_META_DESCRIPTION = "meta_description";
    const COL_SHORT_DESCRIPTION = "short_description";
    const COL_CONTENT = "content";
    const COL_URL = "url";
    const COL_CREATED_AT = "created_at";
    const COL_UPDATED_AT = "updated_at";
    const COL_IS_ACTIVE = "is_active";
    const COL_DATE_END = "date_end";
    const COL_DATE_START = "date_start"; 
    const COL_TYPE_TOUR = "type_tour"; 

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tour';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_ID,
        self::COL_URL,
        self::COL_NAME,
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
        return $this->getAttribute(self::COL_NAME);
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
        return $this->getAttribute(self::COL_NAME);
    }

    public function getFullLink(): string
    {
        return env('WEBSITE_BASE_URL') . $this->getUrl();
    }

    /**
     * @param $pictures
     * @return mixed
     */
    // public function getImageBannerAttribute($pictures)
    // {
    //     return json_decode($pictures, true);
    // }

    // public function setImageBannerAttribute($pictures)
    // {
    //     if (is_array($pictures)) {
    //         $this->attributes['image_banner'] = json_encode($pictures);
    //     }
    // }

    // public function categories()
    // {
    //     return $this->belongsToMany(BlogCategory::class, 'blog_post_category_relation',
    //         'blog_post_id', 'blog_category_id');
    // }

    // /**
    //  * @return BelongsToMany
    //  */
    // public function relatedPosts()
    // {
    //     return $this->belongsToMany(BlogPost::class, 'blog_post_related_post',
    //         'blog_post_id', 'related_id');
    // }
}