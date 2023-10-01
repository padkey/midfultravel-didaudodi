<?php

namespace DDDD\Blog\Http\Controllers;

use DDDD\Blog\Models\Tour;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Encore\Admin\Controllers\HasResourceActions;

class TourController extends Controller
{
    use HasResourceActions;

    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        // Permission::check('dtv.blog-post');
        return $content
            ->title("Tour")
            ->row(function (Row $row) {
                $row->column(12, $this->grid()->render());
            });
    }
    /**
     * @param $id
     * @param Content $content
     * @return mixed
     */
    public function show($id, Content $content)
    {
        return redirect()->route('tour.edit', ['tour' => $id]);
    }
        /**
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        // Permission::check('dtv.blog-post.create');
        return $content
            ->title(__("New tour"))
            ->row(function (Row $row) {
                $row->column(12, function (Column $column){
                    $column->append($this->form());
                });
            });
    }

        /**
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        // Permission::check('dtv.blog-post.edit');
        return $content
            ->title(__("Edit tour"))
            ->row(function (Row $row) use ($id) {
                $row->column(12, function (Column $column) use ($id) {
                    $column->append($this->form()->edit($id));
                });
            });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Tour);
        $grid->column(Tour::COL_ID, __("ID"))->sortable();
        $grid->column(Tour::COL_NAME, __("Name"));
        $grid->column(Tour::COL_META_TITLE)->hide();

        $grid->column(Tour::COL_IS_ACTIVE)->bool();
        $grid->column(Tour::COL_META_KEYWORDS);
        $grid->column(Tour::COL_META_DESCRIPTION);
        $grid->column(Tour::COL_DATE_START);
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {

        $form = new Form(new Tour);
        $form->tab(__("General Information"), function ($form) {
            $form->text(Tour::COL_NAME, __("Name"))->rules("required");
            $form->image(Tour::COL_IMAGE, __("Image"))->setWidth(4, 2)->uniqueName();
            $form->image(Tour::COL_IMAGE_THUMBNAIL, __("Image Thumbnail"))->setWidth(4, 2)->uniqueName();
            //$form->text(BlogPost::COL_URL, __("Url Key"))->rules("required");
            if ($form->isEditing()) {
                $form->text(Tour::COL_URL, __("Url Key"))->rules("required");
            }

        });
        $form->datetime(Tour::COL_DATE_START)->rules("required");
        $form->datetime(Tour::COL_DATE_END)->rules("required");

        $form->tab(__("Content"), function ($form) {
            $form->textarea(Tour::COL_SHORT_DESCRIPTION, __("Short Description"));
            $form->tmeditor(Tour::COL_CONTENT);

        });
        $form->tab(__("Meta Data"), function ($form) {
            $form->text(Tour::COL_META_TITLE, __("Meta Title"))->rules("required");
            $form->textarea(Tour::COL_META_KEYWORDS, __("Meta Keywords"))->rules("required");
            $form->textarea(Tour::COL_META_DESCRIPTION, __("Meta Description"))->rules("required");
        });

        return $form;
    }
}
