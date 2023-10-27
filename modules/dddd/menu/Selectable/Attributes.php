<?php

namespace DTV\EAVAttribute\Selectable;

use DTV\EAVAttribute\Models\EavAttribute;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class Attributes extends Selectable
{
    public $model = EavAttribute::class;

    public function make()
    {
        $this->column(EavAttribute::COL_ATTRIBUTE_ID);
        $this->column(EavAttribute::COL_ATTRIBUTE_DEFAULT_NAME);
        $this->column(EavAttribute::COL_ATTRIBUTE_TITLE);
        $this->column(EavAttribute::COL_IS_REQUIRE)->bool();

        $this->filter(function (Filter $filter) {
            $filter->like(EavAttribute::COL_ATTRIBUTE_DEFAULT_NAME);
            $filter->like(EavAttribute::COL_ATTRIBUTE_TYPE)->select(EavAttribute::ATTRIBUTE_TYPE);
        });
    }
}
