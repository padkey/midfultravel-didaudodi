<?php

namespace DDDD\Blog\Admin\Selectable;

use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;
use DDDD\Blog\Models\BlogCategory;

/**
 * Class CategoryPost
 * @package DDDD\Blog\Admin\Selectable
 */
class BlogCategorySelectable extends Selectable
{
    public $model = BlogCategory::class;

    public function make()
    {
        // Setting
        // $this->model()->orderBy(BlogCategory::COL_POSITION, 'asc');

        $this->column(BlogCategory::COL_ID);
        $this->column(BlogCategory::COL_TITLE)->display(function () {
            if ($this->{BlogCategory::COL_PARENT_ID} !== 0) {
                $prefix = preg_replace(['/\//', '/\d+/'], [' ', '--'], $this->{BlogCategory::COL_PATH_LEVEL});
                return $prefix .' | '. $this->{BlogCategory::COL_TITLE};
            }
            return $this->{BlogCategory::COL_TITLE};

        });

        $this->filter(function (Filter $filter) {
            $filter->like(BlogCategory::COL_TITLE);
        });
    }
}
