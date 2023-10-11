@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_about')
@endsection
@section('content')
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area">
      <div class="container">
         <div class="row">
         <div class="col-lg-3">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget post_category_widget" style="background:white;">
                     <h4 class="widget_title">Category</h4>
                     <ul class="list cat-list">
                        @foreach($categoryPost as $cate)
                        <li>
                           <a href="/list-blogs/{{$cate->url}}" class="d-flex">
                              <p>{{ $cate->title }}</p>
                             {{-- <p>(37)</p>--}}
                           </a>
                        </li>
                        @endforeach
                     </ul>
                  </aside>

                  <!-- <aside class="single_sidebar_widget popular_post_widget" style="background:white;">
                     <h3 class="widget_title">Recommeded reading</h3>
                     <div class="media post_item">
                        <img src="{{url('frontend/images/post_1.png')}}" alt="post">
                        <div class="media-body">
                           <a href="single-blog.html">
                              <h3>From life was you fish...</h3>
                           </a>
                           <p>January 12, 2019</p>
                        </div>
                     </div>
                     <div class="media post_item">
                     <img src="{{url('frontend/images/post_2.png')}}" alt="post">
                        <div class="media-body">
                           <a href="single-blog.html">
                              <h3>The Amazing Hubble</h3>
                           </a>
                           <p>02 Hours ago</p>
                        </div>
                     </div>
                     <div class="media post_item">
                     <img src="{{url('frontend/images/post_3.png')}}" alt="post">
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
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="blog_details">
                     <h1>{{ $post->title }}
                     </h1>
                     <!-- <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                        <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                     </ul> -->
                     <div class="content-blog">
                        {!! $post->content !!}
                     </div>

                  </div>
               </div>

            </div>

         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->
@endsection
