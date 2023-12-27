<?php

namespace DDDD\Blog\Http\Controllers;

use DDDD\Blog\Models\Locale;
use DDDD\Blog\Models\Pages;
use DDDD\Blog\Models\Video;
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
class VideoController extends Controller
{
    use HasResourceActions;

    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        Permission::check('dddd.video');
        return $content
            ->title("Video")
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
            ->title(__("Edit video"))
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
        Permission::check('dddd.video.create');
        return $content
            ->title(__("New Video"))
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
        return redirect()->route('video.edit', ['video' => $id]);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Video);
        $grid->column(Video::COL_ID, __("ID"))->sortable();
        $grid->column(Video::COL_TITLE, __("Title"));
        $grid->column(Video::COL_LOCALE_CODE, __("Language"));
        $grid->column(Video::COL_URL_KEY)->editable();
        //$grid->column(Video::COL_IS_ACTIVE, __("Status"))->bool();

        /*$grid->column(Video::COL_CREATED_AT, __("Created At"))->display(function () {
            return date_format($this->{Video::COL_CREATED_AT},"Y/m/d H:i:s");
        });*/
        $grid->filter(function($filter){
            $filter->ilike(Video::COL_TITLE, __("Title"));
            $filter->like(Video::COL_URL_KEY);
            //$filter->between(Video::COL_PUBLIC_DATE,  __("Public Date"))->datetime();
            $filter->equal(Video::COL_IS_ACTIVE, __("Status"))->select([0 => _("Inactive"), 1 => _("Active")]);
        });
        $grid->actions(function ($actions) {
            if (!Admin::user()->can('dddd.video.delete')) {
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
        $form = new Form(new Video);

        $form->tab(__("General Information"), function ($form) {
            $locales = Locale::all();
            $arrayLocale = [];
            foreach ($locales as $locale) {
                $arrayLocale[$locale->code] = $locale->name;
            }
            $form->select(Video::COL_LOCALE_CODE,__("Language"))->options(
                $arrayLocale
            )->setWidth(4, 2);
            $form->text(Video::COL_TITLE, __("Title"))->rules("required");
            if ($form->isEditing()) {
                $form->text(Video::COL_URL_KEY, __("Url Key"))->rules("required");
            }
            $form->text(Video::COL_URL_VIDEO, __("Url Video"))->rules("required");
            $form->text(Video::COL_AUTHOR, __("Author"));

            $form->select(Video::COL_IS_ACTIVE, "Status")->options([1 => "Active", 0 => "Inactive"]);
           // $form->datetime(Video::COL_PUBLIC_DATE)->rules("required");
        });

        $form->tab(__("Content"), function ($form) {
            $form->image(Video::COL_IMAGE_THUMBNAIL, __("Image thumbnail"))->setWidth(4, 2)->uniqueName();
            //$form->multipleImage(Pages::COL_AVATAR, __("Avatar"))->removable()->uniqueName();

            $form->tmeditor(Video::COL_CONTENT);
        });
        $form->tab(__("Meta Data"), function ($form) {
            $form->text(Video::COL_META_TITLE, __("Meta Title"))->rules("required");
            $form->textarea(Video::COL_META_KEYWORDS, __("Meta Keywords"))->rules("required");
            $form->textarea(Video::COL_META_DESCRIPTION, __("Meta Description"))->rules("required");
        });


        $form->tools(function (Form\Tools $tools) {
            if (!Admin::user()->can('dddd.pages.delete')) {
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
