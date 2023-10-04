<?php

namespace DDDD\Banner\Http\Controllers;

use App\Http\Controllers\Controller;
use DDDD\Banner\Repositories\BannerRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    private BannerRepository $repository;

    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get($uuid)
    {
        if (empty($uuid)) {
            return response([], 400);
        }

        $banner = $this->repository->getBannerByUUID($uuid);
        return response($banner, 200);
    }
}
