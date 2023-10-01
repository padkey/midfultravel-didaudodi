<?php

namespace DDDD\Blog\Observers;

use DDDD\Blog\Jobs\SyncBlogPost;
use DDDD\Blog\Services\BlogPostService;
use DDDD\Blog\Models\BlogPost;
use DDDD\Url\Models\UrlModel;
use DDDD\Url\Services\GenerateUrl;
use DDDD\Url\Services\UrlService;
use Exception;

/**
 * Class BlogPostObserver
 * @package DTV\Blog\Observers
 */
class BlogPostObserver
{
    const URL_ENTITY_TYPE = UrlModel::ENTITY_TYPE_BLOG_POST;

    /**
     * @var BlogPostService
     */
    private $blogPostService;

    /**
     * @var GenerateUrl
     */
    private $generateUrl;

    /**
     * @var UrlService
     */
    private $urlService;

    /**
     * BlogPostObserver constructor.
     * @param BlogPostService $blogPostService
     * @param GenerateUrl $generateUrl
     * @param UrlService $urlService
     */
    public function __construct(
        BlogPostService $blogPostService,
        GenerateUrl $generateUrl,
        UrlService $urlService
    ) {
        $this->generateUrl = $generateUrl;
        $this->blogPostService = $blogPostService;
        $this->urlService = $urlService;
    }

    /**
     * Handle the BlogPost "creating" event.
     * @param BlogPost $item
     * @throws Exception
     */
    public function creating(BlogPost $item): void
    {
        $item->{BlogPost::COL_URL} = $this->generateUrl->generateAndCheckUrl($item->getTitle());
        $item->{BlogPost::COL_AUTHOR_ID} = 1;
    }

    /**
     * Handle the BlogPost "created" event.
     * @param BlogPost $item
     * @throws Exception
     */
    public function created(BlogPost $item): void
    {
        $this->urlService->create($item->getUrl(), self::URL_ENTITY_TYPE , $item->getId());
    }

    /**
     * @param BlogPost $item
     * @throws Exception
     */
    public function updating(BlogPost $item): void
    {
        if ($item->getUrl() != $item->getOriginal(BlogPost::COL_URL)) {
            if ($this->urlService->isUrlExisted($item->getUrl())) {
                throw new Exception(sprintf("Error occur during updating BlogPost: Url key already existed."));
            }
        }
    }

    /**
     * @param BlogPost $item
     * @throws Exception
     */
    public function updated(BlogPost $item): void
    {
        if ($item->getUrl() != $item->getOriginal(BlogPost::COL_URL)) {
            $this->urlService->update($item->getOriginal(BlogPost::COL_URL), $item->getUrl());
        }
    }

    /**
     * @param BlogPost $item
     * @throws Exception
     */
    public function deleted(BlogPost $item): void
    {
        $this->urlService->delete($item->getUrl());
    }
}
