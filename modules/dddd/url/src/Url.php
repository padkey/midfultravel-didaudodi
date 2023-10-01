<?php

namespace DDDD\Url;

use Encore\Admin\Extension;

class Url extends Extension
{
    public $name = 'url';

    public $menu = [
        'title' => 'Url Management',
        'path' => 'url',
        'icon' => 'fa-link',
    ];

    /**
     * {@inheritdoc}
     * @throws \Exception
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

            if (!$menuModel::firstWhere('uri', 'url')) {
                parent::createMenu('Url Management', 'url', 'fa-link', $menuModelId);
            }

            $permissionModel = config('admin.database.permissions_model');
            if (!$permissionModel::firstWhere('slug', 'dtv.url')) {
                parent::createPermission('Url', 'dtv.url', 'url*');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.url.edit')) {
                parent::createPermission('Url edit', 'dtv.url.edit', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.url.create')) {
                parent::createPermission('Url create', 'dtv.url.create', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.url.delete')) {
                parent::createPermission('Url delete', 'dtv.url.delete', '');
            }
        } catch (\Exception $e) {
            return;
        }
    }
}
