<?php


namespace DDDD\CatalogProduct\Services;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait CatalogDataRequest
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getRequestProductIds()
    {
        $productIds = request()->get("products");
        $intArray = array();
        foreach ($productIds as $element) {
            if ($element == null) {
                continue;
            }
            $intArray[] = intval($element);
        }
        return $intArray;
    }

    public function getRequestCategoryIds()
    {
        $categoryIds = request()->get("categories");
        $intArray = array();
        foreach ($categoryIds as $element) {
            if ($element == null) {
                continue;
            }
            $intArray[] = intval($element);
        }
        return $intArray;
    }

    /**
     * @param array $a
     * @param array $b
     * @return array
     */
    public function getDiffElements(array $a, array $b): array
    {
        // Find elements in $b that are not present in $a
        $difference1 = array_diff($a, $b);

        // Find elements in $a that are not present in $b
        $difference2 = array_diff($b, $a);
        return array_unique(array_merge($difference1, $difference2));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getDiffProductIdsFromRequest(array $ids): array
    {
        $requestIds = $this->getRequestProductIds();
        return $this->getDiffElements($ids, $requestIds);
    }
}
