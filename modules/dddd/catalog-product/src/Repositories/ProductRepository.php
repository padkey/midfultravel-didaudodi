<?php

namespace DDDD\CatalogProduct\Repositories;

use DDDD\CatalogProduct\Models\CatalogProduct as ProductModel;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    /**
     * @var ProductModel
     */
    protected $product;

    /**
     * CatalogProductRepository constructor.
     * @param ProductModel $product
     */
    public function __construct(ProductModel $product)
    {
        $this->product = $product;
    }

    /**
     * @param $sku
     * @return bool
     */
    public function isSkuExisted($sku): bool
    {
        return $this->product->newQuery()->where(ProductModel::COL_SKU, $sku)->exists();
    }

    /**
     * @throws Exception
     */
    public function getProductBySku($sku)//: Builder|Model
    {
        $product = $this->product->newQuery()->where(ProductModel::COL_SKU, $sku)->first();
        if ($product == null) {
            throw new Exception(sprintf("Product with sku %s does not exit.", $sku));
        }
        return $product;
    }

    /**
     * @param $ids
     * @return Collection|array
     */
    public function getProductsByIds($ids)//: Collection|array
    {
        return $this->product
            ->newQuery()
            ->whereIn(ProductModel::COL_ENTITY_ID, $ids)
            ->get();
    }

    public function getProductsByCateIds(array $ids): Collection
    {
        $idProducts = DB::table('catalog_category_product')
            ->whereIn('category_id', $ids)
            ->pluck('product_id')
            ->toArray();
        return $this->getProductsByIds($idProducts);
    }
}
