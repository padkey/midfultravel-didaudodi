<?php

namespace DDDD\CatalogProduct\Selectable;

use DDDD\CatalogProduct\Models\ProductTag as ProductTagModel;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class ProductTag extends Selectable
{
    public $model = ProductTagModel::class;

    public function make()
    {
        $this->column(ProductTagModel::COL_ID);
        $this->column(ProductTagModel::COL_TAG_KEY);
        $this->column(ProductTagModel::COL_NAME);

        $this->filter(function (Filter $filter) {
            $filter->like(ProductTagModel::COL_TAG_KEY);
            $filter->like(ProductTagModel::COL_NAME);
        });
    }
}
