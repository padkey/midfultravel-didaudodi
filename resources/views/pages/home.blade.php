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
        .owl-carousel:hover .owl-nav div:hover{
            background: lightgray;
        }
    </style>

    <!-- mission -->
	<style>
    .mission_area{
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
        border-radius: 43px;
        box-shadow: 0 40px 50px -20px rgba(0,0,0,.35);
    }

    .xtc{
        text-align:center;
        margin:auto;
    }
    .xtc {
        text-align: center;
        max-width: 1100px;
        height: fit-content;
    }

    .title-welcome{
        font-family: 'Great Vibes', cursive;
        color: #c1955d;
        font-size: 43px;
        margin-top:50px;
    }
    .xtc h5 {
        font-size: 22px;
        font-family: 'Playfair Display', serif!important;
        letter-spacing: 0.5px;
        color: rgba(77,66,58,0.76);
        line-height: 1.6em;
    }
    .xtc h2{
        color: #4c423a;
        font-size: 43px;
        text-transform: uppercase;
        font-style: normal;
        /*color: #8b572a;*/
        /*padding: 0 0 34px;*/
        font-size: 40px;
        animation-delay: 1s ;
        position: relative;
        font-family: 'Playfair Display', serif!important;

    }
    .mt-12{
        margin-top: 12px;
    }
    .font-play-fair {
        font-family: 'Playfair Display', serif!important;
    }

    .mission-title {
        margin-bottom: 20px;
    }

    .content_center{
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
    .mission_content span,p{
        font-weight: 200;
        line-height: 165%;
        font-size: 18px;
        letter-spacing: 0.5px;
        color: rgba(77,66,58,0.76)!important;
        line-height: 165%;
        font-family: 'Playfair Display', serif!important;
    }
    /*font title*/
    .section-title h1{
        color: #8b572a;
        text-transform: uppercase;
        font-family: 'Playfair Display', serif!important;
        color: #4c423a;
        margin: 0;
        font-size: 65px;
    }
    .section-title h3{
        font-family: 'Great Vibes',handwriting!important;
        color: #c1955d;
        font-size: 34px;
        margin: 0;
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
        .content_center {
            padding-left: 12px;
            padding-right: 0px;

        }
        .container-mission{
            width: 100%;
            margin:auto;
            padding-left: 20px;
        }
        .mission-title {
            margin-left: 10px;

        }
        .mission_content{
            width: 95%;
            margin: auto;
        }
        .mission-image img{
            border-radius: 0;
        }
        .mission-image {
            margin-bottom: 31px;
        }
        .xtc h5{
            font-size: 16px;
            letter-spacing: 1px;
        }
        .btn-xt{
            margin-right: 20px;
        }
        .section-title h1 {
            font-size: 43px;
        }

    }




	</style>
    <style>

    </style>
    @if($blockShortAboutUs != null)
        <div class="row" style=" margin-right: 0;margin-left: 0;">
            <hr width=60%>
            <div class="container xtc">
                <h4 class="title-welcome mt-12 fadeInDown wow" data-wow-delay="200ms">
                     {{trans('messages.welcome_to_our')}}
                </h4>
                <h2 class="title-short-about-us mt-12 fadeInUp wow" data-wow-delay="200ms">
                    {{trans('messages.slogan_line_1')}}
                </h2>
                <h5 class=" mt-12 fadeInDown wow" data-wow-delay="200ms">
                    {{trans('messages.slogan_line_2')}}

                </h5>
                <a href="/about-us" class="btn primary-btn fadeInUp wow" data-wow-delay="200ms"> <span>About us</span> </a>
            </div>
        </div>
    @endif
    @if($blockOurMission != null)
     <div class="mission_area" >
        <div class="container-mission">
            <div class="row">
                <div class="col-xl-6 col-lg-12 content_center wow fadeInLeft" data-wow-delay="0.5s">
                    <div class="mb-20px mission-image ">
                        <img src="{{url('uploads/'.$blockOurMission->image_one)}}" alt=""  >
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 content_center wow fadeInRight" data-wow-delay="0.8s">
                    <div class="mission-title section-title">
                        <h1>{{trans('messages.mission')}}</h1>
                        <h3>Our happy clients</h3>
                    </div>
                    <div class="mission_content ">{!! $blockOurMission->content !!} </div>
                    <div class="btn-xemthem">
                        <button class="btn primary-btn btn-xt">{{trans('messages.see_more')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- mission_end -->

    <!--VALUE AREA -->
    <style>
        .core_value_title h1{
            text-align: center;
        }
        .content_core_value h3{
            text-align: center;
        }
        .single_value {
            padding: 8px;
        }
        .single_content_value{
            font-weight: 200;
            line-height: 165%;
            font-size: 18px;
            font-family: 'Playfair Display', serif!important;
            letter-spacing: 0.5px;
            color: rgba(77,66,58,0.76)!important;
            line-height: 165%;
        }
    </style>
    <!--END VALUE AREA -->

    <style>
        .area_core_value{
            background-color: #f9f3ed;

        }
        .container_value {
            background-color: transparent;
            background-image: radial-gradient(at top center,#FFFFFF 0%,#F9F3ED00 65%),radial-gradient(at bottom left ,#FFFFFF 0%,#F9F3ED00 31%)
            ,radial-gradient(at bottom right ,#FFFFFF 0%,#F9F3ED00 43%);
        }
        .timeline{
            position: relative;
            margin: 100px auto;
        }
        .single_value {
            padding: 10px 65px;
            position: relative;
            width: 50%;
            min-height: 250px;
            /*background: rgba(0,0,0,0.3);*/
            /*animation: movedown 1s linear forwards;
            opacity: 0;*/
        }

        .text-box{
            padding: 20px 30px;
            background: #FFFFFF;
            position: relative;
            font-size: 15px;
            border-radius: 20px  ;
            border: 1px solid #FFFFFF;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 25px 50px -12px;
        }
        .left-container{
            left: 0;
        }
        .right-container{
            left: 50%
        }
        .single_value img {
            position: absolute;
             width: 90px;
            height: 90px;
            border-radius: 50%;
            right: -40px;
            top: -10px;
            z-index: 2;
            object-fit: cover;
            border: 5px solid #FFFFFF;
            box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;

        }
        .right-container img {
            left: -40px;
        }
        .left-container img{
            right: -51px;
        }
        .timeline::after{
           content: '';
            position: absolute;
            width: 12px;
            height: 200px;
            background: #FFFFFF;
            top: 0;
            left: 50%;
            margin-left: 0px;
            z-index: 1;
            animation: moveline 4s linear forwards;
            box-shadow: rgba(17, 17, 26, 0.02) 0px 1px 0px, rgba(17, 17, 26, 0.02) 0px 0px 8px;

        }
        @keyframes moveline {
            0% {
                height: 0;
            }
            100% {
                height: calc(100% - 300px);
            }

        }
        .text-box h2 {
            font-weight: 600;
        }
        .text-box p,span {
            font-weight: 200;
            line-height: 165%;
            font-size: 18px;
            font-family: 'Playfair Display',sans-serif !important;
            letter-spacing:1px!important;
            color: rgba(77,66,58,0.76)!important;
        }
        .left-container-arrow {
            height: 0;
            width: 0;
            position: absolute;
            top: 5px;
            z-index: 1;
            border-top: 15px solid transparent;
            border-bottom: 15px solid transparent;
            border-left: 15px solid #FFFFFF;
            right: -11px;
        }
        .right-container-arrow {
            height: 0;
            width: 0;
            position: absolute;
            top: 5px;
            z-index: 1;
            border-top: 15px solid transparent;
            border-bottom: 15px solid transparent;
            border-right: 15px solid #FFFFFF;
            left: -11px;
        }
        @media screen and (max-width: 900px) {
            .timeline{
                margin: 50px auto;
            }
            .timeline::after {
                left:41px;
            }
            .single_value{
                width:100%;
                padding-left: 112px;
                padding-right: 12px;
            }
            .text-box{
                font-size: 13px;
            }
            .text-box p,span {
                font-weight: 200;
                line-height: 165%;
                font-size: 18px;
                font-family: 'Playfair'!important;
                letter-spacing: 0.5px;
                color: rgba(77,66,58,0.76)!important;
                line-height: 165%;
            }
            .right-container {
                left: 0;
            }
            .left-container img, .right-container img {
                left: 0px;
            }
            .left-container-arrow, .right-container-arrow {
                border-right: 15px solid #FFFFFF;
                border-radius: 10px ;
                border-left: 0;
                left: -12px;
            }
        }
        .core_value_title h1{
            color: #8b572a;
            text-transform: uppercase;
            font-family: 'Playfair';
            color: #4c423a;
            margin: 0;
        }


    </style>
    <div class="area_core_value ">
        <div class="container_value">
            <div class="section-title text-center pt-80">
                <h3 class="text-center"> Mindful Travel </h3>
                <h1 >
                    {{trans('messages.value')}}
                </h1>
            </div>
            <div class="timeline">
                <div class="single_value left-container">
                    <img src="{{url('frontend/images/mental-health.gif')}}" alt="" class="wow fadeIn" data-wow-delay="500ms">
                    <div class="text-box wow fadeInLeftBig" data-wow-delay="400ms">
                        <h2> {{$valueMindfulness->title}}</h2>
                        <div class="content-single-value">
                             {!! $valueMindfulness->content !!}
                        </div>
                        <span class="left-container-arrow"></span>
                    </div>
                </div>
                <div class="single_value right-container">
                    <div class="image_value">
                        <img src="{{url('frontend/images/volunteering.gif')}}" alt="" class="wow fadeIn" data-wow-delay="800ms">
                    </div>
                    <div class="text-box wow fadeInRightBig" data-wow-delay="700ms">
                        <h2> {{$valueConnection->title}}</h2>
                        <div class="content-single-value">
                            {!!  $valueConnection->content!!}
                        </div>
                        <span class="right-container-arrow"></span>

                    </div>
                </div>
                <div class="single_value left-container">
                    <img src="{{url('frontend/images/eco-earth.gif')}}" alt="" class="wow fadeIn" data-wow-delay="1100ms">
                    <div class="text-box wow fadeInLeftBig" data-wow-delay="1000ms">
                        <h2> {{$valueSustainability->title}}</h2>
                        <div class="content-single-value">
                             {!! $valueSustainability->content  !!}
                        </div>
                        <span class="left-container-arrow"></span>

                    </div>
                </div>
                <div class="single_value right-container value-end" style="height: 300px">
                    <img src="{{url('frontend/images/kindness.gif')}}" alt="" class="wow fadeIn" data-wow-delay="1400ms">
                    <div class="text-box wow fadeInRightBig" data-wow-delay="1300ms">
                        <h2> {{$valuePersonalGrowth->title}}</h2>
                        <div class="content-single-value">
                          {!! $valuePersonalGrowth->content !!}
                        </div>
                        <span class="right-container-arrow"></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
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
    .ourToursImage img{
        width: 100%;
        border-radius: 43px;
        box-shadow: 0 40px 50px -20px rgba(0,0,0,.35);
    }

    .our_tour_title {
        margin-bottom: 20px;
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
    .our_tour_content span,p{
        font-weight: 200;
        line-height: 165%;
        font-size: 24px;
        font-family: 'Playfair Display', serif!important;
        letter-spacing: 0.5px!important;
        color: rgba(77,66,58,0.76)!important;
        line-height: 165%;
    }

    .our_tour_xt{
        margin-top: 20px;
        margin-bottom: 40px;
        font-size: 18px;
    }
    @media (max-width: 990px) {
        .content_center {
            padding-left: 0px;
            padding-right: 0px;
        }
        .container-our-tour{
            width: 100%;
        }
        .our_tour_title {
            margin-left: 20px;
        }
        .our_tour_content{
            width: 95%;
            padding-left: 20px;
        }
        .our_tour_xt{
            margin-left: 20px;
        }
        .ourToursImage img {
            border-radius: 0;
        }
    }
	</style>
    @if($blockOurTour != null)
    <div class="generated_area">
        <div class="container-our-tour">
            <div class="row" >
                <div class="col-xl-6 col-lg-12   wow fadeInLeft" data-wow-delay="0.5s">
                    <div class="our_tour_title section-title">
                        <h1>{{trans('messages.our_tours')}}</h1>
                        <h3>Giving you a memorable experience</h3>
                    </div>
                    <div class="our_tour_content">
                        {!! $blockOurTour->content !!}
                    </div>
                    {{--<div>
                        <button class="btn btn-earth our_tour_xt"> {{trans('messages.see_more')}} </button>
                    </div>--}}
                </div>
                <div class="col-xl-6 col-lg-12 content_center wow zoomIn" data-wow-delay="0.5s" >
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
        .bg-pink{
            background-color: #f9f3ed;
        }
        .section-icon{
            text-align: center;
            margin: auto;
            position: relative;
        }
        .section-icon img{
            border-radius: 50%;
            margin-bottom: 10px;
            width:100px;
        }
        .hightlight-underline-white {
            text-transform: uppercase;
            /*padding-bottom: 10px;*/
            display: inline-block;
            position: relative;
        }
        .hightlight-underline-white::before {
            content: "";
            top: -5px;
            width: 80%;
            position: absolute;
            margin: 0 10%;
            border-bottom: 3px solid #FFFFFF;
        }
        .hightlight-underline-green {
            text-transform: uppercase;
            /*padding-bottom: 10px;*/
            display: inline-block;
            position: relative;
        }
        .hightlight-underline-green::before {
            content: "";
            top: -5px;
            width: 80%;
            position: absolute;
            margin: 0 10%;
            border-bottom: 3px solid #024f43;
        }
        @media (max-width: 800px) {
            /*.container{
                width:95%;
                margin:auto;
            }*/
            .hightlight-underline-white::before  {
                content: "";
                position: absolute;
                bottom: -10px;
                height: 1px;
                width: 80%!important;
                margin: 0 auto 0 10%!important;
                display: block;
            }
            .hightlight-underline-green::before  {
                content: "";
                position: absolute;
                bottom: -10px;
                height: 1px;
                width: 80%!important;
                margin: 0 auto 0 10%!important;
                display: block;
            }
        }
        .offers_area {
            position: relative;
            padding-bottom:0px!important;
            background-size: cover;
            width: 100%;
            margin: auto;

        }
        .pop-color {
            padding-bottom: 43px;
            background-color: transparent;
            background-image: radial-gradient(at top center,#FFFFFF 0%,#F9F3ED00 65%),radial-gradient(at bottom left ,#FFFFFF 0%,#F9F3ED00 31%)
            ,radial-gradient(at bottom right ,#FFFFFF 0%,#F9F3ED00 43%),radial-gradient(at bottom  ,#FFFFFF 0%,#F9F3ED00 43%);
        }

        .container-pop-tour{
            width: 85%;
            margin: auto;

        }

        .area_core_value{
            background-color: #f9f3ed;

        }
        .container_value {
            background-color: transparent;
            background-image: radial-gradient(at top center,#FFFFFF 0%,#F9F3ED00 65%),radial-gradient(at bottom left ,#FFFFFF 0%,#F9F3ED00 31%)
            ,radial-gradient(at bottom right ,#FFFFFF 0%,#F9F3ED00 43%);
        }

        .short-desc {
            font-weight: 500;
            font-size: 23px;
            font-family: 'Cormorant Garamond', serif!important;
            letter-spacing: 0.5px!important;
            color: rgba(77,66,58,0.76)!important;
            line-height: 165%;
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
            font-style: italic;
        }
        .about_thumb_tour {
            height:290px;
            border-radius: 5px 5px 0 0;

        }
        .about_thumb_tour img{
            height: 100%;
            object-fit: cover;
        }
        .trangthai-category{
            display:flex;
            margin-top:10px;
        }
        .event-label{
            display: inline-block;
            background: #222;
            text-transform: uppercase;
            border-radius: 5px;
            padding: 8px;
            color: #FFFFFF!important;
            margin: 0 5px 6px 0;
            font-weight: 600;
            font-size: 18px;
            font-family: 'Playfair Display', serif!important;
            letter-spacing:0.3px;

        }
        .trangthai-open{
            background: #c1955d!important;
            font-family: 'Playfair Display', serif!important;
        }
        .trangthai-close{
            background: black!important;
            font-family: 'Playfair Display', serif!important;

        }
        .mb-40{
            margin-bottom:40px;
        }
        .single_offers{
            /*background: #faf1eb;*/
            background: #FFFFFF;
            border-radius: 5px;
            max-width: 550px;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
            margin: 43px 0 31px 0;
        }
        @media (max-width: 800px) {
            .single_offers{
                width: 90%;
                margin: auto;
            }
            .container-pop-tour{
                width: 95%;
            }
            .event-label {
                font-size: 16px;
            }
        }
        .single_offers h2{
            font-weight: 100;
        }

        .offers_content{
            padding: 15px 15px 25px 15px ;
        }
        .offers_content b {
            color: #4c423a;
        }
        .title-offer h1{
            color: #4c423a;
            text-transform: uppercase;
            font-family: 'Playfair Display', serif!important;
            font-weight: 600;
        }
        .single_offers:hover {
            box-shadow: 10px 10px 15px 10px rgba(221,221,221,0.3);
            transform:  translateY(-2%);
            /* transform: scale(1.1); */
            transition: 0.1s;
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


        .bg-bg{
            /* background-color:beige!important;*/
            background-color:white!important;

        }
        .bg-w{
            background-color:#FFFFFF!important;
        }
        .title_ttp{
            text-align: left;
            border-top: 1px solid #4c423a;
            padding: 10px 0 10px 0;
        }
        .title_ttp h1{
            color: #8b572a;
            text-transform: uppercase;
            font-family: 'Playfair Display', serif!important;
            color: #4c423a;
            margin: 0;
        }
        .title_ttp h3{
            font-family: 'Great Vibes',handwriting!important;
            color: #c1955d;
            font-size: 34px;
            margin: 0;
        }
        .position_tour {
            width: 43px;
            display: flex;
        }
        .position_tour img {
            width: 100%;
            object-fit: cover;
        }
    </style>
    <div class="offers_area bg-pink" >
        <div class="pop-color">
            <div class="container-pop-tour">
                <div class="row mb-40">
                    <div class="col-xl-12">
                        <div class="section-title text-center mb-20 mt-80">
                            <h3 class="title-top">Our products</h3>
                            <h1>{{trans('messages.popular_tours')}}</h1>
                        </div>
                        {{--<div class="section-icon">
                            <img src="{{url('/frontend/images/tour1.png')}}" alt="" style="border-radius: 0">
                            <div class="title-center">
                                <h1 class="hightlight-underline-green">{{trans('messages.popular_tours')}}</h1>
                            </div>
                        </div>--}}
                    </div>
                </div>
                <input type="hidden" value="{{count($tours)}}" class="toursNumber">
                <div class="row owl-carousel owl-two owl-theme"  style="margin: auto;">
                    @php
                        $delayPT = 100;
                    @endphp
                    @foreach($tours as $tour)
                        <div class="single_offers hidden2 block  wow fadeInUp" data-wow-delay="{{$delayPT}}ms" data-img="{{url('/uploads/'.$tour->image_thumbnail)}}">
                            <div class="about_thumb about_thumb_tour">
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
                                {{--
                                                             <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$tour->region}}</p>
                                --}}
                                <p class="position_tour" ><img src="{{url('/frontend/images/position.gif')}}" alt=""> {{$tour->region}} </p>
                                <p class="short-desc"> {{$tour->short_description}} </p>
                                <a href="/tours/{{$tour->url}}" class="btn primary-btn">{{trans('messages.more_infomation_&_register')}}</a>
                            </div>
                        </div>
                        @php
                            $delayPT = $delayPT + 200;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- offers_area_end -->

    <!-- Tour ddax qua -->
    <style>
        .bg-bg{
           /* background-color:beige!important;*/
            background-color:white!important;

        }
        .bg-w{
            background-color:#FFFFFF!important;
        }
        .title_ttp{
            text-align: left;
            border-top: 1px solid #4c423a;
            padding: 10px 0 10px 0;
        }
        .title_ttp h1{
            color: #8b572a;
            text-transform: uppercase;
            font-family: 'Playfair Display', serif!important;
            color: #4c423a;
            margin: 0;
        }
        .title_ttp h3{
            font-family: 'Great Vibes',handwriting!important;
            color: #c1955d;
            font-size: 34px;
            margin: 0;
        }
        .position_tour {
            width: 43px;
            display: flex;
        }
        .position_tour img {
            width: 100%;
            object-fit: cover;
        }
        .pt-20{
            padding-top: 20px;
        }
    </style>
    @if(count($toursTookPlace) > 0)
        <div class="offers_area" >
            <div class="container-pop-tour" style="">
                <div class="row ">
                    <div class="col-xl-12">
                        <div class="title_ttp mb-20 pt-20">
                            <h1>{{trans('messages.tours_took_place')}}</h1>
                            <h3>See past tours
                            </h3>
                        </div>
                        {{--<div class="section-icon">
                            <img src="{{url('/frontend/images/tour3.png')}}" alt="" style="border-radius: 0">
                            <div class="title-center">
                                <h1 class="hightlight-underline-green">{{trans('messages.tours_took_place')}}</h1>
                            </div>
                        </div>--}}
                    </div>
                </div>
                <input type="hidden" value="{{count($toursTookPlace)}}" class="toursTPNumber">
                <div class="row owl-carousel owlTourTP owl-theme"  style="margin: auto;">
                    @php
                        $delayPT = 100;
                    @endphp
                    @foreach($toursTookPlace as $tour)
                        <div class="single_offers bg-bg block wow fadeInUp" data-wow-delay="{{$delayPT}}ms" data-img="{{url('/uploads/'.$tour->image_thumbnail)}}">
                            <div class="about_thumb about_thumb_tour">
                                <img src="{{url('/uploads/'.$tour->image_thumbnail)}}" alt="">
                            </div>
                            <div class="offers_content">
                                <div class="trangthai-category">
                                    <span class="event-label trangthai-open">{{trans('messages.tours_took_place')}}</span> <span  class="event-label">{{$tour->type_tour}}</span>
                                </div>
                                @php
                                    $date = date_create($tour->date_start);
                                    $date_start= date_format($date, 'd/m/Y');
                                    $date = date_create($tour->date_end);
                                    $date_end= date_format($date, 'd/m/Y');
                                @endphp
                                <b>{{$date_start}} - {{$date_end}}</b>
                                <h2 class="title-offer">  {{$tour->name}}</h2>
                                {{--<i class="fa fa-map-marker" aria-hidden="true"></i>--}}
                                <p class="position_tour" ><img src="{{url('/frontend/images/position.gif')}}" alt=""> {{$tour->region}} </p>
                                <p class="short-desc"> {{$tour->short_description}} </p>
                                <a href="/tours/{{$tour->url}}" class="btn primary-btn">{{trans('messages.see_details')}}</a>
                            </div>
                        </div>
                        @php
                            $delayPT = $delayPT + 200;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- end-Tour ddax qua -->

    <!-- video_area_start -->
    <style>
        .video-container{
            width:85%;
            margin:auto;
            /* display:flex;
            flex-wrap:nowrap;
            flex-direction:row; */
            display:grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            column-gap:10px;
        }
        .video_area2{
            margin-bottom:50px;
            /*margin-top:50px*/
        }
        .single_video{
            z-index: 1;
        }
        .single_video img{
             width: 100%;
             /*height: 250px;*/
            object-fit:cover;
        }
        .text_area_video h3{
            font-style: inherit;
            font-weight: 700;
            color:#8b572a;

        }
        .text_area_video {

            width: 85%;
            margin: auto;
        }
        .title-video{
            margin-top: 15px;
        }
        .icon-play{
            position: absolute;
            color: #ced0d2;
            transition: all .4s cubic-bezier(.15,.53,.35,1);
            background-image:url('/frontend/images/play-w.png');
            background-size: 50px;
            width: 50px;
            height: 50px;
            bottom: 8%;
            left: 8%;
            display: flex;
            align-items: center;
            justify-content: center;
            /*-webkit-animation: radio-btn 1.5s linear infinite;
            animation: radio-btn 1.5s linear infinite;*/

        }

        @media (max-width: 1200px) {
            .video-container{
                display:grid;
                grid-template-columns: 1fr 1fr;
                width:95%;
                margin:auto;
            }
            .text_area_video {
                width: 95%;
                margin: auto;
            }
            .icon-play{
                width: 50px;
                height: 50px;
            }
            .fa-play{
             font-size:1.5rem;
            }
        }
        @media (max-width: 750px) {
            .video-container{
                display:grid;
                grid-template-columns: 1fr ;
                width:95%;
                margin:auto;
            }
            .icon-play{
                width: 50px;
                height: 50px;
            }
            .fa-play{
             font-size:1rem;
            }
        }
        .single_video:hover .icon-play{
            background-image:url('/frontend/images/play-b.png');
            background-size: 60px;
            width: 60px;
            height: 60px;
            transition: 0.3s;

        }
        .single_video:hover .fa-play{
            color:white;
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
        .popup-video {
            position:relative;
            display:block;
        }
        .title_video {
            text-align: right;
            border-top: 1px solid #4c423a;
        }
        .title_video h1{
            color: #8b572a;
            text-transform: uppercase;
            font-family: 'Playfair Display', serif!important;
            color: #4c423a;
            margin: 0;
        }
        .title_video h3{
            font-family: 'Great Vibes',handwriting!important;
            color: #c1955d;
            font-size: 34px;
            margin: 0;
        }


        .title-author{
            font-size:16px;
            font-family: 'Playfair Display', serif!important;
            font-weight: 900;
        }

    </style>
    <div class="video_area2" >
    <div class="title_video container-pop-tour mb-40 pt-20">
        <h1>{{trans('messages.our_journey')}}</h1>
        <h3 >Enjoy the journey together</h3>
        <!-- <hr style="margin-bottom:50px;">   -->
    </div>
        <div class="video-container">
               @if($videos != null)
                   @php
                       $delayV = 100;
                   @endphp
                @foreach($videos as $video)
                        <div class="single_video wow fadeInDownBig" data-wow-delay="{{$delayV}}ms">
                            <div class="thumbnail-video">
                                <a href="/{{$video->url_video}}" class="popup-video">
                                    <img src="{{url('uploads/'.$video->image_thumbnail)}}" alt=""  >
                                    <span  class="icon-play"></span>
                                    <!--  -->
                                </a>
                            </div>
                            <div class="">
                                <h3 class="title-video">{{$video->title}}</h3>
                                <p class="title-author">- {{$video->author}}</p>
                                <p></p>
                            </div>
                        </div>
                    @php
                        $delayV = $delayV + 200;
                    @endphp
                @endforeach
                @endif
        </div>
    </div>
    <!-- video_area_end -->

    <!-- companion -->
    <style>
        .companion-area{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Poppins;
            background-image: url("uploads/{{$blackgroundCompanion != null ? $blackgroundCompanion->image_one : 2}}");
            background-size:cover;
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
            height: 310px;
            background-color: #fff;
            padding: 30px;
            /**/border-radius: 10%;
            box-shadow: -5px 8px 45px rgba(51, 51, 51, 0.126);
            transition: all .4s;
            margin: 50px 0px;

        }

        .name-companion {
            text-align: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .name-companion h3{
            font-size: 25px;
            color: #3d3d3d;
            margin-bottom: 0;
            font-style: normal;
            font-weight: 800;
        }
        .name-companion h5 {
            font-size: 18px;
            color: #3d3d3d;
            margin-bottom: 7px;
            font-weight: 500;
        }
        .name-companion h6 {
            color: #3d3d3d;
            margin-bottom: 5px;
            font-weight: 500;
            font-size: 12px;
        }

        .profile-card:hover{
            border-radius: 10px;
            height: 590px;
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
            transform: translateY(-245px);
            opacity: 0;
            pointer-events: none;
            transition: all .5s;
        }
        .profile-card:hover .caption{
            opacity: 1;
            pointer-events: all;
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
        @media (max-width: 1750px) and (min-width: 1620px) {
            .profile-card{
                width: 280px;
                height: 310px;
            }
            .profile-card .img img{
                height: 220px;
            }
        }

        @media (max-width: 1420px) {
            .profile-card{
                width: 280px;
                height: 310px;
            }
            .profile-card .img img{
                height: 220px;
            }
        }
/*        @media (max-width: 1280px) and (min-width: 1190px) {
            .profile-card{
                width: 220px;
                height: 310px;
            }
            .name-companion h3{
                font-size: 20px;
                color: #8B572A;
            }

            .profile-card .img img{
                height: 165px;
            }
            .profile-card .caption{
                transform: translateY(-295px);
            }
            .profile-card  .desc-companion{
                -webkit-line-clamp: 13;
            }
        }
        @media (max-width: 1190px) and (min-width: 1100px) {
            .profile-card{
                width: 280px;
                height: 310px;
            }
            .profile-card .img img{
                height: 220px;
            }
        }
        @media (max-width: 1100px) and (min-width: 900px) {
            .profile-card{
                width: 250px;
                height: 310px;
            }
            .profile-card .img img{
                height: 200px;
            }
        }
        @media (max-width: 970px) and (min-width: 890px) {
            .profile-card{
                width: 220px;
                height: 310px;
            }
            .profile-card .img img{
                height: 165px;
            }
            .name-companion h3{
                font-size: 20px;
                color: #8B572A;
            }
            .profile-card .caption{
                transform: translateY(-295px);
            }
            .profile-card  .desc-companion{
                -webkit-line-clamp: 13;
            }
        }
        @media (max-width: 890px) and (min-width: 730px) {
            .profile-card{
                width: 280px;
                height: 310px;
            }
            .profile-card .img img{
                height: 220px;
            }
        }
        @media (max-width: 730px) and (min-width: 660px) {
            .profile-card{
                width: 250px;
                height: 310px;
            }
            .profile-card .img img{
                height: 200px;
            }
        }*/
        @media (max-width: 660px) and (min-width: 599px) {
            .profile-card{
                width: 280px;
                height: 310px;
            }
            .name-companion h3{
                font-size: 20px;
                color: #8B572A;
            }
            .profile-card .img img{
                height: 220px;
            }
            .profile-card .caption{
                transform: translateY(-295px);
            }
            .profile-card  .desc-companion{
                -webkit-line-clamp: 12;
            }
        }
        @media (max-width: 599px) {
            .profile-card{
                width: 280px;
                height: 310px;
                margin: auto;
                margin-top: 50px;
                margin-bottom: 50px;

            }
            .profile-card .img img{
                height: 220px;
            }

        }
        .container-companion{
            width: 100%;
            margin: auto;
        }
        .team-profile {
            max-width: 1200px;
            margin: auto;
        }
    </style>
    <div class="companion-area " >
            <div class="container-companion">  {{--container--}}
                <div class="section-title text-center" style="margin-bottom: 80px">
                    <h1 style="padding-top: 30px;">{{trans('messages.companions')}}</h1>
                </div>
                {{--<div class="section-icon" style="top:-45px;">
                    <img src="{{url('/frontend/images/companion.png')}}" alt="" ">
                    <div class="title-center">
                        <h1 class="hightlight-underline-white" >{{trans('messages.companions')}}</h1>
                    </div>
                </div>--}}
                <input type="hidden" value="{{count($companions)}}" class="companionNumber">
                <div class="team-profile owl-five owl-carousel  owl-theme">
                    @if($companions != null)
                        @php
                            $delayC = 100;
                        @endphp
                        @foreach($companions as $companion)
                            <div class="profile-card fadeInRight wow"  data-wow-delay="{{$delayC}}ms">
                                <div class="img">
                                    <img src="{{url('uploads/'.$companion->avatar)}}" alt=""  >
                                    <div class="name-companion">
                                        <h3>{{$companion->name}}</h3>
                                        <h5>{{$companion->position}}</h5>
                                        <h6> {{$companion->company_name}}</h6>
                                    </div>
                                </div>
                                <div class="caption">
                                    <div class="desc-companion">
                                        {!! $companion->content !!}
                                    </div>
                                </div>
                            </div>
                            @php
                                $delayC = $delayC + 200;
                            @endphp
                        @endforeach
                    @endif
                </div>
            </div>

    </div>

    <!-- end-companion -->

    <!-- about_area_start -->
        <style>
        .about_area_home{
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
            /*font-size: 40px;*/
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
            padding: 0 0 9px 15px;
        }
        .title-about{
            text-align:center;
            margin-bottom:30px;
        }
        .title-about h1{
            font-style: normal;
            /* font-family:'Dancing Script'!important; */
            color: #c1955d!important;
            font-family:"Playfair Display",serif!important;

        }
        .title-about p {
            font-weight:500;
            font-family:"Playfair Display",serif!important;

        }
        .d-inline-block {
            text-decoration:none;
            display:block;
        }
        /*.d-inline-block::before{
            content: '';
            background-color: rgba(255,210,42,.4);
            position: absolute;
            left: 0;
            bottom: 0px;
            width: 100%;
            height: 0px;
            z-index: -1;
            transition: all .3s ease-in-out;

        }*/
        .d-inline-block:hover{
            text-decoration:underline;
            transition: 0.1s;
            bottom: 2px;
            color: #ffd22a!important;
        }
        .small-image-blog{
            max-height: 272px;
            object-fit: cover;
            width:100%;
            object-position: center center;

        }
        .blog_item {
            margin-bottom: 30px;
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
        }
        .center-small-blog{
            display:flex;
        }
        .center-small-blog img{
            width: 200px;
            height:200px;
            object-fit:cover;
        }
        @media (max-width: 992px) {
            .small-image-blog {
                max-height: 100%;

            }
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
             .small-image-blog{
                 max-height: 100%;
                object-fit: cover;
                width:100%;
                object-position: center center;

            }
        }
        .center-small-blog .small-blog-details p{
            font-size:22px;
        }
        .center-big-blog{
            height: 560px;
            object-fit:cover;
        }
        .short-desc-blog {
            font-family:"Cormorant Garamond",serif!important;
            font-weight: lighter;
            line-height: 165%;
            font-size: 20px;
            word-break: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* number of lines to show */
            -webkit-box-orient: vertical;
            letter-spacing: 0.5px;
        }
        .post-title {
            font-size: 38px!important;
            font-family:"Cormorant Garamond",serif!important;
            font-weight: 500!important;
        }
        .post-title-lr {
            font-size: 31px!important;
            font-family:"Cormorant Garamond",serif!important;
            font-weight: 400!important;
        }
        .short-desc-blog-lr{
            display: none;
        }

        </style>
    <!-- -->
    <div class="about_area_home  bg-pink">
        <div class="pop-color">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-title mb-30 mt-80">
                            <h3 class="text-center">Share experiences</h3>
                            <h1 class="text-center">{{trans('messages.mindful_travel_blog')}}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        @php
                            $delayLB = 150;
                        @endphp
                        @if($blogPostsLeft != null)
                            @foreach($blogPostsLeft as $post)
                                <div class="blog_left_sidebar fadeIn wow"  data-wow-delay="{{$delayLB}}ms">
                                    <article class="blog_item">
                                        <div class="blog_item_img">
                                            <img class="card-img rounded-0 small-image-blog" src="{{url('/uploads/'.$post->image_thumbnail)}}" alt="">
                                        </div>
                                        <div class="small-blog-details">
                                            <a class="d-inline-block" href="/blogs/{{$post->url}}">
                                                <h2 class="post-title-lr">{{$post->title}}</h2>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                                @php
                                    $delayLB = $delayLB +50;
                                @endphp
                            @endforeach
                        @endif

                    </div>
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">
                            @php
                                $small = 'blog_details';
                                $flex = '';
                                $smallCenter = '';
                            @endphp
                            @if($blogPostsCenter != null)
                                @foreach($blogPostsCenter as $post)
                                    <article class="blog_item {{$flex}} fadeIn wow" data-wow-delay="{{$delayLB}}ms">
                                        <div class="blog_item_img">
                                            <img class="card-img rounded-0 " src="{{url('/uploads/'.$post->image_thumbnail)}}" alt="">

                                        </div>

                                        <div class="{{$small}}">
                                            <a class="d-inline-block" href="/blogs/{{$post->url}}">
                                                <h2 class="post-title{{$smallCenter}}">{{$post->title}}</h2>
                                            </a>
                                            <p class="short-desc-blog">{{$post->short_description}}</p>
                                        </div>
                                    </article>
                                    @php
                                        $small = 'small-blog-details';
                                        $flex = 'center-small-blog';
                                            $delayLB = $delayLB + 50;
                                            $smallCenter = '-lr'

                                    @endphp
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        @if($blogPostsRight != null)
                            @foreach($blogPostsRight as $post)
                                <div class="blog_left_sidebar fadeIn wow" data-wow-delay="{{$delayLB}}ms">
                                    <article class="blog_item">
                                        <div class="blog_item_img">
                                            <img class="card-img rounded-0 small-image-blog" src="{{url('/uploads/'.$post->image_thumbnail)}}" alt="">
                                        </div>
                                        <div class="small-blog-details">
                                            <a class="d-inline-block" href="/blogs/{{$post->url}}">
                                                <h2 class="post-title-lr">{{$post->title}}</h2>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                                @php
                                    $delayLB = $delayLB + 50;
                                @endphp
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- about_area_end -->
@endsection
@section('script')
    <script>
        /*const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                console.log(entry)
                if(entry.isIntersecting) {
                    entry.target.classList.add('show1');
                } else {
                    entry.target.classList.remove('show1');
                }
            });
        });
        const hiddenElements = document.querySelectorAll('.hidden1');
        hiddenElements.forEach((el) => observer.observe(el));

        const hiddenElements4 = document.querySelectorAll('.hidden2');
        hiddenElements4.forEach((el) => observer.observe(el));

        const hiddenElements2 = document.querySelectorAll('.logo-image');
        hiddenElements2.forEach((el) => observer.observe(el));

        const hiddenElements3 = document.querySelectorAll('.content-impatti');
        hiddenElements3.forEach((el) => observer.observe(el));


        const hiddenElements5 = document.querySelectorAll('.animation-list-video');
        hiddenElements5.forEach((el) => observer.observe(el));

        const hiddenElements6 = document.querySelectorAll('.fadeIn');
        hiddenElements.forEach((el) => observer.observe(el));*/


    </script>
    <script>
        let toursNumber = parseInt($('.toursNumber').val());
        var owl2 = $('.owl-two');
        owl2.owlCarousel({
            /*loop:true,*/
            nav:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
            margin:20,
            /* autoplay:true,*/
           /* autoplayTimeout:1500,*/
          /*  autoplayHoverPause:true,*/
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                700:{
                    items:2,
                    nav:true
                },
                1200:{
                    items:toursNumber,
                    nav:true,
                    loop:true
                }
            }
        });



        let toursTPNumber = parseInt($('.toursTPNumber').val());
        var owlTourTP = $('.owlTourTP');

        owlTourTP.owlCarousel({
            loop:true,
            nav:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
            margin:20,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                700:{
                    items:2,
                    nav:true
                },
                1200:{
                    items:toursTPNumber,
                    nav:true,
                    loop:true
                }
            }
        });
    </script>
    <script>
        let companionNumber = parseInt($('.companionNumber').val());
        if (companionNumber > 4) {
            companionNumber =4;
        }
        var owl5 = $('.owl-five');
        owl5.owlCarousel({
        loop:true,
        nav:true,
            margin:20,
        navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
        autoplay:true,
        autoplayTimeout:1500,
        autoplayHoverPause:true,
        lazyLoad: true,
        responsive:{
        0:{
            items:1,
            nav:true,
            loop:true,
        },
        600:{
            items:2,
            nav:true,
            loop:true
        },

        890:{
            items:3,
            nav:true,
            loop:true
        },
        1190:{
            items:4 ,
            nav:true,
            loop:true
        },
        1620:{
            items:companionNumber,
            nav:true,
            loop:true
        },
    }});
    </script>
@endsection
