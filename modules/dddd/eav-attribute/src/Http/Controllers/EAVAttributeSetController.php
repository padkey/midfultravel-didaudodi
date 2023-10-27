<?php

namespace DDDD\EAVAttribute\Http\Controllers;

use DDDD\EAVAttribute\Models\EavAttribute;
use DDDD\EAVAttribute\Models\EavAttributeSet;
use DDDD\EAVAttribute\Selectable\AttributeGroup;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Log;

class EAVAttributeSetController extends AdminController
{
    use HasResourceActions;

    protected $title = 'Attribute Sets';

    protected EavAttributeSet $eavAttributeSet;
    protected EavAttribute $eavAttribute;

    function __construct(EavAttributeSet $eavAttributeSet, EavAttribute $eavAttribute)
    {
        $this->eavAttributeSet = $eavAttributeSet;
        $this->eavAttribute = $eavAttribute;
    }

    protected function grid(): Grid
    {
        Permission::check('DDDD.eav-attribute-set');
        $grid = new Grid($this->eavAttributeSet);

        $grid->column(EavAttributeSet::COL_ATTRIBUTE_SET_ID, __('Attribute Set Id'))->sortable();
        $grid->column(EavAttributeSet::COL_ATTRIBUTE_SET_NAME, __('Attribute Name'));
        $grid->column(EavAttributeSet::COL_ATTRIBUTE_SET_GROUP, __('Attribute Set Group'));
        $grid->column(EavAttributeSet::COL_IS_SYSTEM, __('Is System'))->bool();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if (!Admin::user()->can('DDDD.eav-attribute-set.delete') || $actions->row->is_system) {
                $actions->disableDelete();
            }
        });

        $grid->filter(function($filter){
            $filter->like(EavAttributeSet::COL_ATTRIBUTE_SET_NAME);
        });

        return $grid;
    }

    public function create(Content $content): Content
    {
        Permission::check('DDDD.eav-attribute-set.create');
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
        Permission::check('DDDD.eav-attribute-set.edit');
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    protected function detail($attribute_set_id): Form
    {
        Permission::check('DDDD.eav-attribute-set');
        $form = $this->form()->edit($attribute_set_id);
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
            if (!$this->eavAttributeSet->find($id)->is_system) {
                Permission::check('DDDD.eav-attribute-set.delete');
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
        $form = new Form($this->eavAttributeSet);
        $form->text(EavAttributeSet::COL_UID)->required();
        $form->text(EavAttributeSet::COL_ATTRIBUTE_SET_NAME, __('Attribute Set Name'))->rules();
        $form->select(EavAttributeSet::COL_ATTRIBUTE_SET_GROUP, __('Attribute Set Group'))
            ->options($this->eavAttributeSet::ATTRIBUTE_DEFAULT_VALUE)->required();
        $form->belongsToMany('groups', AttributeGroup::class, __('Add Attribute Group'));
        return $form;
    }
}
