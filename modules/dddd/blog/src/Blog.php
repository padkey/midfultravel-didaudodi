<?php

namespace DDDD\Blog;

use Encore\Admin\Extension;

class Blog extends Extension
{
    public $name = 'blog';

    /**
     * {@inheritdoc}
     */
    public static function import()
    {

        try {
            $menuModel = config('admin.database.menu_model');
            if (!$menuModel::firstWhere('uri', 'blog')) {
                $menuModelId = parent::createMenu('Blog', 'blog', 'fa-dashcube', 0)->id;
            } else {
                $menuModelId = $menuModel::firstWhere('uri', 'blog')->id;
            }

            if (!$menuModel::firstWhere('uri', 'blog-category')) {
                parent::createMenu('Blog category', 'blog-category', 'fa-book', $menuModelId);
            }

            if (!$menuModel::firstWhere('uri', 'blog-post')) {
                parent::createMenu('Blog post', 'blog-post', 'fa-file-powerpoint-o', $menuModelId);
            }

            if (!$menuModel::firstWhere('uri', 'pages')) {
                parent::createMenu('Pages', 'pages', 'fa-tags', $menuModelId);
            }
            if (!$menuModel::firstWhere('uri', 'tour')) {
                parent::createMenu('Tour', 'tour', 'fa-linux', $menuModelId);
            }

        } catch (\Exception $exception) {
            throwException($exception);
            return;
        }

    }
}