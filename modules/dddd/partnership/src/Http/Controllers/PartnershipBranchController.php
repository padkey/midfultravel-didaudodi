<?php

namespace DDDD\Partnership\Http\Controllers;


use DDDD\Blog\Models\Locale;
use DDDD\Partnership\Models\PartnershipModel;
use DDDD\Tour\Models\TourModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use DDDD\Partnership\Models\PartnershipBranch;

class PartnershipBranchController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Partnership Branch';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new PartnershipBranch);
        $grid->column('id', __('ID'));
        $grid->column('name', __('Name'))->sortable();
        $grid->column('locale_code', __('Language'));
        $grid->column('address', __('Address'));
        $grid->column('partnership_id', __('Partnership'))->sortable();

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
        $show = new Show(PartnershipBranch::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('name', __('Name'));
        $show->field('locale_code', __('Language '));
        $show->field('address', __('Address '));
        $show->field('partnership_id', __('Partnership'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new PartnershipBranch);
        $locales = Locale::all();
        $arrayLocale = [];
        foreach ($locales as $locale) {
            $arrayLocale[$locale->code] = $locale->name;
        }
        $form->select(PartnershipBranch::COL_LOCALE_CODE,__("Language"))->options(
            $arrayLocale
        )->setWidth(4, 2);
        $form->text('name', 'Name')->required();
        //777 x 430px
        $form->image('image','Image')->uniqueName()->required();
        $form->text('address', 'Address');
        $form->text('link_website', 'Link Website');
        $form->text('short_description', 'Short Description');
        $form->tmeditor('description', 'Description');
        $form->select('partnership_id', 'Partnership ID')
            ->options(PartnershipModel::all()->pluck('name', 'id'))
            ->default(Request::capture()->query('partnership_id'))
            ->required();
        return $form;
    }
}
