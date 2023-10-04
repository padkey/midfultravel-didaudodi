<?php

namespace DDDD\Blog\Observers;

use DDDD\Blog\Services\BlogPostService;
use DDDD\Blog\Models\BlogPost;
use DDDD\Url\Models\UrlModel;
use DDDD\Blog\Models\Companion;
use DDDD\Url\Services\GenerateUrl;
use DDDD\Url\Services\UrlService;
use Exception;

/**
 * Class BlogPostObserver
 * @package DTV\Blog\Observers
 */
class CompanionObserver
{
    const URL_ENTITY_TYPE = UrlModel::ENTITY_TYPE_COMPANION;

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
     * Handle the BlogPost "creating" event.
     * @param Companion $item
     * @throws Exception
     */
    public function creating(Companion $item): void
    {
        $item->{Companion::COL_URL_KEY} = $this->generateUrl->generateAndCheckUrl($item->getTitle());
    }

    /**
     * Handle the BlogPost "created" event.
     * @param Companion $item
     * @throws Exception
     */
    public function created(Companion $item): void
    {
        $this->urlService->create($item->getUrlKey(), self::URL_ENTITY_TYPE , $item->getId());
    }

}
