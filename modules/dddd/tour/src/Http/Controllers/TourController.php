<?php

namespace DDDD\Tour\Http\Controllers;

use DDDD\Blog\Models\Locale;
use DDDD\Tour\Models\TourModel;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use http\Env\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Show;
use DDDD\Partnership\Models\PartnershipBranch;
use DDDD\Partnership\Models\TourPartnershipBranch;
Use Encore\Admin\Widgets\Table;


class TourController extends AdminController
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
        return $content->title('Tour Details')->body($this->detail($id));

    }

    protected function detail( $id): Show
    {
        $show = new Show(TourModel::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Name'));
        $show->field('is_active', __('Active'))->as(function ($status) {
            return 1 ? 'On' : 'Off';
        });

        $show->tourSchedule('Tour Schedule', function ($items) {
            $items->setResource('/admin/tour-schedule');
            $items->id();
            $items->title();
            $items->order()->editable()->sortable();
        })->orderBy('order','DESC');

        return $show;
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
        $grid = new Grid(new TourModel);
        $grid->column(TourModel::COL_ID, __("ID"))->sortable();
        $grid->column(TourModel::COL_NAME, __("Name"))->modal('Schedule Tour', function ($model) {
            $comments = $model->tourSchedule()->get()->map(function ($comment) {
                return $comment->only(['id', 'title','meal','order']);
            });
            return new Table(['ID', 'Title', 'Meals','Order'], $comments->toArray());
        });;
        $grid->column(TourModel::COL_LOCALE_CODE, __("Language"));
        $grid->column(TourModel::COL_IS_ACTIVE)->bool();
        $grid->column(TourModel::COL_URL)->editable();
        $grid->column(TourModel::COL_DATE_START);
        $grid->column(TourModel::COL_DATE_END);
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new TourModel);
        $locales = Locale::all();
        $arrayLocale = [];
        foreach ($locales as $locale) {
            $arrayLocale[$locale->code] = $locale->name;
        }
        $form->select(TourModel::COL_LOCALE_CODE,__("Language"))->options(
            $arrayLocale
        )->setWidth(4, 2);
        $form->tab(__("General Information"), function ($form) {
            $states = [
                'on' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];

            $form->text(TourModel::COL_NAME, __("Name"))->rules("required");
            $form->switch(TourModel::COL_IS_ACTIVE, 'Is Active?')->states($states);
            $form->select(TourModel::COL_REGION)->options(
                [
                    'Asia'=>'Asia',
                    'Africa'=>'Africa',
                    'the Americas'=>'The Americas',
                    'Europe'=>'Europe',
                    'Oceania'=>'Oceania',
                ])->setWidth(4, 2);
            $form->multipleImage(TourModel::COL_IMAGE, __("Overview Image"))->setWidth(4, 2)->removable()->sortable()->uniqueName();
            $form->image(TourModel::COL_IMAGE_THUMBNAIL, __("Image Thumbnail Desktop"))->setWidth(4, 2)->removable()->uniqueName();
            $form->image(TourModel::COL_IMAGE_THUMBNAIL_MOBILE, __("Image Thumbnail Mobile"))->setWidth(4, 2)->removable()->uniqueName();
            $form->text(TourModel::COL_TYPE_TOUR, __("Type tour"))->rules("required");
            if ($form->isEditing()) {
                $form->text(TourModel::COL_URL, __("Url Key"))->rules("required");
            }



        });
        $form->multipleSelect('partnershipBranch','Partnership Branch')
            ->options(PartnershipBranch::all()->pluck('name','id'))
            //->default(Request::capture()->query('partnership_branch_id'))
            ->required();

        $form->datetime(TourModel::COL_DATE_START)->rules("required");
        $form->datetime(TourModel::COL_DATE_END)->rules("required");

        $form->tab(__("Content"), function ($form) {
            $form->tmeditor(TourModel::COL_IMPORTANT_INFORMATION, __("Important Information"));
            $form->tmeditor('important_info_1', __("Our Service"));
            $form->tmeditor('important_info_2', __("Tour Condition"));
            $form->tmeditor('important_info_3', __("Condition in euro"));
            $form->tmeditor('important_info_4', __("Schedule in mindful center"));
            $form->textarea(TourModel::COL_SHORT_DESCRIPTION, __("Short Description"));
           // $form->tmeditor(TourModel::COL_CONTENT);
            $form->textarea(TourModel::COL_PLACE_OVERVIEW, __("Place Overview"));
            $form->image(TourModel::COL_IMAGE_TRIP_HIGHTLIGHTS, __("Image Trip Highlights"))->setWidth(4, 2)->uniqueName();
            $form->tmeditor(TourModel::COL_TRIP_HIGHTLIGHTS, __("Text Trip Highlights"));

        });
        $form->tab(__("Meta Data"), function ($form) {
            $form->text(TourModel::COL_META_TITLE, __("Meta Title"))->rules("required");
            $form->textarea(TourModel::COL_META_KEYWORDS, __("Meta Keywords"))->rules("required");
            $form->textarea(TourModel::COL_META_DESCRIPTION, __("Meta Description"))->rules("required");
        });

        return $form;
    }
}
