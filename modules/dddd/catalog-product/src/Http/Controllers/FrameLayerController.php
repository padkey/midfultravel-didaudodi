<?php

namespace DDDD\CatalogProduct\Http\Controllers;

use App\Admin\Controllers\AdminDashboardController;
use DDDD\CatalogCategory\Admin\Selectable\CategorySelectable;
use DDDD\CatalogProduct\CatalogProduct;
use DDDD\CatalogProduct\Models\FrameLayer;
use DDDD\CatalogProduct\Selectable\ProductSelectable as ProductSelect;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class FrameLayerController extends AdminDashboardController
{
    public function grid(): Grid
    {
        $grid = new Grid(new FrameLayer);
        $grid->column(FrameLayer::COL_ID);
        $grid->column(FrameLayer::COL_NAME);
        $grid->column(FrameLayer::COL_START)->date();
        $grid->column(FrameLayer::COL_END)->date();
        $grid->filter(function($filter){
            $filter->ilike(FrameLayer::COL_NAME);
        });
        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new FrameLayer);
        $form->tab('General', function (Form $form){
            $form->text(FrameLayer::COL_NAME)->required();
            $form->dateRange(FrameLayer::COL_START, FrameLayer::COL_END);
            $form->select(FrameLayer::COL_TYPE)
                ->options(['frame' => 'Frame', 'sticker' => 'Sticker'])->default('frame');
            $form->image(FrameLayer::COL_IMAGE);
        });

        $form->tab('Products',function (Form $form){
           $form->belongsToMany('products', ProductSelect::class, __('Choose'));
        });
        $form->tab('Categories',function (Form $form){
            $form->belongsToMany('categories', CategorySelectable::class, __('Choose'));
        });
        return $form;
    }

    protected function getPermissionKey(): string
    {
        return CatalogProduct::FRAME_LAYER_PERMISSION_SLUG;
    }
}
