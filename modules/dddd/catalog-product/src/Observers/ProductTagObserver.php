<?php

namespace DDDD\CatalogProduct\Observers;

//use DDDD\Blog\Services\AuthorService;
use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Models\ProductTag;
use DDDD\CatalogProduct\Repositories\ProductRepository;
use DDDD\CatalogSync\Jobs\SyncProductGeneral;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductTagObserver
{
    /**
     * @var ProductRepository
     */
    protected ProductRepository $productRepository;

    /**
     * @var AuthorService
     */
    //protected AuthorService $authorService;

    /**
     * @param ProductRepository $productRepository
     * @param AuthorService $authorService
     */
    function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
        //$this->authorService = $authorService;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function saved(ProductTag $item): void
    {
        $productIdsNew = request()->get("products");
        $productIdsOld = $item->products()->pluck(CatalogProduct::COL_ENTITY_ID)->toArray();
        $ids = array_unique(array_merge($productIdsNew, $productIdsOld));
        $products = $this->productRepository->getProductsByIds($ids);
        foreach ($products as $product) {
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
