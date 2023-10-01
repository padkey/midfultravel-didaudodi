<?php

namespace DDDD\Blog\Services;

use DDDD\Blog\Models\BlogPost;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Log;

/**
 * Class BlogPostRepo
 * @package DTV\Blog\Repositories
 */
class BlogPostService
{
    const DEFAULT_ADMIN_ID = 1;

    /**
     * @param BlogPost $item
     */
    public function addAuthorBlogPost(BlogPost $item) {
        if (Admin::user() != null) {
            $item->{BlogPost::COL_AUTHOR_ID} = Admin::user()->getAuthIdentifier();
        } else {
            Log::alert("Admin does not login.");
            $item->{BlogPost::COL_AUTHOR_ID} = self::DEFAULT_ADMIN_ID;
        }
    }
}
