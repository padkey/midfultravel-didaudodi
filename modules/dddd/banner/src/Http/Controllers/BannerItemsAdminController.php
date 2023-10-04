<?php

namespace DDDD\Banner\Http\Controllers;

use DDDD\Banner\Models\Banner;
use DDDD\Banner\Models\BannerItems;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class BannerItemsAdminController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banner Items';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new BannerItems);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('banner_id', __('Banner ID'));
        $grid->column('name', __('Name'));
        $grid->column('url', __('URL'));
        $grid->column('is_active', __('Active'))->icon([
            0 => 'toggle-off',
            1 => 'toggle-on',
        ]);
        $grid->column('priority', __('Priority'));

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(BannerItems::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('banner_id', __('Banner ID'))->as(function ($bannerId) {
            // dd(Banner::firstWhere('id', $bannerId)->name);
            return $bannerId . ' - ' . Banner::firstWhere('id', $bannerId)->name;
        });
        $show->field('name', __('Name'));
        $show->field('url', __('URL'))->link();
        $show->field('is_active', __('Active'))->as(function ($status) {
            return 1 ? 'On' : 'Off';
        });
        $show->field('schedule_from', __('Schedule From'));
        $show->field('schedule_to', __('Schedule To'));
        $show->field('province_id', __('Province ID'));
        $show->field('path_desktop', __('Path Desktop'))->image();
        $show->field('path_mobile', __('Path Mobile'))->image();
        $show->field('priority', __('Priority'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new BannerItems);
        $states = [
            'on' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
        ];

        $form->text('name', 'Name')->required();
        $form->url('url', 'URL')->required();

        // dd(Request::capture()->query('banner_id'));

        $form->select('banner_id', 'Banner ID')
            ->options(Banner::all()->pluck('name', 'id'))
            ->default(Request::capture()->query('banner_id'))
            ->required();

        $form->switch('is_active', 'Is Active?')->states($states);
        $form->datetime('schedule_from', 'Schedule From');
        $form->datetime('schedule_to', 'Schedule To');

        $form->image('path_desktop', 'Path Desktop')->uniqueName()->required();
        $form->image('path_mobile', 'Path Mobile')->uniqueName()->required();

        $form->text('priority', 'Priority')->default(0);


        return $form;
    }
}
