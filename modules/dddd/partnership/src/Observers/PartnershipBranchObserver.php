<?php

namespace DDDD\Partnership\Observers;

use DDDD\Blog\Services\BlogPostService;
use DDDD\Blog\Models\BlogPost;
use DDDD\Url\Models\UrlModel;
use DDDD\Partnership\Models\PartnershipBranch;
use DDDD\Url\Services\GenerateUrl;
use DDDD\Url\Services\UrlService;
use Exception;

/**
 * Class BlogPostObserver
 * @package DTV\Blog\Observers
 */
class PartnershipBranchObserver
{
    const URL_ENTITY_TYPE = UrlModel::ENTITY_TYPE_PARTNERSHIP_BRANCH;

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
     * @param PartnershipBranch $item
     * @throws Exception
     */
    public function creating(PartnershipBranch $item): void
    {
        $item->{PartnershipBranch::COL_URL} = $this->generateUrl->generateAndCheckUrl($item->getTitle());
    }

    /**
     * Handle the BlogPost "created" event.
     * @param PartnershipBranch $item
     * @throws Exception
     */
    public function created(PartnershipBranch $item): void
    {
        $this->urlService->create($item->getUrl(), self::URL_ENTITY_TYPE , $item->getId());
    }

}
