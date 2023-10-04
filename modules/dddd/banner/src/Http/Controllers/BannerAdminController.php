<?php

namespace DDDD\Banner\Http\Controllers;

use DDDD\Banner\Models\Banner;
use DDDD\Blog\Admin\Selectable\PageSelectable;
// use DDDD\CatalogProduct\Selectable\CategorySelectable;
// use DDDD\CatalogProduct\Selectable\ProductSelectable;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BannerAdminController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banner';


    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        Permission::check('DDDD.banner');
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->grid());
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        Permission::check('DDDD.banner.edit');
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }


    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        Permission::check('DDDD.banner.create');
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Banner);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('uuid', __('UUID'));
        $grid->column('description', __('Description'));
        $grid->column('banner_type', __('Banner Type'));
        $grid->column('position', __('Position'));


        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->actions(function ($actions) {
            if (!Admin::user()->can('DDDD.banner.delete')) {
                $actions->disableDelete();
            }
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail( $id): Show
    {
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Name'));
        $show->field('uuid', __('UUID'));
        $show->field('description', __('Description'));
        $show->field('banner_type', __('Banner Type'));
        $show->field('banner_style', __('Banner Style'));
        $show->field('position', __('Position'));

        $show->field('category_id', __('Category IDs'))->badge('green');

        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->items('Banner Items', function ($items) {
            $items->setResource('/admin/banner-items');
            $items->id();
            $items->name();
            $items->url();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new Banner);

        $form->text('name', 'Name')->required();
        $form->text('uuid', 'UUID')->required();
        $form->textarea('description', 'Description')->rows(5);
        $form->select('banner_type', 'Banner type')
            ->options([
                    'home' => 'Home',
                    'catalog-product' => 'Product Page',
                    'catalog-category' => 'Category Page',
                    'pages' => 'Pages',
                    'custom' => 'Custom'
                ])
            // ->when('catalog-product', function (Form $form) {
            //     $form->belongsToMany('products', ProductSelectable::class, __('Products'));
            //     $form->belongsToMany('categories', CategorySelectable::class, __('Categories'));
            // })
            // ->when('catalog-category', function (Form $form) {
            //     $form->belongsToMany('categories', CategorySelectable::class, __('Categories'));
            // })
            // ->when('pages', function (Form $form) {
            //     $form->belongsToMany('pages', PageSelectable::class, __('Pages'));
            // })
            ->default('home')
            ->required();

        $form->select('banner_style', 'Banner style')
            ->options(['image' => 'Image', 'slide' => 'Slide'])
            ->required();

        $form->select('position', 'Position')
            ->options(['left' => 'Left', 'right' => 'Right', 'bottom' => 'Bottom', 'none' => 'None'])
            ->default('none');

        $form->tools(function (Form\Tools $tools) {
            if (!Admin::user()->can('DDDD.banner.delete')) {
                $tools->disableDelete();
            }
        });

        return $form;
    }
}
