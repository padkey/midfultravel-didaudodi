<?php

namespace DDDD\Blog\Observers;

use DDDD\Blog\Services\BlogPostService;
use DDDD\Url\Models\UrlModel;
use DDDD\Blog\Models\UploadFileMedia;
use DDDD\Url\Services\GenerateUrl;
use DDDD\Url\Services\UrlService;
use Exception;

/**
 * Class BlogPostObserver
 * @package DTV\Blog\Observers
 */
class UploadFileMediaObserver
{
    const URL_ENTITY_TYPE = UrlModel::ENTITY_TYPE_VIDEO;

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
     * @param UploadFileMedia $item
     * @throws Exception
     */
    public function creating(UploadFileMedia $item): void
    {
        //$item->{UploadFileMedia::COL_URL_KEY} = $this->generateUrl->generateAndCheckUrl($item->getTitle());
        $item->{UploadFileMedia::COL_URL_FILE} =  env('APP_URL').'/uploads/'.$item->{UploadFileMedia::COL_FILE} ;
    }

    /**
     * Handle the BlogPost "created" event.
     * @param UploadFileMedia $item
     * @throws Exception
     */
    public function created(UploadFileMedia $item): void
    {
        //$this->urlService->create($item->getUrlKey(), self::URL_ENTITY_TYPE , $item->getId());
        //$item->{UploadFileMedia::COL_URL_FILE} =  env('APP_URL').'/'.$item->getFile();

    }

}
