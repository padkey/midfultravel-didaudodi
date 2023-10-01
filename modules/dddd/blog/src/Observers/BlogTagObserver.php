<?php

namespace DTV\Blog\Observers;

use DTV\Blog\Models\BlogTag;
use DTV\Url\Models\UrlModel;
use DTV\Url\Services\GenerateUrl;
use DTV\Url\Services\UrlService;
use Exception;

/**
 * Class BlogTagObserver
 * @package DTV\Blog\Observers
 */
class BlogTagObserver
{
    const URL_ENTITY_TYPE = UrlModel::ENTITY_TYPE_BLOG_TAG;

    /**
     * @var GenerateUrl
     */
    private GenerateUrl $generateUrl;

    /**
     * @var UrlService
     */
    private UrlService $urlService;

    /**
     * BlogTagObserver constructor.
     * @param GenerateUrl $generateUrl
     * @param UrlService $urlService
     */
    public function __construct(
        GenerateUrl $generateUrl,
        UrlService $urlService
    ) {
        $this->generateUrl = $generateUrl;
        $this->urlService = $urlService;
    }

    /**
     * Handle the BlogTag "creating" event.
     * @param BlogTag $item
     * @throws Exception
     */
    public function creating(BlogTag $item): void
    {
        $item->{BlogTag::COL_URL} = $this->generateUrl->generateAndCheckUrl($item->{BlogTag::COL_TAG_KEY});
    }

    /**
     * Handle the BlogTag "created" event.
     * @param BlogTag $item
     * @throws Exception
     */
    public function created(BlogTag $item): void
    {
        $this->urlService->create($item->{BlogTag::COL_URL}, self::URL_ENTITY_TYPE , $item->{BlogTag::COL_ID});
    }

    /**
     * @param BlogTag $item
     * @throws Exception
     */
    public function updating(BlogTag $item): void
    {
        if ($item->{BlogTag::COL_URL} != $item->getOriginal(BlogTag::COL_URL)) {
            if ($this->urlService->isUrlExisted($item->{BlogTag::COL_URL})) {
                throw new Exception("Error occur during updating BlogTag: Url key already existed.");
            }
        }
    }

    /**
     * @param BlogTag $item
     * @throws Exception
     */
    public function updated(BlogTag $item): void
    {
        if ($item->{BlogTag::COL_URL} != $item->getOriginal(BlogTag::COL_URL)) {
            $this->urlService->update($item->getOriginal(BlogTag::COL_URL), $item->{BlogTag::COL_URL});
        }
    }

    /**
     * @param BlogTag $item
     * @throws Exception
     */
    public function deleted(BlogTag $item): void
    {
        $this->urlService->delete($item->{BlogTag::COL_URL});
    }
}
