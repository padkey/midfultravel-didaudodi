<?php

namespace DDDD\CatalogCategory\Observers;

use DDDD\Blog\Models\Block;
use DDDD\Blog\Services\AuthorService;
use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogSync\Jobs\SyncCategory;
use DDDD\CatalogSync\Jobs\SyncCategorySearch;
use DDDD\Url\Services\UrlService;
use Exception;

/**
 * Class CatalogCategoryObserver
 * @package DDDD\CatalogCategory\Http\Observers
 */
class CatalogCategoryObserver
{
    /**
     * @var UrlService
     */
    private UrlService $urlService;

    /**
     * @var AuthorService
     */
    private AuthorService $authorService;

    function __construct(UrlService $urlService, AuthorService $authorService)
    {
        $this->urlService = $urlService;
        $this->authorService = $authorService;
    }

    /**
     * @throws Exception
     */
    public function creating(CatalogCategory $catalogCategory): void
    {
        $this->authorService->processAuthorCreate($catalogCategory);
    }

    public function updating(CatalogCategory $catalogCategory): void
    {
        $this->authorService->processAuthorUpdate($catalogCategory);
    }

    public function deleted(CatalogCategory $category): void
    {
        $this->urlService->delete($category->getUri());
        SyncCategory::dispatch($category, 'delete');
        SyncCategorySearch::dispatch($category, 'delete');
    }
}
