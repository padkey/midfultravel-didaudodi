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
            if (!$menuModel::firstWhere('uri', 'video')) {
                parent::createMenu('Video', 'video', 'fa-youtube', $menuModelId);
            }
            if (!$menuModel::firstWhere('uri', 'companion')) {
                parent::createMenu('Companion', 'companion', 'fa-users', $menuModelId);
            }
            if (!$menuModel::firstWhere('uri', 'block')) {
                parent::createMenu('Block', 'block', 'fa-tags', $menuModelId);
            }
            if (!$menuModel::firstWhere('uri', 'upload-file-media')) {
                parent::createMenu('Upload file media', 'upload-file-media', 'fa-file-pdf-o', $menuModelId);
            }
        } catch (\Exception $exception) {
            throwException($exception);
            return;
        }

    }
}
