<?php

namespace DDDD\Banner\Admin\Selectable;

use DDDD\Banner\Models\Banner as model;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

/**
 * Class BannerSelectable
 * @package DDDD\Banner\Admin\Selectable
 */
class BannerSelectable extends Selectable
{
    /**
     * @var string
     */
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
