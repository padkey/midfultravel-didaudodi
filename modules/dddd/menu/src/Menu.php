<?php

namespace DDDD\Menu;

use Encore\Admin\Extension;
use App\Admin\Extension\CRUDPermission;

class Menu extends Extension
{
    public $name = 'menu';

    public $menu = [
        'title' => 'Menu',
        'path' => 'menu',
        'icon' => 'fa-bars',
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

            if (!$menuModel::firstWhere('uri', 'menu')) {
                parent::createMenu('Menu Management', 'menu', 'fa-bars', $menuModelId);
            }
           // CRUDPermission::initPermission("Menu", "menu");
        } catch (\Exception $exception) {
            return;
        }

    }
}
