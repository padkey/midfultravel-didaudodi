<?php


namespace DDDD\CatalogProduct\Services;

use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Models\ProductPrice;
use DDDD\CatalogProduct\Models\ProductStockProvince;

class ProductService
{
    private $model;
    public function __construct(CatalogProduct $model) {
        $this->model = $model;
    }

    public function loadService($id, string $sku = null)//: static
    {
        if ($sku != null) {
            $this->model = $this->model->newQuery()->firstWhere(CatalogProduct::COL_SKU, $sku);
        }
        $this->model = $this->model->newQuery()->findOrFail($id);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function isProductService(): bool {
        $attrService = $this->model->getCustomAttribute("product_dich_vu");
        if ($attrService != null && $attrService->first() != null && $attrService->first()->getValue() != "Phụ kiện") {
            return true;
        }
        return false;
    }

    /**
     * @param int $provinceId
     * @return bool
     * @throws \Exception
     */
    public function getIsInStock(int $provinceId = 30): bool
    {
        if ($this->isProductService()) {
            return true;
        }

        /**
         * @var ProductStockProvince $provinceStock
         */
        $provinceStock = $this->model->provinceStocks()
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

    protected function getPrice(int $provinceId = 30)//: ProductPrice|null
    {
        /**
         * @var ProductPrice $price
         */
        return $this->model->price()->orderBy("updated_at", "desc")->get()
            ->firstWhere(ProductPrice::COL_PROVINCE_ID, $provinceId);
    }

    public function getBasePrice(int $provinceId = 30)
    {
        $sepPrice = $this->getPrice($provinceId);
        if ($sepPrice == null) {
            $price = $this->model->getCustomAttribute("product_price");
            return $price == null ? 0 : $price;
        }
        return $sepPrice->getBasePrice();
    }

    public function getSpecialPrice(int $provinceId = 30)
    {
        $sepPrice = $this->getPrice($provinceId);
        if ($sepPrice == null) {
            $price = $this->model->getCustomAttribute("product_special_price");
            return $price == null ? 0 : $price;
        }
        return $sepPrice->getSpecialPrice();
    }
}
