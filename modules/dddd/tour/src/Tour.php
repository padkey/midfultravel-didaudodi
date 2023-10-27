<?php

namespace DDDD\Tour;
use Encore\Admin\Extension;
use App\Admin\Extension\CRUDPermission;
class Tour extends Extension
{
    public $name = 'tour';

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

            if (!$menuModel::firstWhere('uri', 'tour')) {
                parent::createMenu('Tour Management', 'tour', 'fa-bars', $menuModelId);
            }
            if (!$menuModel::firstWhere('uri', 'tour_schedule')) {
                parent::createMenu('Tour Management', 'tour', 'fa-bars', $menuModelId);
            }
        } catch (\Exception $exception) {
            return;
        }
    }
}
