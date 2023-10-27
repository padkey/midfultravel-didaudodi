<?php

namespace DDDD\CatalogCategory\Models;

//use DDDD\Blog\Models\TrailAuthorModel;
use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Models\FrameLayer;
use DDDD\CatalogProduct\Models\TextPromotionGroup;
use DDDD\EAVAttribute\Models\EavAttribute;
use DDDD\EAVAttribute\Models\EavAttributeSet;
use DDDD\EAVAttribute\Models\EavAttributeValue;
use DDDD\EAVAttribute\Repositories\EavAttributeValueRepository;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogCategory extends Model
{
    use SoftDeletes;//  TrailAuthorModel;

    use ModelTree {
        ModelTree::boot as treeBoot;
    }

    const DEFAULT_CATEGORY_VALUE = [
        'ROOT' => 0,
        'CHILDREN_COUNT' => 1,
        'PARENT_ID' => 0,
        'POSITION' => 1,
        'CATEGORY_ID' => 2,
        'ATTRIBUTE_SET_ID' => 2,
        'ENTITY_TYPE' => 'catalog-category'
    ];

    const COL_ENTITY_ID = 'entity_id';
    const COL_CATEGORY_NAME = 'category_name';
    const COL_TERM_ID = 'term_id';
    const COL_PARENT_TERM_ID = 'parent_term_id';
    const COL_PARENT_ID = 'parent_id';
    const COL_CATEGORY_PATH = 'category_path';
    const COL_CATEGORY_URI = 'category_uri';
    const COL_POSITION = 'position';
    const COL_LEVEL = 'level';
    const COL_CHILDREN_COUNT = 'children_count';
    const COL_ATTRIBUTE_SET_ID = 'attribute_set_id';
    const COL_CREATED_AT = "created_at";
    const COL_UPDATED_AT = "updated_at";
    const COL_NUMBER_EXTERNAL_LINK = "number_external_link";
    const COL_NUMBER_INTERNAL_LINK = "number_internal_link";

    protected $table = 'catalog_category_entity';

    protected $primaryKey = 'entity_id';

    protected $fillable = [
        self::COL_ENTITY_ID,
        self::COL_CATEGORY_NAME,
        self::COL_TERM_ID,
        self::COL_PARENT_TERM_ID,
        self::COL_PARENT_ID,
        self::COL_CATEGORY_PATH,
        self::COL_CATEGORY_URI,
        self::COL_POSITION,
        self::COL_LEVEL,
        self::COL_CHILDREN_COUNT,
        self::COL_ATTRIBUTE_SET_ID,
        self::COL_NUMBER_EXTERNAL_LINK,
        self::COL_NUMBER_INTERNAL_LINK
    ];

    const COL_AUTHOR_UPDATE_ID = "author_update_id";
    const COL_AUTHOR_ID = "author_id";
    const COL_AUTHOR_NAME_EXT = "author_name";
    const COL_AUTHOR_UPDATE_NAME_EXT = "author_update_name";

    protected $appends = [
        self::COL_AUTHOR_NAME_EXT,
        self::COL_AUTHOR_UPDATE_NAME_EXT
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setParentColumn(self::COL_PARENT_ID);
        $this->setOrderColumn(self::COL_POSITION);
        $this->setTitleColumn(self::COL_CATEGORY_NAME);
    }

    public function values(): HasMany
    {
        return $this->hasMany(CatalogCategoryValue::class, 'entity_id', 'entity_id');
    }

    public function products()
    {
        return $this->belongsToMany(
            CatalogProduct::class,
            'catalog_category_product',
            'category_id', 'product_id'
        );
    }

    function frame_layers(): BelongsToMany
    {
        return $this->belongsToMany(
            FrameLayer::class,
            'category_frame_layer',
            'category_id', 'frame_layer_id'
        );
    }

    /**
     * @returns BelongsToMany
     */
    function text_promotions(): BelongsToMany
    {
        return $this->belongsToMany(
            TextPromotionGroup::class,
            'text_promotion_category',
            'category_id','text_promotion_group_id'
        );
    }

    public function children()
    {
        return $this->hasMany(CatalogCategory::class, 'parent_id', 'entity_id');
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(EavAttributeSet::class, 'attribute_set_id', 'attribute_set_id');
    }

    protected static function boot()
    {
        static::treeBoot();
    }

    /**
     * @param $attr
     * @return mixed
     */
    public function getCustomAttribute($attr): mixed
    {
        $data = EavAttribute::query()->firstWhere("attribute_default_name", $attr);
        if ($data == null) {
            return null;
        }

        $attrModel = CatalogCategoryValue::query()
            ->where('attribute_id', $data->{EavAttribute::COL_ATTRIBUTE_ID})
            ->where('entity_id', $this->getAttribute(self::COL_ENTITY_ID))->first();

        if ($data->{EavAttribute::COL_ATTRIBUTE_TYPE} == 'multiple-select') {
            if ($attrModel->value == null) {
                return [];
            }
            return EavAttributeValue::query()
                ->whereIn('id', json_decode(($attrModel->value)))
                ->get(['id', 'value', 'attribute_id'])->toArray();
        } else if ($data->{EavAttribute::COL_ATTRIBUTE_TYPE} == 'boolean') {
            if ($attrModel == null) {
                return null;
            } else {
                return $attrModel->value == "1";
            }
        } else if ($data->{EavAttribute::COL_ATTRIBUTE_TYPE} == EavAttribute::TYPE_SELECT) {
            if ($attrModel == null) {
                return null;
            }
            return [
                "key" => $attrModel->value,
                "value" => EavAttributeValueRepository::getValueById($attrModel->value)
            ];
        } else {
            //return $attrModel?->value;
            return $attrModel->value;
        }
    }

    public function setCustomAttribute($attr, $value): void
    {
        $data = EavAttribute::query()->firstWhere("attribute_default_name", $attr);
        $matches = [
            'attribute_id' => $data->{EavAttribute::COL_ATTRIBUTE_ID},
            'entity_id' => $this->getAttribute(self::COL_ENTITY_ID)
        ];
        if ($data->{EavAttribute::COL_ATTRIBUTE_TYPE} == 'multiple-select' && is_array($value)) {
            $value = json_encode($value);
        }
        CatalogCategoryValue::query()->updateOrCreate($matches, ["value" => $value]);
    }


    public function getName() {
        return $this->getAttribute(self::COL_CATEGORY_NAME);
    }

    public function getId() {
        return $this->getAttribute(self::COL_ENTITY_ID);
    }

    public function getUri() {
        return $this->getAttribute(self::COL_CATEGORY_URI);
    }

    public function getParentId() {
        return $this->getAttribute(self::COL_PARENT_ID);
    }

    public function getLevel() {
        return $this->getAttribute(self::COL_LEVEL);
    }

    public function getCategoryPath() {
        return $this->getAttribute(self::COL_CATEGORY_PATH);
    }


    public function getCreatedAt() {
        return $this->getAttribute(self::COL_CREATED_AT);
    }

    public function getUpdatedAt() {
        return $this->getAttribute(self::COL_UPDATED_AT);
    }

    public function getChildrenCount() {
        return $this->getAttribute(self::COL_CHILDREN_COUNT);
    }

    public function getAttributeSetId() {
        return $this->getAttribute(self::COL_ATTRIBUTE_SET_ID);
    }

    public function getSubject() {
        return $this->getAttribute(self::COL_CATEGORY_NAME);
    }

    public function getFullLink(): string
    {
        return env('WEBSITE_BASE_URL') . $this->getUri();
    }
}
