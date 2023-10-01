<?php

namespace DDDD\Blog\Admin\Selectable;

use DDDD\Blog\Models\BlogPost as BlogPostModel;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

/**
 * Class BlogPost
 * @package DTV\Blog\Admin\Selectable
 */
class BlogPostSelectable extends Selectable
{
    public $model = BlogPostModel::class;

    public function make()
    {
        $this->column(BlogPostModel::COL_ID);
        $this->column(BlogPostModel::COL_TITLE);
        $this->column(BlogPostModel::COL_IMAGE_THUMBNAIL,'Thumbnail')->image();
        $this->column(BlogPostModel::COL_CREATED_AT);

        $this->filter(function (Filter $filter) {
            $filter->like(BlogPostModel::COL_TITLE);
        });
    }
}
