<?php

namespace DDDD\Blog\Http\Controllers;

use DDDD\Blog\Models\Block;
use DDDD\Blog\Models\Locale;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Admin\Controllers\AdminDashboardController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Routing\Controller;
use Encore\Admin\Tree;

/**
 * Class BlogTagController
 * @package DTV\Blog\Http\Controllers
 */
class BlockController extends AdminController
{

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $locales = Locale::all();
        $arrayLocale = [];
        foreach ($locales as $locale) {
            $arrayLocale[$locale->code] = $locale->name;
        }
        $form = new Form(new Block());
        $form->select(Block::COL_LOCALE_CODE,__("Language"))->options(
            $arrayLocale
        )->setWidth(4, 2);

        $form->text(Block::COL_TITLE);
        $form->text(Block::COL_CODE);
        $form->select(Block::COL_TYPE)->options(
            [
                'two_image_content_center'=>'Two image content center',
                'one_image_left_content_right'=>'One image left content right',
                'one_image_right_content_left'=>'One image right content left'

            ])->when('two_image_content_center', function (Form $form) {
            $form->image(Block::COL_IMAGE_ONE, __("Image one"))->setWidth(4, 2)->uniqueName();
            $form->image(Block::COL_IMAGE_TWO, __("Image two"))->setWidth(4, 2)->uniqueName();
            })->when('one_image_left_content_right', function (Form $form) {
            $form->image(Block::COL_IMAGE_ONE, __("Image one"))->setWidth(4, 2)->uniqueName();
            })->when('one_image_right_content_left', function (Form $form) {
            $form->image(Block::COL_IMAGE_ONE, __("Image one"))->setWidth(4, 2)->uniqueName();
            });
        $form->tmeditor(Block::COL_CONTENT);
        $form->setTitle("Block Information");
        return $form;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Block());
        $grid->column(Block::COL_ID)->sortable();
        $grid->column(Block::COL_TITLE);
        $grid->column(Block::COL_CODE);
        $grid->column(Block::COL_LOCALE_CODE, __("Language"));
        $grid->filter(function($filter){
            $filter->like(Block::COL_TITLE);
            $filter->like(Block::COL_CODE);
        });
        return $grid;
    }

    protected function getPermissionKey(): string
    {
        return 'block';
    }
}
