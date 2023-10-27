<?php

namespace DDDD\Partnership\Models;

use Illuminate\Database\Eloquent\Model;

class TourPartnershipBranch extends Model
{
    const COL_ID = "id";
    const COL_TOUR_ID = "tour_id";
    const COL_PARTNERSHIP_BRANCH_ID = "partnership_branch_id";


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tour_partnership_branch';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_ID,
        self::COL_TOUR_ID,
        self::COL_PARTNERSHIP_BRANCH_ID,
      //  self::COL_NAME,
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
        //return $this->getAttribute(self::COL_NAME);
    }

    public function getUrl() {
      //  return self::COL_URL;
    }


}
