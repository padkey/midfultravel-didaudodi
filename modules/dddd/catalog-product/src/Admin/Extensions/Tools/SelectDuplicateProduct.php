<?php

namespace DDDD\CatalogProduct\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\AbstractTool;
class SelectDuplicateProduct extends AbstractTool {

    protected int $productId;
    public function __construct($id)
    {
        $this->productId = $id;
    }

    public function render(): string
    {
        return <<<EOT
        <div class="btn-group pull-right" style="margin-right: 10px">
                <a class="btn btn-sm btn-default" href="/admin/replicate-product/{$this->productId}">
                    <i class="fa fa-list"></i>&nbsp;&nbsp;Duplicate
                </a>'
        </div>
        EOT;
    }
}
