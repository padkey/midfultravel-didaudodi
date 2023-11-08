<?php

namespace DDDD\Tour\Models;

//use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
//use Encore\Admin\Traits\ModelTree;

class TourSchedule extends Model
{

    const COL_ID = "id";
    const COL_TITLE = "title";
    const COL_SUB_TITLE = "sub_title";

    const COL_DESCRIPTION = "description";
    const COL_POSITION = "position";
    const COL_TOUR_ID = "tour_id";
    const COL_ORDER = "order";


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tour_schedule';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_ID,
        self::COL_TITLE,
        self::COL_ORDER
    ];

    /**
     * BlogPost constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
/*        $this->setParentColumn(self::COL_TOUR_ID);
        $this->setOrderColumn(self::COL_ORDER);
        $this->setTitleColumn(self::COL_TITLE);*/
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
        return $this->getAttribute(self::COL_TITLE);
    }
    public function tour(): BelongsTo
    {
        return $this->belongsTo(tour::class, 'tour_id', 'id');
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
