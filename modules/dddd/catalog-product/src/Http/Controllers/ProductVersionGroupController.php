<?php

namespace DDDD\CatalogProduct\Http\Controllers;

use DDDD\CatalogProduct\Models\CatalogProduct as ProductModel;
use DDDD\CatalogProduct\Models\ProductVersion;
use DDDD\CatalogProduct\Selectable\ProductSelectable as ProductSelect;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use DDDD\CatalogProduct\Models\ProductVersionGroup;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use DDDD\CatalogProduct\CatalogProduct;
use App\Admin\Controllers\AdminDashboardController;

class ProductVersionGroupController extends AdminDashboardController
{
    public function grid(): Grid
    {
        $grid = new Grid(new ProductVersionGroup);
        $grid->column(ProductVersionGroup::COL_ID);
        $grid->column(ProductVersionGroup::COL_NAME);
        $grid->column(ProductVersionGroup::COL_DISPLAY_TITLE);
        $grid->column(ProductVersionGroup::COL_POSITION);
        $grid->column(ProductVersionGroup::COL_AUTHOR_UPDATE_NAME_EXT, __("Author Update"));
        $grid->column(ProductVersionGroup::COL_AUTHOR_NAME_EXT, __("Author Create"));
        $grid->filter(function($filter){
            $filter->ilike(ProductVersionGroup::COL_NAME);
        });
        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new ProductVersionGroup);
        $form->tab('General', function (Form $form) {
            $form->text(ProductVersionGroup::COL_NAME)->required();
            $form->text(ProductVersionGroup::COL_DISPLAY_TITLE);
            $form->number(ProductVersionGroup::COL_POSITION)->default(1);
            $form->switch(ProductVersionGroup::COL_IS_DISPLAY_TITLE);
        });

        $form->tab('Products', function (Form $form) {
            $form->belongsToMany('products', ProductSelect::class, __('Choose'));
        });

        return $form;
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content): Content
    {
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->row(function (Row $row) use ($id) {
                $row->column(12, function (Column $column) use ($id) {
                    $show = new Show(ProductVersionGroup::findOrFail($id));
                    $show->field(ProductVersionGroup::COL_ID);
                    $show->field(ProductVersionGroup::COL_NAME);
                    $show->field(ProductVersionGroup::COL_DISPLAY_TITLE);
                    $show->field(ProductVersionGroup::COL_IS_DISPLAY_TITLE);
                    $column->append($show);
                });
                $row->column(12, function (Column $column) use ($id) {
                    $grid = new Grid(new ProductVersion());
                    $grid->model()->where(ProductVersion::COL_PRODUCT_VERSION_GROUP_ID, $id);
                    $grid->column('product.'. ProductModel::COL_ENTITY_ID, __("Entity"));
                    $grid->column('product.'. ProductModel::COL_PRODUCT_NAME, __("Product Name"));
                    $grid->column('product.'. ProductModel::COL_SKU, __("Sku"));
                    $grid->column('product.'. ProductModel::COL_PRODUCT_TYPE, __("Product Type"));
                    $grid->column(ProductVersion::COL_ID);
                    $grid->column(ProductVersion::COL_POSITION)->editable();
                    $grid->column(ProductVersion::COL_DISPLAY_TITLE)->editable();
                    $grid->setResource('./../product-version-ajax');
                    $grid->disableCreation();
                    $column->append($grid);
                });
            });
    }

    protected function getPermissionKey(): string
    {
        return CatalogProduct::PRODUCT_VERSION_PERMISSION_SLUG;
    }
}
