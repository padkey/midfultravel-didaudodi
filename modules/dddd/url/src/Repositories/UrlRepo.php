<?php

namespace DDDD\Url\Repositories;

use DDDD\Url\Models\UrlModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UrlRepo
 * @package DTV\Url\Repositories
 */
class UrlRepo
{

    /**
     * @var UrlModel
     */
    private $url;

    /**
     * UrlRepo constructor.
     * @param UrlModel $url
     */
    public function __construct(UrlModel $url)
    {
        $this->url = $url;
    }

    /**
     * @param string $requestUrl
     * @return Builder|Model
     */
    public function getUrlModelByRequestPath($requestUrl) {
        return $this->url->newQuery()->firstWhere(UrlModel::COL_REQUEST_PATH, $requestUrl);
    }

}
