<?php

namespace DDDD\Partnership\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PartnershipBranch extends Model
{
    const COL_ID = "id";
    const COL_NAME = "name";
    const COL_IMAGE = "image";
    const COL_SHORT_DESCRIPTION = "short_description";
    const COL_DESCRIPTION = "description";
    const COL_ADDRESS = "address";
    const COL_URL = "url";

    const COL_PARTNERSHIP_ID = "partnership_id";
    const COL_LOCALE_CODE = 'locale_code';



    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partnership_branch';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_ID,
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


    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->getAttribute(self::COL_NAME);
    }
    public function partnership(): BelongsTo
    {
        return $this->belongsTo(Partnership::class, 'partnership_id', 'id');
    }
    public function getUrl() {
        return self::COL_URL;
    }
    public function tourPartnershipBranch(){
        return $this->belongsToMany(PartnershipBranch::class,'tour_partnership_branch','partnership_branch_id','tour_id');
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
