<?php

namespace DDDD\CatalogProduct\Models;

use DDDD\Blog\Models\BlogPost;
//use DDDD\Blog\Models\TrailAuthorModel;
use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogProduct\Repositories\ProductValueRepository;
use DDDD\CatalogProduct\Services\ProductValueService;
use DDDD\EAVAttribute\Models\EavAttribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogProduct extends Model
{
    //use TrailAuthorModel;

    const CURRENCY_SYMBOL = 'VND';

    const TYPE_SINGLE = 'single_product';
    const TYPE_PARENT = 'parent_product';
    /**
     * array
     */
    const PRODUCT_TYPE = [
        self::TYPE_SINGLE => 'Single Product',
        self::TYPE_PARENT => 'Parent Product'
    ];

    const COL_AUTHOR_UPDATE_ID = "author_update_id";
    const COL_AUTHOR_ID = "author_id";
    const COL_AUTHOR_NAME_EXT = "author_name";
    const COL_AUTHOR_UPDATE_NAME_EXT = "author_update_name";

    protected $appends = [
        self::COL_AUTHOR_NAME_EXT,
        self::COL_AUTHOR_UPDATE_NAME_EXT
    ];

    /**
     * array
     */
    const DEFAULT_PRODUCT_VALUE = [
        'ENTITY_TYPE' => 'catalog-product',
        'ATTRIBUTE_SET_ID' => 1,
    ];

    const COL_ENTITY_ID = "entity_id";
    const COL_SKU = "sku";
    const COL_ATTRIBUTE_SET_ID = "attribute_set_id";
    const COL_PRODUCT_TYPE = "product_type";
    const COL_PRODUCT_URI = "product_uri";
    const COL_PRODUCT_NAME = "product_name";
    const COL_STATUS = "status";
    const COL_CREATED_AT = "created_at";
    const COL_UPDATED_AT = "updated_at";
    const COL_APPEND_IS_PARENT = "is_parent";
    const COL_NUMBER_EXTERNAL_LINK = "number_external_link";
    const COL_NUMBER_INTERNAL_LINK = "number_internal_link";

    /**
     * @var string
     */
    protected $table = 'catalog_product_entity';

    /**
     * @var string
     */
    protected $primaryKey = self::COL_ENTITY_ID;

    /**
     * @var string[]
     */
    protected $fillable = [
        self::COL_ENTITY_ID,
        self::COL_SKU,
        self::COL_ATTRIBUTE_SET_ID,
        self::COL_PRODUCT_TYPE,
        self::COL_PRODUCT_URI,
        self::COL_STATUS,
        self::COL_NUMBER_EXTERNAL_LINK,
        self::COL_NUMBER_INTERNAL_LINK,

    ];


    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    function stock(): HasMany
    {
        return $this->hasMany(ProductStockShop::class, ProductStockShop::COL_PRODUCT_SKU, self::COL_SKU);
    }

    /**
     * @return Collection
     */
    function getProductStock(): Collection
    {
        return $this->stock()->get();
    }

    public function price(): HasMany
    {
        return $this->hasMany(ProductPrice::class, ProductPrice::COL_SKU, self::COL_SKU);
    }

    /**
     * @return Collection
     */
    public function getProductPrice(): Collection
    {
        return $this->price()->get();
    }

    /**
     * @return BelongsToMany
     */
    function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogCategory::class,
            'catalog_category_product',
            'product_id', 'category_id'
        );
    }

    function cross_sale(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogProduct::class,
            'catalog_product_cross_sell',
            'product_id', 'cross_sell_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductTag::class,
            'product_tag_relation',
            'product_id', 'tag_id'
        );
    }

    function frame_layers(): BelongsToMany
    {
        return $this->belongsToMany(
            FrameLayer::class,
            'product_frame_layer',
            'product_id', 'frame_layer_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            BlogPost::class,
            'blog_post_product_relation',
            'product_id', 'blog_post_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    function children(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogProduct::class,
            'catalog_product_relation',
            'parent_id', 'child_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    function parents(): BelongsToMany
    {
        return $this->belongsToMany(
            CatalogProduct::class,
            'catalog_product_relation',
            'child_id', 'parent_id'
        );
    }

    /**
     * @return bool
     */
    function isParent(): bool
    {
        return count($this->parents()->get()->toArray()) == 0;
    }

    /**
     * @returns BelongsToMany
     */
    function text_promotions(): BelongsToMany
    {
        return $this->belongsToMany(
            TextPromotionGroup::class,
            'text_promotion_product',
            'product_id','text_promotion_group_id'
        );
    }

    function provinceStocks(): HasMany
    {
        return $this->hasMany(
            ProductStockProvince::class,
            ProductStockProvince::COL_PRODUCT_ID,self::COL_ENTITY_ID,
        );
    }

    /**
     * @param $attr
     * @return mixed
     */
    public function getCustomAttribute($attr): mixed
    {
        $attr = EavAttribute::query()->firstWhere("attribute_default_name", $attr);

        if ($attr == null) {
            return null;
        }

        /**
         * @var Model $model
         * @var CatalogProductType $attrValueModel
         */
        $model = ProductValueService::getModelProductEntityType($attr->{EavAttribute::COL_ATTRIBUTE_TYPE});

        $attrValueModel = $model::query()
            ->where('attribute_id', $attr->{EavAttribute::COL_ATTRIBUTE_ID})
            ->where('entity_id', $this->getId())->first();
        return $attrValueModel->getValue();
    }

    public function upsertCustomAttribute($attr, $value): bool
    {
        $attr = EavAttribute::query()->firstWhere("attribute_default_name", $attr);

        if ($attr == null) {
            return false;
        }

        /**
         * @var Model $model
         */
        $model = ProductValueService::getModelProductEntityType($attr->{EavAttribute::COL_ATTRIBUTE_TYPE});
        if (($attr->{EavAttribute::COL_ATTRIBUTE_TYPE} == EavAttribute::TYPE_MULTIPLE_SELECT ||
            $attr->{EavAttribute::COL_ATTRIBUTE_TYPE} == EavAttribute::TYPE_GALLERY) && is_array($value)) {
            $value = json_encode($value,  JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
        }

        $model::query()->upsert(
            [
                'entity_id' =>  $this->getId(),
                'attribute_id' => $attr->{EavAttribute::COL_ATTRIBUTE_ID},
                'value' => $value
            ],
            ['entity_id', 'attribute_id'],
            ['value']
        );
        return true;
    }

    public function getCustomAttributes() {
        $models = [
            'catalog_product_entity_datetime' => CatalogProductDatetime::class,
            'catalog_product_entity_decimal' => CatalogProductDecimal::class,
            'catalog_product_entity_int' => CatalogProductInt::class,
            'catalog_product_entity_text' => CatalogProductText::class,
            'catalog_product_entity_varchar' => CatalogProductVarchar::class,
        ];

        $collection = collect([]);
        foreach ($models as $modelName => $model) {
            $collection = $collection
                ->merge(ProductValueRepository::selectValueAttributeOfProduct(
                    $model, $modelName, $this->getId()));
        }
        return $collection;
    }

    /**
     * @param int $provinceId
     * @return bool
     */
    public function getIsInStock(int $provinceId = 30): bool
    {
        $attrService = $this->getCustomAttribute("product_dich_vu");
        if ($attrService != null && $attrService->first() != null && $attrService->first()->getValue() != "Phụ kiện") {
            return true;
        }

        /**
         * @var ProductStockProvince $provinceStock
         */
        $provinceStock = $this->provinceStocks()
            ->get()
            ->firstWhere(
                ProductStockProvince::COL_PROVINCE_ID,
                $provinceId
            );

        if ($provinceStock == null) {
            return false;
        }

        return $provinceStock->isInStock();
    }

    protected function getPrice(int $provinceId = 30)
    {
        /**
         * @var ProductPrice $price
         */
        return $this->price()->orderBy("sale_price", "desc")->get()->firstWhere(ProductPrice::COL_PROVINCE_ID, $provinceId);
    }

    public function getProvinceStock(int $provinceId = 30)
    {
        return $this->provinceStocks()->get()->firstWhere(ProductStockProvince::COL_PROVINCE_ID, $provinceId);
    }

    public function getStockStatusId(int $provinceId = 30)
    {
        $stockProvince = $this->getProvinceStock($provinceId);
        if ($stockProvince == null) {
            return 4;
        }
        return $stockProvince->{ProductStockProvince::COL_STOCK_STATUS_ID};
    }

    public function getStock(int $provinceId = 30)
    {
        $stockProvince = $this->getProvinceStock($provinceId);
        if ($stockProvince == null) {
            return 0;
        }
        return $stockProvince->{ProductStockProvince::COL_STOCK};
    }

    public function getBasePrice(int $provinceId = 30)
    {
        $sepPrice = $this->getPrice($provinceId);
        if ($sepPrice == null) {
            $price = $this->getCustomAttribute("product_price");
            return $price == null ? 0 : $price;
        }
        return $sepPrice->getBasePrice();
    }

    public function getSpecialPrice(int $provinceId = 30)
    {
        $sepPrice = $this->getPrice($provinceId);
        if ($sepPrice == null) {
            $price = $this->getCustomAttribute("product_special_price");
            return $price == null ? 0 : $price;
        }
        return $sepPrice->getSpecialPrice();
    }

    public function getId() {
        return $this->getAttribute(self::COL_ENTITY_ID);
    }

    public function getName() {
        return $this->getAttribute(self::COL_PRODUCT_NAME);
    }

    public function getSku() {
        return $this->getAttribute(self::COL_SKU);
    }

    public function getUri() {
        return $this->getAttribute(self::COL_PRODUCT_URI);
    }

    public function getType() {
        return $this->getAttribute(self::COL_PRODUCT_TYPE);
    }

    public function getStatus() {
        return $this->getAttribute(self::COL_STATUS);
    }

    public function getAttributeSetId() {
        return $this->getAttribute(self::COL_ATTRIBUTE_SET_ID);
    }

    public function getCreatedAt() {
        return $this->getAttribute(self::COL_CREATED_AT);
    }

    public function getUpdatedAt() {
        return $this->getAttribute(self::COL_UPDATED_AT);
    }

    public function getSubject() {
        return $this->getAttribute(self::COL_PRODUCT_NAME);
    }

    public function getUrl(): string
    {
        return env('WEBSITE_BASE_URL') . $this->getUri();
    }

    public function getFullLink(): string
    {
        return env('WEBSITE_BASE_URL') . $this->getUri();
    }
}
