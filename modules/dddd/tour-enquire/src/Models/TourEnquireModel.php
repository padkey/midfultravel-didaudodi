<?php

namespace DDDD\TourEnquire\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourEnquireModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tour_enquire';

    const COL_ID = "id";
    const COL_STATUS = "status";
    const COL_CUSTOMER_NAME = "customer_name";
    const COL_CUSTOMER_PHONE = "customer_phone";
    const COL_CUSTOMER_EMAIL = "customer_email";
    const COL_CUSTOMER_MESSAGE = "customer_message";
    const COL_TOUR_ID = "tour_id";
    const COL_ADMIN_NOTE= "admin_note";
    const COL_RESPONSE_MESSAGE_TO_EMAIL= "response_message_to_email";


    const STATUS_PENDING = "pending";
    const STATUS_COMPLETE = "complete";

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_STATUS,
        self::COL_CUSTOMER_NAME,
        self::COL_CUSTOMER_PHONE,
        self::COL_CUSTOMER_EMAIL,
        self::COL_CUSTOMER_MESSAGE,
        self::COL_TOUR_ID,
        self::COL_ADMIN_NOTE,
        self::COL_ID,
        ];

    public function tour():BelongsTo{
        return $this->belongsTo(TourModel::class,'tour_id','id');
    }

}
