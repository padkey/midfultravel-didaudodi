<?php

namespace DDDD\Blog\Observers;

use DDDD\Blog\Repositories\BlogCategoryRepo;
use DDDD\Blog\Models\BlogCategory;
use DDDD\Url\Models\UrlModel;
use DDDD\Url\Services\GenerateUrl;
use DDDD\Url\Services\UrlService;
use Exception;

/**
 * Class BlogCategoryObserver
 * @package DTV\Blog\Observers
 */
class BlogCategoryObserver {

    const URL_ENTITY_TYPE = UrlModel::ENTITY_TYPE_BLOG_CATEGORY;

    /**
     * @var BlogCategoryRepo
     */
    private $blogCategoryRepo;

    /**
     * @var GenerateUrl
     */
    private $generateUrl;

    /**
     * @var UrlService
     */
    private $urlService;

    /**
     * BlogCategoryObserver constructor.
     * @param BlogCategoryRepo $blogCategoryRepo
     * @param GenerateUrl $generateUrl
     * @param UrlService $urlService
     */
    public function __construct(
        BlogCategoryRepo $blogCategoryRepo,
        GenerateUrl $generateUrl,
        UrlService $urlService)
    {
        $this->blogCategoryRepo = $blogCategoryRepo;
        $this->generateUrl = $generateUrl;
        $this->urlService = $urlService;
    }

    /**
     * Handle the BlogCategory "creating" event.
     * @param BlogCategory $item
     * @throws Exception
     */
    public function creating(BlogCategory $item): void
    {
        $item->{BlogCategory::COL_URL} = $this->generateUrl->generateAndCheckUrl($item->getTitle());
    }

    /**
     * Handle the BlogCategory "created" event.
     * @param BlogCategory $item
     * @throws Exception
     */
    public function created(BlogCategory $item): void
    {
        $this->urlService->create($item->getUrl(), self::URL_ENTITY_TYPE , $item->getId());
        //$this->blogCategoryRepo->injectLevelAndPath($item);
    }

    /**
     * Handle the BlogCategory "updated" event.
     * @param BlogCategory $item
     * @throws Exception
     */
    public function updated(BlogCategory $item): void
    {
        if ($item->getUrl() != $item->getOriginal(BlogCategory::COL_URL)) {
            $this->urlService->update($item->getOriginal(BlogCategory::COL_URL), $item->getUrl());
        }
        $this->blogCategoryRepo->injectLevelAndPath($item);
    }

    /**
     * @param BlogCategory $item
     * @throws Exception
     */
    public function updating(BlogCategory $item): void
    {
        if ($item->getUrl() != $item->getOriginal(BlogCategory::COL_URL)) {
            if ($this->urlService->isUrlExisted($item->getUrl())) {
                throw new Exception("Error occur during updating BlogCategory: Url key already existed.");
            }
        }
    }

    /**
     * @param BlogCategory $item
     * @throws Exception
     */
    public function deleted(BlogCategory $item): void
    {
        $this->urlService->delete($item->getUrl());
    }
}
