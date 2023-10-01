<?php

namespace DTV\Banner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class BannerItems extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banner_items';

    /**
     * Get the banner for the current item.
     */
    public function banner(): BelongsTo
    {
        return $this->belongsTo(Banner::class, 'banner_id', 'id');
    }
}
