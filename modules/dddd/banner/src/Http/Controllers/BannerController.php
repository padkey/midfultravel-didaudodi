<?php

namespace DTV\Banner\Http\Controllers;

use App\Http\Controllers\Controller;
use DTV\Banner\Repositories\BannerRepository;
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

    public function get($uuid): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        if (empty($uuid)) {
            return response([], 400);
        }

        $banner = $this->repository->getBannerByUUID($uuid);
        return response($banner, 200);
    }
}
