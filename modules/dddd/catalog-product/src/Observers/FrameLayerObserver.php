<?php

namespace DDDD\CatalogProduct\Observers;

//use DDDD\Blog\Services\AuthorService;
use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Models\FrameLayer;
use DDDD\CatalogProduct\Repositories\ProductRepository;
use DDDD\CatalogProduct\Services\CatalogDataRequest;
use DDDD\CatalogSync\Jobs\SyncProductGeneral;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class FrameLayerObserver
{
    use CatalogDataRequest;

    /**
     * @var ProductRepository
     */
    protected ProductRepository $productRepository;

    /**
     * @var AuthorService
     */
   // protected AuthorService $authorService;

    /**
     * @param ProductRepository $productRepository
     * @param AuthorService $authorService
     */
    function __construct(
        ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    //   $this->authorService = $authorService;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function saved(FrameLayer $item): void
    {

        $productIdsOld = $item->products()->pluck(CatalogProduct::COL_ENTITY_ID)->toArray();
        $productIds = array_unique(array_merge($this->getRequestProductIds(), $productIdsOld));

        $categoryIdsOld = $item->categories()->pluck(CatalogCategory::COL_ENTITY_ID)->toArray();
        $categoryIds = array_unique(array_merge($this->getRequestCategoryIds(), $categoryIdsOld));

        foreach ($categoryIds as $categoryId) {
            /**
             * @var CatalogCategory $cate
             */
            if ($categoryId == null) {
                continue;
            }
            $cate = CatalogCategory::query()->findOrFail($categoryId);
            $ids = $cate->products()->pluck(CatalogCategory::COL_ENTITY_ID)->toArray();
            $productIds = array_unique(array_merge($ids, $productIds));
        }
        $products = $this->productRepository->getProductsByIds($productIds);
        foreach ($products as $product) {
            /**
             * @var CatalogProduct $product
             */
            SyncProductGeneral::dispatch($product, 'update');
        }
    }

    /**
     * @param $item
     * @throws Exception
     */
    public function creating($item): void
    {
       // $this->authorService->processAuthorCreate($item);
    }

    /**
     * @param $item
     * @throws Exception
     */
    public function saving($item): void
    {
       // $this->authorService->processAuthorUpdate($item);
    }
}
