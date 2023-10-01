<?php

namespace DDDD\Blog\Admin\Selectable;

use DDDD\Blog\Models\BlogTag as BlogTagModel;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

/**
 * Class BlogTag
 * @package DTV\Blog\Admin\Selectable
 */
class BlogTagSelectable extends Selectable
{
    /**
     * @var string
     */
    public $model = BlogTagModel::class;

    const RESOURCE_PATH = "/admin/blog-tag";

    public function make()
    {
        $this->column(BlogTagModel::COL_ID);
        $this->column(BlogTagModel::COL_TAG_KEY);
        $this->column(BlogTagModel::COL_CREATED_AT);
        $this->filter(function (Filter $filter) {
            $filter->like(BlogTagModel::COL_TAG_KEY);
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
