<?php

namespace DDDD\Blog\Http\Controllers;

use DDDD\Blog\Models\Pages;
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

/**
 * Class PagesController
 * @package DTV\Blog\Http\Controllers
 */
class PagesController extends Controller
{
    use HasResourceActions;

    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        Permission::check('dddd.pages');
        return $content
            ->title("Pages")
            ->row(function (Row $row) {
                $row->column(12, $this->grid()->render());
            });
    }

    /**
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        Permission::check('dtv.pages.edit');
        return $content
            ->title(__("Edit page"))
            ->row(function (Row $row) use ($id) {
                $row->column(12, function (Column $column) use ($id) {
                    $column->append($this->form()->edit($id));
                });
            });
    }

    /**
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        Permission::check('dddd.pages.create');
        return $content
            ->title(__("New Page"))
            ->row(function (Row $row) {
                $row->column(12, function (Column $column){
                    $column->append($this->form());
                });
            });
    }

    /**
     * @param $id
     * @param Content $content
     * @return mixed
     */
    public function show($id, Content $content)
    {
        return redirect()->route('pages.edit', ['page' => $id]);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Pages);
        $grid->column(Pages::COL_ID, __("ID"))->sortable();
        $grid->column(Pages::COL_TITLE, __("Title"));
        $grid->column(Pages::COL_URL_KEY);
        $grid->column(Pages::COL_IS_ACTIVE, __("Status"))->bool();
        $grid->column(Pages::COL_PUBLIC_DATE, __("Public Date"))->display(function () {
            $date = date_create($this->{Pages::COL_PUBLIC_DATE});
            return date_format($date,"Y/m/d H:i:s");
        });
        $grid->column(Pages::COL_CREATED_AT, __("Created At"))->display(function () {
            return date_format($this->{Pages::COL_CREATED_AT},"Y/m/d H:i:s");
        });
        $grid->filter(function($filter){
            $filter->ilike(Pages::COL_TITLE, __("Title"));
            $filter->like(Pages::COL_URL_KEY);
            $filter->between(Pages::COL_PUBLIC_DATE,  __("Public Date"))->datetime();
            $filter->equal(Pages::COL_IS_ACTIVE, __("Status"))->select([0 => _("Inactive"), 1 => _("Active")]);
        });
        $grid->actions(function ($actions) {
            if (!Admin::user()->can('dddd.pages.delete')) {
                $actions->disableDelete();
            }
            //$actions->add(new \App\Admin\Actions\QuickView);
        });
        $grid->perPages([10,20,50,100,200,500,999]);
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new Pages);
        $form->tab(__("General Information"), function ($form) {
            $form->text(Pages::COL_TITLE, __("Title"))->rules("required");
            if ($form->isEditing()) {
                $form->text(Pages::COL_URL_KEY, __("Url Key"))->rules("required");
            }
            $form->select(Pages::COL_IS_ACTIVE, "Status")->options([1 => "Active", 0 => "Inactive"]);
            $form->datetime(Pages::COL_PUBLIC_DATE)->rules("required");
        });

        $form->tab(__("Content"), function ($form) {
            $form->image(Pages::COL_AVATAR, __("Avatar"))->setWidth(4, 2)->uniqueName();
            //$form->multipleImage(Pages::COL_AVATAR, __("Avatar"))->removable()->uniqueName();

            $form->tmeditor(Pages::COL_CONTENT)->rules("required");
        });
        $form->tab(__("Meta Data"), function ($form) {
            $form->text(Pages::COL_META_TITLE, __("Meta Title"))->rules("required");
            $form->image(Pages::COL_META_THUMBNAIL, __("Meta Thumbnail"))->setWidth(4, 2)->uniqueName();
            $form->textarea(Pages::COL_META_KEYWORDS, __("Meta Keywords"))->rules("required");
            $form->textarea(Pages::COL_META_DESCRIPTION, __("Meta Description"))->rules("required");
        });


        $form->tools(function (Form\Tools $tools) {
            if (!Admin::user()->can('dtv.pages.delete')) {
                $tools->disableDelete();
            }
        });

        $form->disableReset();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();

        $form->setTitle("Page Information");
        return $form;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        try {
            return $this->form()->store();
        } catch (\Exception $exception) {
            $content = new Content();
            $content->withError(_("Notification"), $exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return mixed|Response
     */
    public function update($id)
    {
        try {
            return $this->form()->update($id);
        } catch (\Exception $exception) {
            $content = new Content();
            $content->withError(_("Notification"), $exception->getMessage());
            return back()->withInput();
        }
    }
}
