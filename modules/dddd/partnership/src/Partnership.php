<?php

namespace DDDD\Partnership;
use Encore\Admin\Extension;
use App\Admin\Extension\CRUDPermission;
class Partnership extends Extension
{
    public $name = 'partnership';

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        try {
            $menuModel = config('admin.database.menu_model');

            if (!$menuModel::firstWhere('uri', 'partnership-management')) {
                $menuModelId = parent::createMenu('Partnership Management', 'partnership-management', 'fa-codiepie', 0)->id;
            } else {
                $menuModelId = $menuModel::firstWhere('uri', 'partnership-management')->id;
            }

            if (!$menuModel::firstWhere('uri', 'partnership')) {
                parent::createMenu('Partnership', 'partnership', 'fa-bars', $menuModelId);
            }
            if (!$menuModel::firstWhere('uri', 'partnership-branch')) {
                parent::createMenu('Partnership Branch', 'partnership-branch', 'fa-bars', $menuModelId);
            }
        } catch (\Exception $exception) {
            return;
        }
    }
}
