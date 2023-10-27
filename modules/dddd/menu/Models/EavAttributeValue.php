<?php

namespace DTV\EAVAttribute\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EavAttributeValue extends Model
{
    use SoftDeletes;

    const COL_ID = 'id';
    const COL_VALUE = 'value';
    const COL_ATTRIBUTE_ID = 'attribute_id';

    protected $table = 'eav_attribute_value';

    protected $fillable = ['value', 'attribute_id'];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(EavAttribute::class, 'attribute_id', 'attribute_id');
    }

    public function getValue()
    {
        return $this->getAttribute(self::COL_VALUE);
    }
}
