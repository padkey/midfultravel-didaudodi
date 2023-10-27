<?php

namespace DDDD\CatalogCategory\Services;

use DDDD\CatalogCategory\Models\CatalogCategory as CategoryModel;
use DDDD\CatalogCategory\Repositories\CatalogCategoryRepository;
use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Services\CatalogDataRequest;
use DDDD\CatalogSync\Jobs\SyncCategory;
use DDDD\CatalogSync\Jobs\SyncProductFilterable;
use DDDD\CatalogSync\Jobs\SyncProductGeneral;
use DDDD\CatalogSync\Jobs\SyncProductSearch;
use DDDD\CatalogSync\Jobs\SyncProductSpec;
use DDDD\EAVAttribute\Services\EavAttributeService;
use DDDD\Url\Services\GenerateUrl;
use DDDD\Url\Services\UrlService;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CatalogCategoryStoreDataService {

    use CatalogDataRequest;

    /**
     * @var GenerateUrl
     */
    private $generateUrl;

    /**
     * @var UrlService
     */
    private $urlService;

    /**
     * @var CatalogCategoryRepository
     */
    private $CategoryRepo;

    /**
     * @var CategoryModel
     */
    protected $producModel;

    /**
     * @var CatalogCategoryService
     */
    protected $catalogCategoryService;

    protected $eavAttributeService;
    /**
     * CatalogCategoryStoreDataService constructor.
     * @param GenerateUrl $generateUrl
     * @param UrlService $urlService
     * @param CatalogCategoryRepository $catalogCategoryRepository
     * @param CatalogCategoryService $catalogCategoryService
     * @param CategoryModel $producModel
     */
    public function __construct(
        GenerateUrl $generateUrl,
        UrlService $urlService,
        CatalogCategoryRepository $catalogCategoryRepository,
        CatalogCategoryService    $catalogCategoryService,
        CategoryModel $producModel,
        EavAttributeService $eavAttributeService
    ) {
        $this->generateUrl = $generateUrl;
        $this->urlService = $urlService;
        $this->CategoryRepo = $catalogCategoryRepository;
        $this->producModel = $producModel;
        $this->catalogCategoryService = $catalogCategoryService;
        $this->eavAttributeService = $eavAttributeService;
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareInsert($data) {
        return [
            CategoryModel::COL_CATEGORY_NAME => $data[CategoryModel::COL_CATEGORY_NAME],
            CategoryModel::COL_ATTRIBUTE_SET_ID => $data[CategoryModel::COL_ATTRIBUTE_SET_ID],
            CategoryModel::COL_PARENT_ID => $data[CategoryModel::COL_PARENT_ID],
            CategoryModel::COL_CATEGORY_URI => $data[CategoryModel::COL_CATEGORY_URI],
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareUpdate($data) {
        return [
            CategoryModel::COL_CATEGORY_NAME => $data[CategoryModel::COL_CATEGORY_NAME],
            CategoryModel::COL_PARENT_ID => $data[CategoryModel::COL_PARENT_ID],
            CategoryModel::COL_CATEGORY_URI => $data[CategoryModel::COL_CATEGORY_URI],
        ];
    }

    /**
     * @param $data
     * @throws \Exception
     */
    public function storeCategory($data) {

        // 1. Verify attribute data.
        $this->eavAttributeService->checkAttributeRequireIsNull(
            $data, $data[CategoryModel::COL_ATTRIBUTE_SET_ID]);

        // 2. Check and verify to determine whether url is existed.
        $data[CategoryModel::COL_CATEGORY_URI] = $this->generateUrl
            ->generateAndCheckUrl($data[CategoryModel::COL_CATEGORY_NAME]);

        return DB::transaction(function () use ($data) {
            try {

                // 1. Create Category model.
                $dataInsert = $this->prepareInsert($data);
                $category = $this->saveModel($dataInsert);
                $categoryId = $category->{CategoryModel::COL_ENTITY_ID};

                // 2. Create URL Model
                $this->urlService->create(
                    $category->{CategoryModel::COL_CATEGORY_URI},
                    CategoryModel::DEFAULT_CATEGORY_VALUE['ENTITY_TYPE'],
                    $categoryId
                );

                // 3. Store Attribute
                $this->catalogCategoryService->createOrUpdateCategoryValue($category, $data);

                // 4.Update children
                $this->catalogCategoryService->updateChidrenCount();

                // 5. inject level and path
                $this->CategoryRepo->injectLevelAndPath($category);

                // 6. Attach Product
                if (end($data['products']) === null){
                    array_pop($data['products']);
                }
                $category->products()->sync($data['products']);

                // 7. Sync Category to Elastic
                SyncCategory::dispatch($category, 'create');

                $products = $category->products()->get();
                foreach ($products as $product) {
                    SyncProductGeneral::dispatch($product, 'update');
                    SyncProductFilterable::dispatch($product, 'update');
                    SyncProductSpec::dispatch($product, 'update');
                    SyncProductSearch::dispatch($product, 'update');
                }

                return $categoryId;

            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
        });
    }

    /**
     * @param $CategoryId
     * @param $data
     * @throws \Exception
     */
    public function updateCategory($categoryId,  $data) {

        // 1. Verify attribute data.
        $this->eavAttributeService->checkAttributeRequireIsNull($data, $data[CategoryModel::COL_ATTRIBUTE_SET_ID]);

        // 2. Check and verify to determine whether url is existed.
        $category = new CategoryModel();
        $category = $category->newQuery()->findOrFail($categoryId);
        if ($category->{CategoryModel::COL_CATEGORY_URI} != $data[CategoryModel::COL_CATEGORY_URI]) {
            if ($this->urlService->isUrlExisted($data[CategoryModel::COL_CATEGORY_URI])) {
                throw new Exception(sprintf(
                    "Error occur during updating category: Uri key already existed."));
            }
        }

        DB::transaction(function () use ($category, $data) {
            try {

                // 1. Update URL Model
                if ($category->{CategoryModel::COL_CATEGORY_URI} != $data[CategoryModel::COL_CATEGORY_URI]) {
                    $this->urlService->update(
                        $category->{CategoryModel::COL_CATEGORY_URI},
                        $data[CategoryModel::COL_CATEGORY_URI]
                    );
                }

                // 2. Update Category model.
                $dataUpdate = $this->prepareUpdate($data);
                $category = $this->updateModel($category, $dataUpdate);

                // 3. Store Attribute
                $this->catalogCategoryService->createOrUpdateCategoryValue($category, $data);

                // 4.Update children
                $this->catalogCategoryService->updateChidrenCount();

                // 5. inject level and path
                $this->CategoryRepo->injectLevelAndPath($category);

                $oldProductIds = $category->products()->pluck(CatalogProduct::COL_ENTITY_ID)->toArray();
                $updateProductIds = $this->getDiffProductIdsFromRequest($oldProductIds);
                $products = CatalogProduct::query()->whereIn(CatalogProduct::COL_ENTITY_ID, $updateProductIds)->get();
                foreach ($products as $product) {
                    SyncProductGeneral::dispatch($product, 'update');
                    SyncProductFilterable::dispatch($product, 'update');
                    SyncProductSpec::dispatch($product, 'update');
                    SyncProductSearch::dispatch($product, 'update');
                }

                //6 Attach Product
                if (end($data['products']) === null){
                    array_pop($data['products']);
                }
                $category->products()->sync($data['products']);

                // 7. sync category to Elastic
                SyncCategory::dispatch($category, 'update');

            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
        });
    }

    /**
     * @param $data
     * @return CategoryModel
     */
    protected function saveModel($data) {
        $Category = new CategoryModel();
        foreach ($data as $key => $value) {
            $Category->{$key} = $value;
        }
        $Category->save();
        return $Category;
    }

    /**
     * @param $Category
     * @param $data
     * @return CategoryModel
     */
    protected function updateModel($category, $data) {
        foreach ($data as $key => $value) {
            $category->{$key} = $value;
        }
        $category->save();
        return $category;
    }
}
