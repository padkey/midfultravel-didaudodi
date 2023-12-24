<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DDDD\Blog\Models\BlogPost;
use DDDD\Blog\Models\BlogCategory;

class BlogController extends Controller
{
    //
    public function showList($url,Request $req)
    {
        $locale_code =   config('app.locale');
        $cate = BlogCategory::with('posts')->where('url',$url)->where('locale_code',$locale_code)->get();
        $listPosts = $cate[0]->posts();
        $listPosts = $listPosts->orderByDesc('id')->where('locale_code',$locale_code)->paginate(5);

        // ----------- SEO -----------\\
        $metaDes = $cate[0]->meta_description;
        $metaKeywords =$cate[0]->meta_keywords;
        $metaTitle = $cate[0]->meta_title;
        $urlCanonical = $req->url();
        // ----------- End Seo -----------\\

        return view('pages.blogs.list')->with(compact('listPosts','metaDes','metaTitle','metaKeywords','urlCanonical'));
    }
    public function showDetails($url,Request $req)
    {


        $locale_code =   config('app.locale');
        $post = BlogPost::where('url',$url)->where('locale_code',$locale_code)->first();
        // ----------- SEO -----------\\
        $metaDes = $post->meta_description;
        $metaKeywords =$post->meta_keywords;
        $metaTitle = $post->meta_title;
        $urlCanonical = $req->url();
        // ----------- End Seo -----------\\
        return view('pages.blogs.details')->with(compact('post','metaDes','metaTitle','metaKeywords','urlCanonical'));

    }
}
