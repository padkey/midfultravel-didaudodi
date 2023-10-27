<?php

namespace DDDD\CatalogProduct\Selectable;

use DDDD\CatalogCategory\Models\CatalogCategory;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class CategorySelectable extends Selectable
{
    public $model = CatalogCategory::class;

    public function make()
    {
        $this->model()->orderBy(CatalogCategory::COL_POSITION);
        // Setting
        $this->column(CatalogCategory::COL_ENTITY_ID);
        $this->column(CatalogCategory::COL_CATEGORY_NAME)->display(function () {
            if ($this->{CatalogCategory::COL_PARENT_ID} !== 0) {
                $prefix = preg_replace(['/\//', '/\d+/'], [' ', '--'], $this->{CatalogCategory::COL_CATEGORY_PATH});
                return $prefix . ' | ' . $this->{CatalogCategory::COL_CATEGORY_NAME};
            }
            return $this->{CatalogCategory::COL_CATEGORY_NAME};
        });
        $this->filter(function (Filter $filter) {
            $filter->like(CatalogCategory::COL_CATEGORY_NAME);
        });
    }
}
