<?php

namespace DDDD\Blog\Repositories;

use DDDD\Blog\Models\BlogCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogCategoryRepo
{
    /**
     * @param BlogCategory $item
     * @return void
     */
    public function injectLevelAndPath(BlogCategory $item): void
    {

        $results = DB::select("
            WITH RECURSIVE level AS (
                SELECT 0 AS n , CAST(id AS TEXT) AS path, parent_id AS parent FROM blog_category WHERE id = ?
                UNION ALL
                SELECT n + 1, CONCAT(id, '/', level.path), parent_id FROM level JOIN blog_category cce ON level.parent = cce.id WHERE parent IS NOT NULL
            ) SELECT n, path FROM level ORDER BY n DESC LIMIT 1
        ", [$item->{BlogCategory::COL_ID}]);

        if (count($results) == 0) {
            return;
        }

        if (count($results) > 1) {
            Log::error("blogcategory find level and path wrong (more than 1 record)");
        } else {
            $item->{BlogCategory::COL_PATH_LEVEL} = $results[0]->path;
            $item->saveQuietly();
        }
    }
}
