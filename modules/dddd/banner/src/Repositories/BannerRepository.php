<?php

namespace DDDD\Banner\Repositories;

use DDDD\Banner\Models\Banner;
use Illuminate\Support\Facades\Log;

class BannerRepository
{
    private Banner $model;

    public function __construct(Banner $model)
    {
        $this->model = $model;
    }

    public function getBannerByUUID($uuid): array
    {
        $data = [];

        try {
            $mainBanner = $this->model->where('uuid', $uuid)->first();
            $items = $mainBanner->items->toArray();
            $data = [
                'name' => $mainBanner->name,
                'uuid' => $mainBanner->uuid,
                'type' => $mainBanner->banner_type,
                'style' => $mainBanner->banner_style,
                'position' => $mainBanner->position,
                'items' => $items
            ];
        } catch (\Exception $e) {
            Log::error("Can't get Banner with $uuid: {$e->getMessage()}");
            return $data;
        }

        return $data;
    }
}
