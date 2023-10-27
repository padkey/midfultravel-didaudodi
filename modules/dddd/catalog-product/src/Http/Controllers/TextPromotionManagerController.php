<?php

namespace DDDD\CatalogProduct\Http\Controllers;

use App\Admin\Controllers\AdminDashboardController;
use DDDD\CatalogProduct\CatalogProduct;
use DDDD\CatalogProduct\Models\CatalogProduct as ProductModel;
use DDDD\CatalogProduct\Models\TextPromotion;
use DDDD\CatalogProduct\Models\TextPromotionGroup;
use DDDD\CatalogProduct\Selectable\ProductSelectable as ProductSelect;
use DDDD\CatalogProduct\Selectable\CategorySelectable as CategorySelect;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Form;
use Encore\Admin\Show;
use Encore\Admin\Grid;

class TextPromotionManagerController extends AdminDashboardController
{
    public function grid(): Grid
    {
        $grid = new Grid(new TextPromotionGroup);
        $grid->column(TextPromotionGroup::COL_ID);
        $grid->column(TextPromotionGroup::COL_URL);
        $grid->column(TextPromotionGroup::COL_TEXT);
        $grid->column(TextPromotionGroup::COL_ADDITIONAL_INFO);
        $grid->filter(function($filter){
            $filter->ilike(TextPromotionGroup::COL_TEXT);
        });
        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new TextPromotionGroup);
        $form->tab('General', function (Form $form){
            $form->text(TextPromotionGroup::COL_URL)->required();
            $form->text(TextPromotionGroup::COL_TEXT)->required();
            $form->text(TextPromotionGroup::COL_ADDITIONAL_INFO);
        });

        $form->tab('Products',function (Form $form){
           $form->belongsToMany('products', ProductSelect::class, __('Choose'));
        });
        $form->tab('Categories',function (Form $form){
            $form->belongsToMany('categories', CategorySelect::class, __('Choose'));
        });
        return $form;
    }

    protected function getPermissionKey(): string
    {
        return CatalogProduct::TEXT_PROMOTION_PERMISSION_SLUG;
    }
}
