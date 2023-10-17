@extends('frontend_layout')
@section('header')
    @include('pages.include.header_home')
@endsection
@section('banner')
    @include('pages.include.banner_home')
@endsection
@section('content')

    <!-- loading-start -->
    <style>
        /*.loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('frontend/images/logo-loading.gif') 50% 50% no-repeat white;
        }
        @media (max-width: 700px) {
            .loader{
                background: url('frontend/images/logo-loading-mobile.gif') 50% 50% no-repeat white;
            }
        }*/
        .owl-carousel:hover .owl-nav div:hover{
            background: lightgray;
        }
    </style>
    {{--<div class="loader">
    </div>--}}
    <!-- loading-end -->

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
    .container-mission{
        width:85%;
        margin:auto;
    }
    .mission-image img{
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
    .misson_title h1{
        color:#8b572a;
        /* font-family:'Dancing Script'!important;
        font-weight: 500;
        font-size: 65px; */
    }
    .mission_margin{
        margin-top: auto;
        margin-bottom: auto;
    }
    .mission_content {
       /* height:700px;*/
        position:relative;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 30px;
        -webkit-line-clamp: 11;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
    @media (max-width: 1700px) {
        .mission_content {
            -webkit-line-clamp: 10;
        }
    }
    .btn-xt {
        margin-top:10px;
        float:right;
        font-size: 18px;
    }
    @media (max-width: 990px) {
        .mission_margin {
            padding-left: 0px;
            padding-right: 0px;

        }

        .container-mission{
            width: 100%;
            margin:auto;

        }
        .misson_title {
            margin-left: 10px;
        }
        .mission_content{
            width: 95%;
            margin: auto;
        }
        .btn-xt{
            margin-right: 20px;
        }
    }
	</style>
    @if($blockShortAboutUs != null)
        <div class="row">
            <hr width=60%>
            <div class="col-xl-7 xtc">
                <h2>{!! $blockShortAboutUs->content!!}</h2>
            </div>
        </div>
    @endif
    @if($blockOurMission != null)
     <div class="misson_area" >
        <div class="container-mission">
            <div class="row">
                <div class="col-xl-6 col-lg-12 mission_margin">
                    <div class="mb-20px mission-image">
                        <img src="{{url('uploads/'.$blockOurMission->image_one)}}" alt=""  >
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 " >
                    <div class="misson_title">
                        <h1>{{trans('messages.mission')}}</h1>
                    </div>
                    <div class="mission_content">{!! $blockOurMission->content !!} </div>
                    <div class="btn-xemthem">
                        <button class="btn btn-success btn-xt">{{trans('messages.see_more')}}</button>
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
    @endif

    <!-- mission_end -->

    <!-- Value -->
    @if($blockValue != null)
    <style>
        .impatti_area{
            box-shadow: 10px 10px 15px 10px rgba(221,221,221,0.3);
            background-color:beige;


        }
        .impatti_area:hover{
            background:#faf1eb;
        }
        .content-impatti{
            max-width: 100%;
            margin:auto;
            font-size:20px

        }
        .image-mt{
            background-image: url("uploads/{{$blockValue->image_one}}");
            background-size: cover;
            background-position: center;
        }
        .image-cn{
            background-image: url("uploads/{{$blockValue->image_two}}");
            background-size: cover;
            background-position: center;
        }
        @media (max-width: 990px) {
            .image-mt{
                background-size: cover;
                height: 600px;
                background-size: cover;
                background-position: center;
            }
            .image-cn{
                background-size: cover;
                height: 600px;
                background-size: cover;
                background-position: center;
            }
        }
        .title-impatti{
            text-align:center;

            /*font-family:'Dancing Script'!important;
            font-weight: 500;
            font-size: 75px;*/
            color:#8b572a;
        }
    </style>
    <div class="impatti_area">
        <div class="row">
            <div class="col-xl-4 col-lg-4 image-mt">
            </div>
            <div class="col-xl-4 col-lg-4" style="">
                <h1 class="title-impatti mt-10">~ {{trans('messages.value')}} ~</h1>
                <div class="content-impatti">
                    {!! $blockValue->content !!}
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 image-cn">

            </div>

        </div>

    </div>
    @endif
    <!-- VALUE_end -->


    <!-- Our tour -->
    <style>
    .container-our-tour{
        width: 85%;
        margin: auto;
    }
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
    .ourToursImage img{
        width: 100%;
    }
    .section_title h1{
        color: #8b572a!important;
    }
    .generated_title h1{
        color: #8b572a!important;
        /* font-family:'Dancing Script'!important;
            font-weight: 500;
            font-size: 65px; */
    }
    .our_tour_content{
        position:relative;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 25px;
        -webkit-line-clamp: 10;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
    .our_tour_xt{
        margin-top: 20px;
        margin-bottom: 40px;
        font-size: 18px;
    }
    @media (max-width: 990px) {
        .mission_margin {
            padding-left: 0px;
            padding-right: 0px;
        }
        .container-our-tour{
            width: 100%;
        }
        .generated_title {
            margin-left: 10px;
        }
        .our_tour_content{
            width: 95%;
            margin: auto;
        }
        .our_tour_xt{
            margin-left: 20px;
        }
    }
	</style>
    @if($blockOurTour != null)
    <div class="generated_area">
        <div class="container-our-tour">
            <div class="row">
                <div class="col-xl-6 col-lg-12 ">
                    <div class="generated_title">
                        <h1>{{trans('messages.our_tours')}}</h1>
                    </div>
                    <div class="our_tour_content">
                        {!! $blockOurTour->content !!}
                    </div>
                    <div>
                        <button class="btn btn-success our_tour_xt"> {{trans('messages.see_more')}} </button>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 mission_margin" >
                    <div class="ourToursImage">
                        <img src="{{url('uploads/'.$blockOurTour->image_one)}}" alt=""   loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{--<hr width=50% >--}}
    <!-- End Our tour  -->

    <!-- offers_area_start -->
    <style>
        .offers_area {
            position: relative;
            padding-bottom: 80px;
            padding-top: 20px;
            margin-bottom:50px;
            background-size: cover;
            background-image: url('uploads/{{$TourBackground != null ? $TourBackground->image_one : 2 }}');
            border-radius:35px;
            width: 100%;
            margin: auto;

        }
        .container-pop-tour{
            width: 85%;
            margin: auto;
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
        @media (max-width: 800px) {
            .single_offers{
                width: 90%;
                margin: auto;
            }
            .container-pop-tour{
                width: 95%;
            }
        }
        .single_offers h2{
            font-weight: 100;
        }

        .offers_content{
            margin-left: 15px ;
        }


/*        .offers_area::before{
            content: "";
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            background-color: rgba(0,0,0,0.30);
            border-radius:35px;


        }*/
        .title-offer{
            color: #8b572a;
        }
        .single_offers {
            /*box-shadow: 10px 10px 15px 10px rgba(221,221,221,0.3);*/
        }
        .single_offers:hover {
            box-shadow: 10px 10px 15px 10px rgba(221,221,221,0.3);
            transform:  translateY(-2%);
            /* transform: scale(1.1); */
            transition: 0.1s;
        }

        .section_title h1{
            margin-bottom:50px;
            text-align:center;
            /*font-family:'Dancing Script'!important;*/
            /*font-weight: 500;
            font-size: 85px;*/
        }
        .owl-prev{
            color: black!important;
            left: -20px!important;
        }
        .owl-next{
            color: black!important;
            right: -20px!important;
        }

        .owl-nav div:hover{
            /* background: darkseagreen!important; */
        }



        .block {
            position: relative;

        }

        .block:before, .block:after {
            content: '';
            position: absolute;
            left: -2px;
            top: -2px;
            /*background: linear-gradient(45deg, #fb0094, #0000ff, #00ff00,#ffff00, #ff0000, #fb0094,
            #0000ff, #00ff00,#ffff00, #ff0000);*/
            background: linear-gradient(45deg, white, white, white,white, #faf1eb, #faf1eb,
            #faf1eb, #faf1eb,white, #faf1eb);
            background-size: 400%;
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            z-index: -1;
            animation: steam 20s linear infinite;
        }

        @keyframes steam {
            0% {
                background-position: 0 0;
            }
            50% {
                background-position: 400% 0;
            }
            100% {
                background-position: 0 0;
            }
        }

        .block:after {
            filter: blur(50px);
        }

    </style>
    <div class="offers_area" >
        <div class="container-pop-tour" style="">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-20 mt-10">
                        <h1>{{trans('messages.popular_tours')}}</h1>
                        {{--<h1>Tours</h1>--}}
                    </div>
                </div>
            </div>
			<div class="row owl-carousel owl-two owl-theme"  style="margin: auto;">
                @foreach($tours as $tour)
                    <div class="single_offers block" data-img="{{url('/uploads/'.$tour->image_thumbnail)}}">
                        <div class="about_thumb">
                            <img src="{{url('/uploads/'.$tour->image_thumbnail)}}" alt="">
                        </div>
                        <div class="offers_content">
                            <div class="trangthai-category">
                                <span class="event-label trangthai-open">{{trans('messages.registration_open')}}</span> <span  class="event-label">{{$tour->type_tour}}</span>
                            </div>
                            @php
                            $date = date_create($tour->date_start);
                            $date_start= date_format($date, 'd/m/Y');
                            $date = date_create($tour->date_end);
                            $date_end= date_format($date, 'd/m/Y');
                            @endphp
                            <b>{{$date_start}} - {{$date_end}}</b>
                            <h2 class="title-offer">  {{$tour->name}}</h2>
                            <i class="fa fa-map-marker" aria-hidden="true"></i> {{$tour->region}}
                            <p class="short-desc"> {{$tour->short_description}} </p>
                            <a href="/tours/{{$tour->url}}" class="btn btn-earth">{{trans('messages.more_infomation_&_register')}}</a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
    <!-- offers_area_end -->

    <!-- picture -->
    {{--<style>
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
            font-size:25px;
            padding-top:10px;
            font-weight: 100;
            font-style: inherit;
            max-width:200px;
            margin: auto;

        }
        .avatar-ndh img{
            width: 185px;
            border-radius: 90px;
            height: 180px;
            object-fit: cover;
        }
        .section-avatar{
            background-size: cover;
        }
        .ndh_title h3{
            font-style: inherit;
            font-weight: 700;
            color:#8b572a;

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
                @foreach($companions as $companion)
                <div class="avatar-p">
                    <a href="">
                        <img src="{{url('uploads/'.$companion->avatar)}}" alt=""  >
                        <h3>{{$companion->name}}</h3>
                    </a>
                </div>
                @endforeach
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
    </div>--}}
    <!-- end-picture -->

    <!-- video_area_start -->
    <style>
        .video_area2{
            margin-bottom:50px;
            margin-top:50px
        }
        .single_video{
            /*margin-right:20px;*/
        }
        .single_video img{
             width: 100%;
            height: 100%;
             /*height: 250px;*/
            object-fit:cover;
        }
        .text_area_video h3{
            font-style: inherit;
            font-weight: 700;
            color:#8b572a;
        }
        .title-video{
            margin-top: 15px;
        }
        .icon-play{
            position: absolute;
            bottom: 35%;
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
        @media (max-width: 800px) {
            .icon-play{
            bottom: 45%;}
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
        .thumbnail-video{
            /*width: 380px;
            height: 250px;*/
            width: 100%;
        }
    </style>
    <div class="video_area2" >
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text_area_video">
                        <h3>{{trans('messages.our_journey')}}</h3>
                        <hr style="margin-bottom:50px;"> <!--  -->
                    </div>
                </div>
            </div>
            <div class="row">
               @if($videos != null)
                @foreach($videos as $video)
                    <div class="col-md-3" >
                        <div class="single_video">
                            <div class="thumbnail-video">
                                <a href="/{{$video->url_video}}" class="popup-video">
                                    <img src="{{url('uploads/'.$video->image_thumbnail)}}" alt=""  >
                                    <span  class="icon-play"><i class="fa fa-play"></i></span>
                                </a>
                            </div>
                            <div class="title-video">
                                <h3>{{$video->title}}</h3>
                                <b>- {{$video->author}}</b>
                                <p></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                <!-- <div class="col-md-3">
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
                </div> -->
            </div>
        </div>
    </div>
    <!-- video_area_end -->

    <!-- companion -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        .companion-area{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Poppins;
            background-image: url("uploads/{{$blackgroundCompanion != null ? $blackgroundCompanion->image_one : 2}}");
            background-size:cover;
            loading:"lazy";
        }
        .team-profile{
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        .profile-card{
            position: relative;
            width: 280px;
            height: 280px;
            background-color: #fff;
            padding: 30px;
            /**/border-radius: 10%;
            box-shadow: -5px 8px 45px rgba(51, 51, 51, 0.126);
            transition: all .4s;
            margin: 50px 0px;

        }
        @media (max-width: 1750px) and (min-width: 1620px) {
            .profile-card{
                width: 250px;
                height: 250px;
            }
            .profile-card .img img{
                height: 200px;
            }
        }

        @media (max-width: 1420px) {
            .profile-card{
                width: 250px;
                height: 250px;
            }
            .profile-card .img img{
                height: 200px;
            }
        }
        @media (max-width: 1280px) and (min-width: 1190px) {
            .profile-card{
                width: 220px;
                height: 220px;
            }
            .profile-card .img img{
                height: 165px;
            }
            .profile-card .caption{
                transform: translateY(-265px);
            }
            .profile-card  .desc-companion{
                -webkit-line-clamp: 13;
            }
        }
        @media (max-width: 1190px) and (min-width: 1100px) {
            .profile-card{
                width: 280px;
                height: 280px;
            }
            .profile-card .img img{
                height: 220px;
            }
        }
        @media (max-width: 1100px) and (min-width: 900px) {
            .profile-card{
                width: 250px;
                height: 250px;
            }
            .profile-card .img img{
                height: 200px;
            }
        }
        @media (max-width: 970px) and (min-width: 890px) {
            .profile-card{
                width: 220px;
                height: 220px;
            }
            .profile-card .img img{
                height: 165px;
            }
            .profile-card .caption{
                transform: translateY(-265px);
            }
            .profile-card  .desc-companion{
                -webkit-line-clamp: 13;
            }
        }
        @media (max-width: 890px) and (min-width: 730px) {
            .profile-card{
                width: 280px;
                height: 280px;
            }
            .profile-card .img img{
                height: 220px;
            }
        }
        @media (max-width: 730px) and (min-width: 660px) {
            .profile-card{
                width: 250px;
                height: 250px;
            }
            .profile-card .img img{
                height: 200px;
            }
        }
        @media (max-width: 660px) and (min-width: 599px) {
            .profile-card{
                width: 220px;
                height: 220px;
            }
            .profile-card .img img{
                height: 165px;
            }
            .profile-card .caption{
                transform: translateY(-265px);
            }
            .profile-card  .desc-companion{
                -webkit-line-clamp: 12;
            }
        }
        @media (max-width: 599px) {
            .profile-card{
                width: 250px;
                height: 250px;
                margin: auto;
                margin-top: 50px;
                margin-bottom: 50px;

            }
            .profile-card .img img{
                height: 200px;
            }
        }
        .profile-card:hover{
            border-radius: 10px;
            height: 500px;
        }
        .profile-card .img{
            position: relative;
            width: 100%;
            height: 100%;
            transform: translateY(-80px);
            border-radius: 50%;
            background: #fff;

        }
        .profile-card:hover img{
            border-radius: 10px;
        }
        .img img{
            width: 100%;
            border-radius: 50%;
            transition: all .4s;
            z-index: 99;
            height: 220px;
            object-fit: cover;
        }
        .caption{
            transform: translateY(-210px);
            opacity: 0;
            pointer-events: none;
            transition: all .5s;
        }
        .profile-card:hover .caption{
            opacity: 1;
            pointer-events: all;
        }

        .name-companion {
            text-align: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .name-companion h3{
            font-size: 25px;
            color: #8B572A;
            /*
            font-weight: 600;
            */
        }
        .caption p{
            font-size: 17px;
            font-weight: 500;
            margin: 2px 0 12px 0;
        }
        .caption .social-links i:hover{
            color: #0c52a1;
        }
        .desc-companion {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 10;
            -webkit-box-orient: vertical;
        }
        .title-companion{
            text-align: center;
            margin-top: 80px;
            margin-bottom: 80px;

        }
        .title-companion h1 {
            color: #8b572a;
        }
        .owl-carousel .owl-stage-outer {
            /*overflow: inherit;*/
        }
    </style>
    <div class="companion-area ">
        <div class="container">
            <div class="title-companion" style="margin-bottom: 80px">
                <h1 >{{trans('messages.companions')}}</h1>
            </div>
            <div class="team-profile owl-four owl-carousel  owl-theme">
                @if($companions != null)
                @foreach($companions as $companion)
                    <div class="profile-card">
                        <div class="img">
                            <img src="{{url('uploads/'.$companion->avatar)}}" alt=""  >
                            <div class="name-companion">
                                <h3>{{$companion->name}}</h3>
                            </div>
                        </div>
                        <div class="caption">
                            <div class="desc-companion">
                                {!! $companion->content !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- end-companion -->

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
            font-size: 25px;
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
            /* font-family:'Dancing Script'!important; */
            color: #8b572a!important;

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
        @media screen and (max-width: 800px) {
            .center-small-blog {
                display:block;
                width: 100%;
                height:auto;
            }
            .center-small-blog img{
                width: 100%;
                height:100%;
                object-fit:cover;
            }
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
                        <h1>{{trans('messages.mindful_travel_blog')}}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    @if($blogPostsLeft != null)
                    @foreach($blogPostsLeft as $post)
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0 small-image-blog" src="{{url('/uploads/'.$post->image_thumbnail)}}" alt="">
                            </div>
                            <div class="small-blog-details">
                                <a class="d-inline-block" href="/blogs/{{$post->url}}">
                                    <h2>{{$post->title}}</h2>
                                </a>
                            </div>
                        </article>
                    </div>
                    @endforeach
                    @endif
                    <!-- <div class="blog_left_sidebar">
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
                    </div> -->
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @php
                            $small = 'blog_details';
                            $flex = '';
                        @endphp
                        @if($blogPostsCenter != null)
                        @foreach($blogPostsCenter as $post)
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
                                <p>{{$post->short_description}}</p>
                                <!-- <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                </ul> -->
                            </div>
                        </article>
                        @php
                            $small = 'small-blog-details';
                            $flex = 'center-small-blog';

                        @endphp
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    @if($blogPostsRight != null)
                    @foreach($blogPostsRight as $post)
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0 small-image-blog" src="{{url('/uploads/'.$post->image_thumbnail)}}" alt="">
                            </div>
                            <div class="small-blog-details">
                                <a class="d-inline-block" href="/blogs/{{$post->url}}">
                                    <h2>{{$post->title}}</h2>
                                </a>
                            </div>
                        </article>
                    </div>
                    @endforeach
                    @endif
                    <!-- <div class="blog_left_sidebar">
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
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- about_area_end -->
@endsection
