<?php

namespace DDDD\EAVAttribute\Http\Controllers;

use DDDD\EAVAttribute\Models\EavAttribute;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Log;

class EAVAttributeController extends AdminController
{
    use HasResourceActions;

    protected $title = 'Attributes';
    protected EavAttribute $eavAttribute;

    /**
     * @param EavAttribute $eavAttribute
     */
    function __construct(EavAttribute $eavAttribute)
    {
        $this->eavAttribute = $eavAttribute;
    }

    protected function grid(): Grid
    {
        Permission::check('DDDD.eav-attribute');
        $grid = new Grid($this->eavAttribute);

        $grid->column(EavAttribute::COL_ATTRIBUTE_ID, __('Attribute ID'))->sortable();
        $grid->column(EavAttribute::COL_ATTRIBUTE_TITLE, __('Attribute Title'));
        $grid->column(EavAttribute::COL_ATTRIBUTE_DEFAULT_NAME, __('Attribute Default Name'));
        $grid->column(EavAttribute::COL_ATTRIBUTE_TYPE, __('Attribute Type'));
        $grid->column(EavAttribute::COL_IS_REQUIRE, __('Is Require'))->bool();
        $grid->column(EavAttribute::COL_IS_FILTER, __('Is Filter'))->bool();
        $grid->column(EavAttribute::COL_IS_SYSTEM, __('Is System'))->bool();
        $grid->column(EavAttribute::COL_IS_SHOWN, __('Is Shown'))->bool();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if (!Admin::user()->can('DDDD.eav-attribute.delete') || $actions->row->is_system) {
                $actions->disableDelete();
            }
        });

        $grid->filter(function($filter){
            $filter->equal(EavAttribute::COL_IS_FILTER)->select([ 0 => 'false', 1 => 'true']);
            $filter->equal(EavAttribute::COL_IS_SYSTEM)->select([ 0 => 'false', 1 => 'true']);
            $filter->equal(EavAttribute::COL_IS_REQUIRE)->select([ 0 => 'false', 1 => 'true']);
            $filter->equal(EavAttribute::COL_IS_SHOWN)->select([ 0 => 'false', 1 => 'true']);
            $filter->like(EavAttribute::COL_ATTRIBUTE_DEFAULT_NAME, __('Attribute Default Name'));
        });

        return $grid;
    }

    protected function detail($attribute_id)
    {
        Permission::check('DDDD.eav-attribute');
        $form = $this->form()->edit($attribute_id);
        $form->disableViewCheck()
            ->disableSubmit()
            ->disableCreatingCheck()
            ->disableEditingCheck()
            ->disableReset();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
        return $form;
    }

    public function create(Content $content): Content
    {
        Permission::check('DDDD.eav-attribute.create');
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        Permission::check('DDDD.eav-attribute.edit');
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    public function destroy($id)
    {
        try {
            if (!$this->eavAttribute->find($id)->is_system) {
                Permission::check('DDDD.eav-attribute.delete');
                return $this->form()->destroy($id);
            } else {
                admin_toastr('Can not delete attribute of system', 'error');
            }
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    protected function form(): Form
    {
        $form = new Form($this->eavAttribute);

        $form->text(EavAttribute::COL_ATTRIBUTE_TITLE, __('Attribute Tile'))->required();
        $form->text(EavAttribute::COL_ATTRIBUTE_DEFAULT_NAME, __('Attribute Default Name'))->required();
        $form->switch(EavAttribute::COL_IS_REQUIRE, __('Is Require'));
        if ($form->isEditing()) {
            $form->select(EavAttribute::COL_ATTRIBUTE_TYPE, __('Attribute Type'))
                ->options(EavAttribute::ATTRIBUTE_TYPE)
                ->when('in', ['select', 'multiple-select'], function (Form $form) {
                    $form->hasMany('values', __('Values'), function ($form) {
                        $form->text('value');
                    });
                })
                ->when('=', EavAttribute::TYPE_BOOLEAN, function (Form $form) {
                    $form->switch(EavAttribute::COL_DEFAULT_VALUE);
                })
                ->when('in', [
                    EavAttribute::TYPE_TEXT,
                    EavAttribute::TYPE_DECIMAL,
                    EavAttribute::TYPE_INT,
                    EavAttribute::TYPE_VARCHAR
                ],
                    function (Form $form) {
                    $form->text(EavAttribute::COL_DEFAULT_VALUE);
                })
                ->required()->readonly();
        } else {
            $form->select(EavAttribute::COL_ATTRIBUTE_TYPE, __('Attribute Type'))
                ->options(EavAttribute::ATTRIBUTE_TYPE)
                ->when('in', ['select', 'multiple-select'], function (Form $form) {
                    $form->hasMany('values', __('Values'), function ($form) {
                        $form->text('value');
                    });
                })
                ->when('=', EavAttribute::TYPE_BOOLEAN, function (Form $form) {
                    $form->switch(EavAttribute::COL_DEFAULT_VALUE);
                })
                ->when('in', [
                    EavAttribute::TYPE_TEXT,
                    EavAttribute::TYPE_DECIMAL,
                    EavAttribute::TYPE_INT,
                    EavAttribute::TYPE_VARCHAR
                ],
                    function (Form $form) {
                        $form->text(EavAttribute::COL_DEFAULT_VALUE);
                    })
                ->required();
        }
       // $form->switch(EavAttribute::COL_IS_FILTER, __('Is Filter'));
        $form->switch(EavAttribute::COL_IS_SHOWN, __('Show on Website'));

        return $form;
    }
}
