<?php

namespace DDDD\CatalogProduct\Observers;

//use DDDD\Blog\Services\AuthorService;
use DDDD\CatalogProduct\Models\ProductVersion;
use DDDD\CatalogSync\Jobs\SyncProductGeneral;
use Exception;
use Illuminate\Support\Facades\Log;

class HotSaleObserver
{
    /**
     * @var AuthorService
     */
   // protected AuthorService $authorService;

    public function __construct() //AuthorService $authorService
    {
        //$this->authorService = $authorService;
    }

    /**
     * @param $item
     * @throws Exception
     */
    public function creating($item): void
    {
       // $this->authorService->processAuthorCreate($item);
    }

    /**
     * @param $item
     * @throws Exception
     */
    public function saving($item): void
    {
       // $this->authorService->processAuthorUpdate($item);
    }
}
