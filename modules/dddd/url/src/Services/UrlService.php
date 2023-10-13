<?php

namespace DDDD\Url\Services;

use DDDD\Url\Models\UrlModel as UrlModel;
use DDDD\Url\Repositories\UrlRepo;
use Mockery\Exception;

/**
 * Class UrlService
 * @package DTV\Url\Services
 */
class UrlService
{
    /**
     * @var GenerateUrl
     */
    private $generateUrl;

    /**
     * @var UrlModel
     */
    private $model;

    /**
     * @var UrlRepo
     */
    private $urlRepo;

    /**
     * UrlService constructor.
     * @param GenerateUrl $generateUrl
     * @param UrlModel $model
     * @param UrlRepo $urlRepo
     */
    public function __construct(
        GenerateUrl $generateUrl,
        UrlModel $model,
        UrlRepo $urlRepo)
    {
        $this->generateUrl = $generateUrl;
        $this->model = $model;
        $this->urlRepo = $urlRepo;
    }

    /**
     * The function handle creating URL of entity when entity is created.
     *
     * @param $url
     * @param $type
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function create($url, $type, $id) {
        $prepareData = [
            UrlModel::COL_ENTITY_TYPE => $type,
            UrlModel::COL_ENTITY_ID => $id,
            UrlModel::COL_REQUEST_PATH => $url,
            UrlModel::COL_TARGET_PATH => "",
            UrlModel::COL_REDIRECT_TYPE => UrlModel::NO_REDIRECT_TYPE
        ];
        try {
            $this->store($prepareData);
        } catch (Exception $exception) {
            throw new \Exception(sprintf("Error occur during store URL: %s.", $exception->getMessage()));
        }

    }

    /**
     * The function handle deleting URL of entity when Entity is deleted.
     *
     * @param $requestPath
     * @throws \Exception
     */
    public function delete($requestPath) {
        $model = $this->urlRepo->getUrlModelByRequestPath($requestPath);
        if ($model instanceof UrlModel) {
            $model->delete();
        } else {
            throw new \Exception(sprintf("Error during deleting URL process, URL: %s does not exist.", $requestPath));
        }
    }

    /**
     * @param $newUrl
     * @param $oldUrl
     * @throws \Exception
     */
    public function update($oldUrl, $newUrl) {
        /*if ($this->isUrlExisted($newUrl)) {
            throw new \Exception(sprintf("Error occur during updating URL: Url key already existed."));
        }*/
        $model = $this->urlRepo->getUrlModelByRequestPath($oldUrl);
        if ($model instanceof UrlModel) {
            $model->update([UrlModel::COL_REQUEST_PATH => $newUrl]);
        } else {
            throw new \Exception(sprintf("Error during updating URL process, old URL: %s does not exist.", $oldUrl));
        }

    }

    /**
     * @param $url
     * @return bool
     */
    public function isUrlExisted($url) {
        if ($this->urlRepo->getUrlModelByRequestPath($url) != null) {
            return true;
        }
        return false;
    }

    /**
     * @param array $data
     */
    private function store(array $data) {
        foreach ($data as $column => $value) {
            $this->model->setAttribute($column, $value);
        }
        $this->model->save();
    }
}
