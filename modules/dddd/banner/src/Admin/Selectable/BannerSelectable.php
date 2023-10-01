<?php

namespace DTV\Banner\Admin\Selectable;

use DTV\Banner\Models\Banner as model;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

/**
 * Class BannerSelectable
 * @package DTV\Banner\Admin\Selectable
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
