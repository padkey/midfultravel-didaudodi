<?php

namespace DTV\EAVAttribute\Models;

use DTV\CatalogCategory\Models\CatalogCategoryValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EavAttribute extends Model
{
    use SoftDeletes;

    const TYPE_INT = 'int';
    const TYPE_DECIMAL = 'decimal';
    const TYPE_DATETIME = 'datetime';
    const TYPE_TEXT = 'text';
    const TYPE_VARCHAR = 'varchar';
    const TYPE_IMAGE = 'image';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_GALLERY = 'gallery';
    const TYPE_EDITOR = 'editor';
    const TYPE_SELECT = 'select';
    const TYPE_MULTIPLE_SELECT = 'multiple-select';

    const ATTRIBUTE_TYPE = [
        self::TYPE_INT => 'Int',
        self::TYPE_DECIMAL => 'Decimal',
        self::TYPE_DATETIME => 'Datetime',
        self::TYPE_TEXT => 'Text',
        self::TYPE_VARCHAR => 'Varchar',
        self::TYPE_IMAGE => 'Image',
        self::TYPE_BOOLEAN => 'Boolean',
        self::TYPE_GALLERY => 'Gallery / Multi-Image',
        self::TYPE_EDITOR => 'Editor',
        self::TYPE_SELECT => 'Select',
        self::TYPE_MULTIPLE_SELECT => 'Multiple Select'
    ];
    const IS_REQUIRE = ['0' => 'No', '1' => 'Yes'];

    const COL_ATTRIBUTE_ID = "attribute_id";
    const COL_ATTRIBUTE_DEFAULT_NAME = "attribute_default_name";
    const COL_ATTRIBUTE_TYPE = 'attribute_type';
    const COL_IS_REQUIRE = 'is_require';
    const COL_IS_SYSTEM = 'is_system';
    const COL_ATTRIBUTE_TITLE = 'attribute_title';
    const COL_IS_FILTER = 'is_filter';
    const COL_DEFAULT_VALUE = 'default_value';
    const COL_IS_SHOWN = 'is_shown';
    const COL_CREATED_AT = 'created_at';
    const COL_UPDATED_AT = 'updated_at';
    const COL_DELETED_AT = 'deleted_at';

    protected $table = 'eav_attribute';

    protected $primaryKey = 'attribute_id';

    protected $fillable = [
        self::COL_ATTRIBUTE_DEFAULT_NAME,
        self::COL_ATTRIBUTE_TYPE,
        self::COL_IS_REQUIRE
    ];

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            EavAttributeGroup::class,
            'eav_attribute_relation',
            self::COL_ATTRIBUTE_ID,
            EavAttributeGroup::COL_ATTRIBUTE_GROUP_ID
        );
    }

    public function values(): HasMany
    {
        return $this->hasMany(
            EavAttributeValue::class,
            'attribute_id',
            'attribute_id'
        );
    }

    public function category(): HasMany
    {
        return $this->hasMany(CatalogCategoryValue::class, 'attribute_id', 'attribute_id');
    }

    public function getAttributeType() {
        return $this->getAttribute(self::COL_ATTRIBUTE_TYPE);
    }

    public function getAttributeId() {
        return $this->getAttribute(self::COL_ATTRIBUTE_ID);
    }

    public function getAttributeDefaultName() {
        return $this->getAttribute(self::COL_ATTRIBUTE_DEFAULT_NAME);
    }

    public function getDefaultValue() {
        return $this->getAttribute(self::COL_DEFAULT_VALUE);
    }

    public function getIsRequire() {
        return $this->getAttribute(self::COL_IS_REQUIRE);
    }

    public function getAttributeTitle() {
        return $this->getAttribute(self::COL_ATTRIBUTE_TITLE);
    }
}
