<?php

namespace DDDD\Blog\Admin\Selectable;

use DDDD\Blog\Models\BlogTag as BlogTagModel;
use DDDD\Blog\Models\Pages;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

/**
 * Class BlogTag
 * @package DTV\Blog\Admin\Selectable
 */
class PageSelectable extends Selectable
{
    /**
     * @var string
     */
    public $model = Pages::class;

    const RESOURCE_PATH = "/admin/blog-tag";

    public function make()
    {
        $this->column(Pages::COL_ID);
        $this->column(Pages::COL_TITLE);
        $this->column(Pages::COL_CREATED_AT);
        $this->filter(function (Filter $filter) {
            $filter->ilike(Pages::COL_TITLE);
        });
    }

    /**
     * @return $this
     */
    protected function disableFeatures()
    {
        $this->resource(self::RESOURCE_PATH);
        return $this->disableExport()
            ->disableActions()
            ->disableBatchActions()
            ->disableColumnSelector()
            ->disablePerPageSelector();
    }
}
