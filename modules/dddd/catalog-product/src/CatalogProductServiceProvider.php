<?php

namespace DDDD\CatalogProduct;

use DDDD\CatalogProduct\Models\HotSale;
use DDDD\CatalogProduct\Models\ProductTag;
use DDDD\CatalogProduct\Models\ProductVersionGroup;
use DDDD\CatalogProduct\Models\TextPromotionGroup;
use DDDD\CatalogProduct\Observers\HotSaleObserver;
use DDDD\CatalogProduct\Observers\ProductObserver;
use DDDD\CatalogProduct\Observers\ProductVersionGroupObserver;
use DDDD\CatalogProduct\Observers\ProductVersionObserver;
use DDDD\CatalogProduct\Observers\FrameLayerObserver;
use Illuminate\Support\ServiceProvider;
use DDDD\CatalogProduct\Observers\ProductTagObserver;
use DDDD\CatalogProduct\Observers\TextPromotionGroupObserver;
class CatalogProductServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(CatalogProduct $extension)
    {
        if (! CatalogProduct::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'catalog-product');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/DDDD/catalog-product')],
                'catalog-product'
            );
        }

        $this->app->booted(function () {
            CatalogProduct::routes(__DIR__.'/../routes/web.php');
           // $this->registerMigrations();
        });
        Models\CatalogProduct::observe(ProductObserver::class);
        Models\ProductVersion::observe(ProductVersionObserver::class);
        ProductVersionGroup::observe(ProductVersionGroupObserver::class);
        TextPromotionGroup::observe(TextPromotionGroupObserver::class);
        ProductTag::observe(ProductTagObserver::class);
        Models\FrameLayer::observe(FrameLayerObserver::class);
        HotSale::observe(HotSaleObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function registerMigrations(): void
    {
        $this->loadMigrationsFrom( dirname(__DIR__) . '/database/migrations');
    }
}
