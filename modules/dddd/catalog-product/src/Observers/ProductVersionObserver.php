<?php

namespace DDDD\CatalogProduct\Observers;

use DDDD\CatalogProduct\Models\ProductVersion;
use DDDD\CatalogSync\Jobs\SyncProductGeneral;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductVersionObserver
{
    public function created(ProductVersion $item): void
    {
        $products = $item->getGroup()->products()->get();
        foreach ($products as $product) {
            SyncProductGeneral::dispatch($product, 'update');
        }
    }

    public function updated(ProductVersion $item): void
    {
        $products = $item->getGroup()->products()->get();
        foreach ($products as $product) {
            SyncProductGeneral::dispatch($product, 'update');
        }
    }

    public function deleted(ProductVersion $item): void
    {
        $orderProducts = $item->getGroup()->products()->get();
        foreach ($orderProducts as $product) {
            SyncProductGeneral::dispatch($product, 'update');
        }
        SyncProductGeneral::dispatch($item->getProduct(), 'update');
    }
}
