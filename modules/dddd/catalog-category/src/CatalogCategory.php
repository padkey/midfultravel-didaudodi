<?php

namespace DDDD\CatalogCategory;

use Encore\Admin\Extension;

class CatalogCategory extends Extension
{
    public $name = 'catalog-category';

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        //try {
            $menuModel = config('admin.database.menu_model');

            if (!$menuModel::firstWhere('uri', 'catalogs')) {
                $menuModelId = parent::createMenu('Catalogs', 'catalogs', 'fa-certificate', 0)->id;
            } else {
                $menuModelId = $menuModel::firstWhere('uri', 'catalogs')->id;
            }

            if (!$menuModel::firstWhere('uri', 'catalog-category')) {
                parent::createMenu('Catalog Categories', 'catalog-category', 'fa-angle-double-down', $menuModelId);
            }

            $permissionModel = config('admin.database.permissions_model');
            if (!$permissionModel::firstWhere('slug', 'DDDD.catalog-category')) {
                parent::createPermission('Catalog Category', 'DDDD.catalog-category', 'catalog-category*');
            }
            if (!$permissionModel::firstWhere('slug', 'DDDD.catalog-category.edit')) {
                parent::createPermission('Catalog Category Edit', 'DDDD.catalog-category.edit', '');
            }
            if (!$permissionModel::firstWhere('slug', 'DDDD.catalog-category.create')) {
                parent::createPermission('Catalog Category Create', 'DDDD.catalog-category.create', '');
            }
            if (!$permissionModel::firstWhere('slug', 'DDDD.catalog-category.delete')) {
                parent::createPermission('Catalog Category Delete', 'DDDD.catalog-category.delete', '');
            }
        // } catch (\Exception) {
        //     return;
        // }
    }
}
