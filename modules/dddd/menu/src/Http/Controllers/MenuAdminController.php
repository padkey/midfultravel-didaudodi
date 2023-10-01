<?php

namespace DDDD\Menu\Http\Controllers;

use App\Http\Controllers\Controller;
use DDDD\Blog\Admin\Selectable\PageSelectable;
//use DDDD\CatalogProduct\Selectable\CategorySelectable;
use DDDD\Menu\Models\Menu;
use DDDD\Menu\Models\MenuItems;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;

class MenuAdminController extends Controller
{
    use HasResourceActions;

    /**
     * Make: Index Page
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content): Content
    {
        Permission::check('dtv.menu');
        return $content
            ->title('Menu Management')
            ->row(function (Row $row) {
                $row->column(12, $this->grid()->render());
            });
    }

    /**
     * Make: Edit Page
     *
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content): Content
    {
        Permission::check('dtv.menu.edit');
        return $content
            ->title('Menu Edit')
            ->row($this->form()->edit($id));
    }

    /**
     * Make: Create Page
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content): Content
    {
        Permission::check('dtv.menu.create');
        return $content
            ->title('Menu Create')
            ->row($this->form());
    }

    /**
     * Make: Detail Page
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content): Content
    {
        Permission::check('dtv.menu.edit');
        return $content
            ->title('Menu Detail')
            ->row(function (Row $row) use ($id) {
                $row->column(12, function (Column $column) use ($id) {
                    $show = new Show(Menu::findOrFail($id));
                    $show->field(Menu::COL_ID, __('ID'));
                    $show->field(Menu::COL_NAME, __('Name'));
                    $show->field(Menu::COL_DESCRIPTION, __('Description'));
                    $column->append($show);
                });
            })
            ->row(function (Row $row) use ($id) {
                $row->column(6, $this->treeView($id)->render());
                if (Admin::user()->can('dtv.menu.create')) {
                    $row->column(6, function (Column $column) use ($id) {
                        $form = new \Encore\Admin\Widgets\Form;
                        $form->action(admin_url('menu-items'));
                        $form->select('parent_id', 'Parent ID')->options(MenuItems::selectOptions(null,'ROOT', $id));
                        $form->select('menu_id', 'Menu')->options(Menu::find($id)->pluck('name', 'id'))->default($id)->readonly();
                        $form->text('name', 'Name')->rules('required');
                        $form->url('url', 'URL')->rules('required');
                        $form->select('target_attr', 'Target attribute')
                            ->options([
                                '_blank' => '_blank',
                                '_self' => '_self',
                                '_parent' => '_parent',
                                '_top' => '_top',
                            ])->rules('required');

                        $form->select('type', 'Type')
                            ->options(['item' => 'Item', 'group' => 'Group'])
                            ->when('=', 'item', function (\Encore\Admin\Widgets\Form $form) {
                                $form->image('icon', 'Icon Image');
                                $form->color('color', 'Color');
                                $form->image('image', 'Image');
                                $form->select('is_use_label_on_mobile', 'Is Use Label On Mobile')
                                    ->options([true => 'Yes', false => 'No']);
                            });

                        $form->hidden('_token')->default(csrf_token());
                        $column->append((new Box('Add New', $form))->style('success'));
                    });
                }
            });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Menu);

        $grid->column(Menu::COL_ID, __('ID'))->sortable();
        $grid->column(Menu::COL_MENU_KEY, __('Menu key'));
        $grid->column(Menu::COL_NAME, __('Name'));
        $grid->column(Menu::COL_DESCRIPTION, __('Description'));

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function($filter){
            $filter->like(Menu::COL_MENU_KEY, __('Menu key'));
        });

        $grid->actions(function ($actions) {
            if (!Admin::user()->can('dtv.menu.delete')) {
                $actions->disableDelete();
            }
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new Menu);

        $form->text(Menu::COL_NAME, 'Name')->required();
        $form->text(Menu::COL_MENU_KEY, __('Menu key'))->required();
        $form->textarea(Menu::COL_DESCRIPTION, 'Description')->rows(5);
        // $form->select('menu_type', 'Menu type')
        //     ->options([
        //         'static' => 'Static',
        //         'catalog-category' => 'Catalog Category',
        //         'pages' => 'Pages',
        //     ])
        //     ->when('catalog-category', function (Form $form) {
        //         $form->belongsToMany('categories', CategorySelectable::class, __('Categories'));
        //     })
        //     ->when('pages', function (Form $form) {
        //         $form->belongsToMany('pages', PageSelectable::class, __('Pages'));
        //     })
        //     ->default('static')
        //     ->required();

        $form->number(Menu::COL_DISPLAY_ORDER)
            ->default(1);
        $form->select(Menu::COL_DISPLAY_STYLE)
            ->options(Menu::STYLE_OPTIONS);

        $form->tools(function (Form\Tools $tools) {
            if (!Admin::user()->can('dtv.menu.delete')) {
                $tools->disableDelete();
            }
        });
        return $form;
    }

    /**
     * Make a tree form builder.
     *
     * @param $id
     * @return Tree
     */
    protected function treeView($id): Tree
    {
        $tree = new Tree(new MenuItems);

        $tree->disableCreate();
        $tree->query(function ($model) use ($id) {
            return $model->where('menu_id', $id);
        });
        $tree->path = admin_url('menu-items');

        $tree->branch(function ($branch) {
            $payload = "{$branch['id']} &nbsp; | &nbsp; <i class='fa {$branch['icon']}'></i>&nbsp;&nbsp;<strong>{$branch['name']}</strong>";

            if (!isset($branch['children'])) {
                $url = $branch['url'];
                $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$url\" class=\"dd-nodrag\">$url</a>";
            }

            return $payload;
        });

        return $tree;
    }
}
