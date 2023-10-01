<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DDDD\Blog\Models\BlogPost;
use DDDD\Blog\Models\BlogCategory;

class BlogController extends Controller
{
    //
    public function showList($url)
    {
        // $aa = BlogPost::query()->findOrFail(1);
        //        $cates = $aa->categories()->get();
        //        foreach ($cates as $cate) {
        //            /**
        //             * @var BlogCategory $cate
        //             *
        //             */
        //        }
        $listPosts =  BlogCategory::with('posts')->where('url',$url)->get();
        $listCate =  BlogCategory::where('url','!=','show-home')->get();
       // $listPosts = $catePost->posts()->get();
        //$listPosts = BlogPost::with('categories')->where('categories.url',$url)->get();

        return view('pages.blogs.list')->with(compact('listPosts','listCate'));
    }
    public function showDetails($url)
    {
        $listCate =  BlogCategory::where('url','!=','show-home')->get();
        $post = BlogPost::where('url',$url)->first();

        return view('pages.blogs.details')->with(compact('post','listCate'));

    }
}
