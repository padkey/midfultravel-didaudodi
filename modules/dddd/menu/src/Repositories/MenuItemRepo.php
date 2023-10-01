<?php

namespace DDDD\Menu\Repositories;

use DDDD\Menu\Models\MenuItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuItemRepo
{
    /**
     * @param MenuItems $menuItems
     * @return void
     */
    public function injectLevelAndPath(MenuItems $item): void
    {
        $results = DB::select("
            WITH RECURSIVE level AS (
                SELECT 0 AS n , CAST(id AS TEXT) AS path, parent_id AS parent FROM menu_items WHERE id = ?
                UNION ALL
                SELECT n + 1, CONCAT(id, '/', level.path), parent_id FROM level JOIN menu_items cce ON level.parent = cce.id WHERE parent IS NOT NULL
            ) SELECT n, path FROM level ORDER BY n DESC LIMIT 1
        ", [$item->id]);

        if (count($results) == 0) {
            return;
        }

        if (count($results) > 1) {
            Log::error("MenuItem find level and path wrong (more than 1 record)");
        } else {
            $item->path_level = $results[0]->path;
            $item->saveQuietly();
        }
    }
}
