<?php

namespace DDDD\CatalogProduct\Http\Controllers;

use DDDD\CatalogProduct\Models\CatalogProduct as ProductModel;
use DDDD\CatalogProduct\Models\HotSale as HotSaleModel;
use DDDD\CatalogProduct\Models\ProductHotSale as ProductHotSaleModel;
use DDDD\CatalogProduct\Selectable\ProductSelectable as ProductSelect;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use App\Admin\Controllers\AdminDashboardController;
use DDDD\CatalogProduct\CatalogProduct;
class HotSaleController extends AdminDashboardController
{

    public function grid(): Grid
    {
        $grid = new Grid(new HotSaleModel);
        $grid->column(HotSaleModel::COL_ID)->sortable();
        $grid->column(HotSaleModel::COL_CODE);
        $grid->column(HotSaleModel::COL_IS_COUNT_DOWN)->bool();
        $grid->column(HotSaleModel::COL_LINK);
        $grid->column(HotSaleModel::COL_TYPE_PRICE_APPLY);
        $grid->column(HotSaleModel::COL_TIME_COUNT_DOWN);
        $grid->column(HotSaleModel::COL_START);
        $grid->column(HotSaleModel::COL_END);
        $grid->column(HotSaleModel::COL_AUTHOR_UPDATE_NAME_EXT, __("Author Update"));
        $grid->column(HotSaleModel::COL_AUTHOR_NAME_EXT, __("Author Create"));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->getKey() == 1) {
                $actions->disableDelete();
            }
        });

        $grid->tools(function (Grid\Tools $tools) {
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
        });

        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new HotSaleModel);
        $form->tab('General', function (Form $form) {
            $form->text(HotSaleModel::COL_CODE)->required();
            $form->text(HotSaleModel::COL_NAME)->required();
            $form->text(HotSaleModel::COL_LINK);
            $form->color(HotSaleModel::COL_COLOR);
            $form->color(HotSaleModel::COL_COLOR_TWO, __("Color two"));
            $form->color(HotSaleModel::COL_COLOR_TEXT);
            $form->image(HotSaleModel::COL_IMAGE);
            $form->select(HotSaleModel::COL_TYPE_PRICE_APPLY)
                ->options(HotSaleModel::MAP_TYPE_PRICE)->default('origin');
            $form->select(HotSaleModel::COL_IS_COUNT_DOWN)
                ->options([1 => 'Yes', 0 => 'No'])
                ->when(1, function (Form $form) {
                    $form->datetime(HotSaleModel::COL_TIME_COUNT_DOWN);
                })
                ->when(0, function (Form $form) {
                    $form->datetimeRange(HotSaleModel::COL_START, HotSaleModel::COL_END);
                })->default(true);
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
                    $show = new Show(HotSaleModel::findOrFail($id));
                    $show->field(HotSaleModel::COL_ID);
                    $show->field(HotSaleModel::COL_NAME);
                    $show->field(HotSaleModel::COL_LINK);
                    $show->field(HotSaleModel::COL_TYPE_PRICE_APPLY);
                    $show->field(HotSaleModel::COL_TIME_COUNT_DOWN);
                    $show->field(HotSaleModel::COL_START);
                    $show->field(HotSaleModel::COL_END);
                    $column->append($show);
                });
                $row->column(12, function (Column $column) use ($id) {
                    $grid = new Grid(new ProductHotSaleModel());
                    $grid->model()->where(ProductHotSaleModel::COL_HOT_SALE_ID, $id);
                    $grid->column('product.'. ProductModel::COL_ENTITY_ID, __("Entity"));
                    $grid->column('product.'. ProductModel::COL_PRODUCT_NAME, __("Product Name"));
                    $grid->column('product.'. ProductModel::COL_SKU, __("Sku"));
                    $grid->column('product.'. ProductModel::COL_PRODUCT_TYPE, __("Product Type"));
                    $grid->column(ProductHotSaleModel::COL_PRODUCT_ID);
                    $grid->column(ProductHotSaleModel::COL_DISPLAY_ORDER)->editable();
                    $grid->column(ProductHotSaleModel::COL_PRICE_NORTHERN_RIGION)->editable();
                    $grid->column(ProductHotSaleModel::COL_PRICE_SOUTHERN_REGION)->editable();
                    $grid->setResource('./../hot-sale-product-ajax');
                    $grid->disableCreation();
                    $column->append($grid);
                });
            });
    }

    protected function getPermissionKey(): string
    {
        return CatalogProduct::HOT_SALE_PERMISSION_SLUG;
    }
}
