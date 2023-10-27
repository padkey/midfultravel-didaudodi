<?php

namespace DDDD\EAVAttribute\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EavAttributeGroup extends Model
{
    use SoftDeletes;

    const COL_ATTRIBUTE_GROUP_ID = 'attribute_group_id';
    const COL_ATTRIBUTE_GROUP_NAME = 'attribute_group_name';
    const COL_UID = 'uid';
    const COL_IS_SYSTEM = 'is_system';
    const COL_CREATED_AT = "created_at";
    const COL_UPDATED_AT = "updated_at";

    protected $table = 'eav_attribute_group';

    protected $primaryKey = 'attribute_group_id';

    protected $fillable = ['attribute_group_id', 'uid', 'attribute_group_name'];

    /**
     * @return BelongsToMany
     */
    public function attributeSets(): BelongsToMany
    {
        return $this->belongsToMany(
            EavAttributeSet::class,
            'eav_attribute_set_group',
            'attribute_group_id', 'attribute_set_id'
        );
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(
            EavAttribute::class,
            'eav_attribute_relation',
            'attribute_group_id', 'attribute_id'
        );
    }

    public function getAttributeGroupName() {
        return $this->getAttribute(self::COL_ATTRIBUTE_GROUP_NAME);
    }

    public function getAttributeGroupId() {
        return $this->getAttribute(self::COL_ATTRIBUTE_GROUP_ID);
    }

    public function getUID() {
        return $this->getAttribute(self::COL_UID);
    }

    public function getIsSystem()
    {
        return $this->getAttribute(self::COL_IS_SYSTEM);
    }


    public function getCreatedAt() {
        return $this->getAttribute(self::COL_CREATED_AT);
    }

    public function getUpdatedAt() {
        return $this->getAttribute(self::COL_UPDATED_AT);
    }
}
