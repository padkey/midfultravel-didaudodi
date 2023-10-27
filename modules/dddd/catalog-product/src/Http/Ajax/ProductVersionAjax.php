<?php

namespace DDDD\CatalogProduct\Http\Ajax;

use DDDD\CatalogProduct\Models\ProductVersion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductVersionAjax extends AbtractAjax
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $data = $request->all();
        return $this->updateData($data, ProductVersion::class);
    }
}
