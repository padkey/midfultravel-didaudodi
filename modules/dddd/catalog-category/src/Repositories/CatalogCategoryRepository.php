<?php

namespace DDDD\CatalogCategory\Repositories;

use DDDD\CatalogCategory\Models\CatalogCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CatalogCategoryRepository
{

    private CatalogCategory $catalogCategory;

    function __construct(CatalogCategory $catalogCategory)
    {
        $this->catalogCategory = $catalogCategory;
    }

    public function injectLevelAndPath(CatalogCategory $catalogCategory): void
    {
        $results = DB::select("
            WITH RECURSIVE level AS (
                SELECT 0 AS n , CAST(entity_id AS TEXT) AS path, parent_id AS parent FROM catalog_category_entity WHERE entity_id = ?
                UNION ALL
                SELECT n + 1, CONCAT(entity_id, '/', level.path), parent_id FROM level JOIN catalog_category_entity cce ON level.parent = cce.entity_id WHERE parent IS NOT NULL
            ) SELECT (n), path FROM level ORDER BY n DESC LIMIT 1
        ", [$catalogCategory->entity_id]);

        if (count($results) == 0) {
            return;
        }

        if (count($results) > 1) {
            Log::error("catalog_category_entity find level and path wrong (more than 1 record)");
        } else {
            $catalogCategory->level = ($results[0]->n) + CatalogCategory::DEFAULT_CATEGORY_VALUE['CHILDREN_COUNT'];
            $catalogCategory->category_path = $results[0]->path;
            $catalogCategory->saveQuietly();
        }
    }

    public function injectChildrenCount(CatalogCategory $catalogCategory): void
    {
        $results = DB::select("
            WITH RECURSIVE category_tree AS ( SELECT entity_id, parent_id, 0 AS level FROM catalog_category_entity
            WHERE entity_id = ? and deleted_at is null
            UNION ALL
            SELECT e.entity_id, e.parent_id, ct.level + 1 FROM catalog_category_entity e
            JOIN category_tree ct ON e.parent_id = ct.entity_id where deleted_at is null) SELECT COUNT(*) - 1 as children_count FROM category_tree;
        ", [$catalogCategory->getId()]);
        if (count($results) == 0) {
            return;
        }

        if (count($results) > 1) {
            Log::error("catalog_category_entity find children_count wrong (more than 1 record)");
        } else {
            $catalogCategory->children_count = $results[0]->children_count;
            $catalogCategory->saveQuietly();
        }
    }
}
