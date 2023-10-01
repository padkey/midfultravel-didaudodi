@extends('frontend_layout')
@section('header')
    @include('pages.include.header_home')
@endsection
@section('banner')
    @include('pages.include.banner_home')
@endsection
@section('content')


    <!-- mission -->
	<style>
    .misson_area{
        /* background-image: url("frontend/images/banner2.png"); */
        /*  background: #f5f5ef!important;
        border: 1px solid silver; */
		padding: 50px 0px;
        padding-bottom:30px;
        margin-bottom:80px;
        margin-top:80px;
       
    }
    .misson_title img{
        width: 100%;
    }
	.misson h3{
		font-size:50px;
		color:black;
	}
	.misson_content p{
		
	}   
    .xtc{
        text-align:center;
        margin:auto;
    }
    .xtc h2{
        font-size: 35px;
        font-weight: 100;
        margin-top: 20px
    }
	</style>
    
   <div class="row">
        <hr width=60%>
        <div class="col-xl-6 xtc">
            <h2>Zen Master Thich Nhat Hanh is a global spiritual leader, poet and peace activist, revered around the world for his pioneering teachings on mindfulness, global ethics and peace.</h2>
        </div>
   </div>
   
     <div class="misson_area" >
        <div class="container" style="max-width: 1700px;">
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <div class="misson_title mb-20px">
                    <img src="{{url('uploads/'.$missionPage->avatar)}}" alt=""  >
                    </div>
                </div>
                <div class="col-xl-5 col-lg-12">
                    <div class="misson_title mb-20px">
                        <h1>{{trans('messages.mission')}}</h1>
                        <p>{!! $missionPage->content !!} </p>
                    </div>
                </div>
                
            </div>
            <!-- <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="misson_content">
                        <p>Cải thiện chất lượng cuộc sống của người dân, bảo vệ và nâng cao bản sắc xã hội, văn hóa và môi trường của họ, đồng thời hỗ trợ sự phát triển nội sinh của họ. Hành động theo các nguyên tắc công bằng xã hội, môi trường và kinh tế với mục đích biến du lịch thành một trong những công cụ bền vững có khả năng chống lại nghèo đói và các hình thức phân biệt đối xử khác nhau. </p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>


    <!-- mission_end -->

    <!-- IMPATTI -->
    <style>
        .impatti_area{
            box-shadow: 10px 10px 15px 10px rgba(221,221,221,0.3);
            background-color:beige;
        }
        .impatti_area:hover{
            background:#faf1eb;
        }
        .content-impatti{
            max-width: 80%;
            margin:auto;
            font-size:20px

        }
        .image-mt{
            background-image: url("uploads/{{$impactsPage->avatar}}");
            background-size: cover;
        }
        .image-cn{
            background-image: url("frontend/images/h3.jpg");
            background-size: cover;
        }
        .title-impatti{
            text-align:center;
            color: #8b572a;
            text-decoration: overline;
        }
    </style>
    <div class="impatti_area">
        <div class="row impatti">
            <div class="col-xl-4 col-lg-4 image-mt">

            </div>
            <div class="col-xl-4 col-lg-4" style="">
                <h1 class="title-impatti mt-10">{{trans('messages.impacts')}}</h1>
                <div class="content-impatti">
                    {!! $impactsPage->content !!}
                    <!-- <p><i class="fa fa-handshake-o" aria-hidden="true"></i>
                        Mỗi diễn viên được trả một mức lương công bằng, có tính chất tập thể và có sự tham gia.</p>
                    <p><i class="fa fa-money" aria-hidden="true"></i>
                        Khoảng 55% hoặc 65% chi phí của các hành trình mà chúng tôi cung cấp sẽ mang lại lợi ích cho cộng đồng địa phương nơi chúng tôi hoạt động.</p>
                    <p><i class="fa fa-users" aria-hidden="true"></i>
                        Trên khắp Trung Mỹ, chúng tôi trực tiếp mang lại lợi ích cho hơn 100 gia đình.</p>
                    <p><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Chúng tôi đã trao học bổng cho 3 nam và 1 nữ trong 3 năm qua ở Guatemala.</p>
                    <p><i class="fa fa-university" aria-hidden="true"></i>
                        Các đối tác địa phương của chúng tôi giải quyết vấn đề bảo vệ đa dạng sinh học, di sản văn hóa, thủ công, nghệ thuật và tinh thần.</p> -->
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 image-cn">

            </div>

        </div>
       
    </div>
    <!-- IMPATTI_end -->


    <!-- Generated -->
    <style>
    .generated_area{
        /* background-image: url("frontend/images/banner2.png"); */
        /* background-color:white; */
		padding: 50px 0px;
        margin-top:100px;
        padding-bottom:30px;
        margin-bottom:50px;
    }
    .generated_title h1{
    }
	.content-mission{
		max-width:70%;
		margin:auto;
	}
    .ourToursImage img{
            max-height: 50vh;
        }
	</style>
    <div class="generated_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <div class="generated_title mb-20px">
                    <h1>{{trans('messages.our_tours')}}</h1>
                    </div>
                    <div class="section_content">
                        <p>{!! $ourToursPage->content !!}
                         </p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="ourToursImage mb-20px">
                    <img src="{{url('uploads/'.$ourToursPage->avatar)}}" alt=""  >
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="section_content">
                        <p>Là du lịch xã hội, có đạo đức và có ý thức, được tạo ra bằng cách giúp đỡ mọi người, phát triển đối thoại giao lưu văn hóa phù hợp cho tình bạn, sức khỏa và tham gia bình đẳng.
                        Là du lịch xã hội, có đạo đức và có ý thức, được tạo ra bằng cách giúp đỡ mọi người, phát triển đối thoại giao lưu văn hóa phù hợp cho tình bạn, sức khỏa và tham gia bình đẳng
                        Là du lịch xã hội, có đạo đức và có ý thức, được tạo ra bằng cách giúp đỡ mọi người, phát triển đối thoại giao lưu văn hóa phù hợp cho tình bạn, sức khỏa và tham gia bình đẳng
                         </p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <hr width=50% >
    <!-- Generated_end -->

    <!-- offers_area_start -->
    <style>
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
        }
        .about_thumb {
            height:120px;
            border-radius: 5px 5px 0 0;
        }
        .trangthai-category{
            display:flex;
            margin-top:10px;
        }
        .event-label{
            display: inline-block;
            background: #222;
            text-transform: uppercase;
            border-radius: 3px;
            padding: 0 6px;
            color: white;
            margin: 0 5px 6px 0;
            font-weight: 600;
            font-size: 16px;
        }
        .trangthai-open{
            background: #8b572a!important;
        }
        .trangthai-close{
            background: black!important;
        }
        .mb-40{
            margin-bottom:40px;
        }
        .single_offers{
            background: #faf1eb;
            /* background: beige; */
            border-radius: 5px;
        }
        .offers_content{
            margin-left: 15px ;
        }
        
        .offers_area {
            padding-bottom: 0;
            padding-top: 20px;
            margin-bottom:50px;
        }
        .title-offer{
            color: #8b572a;
        }
        .single_offers:hover {
            box-shadow: 10px 10px 15px 10px rgba(221,221,221,0.3);
            transform:  translateY(-2%);
            /* transform: scale(1.1); */
            transition: 0.1s;
        }
        
        .section_title h1{
            margin-bottom:50px;
            font-style: normal;
        }
    </style>
    <div class="offers_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-20 mt-10">
                        <h1>{{trans('messages.popular_tours')}}</h1>
                    </div>
                </div>
            </div>
			<div class="row" >
                @foreach($tours as $tour)
                <div class="col-xl-4 col-md-4">
                    <div class="single_offers">
                        <div class="about_thumb">
                            <img src="{{url('frontend/images/pk2.jpg')}}" alt="">
                        </div>
                        <div class="offers_content">
                            <div class="trangthai-category">
                                <span class="event-label trangthai-open">{{trans('messages.registration_open')}}</span> <span  class="event-label">{{trans('messages.pilgrimage')}}</span>
                            </div>
                            <b>15/9 - 30/9/2023</b>
                            <h2 class="title-offer">  {{$tour->name}}</h2>
                            <i class="fa fa-map-marker" aria-hidden="true"></i> Asia
                            <p class="short-desc"> {{$tour->short_description}} </p>
                            <a href="/tours/{{$tour->url}}" class="btn btn-earth">{{trans('messages.more_infomation_&_register')}}</a>
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
    </div>
    <!-- offers_area_end -->

    <!-- picture -->
    <style>
        .ndh_area{
            padding-bottom:50px;
            padding-top:50px;
        }
        .avatar-p{
            border-radius: 85px;
            margin: 0px 25px 0 25px;
        }
        .avatar-p img{
            width: 185px;
            border-radius: 90px;
            height: 180px;
            object-fit: cover;
        }
        .avatar-p h3{
            text-align:center;
            font-size:20px;
            margin-top:10px;
            font-weight: 700;
            font-style: inherit;
            max-width:200px;
            margin: auto;

        }
        .section-avatar{
            background-size: cover;
        }
        .ndh_title h3{
            font-style: inherit;
            font-weight: 700;
           
        }
        .avatar-p:hover{
            transform: scale(1.1);
            transition: 0.1s;
        }
        .avatar-p:hover > a h3{
            color:darkcyan;
           
        }
    </style>

    <div class="ndh_area">
        <div class="container"style="margin:auto">
            <div class="row">
                <div class="ndh_title">
                    <h3>{{trans('messages.companions')}}</h3>
                </div>
            </div>
            <hr style="margin-bottom:50px;"> <!--  -->
            <div class="row" style="justify-content:center">
                <div class="avatar-p">
                    <a href="">
                        <img src="{{url('frontend/images/z1.jpg')}}" alt=""  >
                        <h3>Sister Luc Nghiem Francese-Inglese</h3>
                    </a>
                </div>
                
                <div class="avatar-p">
                    <img src="{{url('frontend/images/z3.jpg')}}" alt="" >
                    <h3>Sister Sac Nghiem Vietnamese</h3>
                </div>
                <div class="avatar-p">
                    <img src="{{url('frontend/images/z4.jpg')}}" alt="" >
                    <h3>Thay Phap Linh Inglese</h3>
                </div>
                <div class="avatar-p">
                    <img src="{{url('frontend/images/z5.jpg')}}" alt=""  >
                    <h3>Sister Hien Nghiem Inglese</h3>
                </div>
                <div class="avatar-p">
                    <img src="{{url('frontend/images/z2.jpg')}}" alt=""  >
                    <h3>Fabio Cappiello Organizzatore</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- end-picture -->



    <!-- video_area_start -->
    <style>
        .video_area2{
            margin-bottom:50px;
        }
        .single_video img{
         width: 100%;
         height: 215px;
            
        }
        .text_area_video h3{
            font-style: inherit;
            font-weight: 700;
        }
        .title-video{
            margin-top: 15px;
        }
        .icon-play{
            position: absolute;
            bottom: 45%;
            left: 8%;
            color: var(--color-cloud);
            font-size:18px;
            transition: all .4s cubic-bezier(.15,.53,.35,1);
            border-radius: 30px;
            color:black;
            background:white;
            width: 53px;
            height: 53px;
            line-height: 57px;
            text-align: center;
            
        }
        .single_video:hover .icon-play{
            color:white;
            background:black;
            transform:  translateY(-20%); 
            transition: 0.3s;
        }
        /* .title-video h3:hover{
            color: darkcyan;
            transform: scale(1.1);
            transition: 0.1s;
        } */
    </style>
    <div class="video_area2" >
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text_area_video">
                        <h3>{{trans('messages.dharma_talks')}}</h3>
                        <hr style="margin-bottom:50px;"> <!--  -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="single_video">
                        <div class="thumbnail-video ">
                            <a href="/https://www.youtube.com/embed/bX2dMtKEtdU?si=TDE0FtH5a0CfZ93H" class="popup-video">
                                 <img src="{{url('frontend/images/tn1.jpg')}}" alt=""  >
                                 <span  class="icon-play"><i class="fa fa-play"></i></span>
                            </a>
                           
                        </div>
                        <div class="title-video">
                            <h3>Presence, Ethics, and the Rewarding Challenges of Caring for Others</h3>
                            <b>Thich Nhat hanh</b>
                            <p> - July 20, 2023</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_video">
                        <div class="thumbnail-video ">
                            <a href="/https://www.youtube.com/embed/m6keU6_2SzE?si=iIZemXgI14ErFKxH" class="popup-video">
                                 <img src="{{url('frontend/images/tn2.jpg')}}" alt=""  >
                                 <span  class="icon-play"><i class="fa fa-play"></i></span>
                            </a>
                           
                        </div>
                        <div class="title-video">
                            <h3>Exploring the Nature of Consciousness</h3>
                            <b>Thich Nhat hanh</b>
                            <p> - July 20, 2023</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_video">
                        <div class="thumbnail-video">
                            <img src="{{url('frontend/images/tn3.jpg')}}" alt=""  >
                            <a href="https://www.youtube.com/embed/m6keU6_2SzE?si=iIZemXgI14ErFKxH" class="icon-play"><i class="fa fa-play"></i></a>
                        </div>
                        <div class="title-video">
                            <a href=""><h3>Exploring the Nature of Consciousness</h3></a>
                            <b>Br Pháp Hữu, Br Pháp Linh, Br Troi Bao Tang</b>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single_video">
                        <div class="thumbnail-video">
                            <img src="{{url('frontend/images/tn4.jpg')}}" alt=""  >
                            <a href="" class="icon-play"><i class="fa fa-play"></i></a>
                        </div>
                        <div class="title-video">
                            <h3>Presence, Ethics, and the Rewarding Challenges of Caring for Others</h3>
                            <b>Thich Nhat hanh</b>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- video_area_end -->

        <!-- about_area_start -->
        <style>
        .about_area_home{
            padding-top:20px;
         
        }    
        .about_thumb img{
            max-height: 50vh;
        }
        .small-blog-details{
            box-shadow: 0px 10px 20px 0px rgba(221,221,221,0.3);

        }
        .blog_details{
            padding: 15px 25px 5px 25px;
        }
        .blog_details h2{
            font-size: 40px;
            margin-bottom: 0px;
            padding: 0px 0 5px 0px;
        }
        .blog_details p{
            font-size: 29px;
        }

        .small-blog-details h2{
            font-size: 28px;
            margin-bottom: 0px;
            padding: 15px 0 5px 15px;
           
        }
        .small-blog-details p{
            padding: 0 0 15px 15px;
        }
        .title-about{
            text-align:center;
            margin-bottom:30px;
        }
        .title-about h1{
            font-style: normal;
            font-size: 40px;

        }
        .title-about p {
            font-weight:500;
        }
        .d-inline-block {
            text-decoration:none;
            display:block;
            position:relative;
        }
        .d-inline-block::before{
            content: '';
            background-color: rgba(255,210,42,.4); 
            position: absolute;
            left: 0;
            bottom: 0px;
            width: 100%;
            height: 0px;
            z-index: -1;
            transition: all .3s ease-in-out;

        }
        .d-inline-block:hover::before{
            bottom: 0;
            height: 100%;
            background-color: #ffd22a;
        }
        .small-image-blog{
            height: 272px;
         object-fit: cover;
            width:100%;
        }
        .blog_item {
            margin-bottom: 30px;
        }
        .center-small-blog{
            display:flex;
        }
        .center-small-blog img{
            width: 200px;
            height:200px;
            object-fit:cover;
        }
        .center-small-blog .small-blog-details p{
            font-size:22px;
        }
        .center-big-blog{
            height: 560px;
            object-fit:cover;
        }
 
   
    </style>
    <div class="about_area_home">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="title-about">
                        <p>Didaudodi midful travel</p>
                        <h1>Honoring our beloved teacher</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0 small-image-blog" src="{{url('/frontend/images/bl1.jpg')}}" alt="">
                            </div>
                            <div class="small-blog-details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Video of Thay’s funeral and cremation</h2>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0 small-image-blog" src="{{url('/frontend/images/bl2.jpg')}}" alt="">
                            </div>
                            <div class="small-blog-details">
                                <a class="d-inline-block" href="single-blog.html">
                                <h2>Video of Thay’s funeral and cremation</h2>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0 small-image-blog" src="{{url('/frontend/images/bl3.jpg')}}" alt="">
                            </div>
                            <div class="small-blog-details">
                                <a class="d-inline-block" href="single-blog.html">
                                <h2>Video of Thay’s funeral and cremation</h2>
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @php 
                            $small = 'blog_details';
                            $flex = '';
                        @endphp;
                        @foreach($blogPosts['posts'] as $post)
                        <article class="blog_item {{$flex}}">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0 " src="{{url('/uploads/'.$post->image_thumbnail)}}" alt="">
                                <!-- <a href="#" class="blog_item_date">
                                    <h3>15</h3>
                                    <p>Jan</p>
                                </a> -->
                            </div>

                            <div class="{{$small}} ">
                                <a class="d-inline-block" href="/blogs/{{$post->url}}">
                                    <h2>{{$post->title}}</h2>
                                </a>
                                <p>Brother Phap Linh aka, Brother Spirit, recently spoke at Overheated, a climate event in London co-presented by Billie Eilish.</p>
                                <!-- <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                </ul> -->
                            </div>
                        </article>
                        @php 
                            $small = 'small-blog-details';
                            $flex = 'center-small-blog';

                        @endphp;
                        @endforeach

                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0 small-image-blog" src="{{url('/frontend/images/bl5.jpg')}}" alt="">
                            </div>
                            <div class="small-blog-details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Free at School</h2>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0 small-image-blog" src="{{url('/frontend/images/bl6.jpg')}}" alt="">
                            </div>
                            <div class="small-blog-details">
                                <a class="d-inline-block" href="single-blog.html">
                                <h2>Video of Thay’s funeral and cremation</h2>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0 small-image-blog" src="{{url('/frontend/images/bl4.jpg')}}" alt="">
                            </div>
                            <div class="small-blog-details">
                                <a class="d-inline-block" href="single-blog.html">
                                <h2>Video of Thay’s funeral and cremation</h2>
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about_area_end -->
@endsection