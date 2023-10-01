<?php

namespace DTV\Banner;

use Encore\Admin\Extension;

class Banner extends Extension
{
    public $name = 'banner';

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        try {
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
            if (!$permissionModel::firstWhere('slug', 'dtv.banner')) {
                parent::createPermission('Banner', 'dtv.banner', 'banner*');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.banner.edit')) {
                parent::createPermission('Banner edit', 'dtv.banner.edit', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.banner.create')) {
                parent::createPermission('Banner create', 'dtv.banner.create', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.banner.delete')) {
                parent::createPermission('Banner delete', 'dtv.banner.delete', '');
            }
        } catch (\Exception) {
            return;
        }

    }
}
