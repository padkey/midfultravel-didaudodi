<?php

namespace DDDD\Tour\Observers;

use DDDD\Url\Models\UrlModel;
use DDDD\Tour\Models\Partnership;
use DDDD\Url\Services\GenerateUrl;
use DDDD\Url\Services\UrlService;
use Exception;

/**
 * Class BlogPostObserver
 * @package DTV\Blog\Observers
 */
class TourObserver
{
    const URL_ENTITY_TYPE = UrlModel::ENTITY_TYPE_TOUR;

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
     * @param Partnership $item
     * @throws Exception
     */
    public function creating(Partnership $item): void
    {
        $item->{Partnership::COL_URL} = $this->generateUrl->generateAndCheckUrl($item->getTitle());
    }

    /**
     * Handle the BlogPost "created" event.
     * @param Partnership $item
     * @throws Exception
     */
    public function created(Partnership $item): void
    {
        $this->urlService->create($item->getUrl(), self::URL_ENTITY_TYPE , $item->getId());
    }

}
