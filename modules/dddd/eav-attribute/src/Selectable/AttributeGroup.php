<?php

namespace DDDD\EAVAttribute\Selectable;

use DDDD\EAVAttribute\Models\EavAttributeGroup;
use DDDD\EAVAttribute\Models\EavAttribute;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;
Use Encore\Admin\Widgets\Table;

class AttributeGroup extends Selectable
{
    public $model = EavAttributeGroup::class;

    public function make()
    {
        $this->column(EavAttributeGroup::COL_ATTRIBUTE_GROUP_ID)->sortable();
        $this->column(EavAttributeGroup::COL_ATTRIBUTE_GROUP_NAME)->expand(function (EavAttributeGroup $model) {
            $attribute = $model->attributes()->take(10)->get()->map(function ($attribute) {
                return $attribute->only([
                    EavAttribute::COL_ATTRIBUTE_ID,
                    EavAttribute::COL_ATTRIBUTE_DEFAULT_NAME,
                    EavAttribute::COL_ATTRIBUTE_TITLE,
                ]);
            });

            return new Table([
                EavAttribute::COL_ATTRIBUTE_ID,
                EavAttribute::COL_ATTRIBUTE_DEFAULT_NAME,
                EavAttribute::COL_ATTRIBUTE_TITLE,
            ], $attribute->toArray());
        });

        $this->filter(function (Filter $filter) {
            $filter->like(EavAttributeGroup::COL_ATTRIBUTE_GROUP_NAME);
        });
    }
}
