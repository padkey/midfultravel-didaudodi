<?php

namespace DDDD\Blog\Observers;

use DDDD\Blog\Models\Pages;
use DDDD\Url\Models\UrlModel;
use DDDD\Url\Services\GenerateUrl;
use DDDD\Url\Services\UrlService;
use Exception;

/**
 * Class PagesObserver
 * @package DTV\Blog\Observers
 */
class PagesObserver
{
    const URL_ENTITY_TYPE = UrlModel::ENTITY_TYPE_PAGES;

    /**
     * @var GenerateUrl
     */
    private GenerateUrl $generateUrl;

    /**
     * @var UrlService
     */
    private UrlService $urlService;

    /**
     * PagesObserver constructor.
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
     * Handle the Pages "creating" event.
     * @param Pages $item
     * @throws Exception
     */
    public function creating(Pages $item): void
    {
        $item->{Pages::COL_URL_KEY} = $this->generateUrl->generateAndCheckUrl($item->getTitle());
    }

    /**
     * Handle the Pages "created" event.
     * @param Pages $item
     * @throws Exception
     */
    public function created(Pages $item): void
    {
        $this->urlService->create($item->getUrlKey(), self::URL_ENTITY_TYPE , $item->getId());
    }

    /**
     * @param Pages $item
     * @throws Exception
     */
    public function updating(Pages $item): void
    {
        if ($item->getUrlKey() != $item->getOriginal(Pages::COL_URL_KEY)) {
            if ($this->urlService->isUrlExisted($item->getUrlKey())) {
                throw new Exception(sprintf("Error occur during updating Pages: Url key already existed."));
            }
        }
    }

    /**
     * @param Pages $item
     * @throws Exception
     */
    public function updated(Pages $item): void
    {
        if ($item->getUrlKey() != $item->getOriginal(Pages::COL_URL_KEY)) {
            $this->urlService->update($item->getOriginal(Pages::COL_URL_KEY), $item->getUrlKey());
        }
    }

    /**
     * @param Pages $item
     * @throws Exception
     */
    public function deleted(Pages $item): void
    {
        $this->urlService->delete($item->getUrlKey());
    }
}
