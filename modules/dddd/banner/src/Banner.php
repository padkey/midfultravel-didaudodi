<?php

namespace DDDD\Banner;

use Encore\Admin\Extension;

class Banner extends Extension
{
    public $name = 'banner';

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
            $menuModel = config('admin.database.menu_model');

            if (!$menuModel::firstWhere('uri', 'general')) {
                $menuModelId = parent::createMenu('General Setting', 'general', 'fa-briefcase', 0)->id;
            } else {
                $menuModelId = $menuModel::firstWhere('uri', 'general')->id;
            }

            if (!$menuModel::firstWhere('uri', 'banner')) {
                parent::createMenu('Banner', 'banner', 'fa-image', $menuModelId);
            }

            $permissionModel = config('admin.database.permissions_model');
            if (!$permissionModel::firstWhere('slug', 'dddd.banner')) {
                parent::createPermission('Banner', 'dddd.banner', 'banner*');
            }
            if (!$permissionModel::firstWhere('slug', 'dddd.banner.edit')) {
                parent::createPermission('Banner edit', 'dddd.banner.edit', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dddd.banner.create')) {
                parent::createPermission('Banner create', 'dddd.banner.create', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dddd.banner.delete')) {
                parent::createPermission('Banner delete', 'dddd.banner.delete', '');
            }
       

    }
}
