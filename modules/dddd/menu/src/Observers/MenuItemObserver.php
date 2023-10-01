<?php

namespace DDDD\Menu\Observers;

use DDDD\Menu\Models\MenuItems;
use DDDD\Menu\Repositories\MenuItemRepo;

class MenuItemObserver
{
    private MenuItemRepo $menuItemRepo;

    public function __construct(MenuItemRepo $menuItemRepo)
    {
        $this->menuItemRepo = $menuItemRepo;
    }

    /**
     * Handle the MenuItem "created" event.
     */
    public function created(MenuItems $item): void
    {
        //$this->menuItemRepo->injectLevelAndPath($item);
    }

    /**
     * Handle the MenuItem "updated" event.
     */
    public function updated(MenuItems $item): void
    {
        $this->menuItemRepo->injectLevelAndPath($item);
    }

    /**
     * Handle the MenuItem "deleted" event.
     */
    public function deleted(MenuItems $item): void
    {
        // ...
    }

    /**
     * Handle the MenuItem "restored" event.
     */
    public function restored(MenuItems $item): void
    {
        // ...
    }

    /**
     * Handle the MenuItem "forceDeleted" event.
     */
    public function forceDeleted(MenuItems $item): void
    {
        // ...
    }
}
