<?php

namespace DDDD\Blog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pages
 * @package DTV\blog\Models
 */
class Companion extends Model
{
    const COL_ID = "id";
    const COL_CONTENT = "content";
    const COL_NAME = "name";
    const COL_IS_ACTIVE = "is_active";
    const COL_AVATAR = "avatar";
    const COL_META_TITLE = "meta_title";
    const COL_META_THUMBNAIL = "meta_thumbnail";
    const COL_META_KEYWORDS = "meta_keywords";
    const COL_META_DESCRIPTION = "meta_description";
    const COL_CREATED_AT = "created_at";
    const COL_URL_KEY = "url_key";
    const COL_UPDATED_AT = "updated_at";
    const COL_LOCALE_CODE = "locale_code";
    const COL_COMPANY_NAME = "company_name";
    const COL_POSITION = "position";

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companion';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_ID,
        self::COL_NAME,
        self::COL_IS_ACTIVE,
    ];

    /**
     * Pages constructor.
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
    public function getUrlKey() {
        return $this->getAttribute(self::COL_URL_KEY);
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->getAttribute(self::COL_NAME);
    }

    public function getSubject() {
        return $this->getAttribute(self::COL_NAME);
    }

    public function getFullLink(): string
    {
        return env('WEBSITE_BASE_URL') . $this->getUrlKey();
    }

    public function getImageAvatarAttribute($pictures)
    {
        return json_decode($pictures, true);
    }

    public function setImageAvatarAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['image_banner'] = json_encode($pictures);
        }
    }
}
