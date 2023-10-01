<?php

namespace DDDD\Blog\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(view('blog::index'));
    }
}