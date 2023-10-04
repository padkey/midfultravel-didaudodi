<?php

namespace DDDD\Blog\Http\Controllers;

use DDDD\Blog\Models\UploadFileMedia;
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
class UploadFileMediaController extends AdminController
{

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new UploadFileMedia());
        $form->text(UploadFileMedia::COL_TITLE);
        //$form->text(UploadFileMedia::COL_URL_FILE);
        $form->file(UploadFileMedia::COL_FILE);

        $form->setTitle("Upload File media");
        return $form;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new UploadFileMedia());
        $grid->column(UploadFileMedia::COL_ID)->sortable();
        $grid->column(UploadFileMedia::COL_TITLE);
        $grid->column(UploadFileMedia::COL_URL_FILE);
        //$grid->column(UploadFileMedia::COL_FILE);

        return $grid;
    }

    protected function getPermissionKey(): string
    {
        return 'upload_file_media';
    }
}
