<?php

namespace DDDD\CatalogProduct\Admin\Extensions\Tools;
use DDDD\EAVAttribute\Models\EavAttributeSet;
use Encore\Admin\Grid\Tools\AbstractTool;

class SelectAttributeSetProduct extends AbstractTool {


    public function render()
    {
        $attrSetProduct = EavAttributeSet::query()->where('attribute_set_group', 'product')
            ->get(['attribute_set_id','attribute_set_name'])->toArray();
        $html = "";
        foreach ($attrSetProduct as $item) {
            $link = '?attr_group='.  $item["attribute_set_id"];
            $html = $html . '<li><a target="_self" href="'. $link .'" target="_blank">'. $item["attribute_set_name"] .'</a></li>';
        }
        return <<<EOT
        <div class="btn-group pull-right" style="margin-right: 10px">
            <p class="btn btn-sm btn-twitter" title="Export"><i class="fa fa-download"></i><span class="hidden-xs"> Select Attribute Set</span></p>
            <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                {$html}
            </ul>
        </div>
        EOT;
    }
}
