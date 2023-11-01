<?php

namespace DDDD\Tour\Http\Controllers;


use DDDD\Blog\Models\BlogCategory;
use DDDD\Tour\Models\TourModel;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Tree;
use Illuminate\Http\Request;
use DDDD\Tour\Models\TourSchedule;
use Encore\Admin\Controllers\ModelForm;

class TourScheduleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tour schedule';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new TourSchedule);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Title'));
        $grid->column('tour_id', __('Tour id'));
        $grid->column('position', __('Position'));
        $grid->column('description', __('Description'));
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
        $show = new Show(TourSchedule::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('title', __('Name'));
        $show->field('sub_title', __('Sub title '));
        $show->field('position', __('Position '));
        $show->field('description', __('Description'));
        return $show;
    }
    protected function treeView(): Tree
    {
        $tree = new Tree(new TourSchedule);
        $tree->branch(function ($branch) {
            return "{$branch[TourSchedule::COL_ID]} &nbsp; | &nbsp;&nbsp;<strong>{$branch[TourSchedule::COL_TITLE]}</strong>| &nbsp;&nbsp;<strong></strong>";
        });

        return $tree;
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new TourSchedule);
        $form->text('title', 'title')->required();
        $form->text('sub_title', 'sub_title')->required();
        $form->text('position', 'position')->required();
        $form->text('meal', 'Meals')->required();
        $form->tmeditor('description', 'description')->required();
        $form->number('order', 'Order')->required();
        $form->select('tour_id', 'Tour ID')
            ->options(TourModel::all()->pluck('name', 'id'))
            ->default(Request::capture()->query('tour_id'))
            ->required();
        return $form;
    }
}
