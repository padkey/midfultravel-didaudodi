<?php

namespace DDDD\CatalogProduct\Selectable;

use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogProduct\Models\CatalogProduct;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;


class ProductSingleSelectable extends Selectable
{
    /**
     * @var string
     */
    public $model = CatalogProduct::class;

    public function make()
    {
        $this->model()->newQuery()->where(CatalogProduct::COL_PRODUCT_TYPE, CatalogProduct::TYPE_SINGLE);

        $this->column(CatalogProduct::COL_ENTITY_ID);
        $this->column(CatalogProduct::COL_SKU);
        $this->column(CatalogProduct::COL_PRODUCT_NAME);
        $this->column(CatalogProduct::COL_STATUS);
        $this->column(CatalogProduct::COL_PRODUCT_TYPE);
        $this->column('is_parent')->display(function () {
            /**
             * @var CatalogProduct $this
             */
            return $this->isParent();
        })->bool();
        $this->filter(function (Filter $filter) {
            $filter->ilike(CatalogProduct::COL_SKU);
            $filter->ilike(CatalogProduct::COL_PRODUCT_NAME);
            $filter->equal(CatalogProduct::COL_PRODUCT_TYPE)
                ->select(CatalogProduct::PRODUCT_TYPE);
        });
    }
}
