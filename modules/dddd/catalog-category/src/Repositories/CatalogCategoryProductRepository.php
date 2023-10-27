<?php

namespace DTV\CatalogCategory\Repositories;

use DTV\CatalogCategory\Models\CatalogCategoryProduct;

class CatalogCategoryProductRepository
{
    public static function createRelationCategotyProduct($categoryId, $productId)
    {
        CatalogCategoryProduct::create([
            'category_id' => $categoryId,
            'product_id' => $productId
        ]);
    }

    public static function deteleRelationCategotyProduct($categoryId, $productI)
    {
        CatalogCategoryProduct::where('category_id', $categoryId)->where('product_id', $productI)->delete();
    }

    public static function selectCategoryByProductId($productId, $selects = ['*'])
    {
        return CatalogCategoryProduct::where('catalog_category_product.product_id', $productId)
            ->join('catalog_category_entity', 'catalog_category_entity.entity_id', '=', 'catalog_category_product.category_id')
            ->select($selects)->get();
    }

    public static function selectCategoryProductById($property, $conditionType, $value, $select = ['*'])
    {
        return CatalogCategoryProduct::where($property, $conditionType, $value)
            ->select($select)->get();
    }
}
