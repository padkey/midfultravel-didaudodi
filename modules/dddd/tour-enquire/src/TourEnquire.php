<?php

namespace DDDD\TourEnquire;

use App\Admin\Extension\CRUDPermission;
use Encore\Admin\Extension;

class TourEnquire extends Extension
{
    public $name = 'TourEnquire';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';


    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        
            $menuModel = config('admin.database.menu_model');

       
            if (!$menuModel::firstWhere('uri', 'tour-enquire')) {
                parent::createMenu('Tour Enquire', 'tour-enquire', 'fa-commenting-o');
            }

         //   CRUDPermission::initPermission("product-TourEnquire", self::PRODUCT_TourEnquire_PERMISSION_SLUG);
         //   CRUDPermission::initPermission("TourEnquire", self::TourEnquire_PERMISSION_SLUG);

    }
}
