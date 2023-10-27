<?php

namespace DDDD\CatalogProduct\Services;

//use DDDD\Blog\Services\AuthorService;
use DDDD\CatalogProduct\Models\CatalogProduct as ProductModel;
use DDDD\CatalogProduct\Repositories\ProductRepository;
use DDDD\CatalogSync\Jobs\SyncProductFilterable;
use DDDD\CatalogSync\Jobs\SyncProductGeneral;
use DDDD\CatalogSync\Jobs\SyncProductSearch;
use DDDD\CatalogSync\Jobs\SyncProductSpec;
use DDDD\EAVAttribute\Services\EavAttributeService;
use DDDD\Url\Services\GenerateUrl;
use DDDD\Url\Services\UrlService;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ProductStoreDataService {

    /**
     * @var GenerateUrl
     */
    private $generateUrl;

    /**
     * @var UrlService
     */
    private $urlService;

    /**
     * @var ProductValueService
     */
    private $productValueService;

    /**
     * @var ProductRepository
     */
    private $productRepo;

    /**
     * @var ProductModel
     */
    protected $producModel;

    /**
     * @var EavAttributeService
     */
    protected EavAttributeService $eavAttributeService;

    /**
     * @var AuthorService
     */
    //protected AuthorService $authorService;

    /**
     * CatalogProductStoreDataService constructor.
     * @param GenerateUrl $generateUrl
     * @param UrlService $urlService
     * @param ProductValueService $catalogProductValueService
     * @param ProductRepository $catalogProductRepository
     * @param ProductModel $producModel
     * @param EavAttributeService $eavAttributeService
     * @param AuthorService $authorService
     */
    public function __construct(
        GenerateUrl         $generateUrl,
        UrlService          $urlService,
        ProductValueService $catalogProductValueService,
        ProductRepository   $catalogProductRepository,
        ProductModel        $producModel,
        EavAttributeService $eavAttributeService
       // AuthorService $authorService
    ) {
        $this->generateUrl = $generateUrl;
        $this->urlService = $urlService;
        $this->productValueService = $catalogProductValueService;
        $this->productRepo = $catalogProductRepository;
        $this->producModel = $producModel;
        $this->eavAttributeService = $eavAttributeService;
      //  $this->authorService = $authorService;
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareInsert($data) {
        return [
            ProductModel::COL_PRODUCT_NAME =>  $data[ProductModel::COL_PRODUCT_NAME],
            ProductModel::COL_PRODUCT_TYPE => $data[ProductModel::COL_PRODUCT_TYPE],
            ProductModel::COL_SKU => $data[ProductModel::COL_SKU],
            ProductModel::COL_ATTRIBUTE_SET_ID => $data[ProductModel::COL_ATTRIBUTE_SET_ID],
            ProductModel::COL_PRODUCT_URI => $data[ProductModel::COL_PRODUCT_URI],
            ProductModel::COL_STATUS => $data[ProductModel::COL_STATUS],
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareUpdate($data) {
        return [
            ProductModel::COL_SKU => $data[ProductModel::COL_SKU],
            ProductModel::COL_PRODUCT_URI => $data[ProductModel::COL_PRODUCT_URI],
            ProductModel::COL_PRODUCT_NAME =>  $data[ProductModel::COL_PRODUCT_NAME],
            ProductModel::COL_STATUS => $data[ProductModel::COL_STATUS],
        ];
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function storeProduct($data): mixed
    {
        // 0. Fill meta data
        $data = $this->fillMetadata($data);

        // 1. Verify attribute data.
        $this->eavAttributeService->checkAttributeRequireIsNull($data, $data[ProductModel::COL_ATTRIBUTE_SET_ID]);

        // 2. Check and verify to determine whether url is existed.
        $data[ProductModel::COL_PRODUCT_URI] = $this->generateUrl->generateAndCheckUrl($data['product_name']);

        // 3. Verify whether sku is exited.
        if ($this->productRepo->isSkuExisted($data[ProductModel::COL_SKU])) {
            throw new Exception(__("Sku of product already existed."));
        }

        return DB::transaction(function () use ($data) {
            try {

                // 1. Create product model.
                $dataInsert = $this->prepareInsert($data);
                $product = $this->saveModel($dataInsert);
                $productId = $product->getId();

                // 2. Create URL Model
                $this->urlService->create(
                    $product->getUri(),
                    ProductModel::DEFAULT_PRODUCT_VALUE['ENTITY_TYPE'],
                    $productId
                );

                // 3. Attach Categories
                if (end($data['categories']) === null) {
                    array_pop($data['categories']);
                }
                $product->categories()->sync($data['categories']);

                // 3.1 Attach Tags
                if (end($data['tags']) === null) {
                    array_pop($data['tags']);
                }
                $product->tags()->sync($data['tags']);

                //3.2 Attach Blog Posts
                if (end($data['posts']) === null){
                    array_pop($data['posts']);
                }
                $product->posts()->sync($data['posts']);

                //3.3 Attach Cross sale
                if (end($data['cross_sale']) === null){
                    array_pop($data['cross_sale']);
                }
                $product->cross_sale()->sync($data['cross_sale']);

                //3.4 Attach Children Product
                if ($product->getType() == ProductModel::TYPE_PARENT) {
                    if (end($data['children']) === null){
                        array_pop($data['children']);
                    }
                    $product->children()->sync($data['children']);
                }

                // 4. Store Attribute
                $this->productValueService->createOrUpdateProductValue($product, $data);

                // 5. Sync product to Elastic
                if (env('IS_SYNC_ELASTIC','false') == 'true') {
                    SyncProductGeneral::dispatch($product, 'new');
                    SyncProductFilterable::dispatch($product, 'new');
                    SyncProductSpec::dispatch($product, 'new');
                    SyncProductSearch::dispatch($product, 'new');
                }

                return $productId;
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
        });
    }

    /**
     * @param $productId
     * @param $data
     * @throws \Exception
     */
    public function updateProduct($productId,  $data) {

        // 1. Verify attribute data.
        $this->eavAttributeService->checkAttributeRequireIsNull($data, $data[ProductModel::COL_ATTRIBUTE_SET_ID]);

        // 2. Check and verify to determine whether url is existed.
        $product = new ProductModel();
        $product = $product->newQuery()->findOrFail($productId);

        if ($product->getUri() != $data[ProductModel::COL_PRODUCT_URI]) {
            if ($this->urlService->isUrlExisted($data[ProductModel::COL_PRODUCT_URI])) {
                throw new Exception(sprintf("Error occur during updating: Uri key already existed."));
            }
        }

        // 3. Verify changed sku is exited.
        if ($product->getSku() != $data[ProductModel::COL_SKU]) {
            if ($this->productRepo->isSkuExisted($data[ProductModel::COL_SKU])) {
                throw new Exception(sprintf("Error occur during creating: Sku of product already existed."));
            }
        }

        DB::transaction(function () use ($product, $data) {
            try {

                // 1. Update URL Model
                if ($product->getUri() != $data[ProductModel::COL_PRODUCT_URI]) {
                    $this->urlService->update(
                        $product->getUri(),
                        $data[ProductModel::COL_PRODUCT_URI]
                    );
                }

                // 2. Update product model.
                $dataUpdate = $this->prepareUpdate($data);
                $product = $this->updateModel($product, $dataUpdate);

                // 3. Attach Categories
                if (end($data['categories']) === null) {
                    array_pop($data['categories']);
                }
                $product->categories()->sync($data['categories']);

                // 3.1 Attach Tags
                if (end($data['tags']) === null) {
                    array_pop($data['tags']);
                }
                $product->tags()->sync($data['tags']);

                //3.2 Attach Blog Posts
                if (end($data['posts']) === null){
                    array_pop($data['posts']);
                }
                $product->posts()->sync($data['posts']);

                //3.3 Attach Cross sale
                if (end($data['cross_sale']) === null){
                    array_pop($data['cross_sale']);
                }
                $product->cross_sale()->sync($data['cross_sale']);

                //3.4 Attach Children Product
                if ($product->getType() == ProductModel::TYPE_PARENT) {
                    if (end($data['children']) === null){
                        array_pop($data['children']);
                    }
                    $product->children()->sync($data['children']);
                }

                // 4. Store Attribute
                $this->productValueService->createOrUpdateProductValue($product, $data);

                // 5. Sync product to Elastic
                if (env('IS_SYNC_ELASTIC','false') == 'true') {
                    SyncProductGeneral::dispatch($product, 'update');
                    SyncProductFilterable::dispatch($product, 'update');
                    SyncProductSpec::dispatch($product, 'update');
                    SyncProductSearch::dispatch($product, 'update');
                }

            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
        });
    }

    /**
     * @param $data
     * @return ProductModel
     */
    public function saveModel($data) {
        $product = new ProductModel();
        foreach ($data as $key => $value) {
            $product->{$key} = $value;
        }
        $product->save();
        return $product;
    }

    /**
     * @param $product
     * @param $data
     * @return ProductModel
     */
    public function updateModel(ProductModel $product, $data) {
        foreach ($data as $key => $value) {
            $product->{$key} = $value;
        }
        if (!$product->save()) {
            throw new Exception("Save product Error!");
        }
        return $product;
    }

    public function updateInline($data): \Illuminate\Http\JsonResponse
    {
        // 1. Check and verify to determine whether url is existed.
        $product = new ProductModel();

        /**
         * @var ProductModel $product
         */
        $product = $product->newQuery()->findOrFail($data['pk']);
        if ($product->upsertCustomAttribute($data['name'], $data['value'])) {
         //   $this->authorService->processAuthorUpdate($product);
            return response()->json([
                'status'    => true,
                'message'   => "Update succeeded !",
                'display'   => [],
            ]);
        } else {
            $product->{$data['name']} = $data['value'];
            if ($product->save()) {
                return response()->json([
                    'status'    => true,
                    'message'   => "Update succeeded !",
                    'display'   => [],
                ]);
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => "Update fail!",
                    'display'   => [],
                ], 500);
            }
        }
    }

    public function fillMetadata($data): array
    {
        $data['meta_title'] = "%%title%% chính hãng | Lấy liền";
        $data['meta_description'] = "Giá %%title%% chính hãng bao nhiêu tiền tại TPHCM và Hà Nội? Xem ngay bảng giá %%title%% mới nhất %%currentyear%% tại đây!";
        $data['meta_keyword'] = $data[ProductModel::COL_PRODUCT_NAME];
        $data['alt_thumbnail'] = $data[ProductModel::COL_PRODUCT_NAME];
        return $data;
    }
}
