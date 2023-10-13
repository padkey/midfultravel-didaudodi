<?php

namespace DDDD\Url\Services;

use DDDD\Url\Repositories\UrlRepo;

/**
 * Class GenerateUrl
 * @package DTV\Url\Services
 */
class GenerateUrl
{
    /**
     * @var UrlRepo
     */
    protected $urlRepo;

    /**
     * GenerateUrl constructor.
     * @param UrlRepo $urlRepo
     */
    public function __construct(UrlRepo $urlRepo)
    {
        $this->urlRepo = $urlRepo;
    }

    /**
     * Function is handle to generate friendly URl,
     * example: Điện thoại vui => dien-thoai-vui
     *
     * @param string $string
     * @return string
     */
    public function createUrlSlug($string): string
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);

        return $string;
    }

    /**
     * @param string $string
     * @return string
     * @throws \Exception
     */
    public function generateAndCheckUrl($string) {

        if ($string == "") {
            throw new \Exception(__("String is not empty."));
        }
        $baseUrl = $this->createUrlSlug($string);
        /*if ($this->urlRepo->getUrlModelByRequestPath($baseUrl) != null) {
            throw new \Exception(sprintf("Url key already existed, please change the title or name (%s).", $string));
        }*/

        return $baseUrl;
    }
}
