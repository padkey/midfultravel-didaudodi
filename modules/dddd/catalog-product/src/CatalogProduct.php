<?php

namespace DDDD\CatalogProduct;

use App\Admin\Extension\CRUDPermission;
use Encore\Admin\Extension;

class CatalogProduct extends Extension
{
    public $name = 'catalog-product';

    const PRODUCT_PERMISSION_SLUG = "catalog-product";
    const HOT_SALE_PERMISSION_SLUG = "hot-sale";
    const PRODUCT_VERSION_PERMISSION_SLUG = "product-version";
    const PRODUCT_TAG_PERMISSION_SLUG = "product-tag";

    const TEXT_PROMOTION_PERMISSION_SLUG = "text-promotion-manager";
    const FRAME_LAYER_PERMISSION_SLUG = 'frame-layer';

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

            if (!$menuModel::firstWhere('uri', self::PRODUCT_PERMISSION_SLUG)) {
                parent::createMenu('Catalog Products', self::PRODUCT_PERMISSION_SLUG, 'fa-angle-double-down', $menuModelId);
            }

            if (!$menuModel::firstWhere('uri', self::PRODUCT_TAG_PERMISSION_SLUG)) {
                parent::createMenu('Product Tag', self::PRODUCT_TAG_PERMISSION_SLUG, 'fa-angle-double-down', $menuModelId);
            }

            if (!$menuModel::firstWhere('uri', self::HOT_SALE_PERMISSION_SLUG)) {
                parent::createMenu('Hot Sale', self::HOT_SALE_PERMISSION_SLUG, 'fa-angle-double-down', $menuModelId);
            }

            if (!$menuModel::firstWhere('uri', self::PRODUCT_VERSION_PERMISSION_SLUG)) {
                parent::createMenu('Product Version', self::PRODUCT_VERSION_PERMISSION_SLUG, 'fa-angle-double-down', $menuModelId);
            }

            if (!$menuModel::firstWhere('uri',self::TEXT_PROMOTION_PERMISSION_SLUG)) {
                parent::createMenu('Text Promotion Manager', self::TEXT_PROMOTION_PERMISSION_SLUG, 'fa-angle-double-down', $menuModelId);
            }

            if (!$menuModel::firstWhere('uri',self::FRAME_LAYER_PERMISSION_SLUG)) {
                parent::createMenu('Frame layer', self::FRAME_LAYER_PERMISSION_SLUG, 'fa-angle-double-down', $menuModelId);
            }


            // CRUDPermission::initPermission("Catalog Product", self::PRODUCT_PERMISSION_SLUG);
            // CRUDPermission::initPermission("Hot sale", self::HOT_SALE_PERMISSION_SLUG);
            // CRUDPermission::initPermission("Product version", self::PRODUCT_VERSION_PERMISSION_SLUG);
            // CRUDPermission::initPermission("Product tag", self::PRODUCT_TAG_PERMISSION_SLUG);
            // CRUDPermission::initPermission("Text Promotion Manager", self::TEXT_PROMOTION_PERMISSION_SLUG);
            // CRUDPermission::initPermission("Frame layer", self::FRAME_LAYER_PERMISSION_SLUG);

        // } catch (\Exception) {
        //     return;
        // }
    }
}
