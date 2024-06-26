@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_about')
@endsection
@section('content')
<!--================Blog Area =================-->
<style>
    .blog_details {
        padding: 30px 30px 15px 5px;
    }
    .cate-blog-title {
        font-family:"PV Sans Serif", sans-serif!important;
        font-weight: 500;
        line-height: 165%;
        font-size: 20px;
    }
    .cate-blog-active{
        color: #8b572a;
    }
    .widget_title {
        font-size: 38px!important;
    }
    .blog_details h4 {
        font-size: 38px!important;
        font-family:"Cormorant Garamond",serif!important;
    }
    .short-desc-blog {
        font-family:"PV Sans Serif", sans-serif!important;
        font-weight: 500;
        line-height: 165%;
        font-size: 20px;
        color: rgba(0, 0, 0, 0.73);
        word-break: break-word;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* number of lines to show */
        -webkit-box-orient: vertical;
    }

    .short-desc{
        word-break: break-word;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        line-height: 24px; /* fallback */
        max-height: 72px; /* fallback */
        -webkit-line-clamp: 3; /* number of lines to show */
        -webkit-box-orient: vertical;
        /* font-family: "Cormorant Garamond",Courier!important; */
        font-size: 20px;
        font-weight: 100;
        /* font-family: "Raleway",sans-serif!important; */
    }
    .blog_area .blog_details .title-blog {
        display:block;
    }
    .blog_area .blog_details .title-blog:hover{
        text-decoration:underline!important;
        transition: 0.1s;
        bottom: 2px;
        color: #ffd22a!important;
    }
</style>
<section class="blog_area mb-100">
        <div class="container" style="max-width: 1440px;">
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        {{--<aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>--}}

                        <aside class="single_sidebar_widget post_category_widget">
                            <h1 class="widget_title">{{trans('messages.category')}}</h1>
                            <ul class="list cat-list">
                                @php $delayCB = 100 @endphp
                                @foreach($categoryPost as $cate)
                                    <li class="wow fadeInDown" data-wow-delay="{{$delayCB}}ms">
                                        <a href="/list-blogs/{{$cate->url}}" class="d-flex">
                                            <p class="cate-blog-title {{$cate->url == $url ? 'cate-blog-active' : ''}}">{{ $cate->title }}</p>
                                            <!-- <p>(37)</p> -->
                                        </a>
                                    </li>
                                    @php $delayCB = $delayCB + 100 @endphp

                                @endforeach
                            </ul>
                        </aside>

                        <!-- <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>
                            <div class="media post_item">
                                <img src="img/post/post_1.png" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>From life was you fish...</h3>
                                    </a>
                                    <p>January 12, 2019</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="img/post/post_2.png" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>The Amazing Hubble</h3>
                                    </a>
                                    <p>02 Hours ago</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="img/post/post_3.png" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>Astronomy Or Astrology</h3>
                                    </a>
                                    <p>03 Hours ago</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="img/post/post_4.png" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>Asteroids telescope</h3>
                                    </a>
                                    <p>01 Hours ago</p>
                                </div>
                            </div>
                        </aside> -->



                    </div>
                </div>
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach($listPosts as $post)
                        <article class="blog_item ">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{url('/uploads/'.$post->image_thumbnail)}}" alt="">
                                {{--<a href="#" class="blog_item_date">
                                    <h3>15</h3>
                                    <p>Jan</p>
                                </a>--}}
                            </div>

                            <div class="blog_details">
                                <a class="title-blog " href="/blogs/{{$post->url}}">
                                    <h4>{{ $post->title }}</h4>
                                </a>
                                <p class="short-desc-blog">{{$post->short_description}}</p>
                                <ul class="blog-info-link">
                                    {{--<li><a href="#"><i class="fa fa-user"></i> {{$listPosts->title}}</a></li>--}}
                                    <!-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> -->
                                </ul>
                            </div>
                        </article>
                        @endforeach
                        {{--<div>
                            {!! $listPosts->links() !!}
                        </div>--}}
                        {{--@php
                        echo '<pre>';
                        echo $listPosts->lastPage();
                        echo'</pre>';
                        @endphp--}}
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="{{$listPosts->previousPageUrl()}}" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                @for($i=1;$i<=$listPosts->lastPage();$i++)
                                    <li class="page-item">
                                        <a href="{{$listPosts->path()}}?page={{$i}}" class="page-link">{{$i}}</a>
                                    </li>
                                @endfor

                         {{--       <li class="page-item active">
                                    <a href="{{$listPosts->nextPageUrl()}}" class="page-link">{{$listPosts->count()}}</a>
                                </li>--}}
                                <li class="page-item">
                                    <a href="{{$listPosts->nextPageUrl()}}" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

@endsection
