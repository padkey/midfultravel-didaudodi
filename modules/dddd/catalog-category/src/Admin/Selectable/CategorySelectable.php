<?php

namespace DDDD\CatalogCategory\Admin\Selectable;

use DDDD\CatalogCategory\Models\CatalogCategory;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

/**
 * Class CategorySelectable
 * @package DDDD\CatalogCategory\Http\Admin\Selectable
 */
class CategorySelectable extends Selectable
{
    public $model = CatalogCategory::class;

    public function make()
    {
        $this->column('entity_id');
        $this->column('category_name')->display(function () {
            if ($this->{'parent_id'} !== 0) {
                $prefix = preg_replace(['/\//', '/\d+/'], [' ', '--'], $this->category_path);
                return $prefix .' | '. $this->category_name;
            }
            return $this->category_name;

        });
        $this->filter(function (Filter $filter) {
            $filter->like('category_name');
        });
    }
}
