<?php

namespace DDDD\Blog\Http\Controllers;

use DDDD\Blog\Models\Companion;
use DDDD\Blog\Models\Locale;
use DDDD\Tour\Models\Partnership;
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
class CompanionController extends Controller
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
            ->title("Companion")
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
            ->title(__("Edit Companion"))
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
            ->title(__("New Companion"))
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
        return redirect()->route('companion.edit', ['companion' => $id]);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Companion);
        $grid->column(Companion::COL_ID, __("ID"))->sortable();
        $grid->column(Companion::COL_NAME, __("Name"));
        $grid->column(Companion::COL_URL_KEY);
        $grid->column(Companion::COL_LOCALE_CODE, __("Language"));

        $grid->column(Companion::COL_CREATED_AT, __("Created At"))->display(function () {
            return date_format($this->{Companion::COL_CREATED_AT},"Y/m/d H:i:s");
        });
        $grid->filter(function($filter){
            $filter->ilike(Companion::COL_NAME, __("name"));
            $filter->like(Companion::COL_URL_KEY);
            //$filter->equal(Companion::COL_IS_ACTIVE, __("Status"))->select([0 => _("Inactive"), 1 => _("Active")]);
        });
        $grid->actions(function ($actions) {
            if (!Admin::user()->can('dddd.companion.delete')) {
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
        $form = new Form(new Companion);
        $locales = Locale::all();
        $arrayLocale = [];
        foreach ($locales as $locale) {
            $arrayLocale[$locale->code] = $locale->name;
        }
        $form->select(Companion::COL_LOCALE_CODE,__("Language"))->options(
            $arrayLocale
        )->setWidth(4, 2);
        $form->tab(__("General Information"), function ($form) {
            $form->text(Companion::COL_NAME, __("Name"))->rules("required");
            $form->text(Companion::COL_COMPANY_NAME, __("Company name"));
            $form->text(Companion::COL_POSITION, __("Position"));

            $form->image(Companion::COL_AVATAR, __("Avatar"))->setWidth(4, 2)->uniqueName();
            if ($form->isEditing()) {
                $form->text(Companion::COL_URL_KEY, __("Url Key"));
            }
            //$form->select(Companion::COL_IS_ACTIVE, "Status")->options([1 => "Active", 0 => "Inactive"]);
        });

        $form->tab(__("Content"), function ($form) {
            //$form->multipleImage(Companion::COL_AVATAR, __("Avatar"))->removable()->uniqueName();
            $form->tmeditor(Companion::COL_CONTENT);
        });
        $form->tab(__("Meta Data"), function ($form) {
            $form->text(Companion::COL_META_TITLE, __("Meta Title"))->rules("required");
            $form->textarea(Companion::COL_META_KEYWORDS, __("Meta Keywords"))->rules("required");
            $form->textarea(Companion::COL_META_DESCRIPTION, __("Meta Description"))->rules("required");
        });


        $form->tools(function (Form\Tools $tools) {
            if (!Admin::user()->can('dddd.companion.delete')) {
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
