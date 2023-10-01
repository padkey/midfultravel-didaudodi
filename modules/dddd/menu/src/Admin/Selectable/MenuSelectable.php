<?php

namespace DDDD\Menu\Admin\Selectable;

use DDDD\Menu\Models\Menu as model;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class MenuSelectable extends Selectable
{
    public $model = model::class;

    public function make()
    {
        $this->column(model::COL_ID);
        $this->column(model::COL_NAME);
        $this->filter(function (Filter $filter) {
            $filter->like(model::COL_NAME);
        });
    }
}
