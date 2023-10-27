<?php

namespace DDDD\EAVAttribute\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EavAttributeSet extends Model
{
    use SoftDeletes;

    const COL_ATTRIBUTE_SET_ID = 'attribute_set_id';
    const COL_ATTRIBUTE_SET_NAME = 'attribute_set_name';
    const COL_ATTRIBUTE_SET_GROUP = 'attribute_set_group';
    const COL_UID = 'uid';
    const COL_IS_SYSTEM = 'is_system';
    const COL_CREATED_AT = 'created_at';
    const COL_UPDATED_AT = 'updated_at';

    const ATTRIBUTE_DEFAULT_VALUE = [
        'product'   => 'Product',
        'category'  => 'Category'
    ];

    const ATTRIBUTE_EAV_DEFAULT_ID = [
        'product'   => 1,
        'category'  => 2
    ];

    protected $table = 'eav_attribute_set';
    protected $primaryKey = 'attribute_set_id';
    protected $fillable = ['attribute_set_name', 'attribute_set_group'];

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            EavAttributeGroup::class,
            'eav_attribute_set_group',
            'attribute_set_id', 'attribute_group_id'
        );
    }

    public function getAttributeSetId() {
        return $this->getAttribute(self::COL_ATTRIBUTE_SET_ID);
    }

    public function getUID() {
        return $this->getAttribute(self::COL_UID);
    }

    public function getAttributeSetName() {
        return $this->getAttribute(self::COL_ATTRIBUTE_SET_NAME);
    }
}
