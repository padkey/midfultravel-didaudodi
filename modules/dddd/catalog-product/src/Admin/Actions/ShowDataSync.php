<?php

namespace DDDD\CatalogProduct\Admin\Actions;

use Encore\Admin\Actions\RowAction;

class ShowDataSync extends RowAction
{

    public $name = '';

    protected string $type = "";

    public function href()
    {
        return sprintf("%s/api/show-product-sync-data?id=%s&type=%s",
            env("APP_URL"),
            $this->getRow()->getId(),
            $this->type);

    }

    /**
     * Render row action.
     *
     * @return string
     */
    public function render()
    {
        if ($href = $this->href()) {
            return "<a target='_blank' href='{$href}'>{$this->name()}</a>";
        }
        return "";
    }
}
