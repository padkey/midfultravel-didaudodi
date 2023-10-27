<?php

namespace DDDD\EAVAttribute;

use Encore\Admin\Extension;

class EAVAttribute extends Extension
{
    public $name = 'eav-attribute';

    public static function import()
    {
       //try {
            $menuModel = config('admin.database.menu_model');

            if (!$menuModel::firstWhere('uri', 'eav')) {
                $menuModelId = parent::createMenu('EAV', 'eav', 'fa-medkit', 0)->id;
            } else {
                $menuModelId = $menuModel::firstWhere('uri', 'eav')->id;
            }

            if (!$menuModel::firstWhere('uri', 'eav-attributes')) {
                parent::createMenu('Eav Attributes', 'eav-attributes', 'fa-angle-double-down', $menuModelId);
            }
            if (!$menuModel::firstWhere('uri', 'eav-attribute-sets')) {
                parent::createMenu('Eav Attribute Sets', 'eav-attribute-sets', 'fa-angle-double-down', $menuModelId);
            }
            if (!$menuModel::firstWhere('uri', 'eav-attribute-groups')) {
                parent::createMenu('Eav Attribute Groups', 'eav-attribute-groups', 'fa-angle-double-down', $menuModelId);
            }

            $permissionModel = config('admin.database.permissions_model');

            // attribute
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute')) {
                parent::createPermission('Eav Attribute', 'dtv.eav-attribute', 'eav-attribute*');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute.edit')) {
                parent::createPermission('Eav Attribute Edit', 'dtv.eav-attribute.edit', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute.create')) {
                parent::createPermission('Eav Attribute create', 'dtv.eav-attribute.create', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute.delete')) {
                parent::createPermission('Eav Attribute Delete', 'dtv.eav-attribute.delete', '');
            }

            // attribute-group
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute-group')) {
                parent::createPermission('Eav Attribute Group', 'dtv.eav-attribute-group', 'eav-attribute-group*');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute-group.edit')) {
                parent::createPermission('Eav Attribute Group Edit', 'dtv.eav-attribute-group.edit', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute-group.create')) {
                parent::createPermission('Eav Attribute Group Create', 'dtv.eav-attribute-group.create', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute-group.delete')) {
                parent::createPermission('Eav Attribute Group Delete', 'dtv.eav-attribute-group.delete', '');
            }

            // attribute-set
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute-set')) {
                parent::createPermission('Eav Attribute Set', 'dtv.eav-attribute-set', 'eav-attribute-set*');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute-set.edit')) {
                parent::createPermission('Eav Attribute Set Edit', 'dtv.eav-attribute-set.edit', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute-set.create')) {
                parent::createPermission('Eav Attribute Set Create', 'dtv.eav-attribute-set.create', '');
            }
            if (!$permissionModel::firstWhere('slug', 'dtv.eav-attribute-set.delete')) {
                parent::createPermission('Eav Attribute Set Delete', 'dtv.eav-attribute-set.delete', '');
            }
        // } catch (\Exception) {
        //     return;
        // }
    }
}
