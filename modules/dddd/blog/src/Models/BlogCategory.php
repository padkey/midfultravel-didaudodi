<?php

namespace DDDD\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyAlias;

class BlogCategory extends Model
{
    use ModelTree, AdminBuilder;

    const COL_ID = "id";
    const COL_TITLE = "title";
    const COL_IMAGE_BANNER = "image_banner";
    const COL_IMAGE_THUMBNAIL = "image_thumbnail";
    const COL_META_TITLE = "meta_title";
    const COL_META_THUMBNAIL = "meta_thumbnail";
    const COL_META_KEYWORDS = "meta_keywords";
    const COL_META_DESCRIPTION = "meta_description";
    const COL_CONTENT_HEADER = "content_header";
    const COL_SHORT_DESCRIPTION = "short_description";
    const COL_CONTENT = "content";
    const COL_URL = "url";
    const COL_POSITION = "position";
    const COL_PARENT_ID = "parent_id";
    const COL_CREATED_AT = "created_at";
    const COL_UPDATED_AT = "updated_at";
    const COL_IS_ACTIVE = "is_active";
    const COL_PATH_LEVEL = "path_level";

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_category';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_ID,
        self::COL_URL,
        self::COL_TITLE
    ];

    /**
     * BlogCategory constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setParentColumn(self::COL_PARENT_ID);
        $this->setOrderColumn(self::COL_POSITION);
        $this->setTitleColumn(self::COL_TITLE);
    }

    /**
     * @return BelongsToManyAlias
     */
    public function posts()
    {
        return $this->belongsToMany(
            BlogPost::class,
            'blog_post_category_relation',
            'blog_category_id',
            'blog_post_id');
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
    public function getSubject() {
        return $this->getAttribute(self::COL_TITLE);
    }

    public function getFullLink(): string
    {
        return env('WEBSITE_BASE_URL') . $this->getUrl();
    }
    

}