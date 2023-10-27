<?php

namespace DDDD\CatalogProduct\Http\Ajax;

use DDDD\CatalogProduct\Models\ProductHotSale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductHotSaleAjax extends AbtractAjax
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $data = $request->all();
        return $this->updateData($data, ProductHotSale::class);
    }
}
