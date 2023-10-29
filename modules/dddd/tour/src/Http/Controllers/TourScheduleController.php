<?php

namespace DDDD\Tour\Http\Controllers;


use DDDD\Tour\Models\TourModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use DDDD\Tour\Models\TourSchedule;

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
        $grid->column('sub_title', __('Sub title'));
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
        $form->select('tour_id', 'Tour ID')
            ->options(TourModel::all()->pluck('name', 'id'))
            ->default(Request::capture()->query('tour_id'))
            ->required();
        return $form;
    }
}
