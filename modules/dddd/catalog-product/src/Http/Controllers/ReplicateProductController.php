<?php

namespace DDDD\CatalogProduct\Http\Controllers;

use DDDD\CatalogProduct\Models\CatalogProduct as ProductModel;
use DDDD\CatalogProduct\Models\CatalogProductType;
use DDDD\CatalogSync\Jobs\SyncProductFilterable;
use DDDD\CatalogSync\Jobs\SyncProductGeneral;
use DDDD\CatalogSync\Jobs\SyncProductSearch;
use DDDD\CatalogSync\Jobs\SyncProductSpec;
use DDDD\Url\Services\UrlService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ReplicateProductController extends Controller
{
    /**
     * @var UrlService
     */
    private $urlService;

    /**
     * @param UrlService $urlService
     */
    public function __construct(UrlService $urlService){
        $this->urlService = $urlService;
    }

    public function index(Request $request, $id)
    {
        $product = ProductModel::findOrFail($id);
        $newProduct = $product->replicate();
        $newProduct->{ProductModel::COL_PRODUCT_NAME} = $newProduct->{ProductModel::COL_PRODUCT_NAME} . " Copy";
        $newProduct->{ProductModel::COL_SKU} = $newProduct->{ProductModel::COL_SKU} . " Copy";
        $newProduct->{ProductModel::COL_PRODUCT_URI} = $newProduct->{ProductModel::COL_PRODUCT_URI} . "-copy";
        $newProduct->{ProductModel::COL_STATUS} = 0;

        $id = DB::transaction(function () use ($newProduct, $product) {
            try {

                /**
                 * @var ProductModel $newProduct
                 * @var ProductModel $product
                 */
                // 1. Create product model.
                $newProduct->save();
                $productId = $newProduct->getId();

                // 2. Create URL Model
                $this->urlService->create(
                    $newProduct->getUri(),
                    ProductModel::DEFAULT_PRODUCT_VALUE['ENTITY_TYPE'],
                    $productId
                );

                $newProduct->categories()->attach($product->categories);
                $newProduct->tags()->attach($product->tags);
                $newProduct->posts()->attach($product->posts);
                $newProduct->cross_sale()->attach($product->cross_sale);
                $newProduct->children()->attach($product->children);

                $attributeCollect = $product->getCustomAttributes();

                foreach ($attributeCollect as $attribute) {
                    $cloneAttr = $attribute->replicate();
                    $cloneAttr->{CatalogProductType::COL_ENTITY_ID} = $productId;
                    $originField = [
                        CatalogProductType::COL_ENTITY_ID,
                        CatalogProductType::COL_ATTRIBUTE_ID,
                        CatalogProductType::COL_VALUE_ID,
                        CatalogProductType::COL_VALUE,
                    ];
                    foreach ($cloneAttr->getAttributes() as $key => $value) {
                        if(!in_array($key, $originField)){
                            unset($cloneAttr->$key);
                        }
                    }
                    $cloneAttr->save();
                }

                return $productId;
            } catch (Exception $exception) {
                echo $exception->getMessage();die;
            }
        });
        admin_toastr('Replicate product succeeded!', 'success');
        return redirect()->route('catalog-product.edit', ['catalog_product' => $id]);
    }
}
