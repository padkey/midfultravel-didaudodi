<?php

namespace DDDD\Partnership\Http\Controllers;

use DDDD\Partnership\Models\PartnershipModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Show;
use DDDD\Blog\Models\Locale;
use DDDD\Tour\Models\PartnershipBranch;
class PartnershipController extends AdminController
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
            ->title("Partnership")
            ->row(function (Row $row) {
                $row->column(12, $this->grid()->render());
            });
    }
        /**
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        // Permission::check('dtv.blog-post.create');
        return $content
            ->title(__("New Tour"))
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
            ->title(__("Edit Tour"))
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
        $grid = new Grid(new PartnershipModel);
        $grid->column(PartnershipModel::COL_ID, __("ID"))->sortable();
        $grid->column(PartnershipModel::COL_NAME, __("Name"));
        $grid->column(PartnershipModel::COL_LOCALE_CODE, __("Language"));
      //  $grid->column(PartnershipModel::COL_SHORT_DESCRIPTION, __("DESCRIPTION"));
        $grid->column(PartnershipModel::COL_URL);

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new PartnershipModel);
        $locales = Locale::all();
        $arrayLocale = [];
        foreach ($locales as $locale) {
            $arrayLocale[$locale->code] = $locale->name;
        }
        $form->select(PartnershipModel::COL_LOCALE_CODE,__("Language"))->options(
            $arrayLocale
        )->setWidth(4, 2);

        $form->text(PartnershipModel::COL_NAME, __("Name"))->rules("required");

        $form->image(PartnershipModel::COL_IMAGE, __("Image"))->setWidth(4, 2)->uniqueName();
        if ($form->isEditing()) {
            $form->text(PartnershipModel::COL_URL, __("Url Key"))->rules("required");
        }
        $form->textarea(PartnershipModel::COL_SHORT_DESCRIPTION, __("Short Description"));
        $form->tmeditor(PartnershipModel::COL_DESCRIPTION, __("Description"));

        // $form->tab(__("Meta Data"), function ($form) {
        //     $form->text(Partnership::COL_META_TITLE, __("Meta Title"))->rules("required");
        //     $form->textarea(Partnership::COL_META_KEYWORDS, __("Meta Keywords"))->rules("required");
        //     $form->textarea(Partnership::COL_META_DESCRIPTION, __("Meta Description"))->rules("required");
        // });

        return $form;
    }
}
