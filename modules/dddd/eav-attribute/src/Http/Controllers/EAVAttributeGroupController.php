<?php

namespace DDDD\EAVAttribute\Http\Controllers;

use DDDD\EAVAttribute\Models\EavAttributeGroup;
use DDDD\EAVAttribute\Selectable\Attributes;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Log;

class EAVAttributeGroupController extends AdminController
{
    use HasResourceActions;

    /**
     * @var string
     */
    protected $title = 'Attribute Groups';

    /**
     * @var EavAttributeGroup
     */
    protected EavAttributeGroup $eavAttributeGroup;

    /**
     * @param EavAttributeGroup $eavAttributeGroup
     */
    function __construct(
        EavAttributeGroup $eavAttributeGroup)
    {
        $this->eavAttributeGroup = $eavAttributeGroup;
    }

    protected function grid(): Grid
    {
        Permission::check('DDDD.eav-attribute-group');
        $grid = new Grid(new EavAttributeGroup());

        $grid->column(EavAttributeGroup::COL_ATTRIBUTE_GROUP_ID, __('Attribute Group Id'))->sortable();
        $grid->column(EavAttributeGroup::COL_UID, __(EavAttributeGroup::COL_UID));
        $grid->column(EavAttributeGroup::COL_ATTRIBUTE_GROUP_NAME, __('attribute group Name'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if (!Admin::user()->can('DDDD.eav-attribute-group.delete') || $actions->row->is_system) {
                $actions->disableDelete();
            }
        });

        $grid->filter(function($filter){
            $filter->like(EavAttributeGroup::COL_ATTRIBUTE_GROUP_NAME);
        });

        return $grid;
    }

    public function create(Content $content)
    {
        Permission::check('DDDD.eav-attribute-group.create');
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        Permission::check('DDDD.eav-attribute-group.edit');
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    protected function detail($attribute_group_id): Form
    {
        Permission::check('DDDD.eav-attribute-group');
        $form = $this->form()->edit($attribute_group_id);
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

    public function destroy($id)
    {
        try {
            if (!$this->eavAttributeGroup->find($id)->is_system) {
                Permission::check('DDDD.eav-attribute-group.delete');
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
        $form = new Form(new $this->eavAttributeGroup);
        $form->text(EavAttributeGroup::COL_UID, __('UID'))->required();
        $form->text(EavAttributeGroup::COL_ATTRIBUTE_GROUP_NAME)->required();
        $form->belongsToMany('attributes', Attributes::class, __('Add attributes'));
        return $form;
    }

}
