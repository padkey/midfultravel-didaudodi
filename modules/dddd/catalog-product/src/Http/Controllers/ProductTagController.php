<?php

namespace DDDD\CatalogProduct\Http\Controllers;

use DDDD\CatalogProduct\Models\ProductTag;
use DDDD\CatalogProduct\Selectable\ProductSelectable;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Admin\Controllers\AdminDashboardController;
use DDDD\CatalogProduct\CatalogProduct;

/**
 * Class BlogTagController
 * @package DDDD\Blog\Http\Controllers
 */
class ProductTagController extends AdminDashboardController
{

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = 0): Form
    {
        $form = new Form(new ProductTag());

        $form->tab('General', function (Form $form) {
            $form->text(ProductTag::COL_TAG_KEY)->rules("required");
            $form->text(ProductTag::COL_NAME)->rules("required");
            $form->belongsToMany('products', ProductSelectable::class, __('Choose product'));
        });
        $form->tab('Content', function (Form $form) {
            $form->tmeditor(ProductTag::COL_DESCRIPTION);
        });
        $form->tab('Meta', function (Form $form) {
            $form->text(ProductTag::COL_META_TITLE);
            $form->text(ProductTag::COL_META_KEYWORDS);
            $form->textarea(ProductTag::COL_META_DESCRIPTION);
            $form->image(ProductTag::COL_META_THUMBNAIL);
            $form->switch(ProductTag::COL_META_FOLLOW, __("Follow"))->default(true);
            $form->switch(ProductTag::COL_META_INDEX, __("Index"))->default(true);
            $form->text(ProductTag::COL_CANONICAL_TAG);
        });

        $form->tools(function (Form\Tools $tools) use ($id) {
            if (!Admin::user()->can('DDDD.product-tag.delete')) {
                $tools->disableDelete();
            }
            if ($id != 0) {
                $tools->append(new \App\Admin\Tools\QuickView(ProductTag::query()->findOrFail($id)));
            }
        });
        $form->setTitle("Tag Information");
        return $form;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new ProductTag());
        $grid->column(ProductTag::COL_ID, __("ID"))->sortable();
        $grid->column(ProductTag::COL_TAG_KEY, __("Tag Key"));
        $grid->column(ProductTag::COL_NAME, __("Tag Name"));
        $grid->column(ProductTag::COL_META_TITLE);
        $grid->column(ProductTag::COL_META_DESCRIPTION);
        $grid->column(ProductTag::COL_META_KEYWORDS);
        $grid->column(ProductTag::COL_DESCRIPTION)->hide();
        $grid->column(ProductTag::COL_AUTHOR_UPDATE_NAME_EXT, __("Author Update"));
        $grid->column(ProductTag::COL_AUTHOR_NAME_EXT, __("Author Create"));
        $grid->column('uri')->display(function () {
           return "the-san-pham/" . $this->{ProductTag::COL_TAG_KEY};
        });
        $grid->column(ProductTag::COL_CREATED_AT, __("Created At"))->display(function () {
            return date_format($this->{ProductTag::COL_CREATED_AT},"Y/m/d H:i:s");
        });
        $grid->column(ProductTag::COL_UPDATED_AT, __("Updated At"))->display(function () {
            return date_format($this->{ProductTag::COL_UPDATED_AT},"Y/m/d H:i:s");
        });
        $grid->filter(function($filter){
            $filter->like(ProductTag::COL_TAG_KEY);
            $filter->like(ProductTag::COL_NAME);
        });
        $grid->export(function ($export) {
            $export->originalValue([
                ProductTag::COL_NAME,
                ProductTag::COL_DESCRIPTION,
            ]);
        });
        $grid->actions(function ($actions) {
            $actions->add(new \App\Admin\Actions\QuickView);
        });
        $grid->perPages([10,20,50,100,200,500,999]);
        return $grid;
    }

    protected function getPermissionKey(): string
    {
        return CatalogProduct::PRODUCT_TAG_PERMISSION_SLUG;
    }
}
