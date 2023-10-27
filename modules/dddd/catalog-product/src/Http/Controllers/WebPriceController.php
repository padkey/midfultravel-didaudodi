<?php

namespace DDDD\CatalogProduct\Http\Controllers;


use DDDD\CatalogProduct\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebPriceController extends Controller
{
    public function updateWebPrice(Request $request, $sku, $region, $price, $salePrice): void
    {
        if ($region == "hn") {
            $provinces = [24];
        } else {
            $provinces = [2,8,30];
        }
        ProductPrice::query()->where(ProductPrice::COL_SKU, $sku)
            ->whereIn(ProductPrice::COL_PROVINCE_ID, $provinces)
            ->update(
                [
                    ProductPrice::COL_PRICE => $price,
                    ProductPrice::COL_SPECIAL_PRICE => $salePrice
                ]
            );
    }
}
