<?php

namespace DDDD\CatalogProduct\Observers;

//use DDDD\Blog\Services\AuthorService;
use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Models\CatalogProductDatetime;
use DDDD\CatalogProduct\Models\CatalogProductDecimal;
use DDDD\CatalogProduct\Models\CatalogProductInt;
use DDDD\CatalogProduct\Models\CatalogProductText;
use DDDD\CatalogProduct\Models\CatalogProductType;
use DDDD\CatalogProduct\Models\CatalogProductVarchar;
use DDDD\CatalogProduct\Models\ProductRaw;
use DDDD\CatalogSync\Jobs\SyncProductFilterable;
use DDDD\CatalogSync\Jobs\SyncProductGeneral;
use DDDD\CatalogSync\Jobs\SyncProductSearch;
use DDDD\CatalogSync\Jobs\SyncProductSpec;
use DDDD\Shop\Models\Shop;
use DDDD\Url\Services\UrlService;
use Exception;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use Junges\Kafka\Message\Serializers\JsonSerializer;

class ProductObserver
{
    /**
     * @var UrlService
     */
    private UrlService $urlService;

    /**
     * @var AuthorService
     */
    //protected AuthorService $authorService;

    /**
     * CatalogProductObserver constructor.
     * @param UrlService $urlService
     */
    function __construct(UrlService $urlService)
    {
      //  $this->authorService = $authorService;
        $this->urlService = $urlService;
    }

    public function deleted(CatalogProduct $product): void
    {
        $this->urlService->delete($product->getUri());
        SyncProductGeneral::dispatch($product, 'delete');
        SyncProductFilterable::dispatch($product, 'delete');
        SyncProductSpec::dispatch($product, 'delete');
        SyncProductSearch::dispatch($product, 'delete');
    }

    public function deleting(CatalogProduct $product): void
    {
        $product->categories()->sync([]);
        $product->children()->sync([]);
        $product->parents()->sync([]);
        CatalogProductDatetime::query()->where(CatalogProductType::COL_ENTITY_ID, $product->getId())->delete();
        CatalogProductDecimal::query()->where(CatalogProductType::COL_ENTITY_ID, $product->getId())->delete();
        CatalogProductInt::query()->where(CatalogProductType::COL_ENTITY_ID, $product->getId())->delete();
        CatalogProductText::query()->where(CatalogProductType::COL_ENTITY_ID, $product->getId())->delete();
        CatalogProductVarchar::query()->where(CatalogProductType::COL_ENTITY_ID, $product->getId())->delete();
    }

    /**
     * @param CatalogProduct $catalogProduct
     * @return void
     */
    public function created(CatalogProduct $catalogProduct): void
    {
        $shops = Shop::select('province_id', 'company_id')
            ->where('company_id','<>',Shop::ASP_COMPANY_ID)->distinct('province_id')->get()->toArray();
        $now = now('UTC');
        $data = [];
        foreach ($shops as $shop){
            $provinceStock = array(
                "product_id" => $catalogProduct->getId(),
                "province_id" => $shop['province_id'],
                "sku" => $catalogProduct->getSku(),
                "stock_available" => "Subscription",
                "stock_status_id" => 4,
                "stock" => 0,
                "updated_at" => $now,
            );
            $data[] = $provinceStock;
        }
        try{
            $catalogProduct->provinceStocks()->createMany($data);
        } catch (Exception $exception){
            admin_toastr($exception->getMessage(), 'error');
            Log::error($exception->getMessage());
        }
    }

    /**
     * @param CatalogProduct $catalogProduct
     * @return void
     */
    public function updated(CatalogProduct $catalogProduct): void
    {
        $dirtyFields = $catalogProduct->getDirty();
        if (isset($dirtyFields['sku'])){
            $sku = $dirtyFields['sku'];
            $catalogProduct->provinceStocks()->update(['sku' => $sku]);
            $rawProduct = ProductRaw::query()->firstWhere(ProductRaw::COL_PRODUCT_ID, $catalogProduct->getId());
            if ($rawProduct != null) {
                $rawProduct->{ProductRaw::COL_SKU} = $sku;
                $rawProduct->save();
            }
        }
    }

    /**
     * @throws Exception
     */
    public function saved(CatalogProduct $catalogProduct): void
    {
        if ($catalogProduct->getType() == CatalogProduct::TYPE_PARENT) {
            $childrenId = request()->get("children");
            if (end($childrenId) === null){
                array_pop($childrenId);
            }
            // $message = new Message(
            //     body: [
            //         "parent_id" => $catalogProduct->getId(),
            //         "children_id" => $childrenId
            //     ],
            //     key : 'product_relation_' . $catalogProduct->getId()
            // );
            $isSend = Kafka::publishOn(env("KAFKA_DEFAULT_PRODUCT_CHANGED_TOPIC"))->withMessage($message)->send();
            if (!$isSend) {
                Log::error("Push message to kafka fail, productId=". $catalogProduct->getId());
            }
        }
    }

    /**
     * @param $item
     * @throws Exception
     */
    public function creating($item): void
    {
        //$this->authorService->processAuthorCreate($item);
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
