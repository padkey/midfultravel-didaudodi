<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mindful Travel Didaudodi</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">  <!--token -->
    {{--<meta property="og:image"
          content="{{url('frontend/images/s-logo.png')}}" />--}}
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    @isset($tour->image_thumbnail)
        <meta property="og:image" content="{{url('/uploads/'.$tour->image_thumbnail)}}">
    @endisset

    <!----------- SEO ------->
    {{--<meta name="description" content="{{$metaDes}}">
    <meta name="author" content="">
    <meta name="keyword" content="{{$metaKeywords}}">
    <meta name="robots" content="INDEX,FOLLOW">
    <link rel="canonical" href="{{$urlCanonical}}">--}}
    <!--------- END SEO --------->

    <!----------- SHARE FACEBOOK  --------->
    {{--<meta property="og:url" content="{{$urlCanonical}}">
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$metaTitle}}">
    <meta property="og:description" content="{{$metaDes}}">--}}
    <!----------- END SHARE FACEBOOK  --------->
    <meta name= “robots” content = “noindex,nofollow”>


    <link rel="shortcut icon" type="image/x-icon" href="{{url('frontend/images/s-logo.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/new-fonts.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Dancing Script' rel='stylesheet'>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
    <link href="{{asset('vendor/laravel-admin/sweetalert2/dist/sweetalert2.css')}}" rel='stylesheet' />
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">

    <!-- Font  Google-->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=playfair">
</head>

<body >




    <style>
        .overlay::before{
            z-index:5!important;
        }
        .header-area{
            padding-top: 0;
        }

        p,span,a{

            color:#333333;
            /*font-size: 18px!important;*/
            line-height: 1.3;
        }

        h1,h2,h3{
            font-family:"Cormorant Garamond",serif!important;
            /*font-style:italic;*/
        }
        h1{
            font-size:45px;
        }
        .container{
            max-width: 85%;
        }
        b{
            color:#222;
            font-family:serif!important;
            font-size: 20px;
        }
        hr{
            margin-top:0;
        }
        .btn-earth{
            background-color: #8b572a;
            color:white;
            padding: 10px;
            border-radius: 10px;
            margin-bottom:15px;
            font-weight: 500;
            font-size:18px;
            transition:0.5s;
            font-family: 'Open Sans', sans-serif!important;

        }
        .btn-earth:hover{
            background-color: #024f43;
            color:white;
        }
        .btn-shop{
            background-color:  #ffe277;
            color:black!important;
            padding: 10px;
            border-radius: 10px;
            margin-bottom:15px;
            font-weight: 900;
        }
        .btn-shop:hover{
            background-color: #006838;
            color:white!important;
        }
        a{
            color:blue;
        }
        strong{
            font-weight: 700!important;
            /*font-size: 20px;*/
        }
        strong span{
            font-weight: 700!important;
            /*font-size: 20px;*/
        }
        .owl-carousel .owl-nav div {
            background: bisque;
            background-color: rgba(255,255,255,0.9);
            color: #a29e9e;
            font-size: 18px;
            border: 1px solid rgba(227, 227, 227, 0.16);
        }
        .owl-carousel .owl-nav div i{
            font-weight: 900;
        }
        .owl-prev{
            left: -30px!important;
        }
        .owl-next{
            right: -30px!important;
        }

        .owl-nav div:hover{
            background: #faf1eb!important;
            border: 1px solid #ffff;
        }
        .mt-50{
            margin-top: 50px;
        }
        .mb-20 {
            margin-bottom: 20px;
        }
        .pt-80{
            padding-top: 80px;
        }
        .primary-btn {
            display: block;
            color: #2b2b2b;
            font-size: 18px;
            border: 1px solid #707070;
            position: relative;
            max-width: 380px;
            padding: 10px 20px;
            transition: .5s;
            font-weight: 300;
            margin: auto;
            position:relative;
            margin-top:30px;
            font-family: 'Playfair Display',serif!important;
            color: #4c423a;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .primary-btn:hover{
            /*
            background-color: #024f43;
            */
            background-color: #4c423a;
            color:white!important;
        }
        .primary-btn span {
            font-family: 'Playfair Display',serif!important;
            letter-spacing: 1px;
            font-weight: 600;
            font-size: 18px;
            font-style: normal;
            text-transform: uppercase;
            color: #4c423a;
        }
        .primary-btn:hover span {
            color:white!important;
        }
    </style>

    <style>
        @-webkit-keyframes pulse-red {
            0% {
                -webkit-transform: scale(.95);
                transform: scale(.95);
                -webkit-box-shadow: 0 0 0 0 rgba(215, 0, 24, .7000000000000001);
                box-shadow: 0 0 0 0 rgba(215, 0, 24, .7000000000000001)
            }
            70% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-box-shadow: 0 0 0 10px rgba(2, 143, 227, 0);
                box-shadow: 0 0 0 10px rgba(2, 143, 227, 0)
            }
            to {
                -webkit-transform: scale(.95);
                transform: scale(.95);
                -webkit-box-shadow: 0 0 0 0 rgba(2, 143, 227, 0);
                box-shadow: 0 0 0 0 rgba(2, 143, 227, 0)
            }
        }

        @keyframes pulse-red {
            0% {
                -webkit-transform: scale(.95);
                transform: scale(.95);
                -webkit-box-shadow: 0 0 0 0 #914C04;
                box-shadow: 0 0 0 0 #b3b3b3;
            }
            70% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-box-shadow: 0 0 0 10px rgba(2, 143, 227, 0);
                box-shadow: 0 0 0 10px rgba(2, 143, 227, 0)
            }
            to {
                -webkit-transform: scale(.95);
                transform: scale(.95);
                -webkit-box-shadow: 0 0 0 0 rgba(2, 143, 227, 0);
                box-shadow: 0 0 0 0 rgba(2, 143, 227, 0)
            }
        }
        .s-call-1 {
            position: fixed;
            bottom: 5px;
            right: 0;
            z-index: 1030
        }

        .s-call-1 .s_call {
            position: fixed;
            bottom: 15px;
            right: 20px;
            width: 60px;
            height: 60px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin: 0;
            z-index: 9999;
            border-radius: 50%;
            background: #914C04;
            -webkit-box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 23%);
            box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 23%);
            overflow: hidden;
            -webkit-transform: rotate(0);
            transform: rotate(0);
            -webkit-transition: all .15s cubic-bezier(.15, .87, .45, 1.23);
            transition: all .15s cubic-bezier(.15, .87, .45, 1.23);
            -webkit-animation: pulse-red 2s infinite;
            animation: pulse-red 2s infinite;
            cursor: pointer
        }

        .s-call-1 .s_call div {
            background-repeat: no-repeat;
            display: inline-block;
            vertical-align: middle;
            background-image: url('/frontend/images/call.png');
            width: 50px;
            height: 50px;
            margin: 0 !important;
            background-size: 694px;
            background-position: -649px 0
        }

        .s-call-1.is-active .s_call div {
            background-size: 615px;
            background-position: -281px -61px
        }

        .s-call-1 .s_wheel {
            width: 260px;
            height: 220px;
            position: absolute;
            bottom: 0;
            right: 0;
            opacity: 0;
            visibility: hidden;
            -webkit-transform: scale(0);
            transform: scale(0);
            -webkit-transform-origin: bottom right;
            transform-origin: bottom right;
            -webkit-transition: all .3s ease;
            transition: all .3s ease;
            z-index: 12
        }

        .s-call-1.is-active .s_wheel {
            -webkit-transform: scale(1);
            transform: scale(1);
            opacity: 1;
            visibility: visible
        }

        .s-call-1 .s_wheel a {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            font-size: 14px;
            font-weight: 700;
            color: #fff!important;
            position: absolute;
            bottom: 30px
        }
        .s-call-1 .s_wheel a span{
            color: #fff!important;
            font-size: 21px;
        }
        .s-call-1 .s_wheel a div em {
            background-repeat: no-repeat;
            display: inline-block;
            vertical-align: middle;
            background-image: url('/frontend/images/call.png');
            background-size: 453px
        }

        .s-call-1 .s_wheel a div {
            width: 45px;
            height: 45px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            float: left;
            padding: 4px;
            border-radius: 50%;
            background: #0f1941;
            -webkit-box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
            box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
            font-size: 24px;
            color: #fff;
            -webkit-transition: all 1s ease;
            transition: all 1s ease;
            overflow: hidden;
            margin-left: 10px
        }

        .s-call-1 .s_wheel a:first-child {
            left: -40px;
            bottom: 10px;
            z-index: 200
        }

        .s-call-1 .s_wheel a:first-child div {
            background: #2f82fc
        }

        .s-call-1 .s_wheel a:first-child div em {
            width: 30px;
            height: 30px;
            background-position: -362px -1px;
            background-size: 515px
        }

        .s-call-1 .s_wheel a:nth-child(2) {
            left: 30px;
            bottom: 75px;
            z-index: 200
        }

        .s-call-1 .s_wheel a:nth-child(2) div {
            background: #fff
        }

        .s-call-1 .s_wheel a:nth-child(2) div em {
            width: 30px;
            height: 30px;
            background-position: -369px 0
        }

        .s-call-1 .s_wheel a:nth-child(2) {
            top: 75px;
            right: 60px
        }

        .s-call-1 .s_wheel a:nth-child(2) div {
            background: #fb0
        }

        .s-call-1 .s_wheel a:nth-child(2) div em {
            width: 28px;
            height: 28px;
            background-position: 0 -48px
        }

        .s-call-1 .s_wheel a:nth-child(3) {
            top: -110px;
            right: 10px
        }

        .s-call-1 .s_wheel a:nth-child(3) div {
            background: #15b76c
        }

        .s-call-1 .s_wheel a:nth-child(3) div em {
            width: 30px;
            height: 30px;
            background-position: -51px -49px
        }
        .s-call-1 .s_wheel a:nth-child(3) {
            right: 10px
        }
        .s-call-1 .s_wheel a:nth-child(4) {
            top: -70px;
            right: 60px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex
        }
        .hide{
            display: none !important;
        }
    </style>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    @yield('header')
    <!-- header-end -->

    <!-- slider_area_start -->
    @yield('banner')
    <!-- slider_area_end -->

    @yield('content')
    <!-- footer -->
    <style>
        .footer {
                background: white;
            }
        .footer .footer_top {
            padding-top: 60px;
            padding-bottom: 80px;
        }
        .title_address {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
            font-style: normal;
        }
        .footer_title_1 {
            font-size: 35px;
            font-weight: 400;
             color: black;
            /* margin-bottom: 45px; */
        }
        .footer_text {
            /* color: #fff; */
            font-size: 22px;
        }
        .footer_title_2 {
            font-size: 24px;
            font-weight: 900;
            font-style: normal;
            /*color: #808080*/;
            color: #8b572a!important;

            /* margin-bottom: 45px; */
        }
        .input-dk{
            margin-bottom: 20px;
        }
        .footer_2 {
            /*margin-top:50px;*/
        }
        .footer_content_address  a{
            font-size: 18px!important;
            font-weight: 500;
            margin-left: 10px;
            font-style: normal;
            margin-bottom: 0px;
            color: #818181;
        }
        .footer_content_address  a:hover{
            font-size: 20px!important;
            color:#004e42!important;
            transition:0.2s;
        }

        .footer_widget a {
            font-size: 35px;
            color:black;
            margin-left:5px;
        }
        .practice-center .col-xl-4{
            width: auto!important;
        }
        .follow-us a:hover{
            position: relative;
            top: -5px;
            transition:1s;
        }
        @media (max-width: 800px){
            .support_our{
                margin-top: 30px;
            }
            .parnership {
                margin-top:30px;
            }
            .follow-us{
                margin-top:30px;
            }
            .footer_2{
                margin-top:0px;
            }
            .container {
                max-width: 100%;
            }
        }
    </style>


    <hr style="margin-top: 0px;" class=" wow fadeIn" data-wow-delay="300ms">
    <footer class="footer wow fadeIn" data-wow-delay="300ms">
        <div class="footer_top">
            <div class="container">
                {{--<div class="row">
                    <div class="col-xl-7">
                        <h3 class="footer_title_1"> {{trans('messages.bring_i_t_y_i')}}</h3>
                        <p class="footer_text"> {{trans('messages.bring_i_t_y_i_c')}}</p>
                        <div class="row">

                            <div class="col-xl-5 ">
                                <div class="input-dk">
                                    <input type="text"placeholder="First name" class="form-control">
                                </div>
                                <div class="input-dk">
                                    <input type="text"placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="input-dk">
                                    <input type="text"placeholder="Last name" class="form-control">
                                </div>
                                <div>
                                    <button class="genric-btn primary circle">{{trans('messages.register')}}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-5 support_our">
                        <h3 class="footer_title_1">
                        {{trans('messages.support_our_community')}}
                        </h3>
                        <div class="">
                            <p class="footer_text">
                            {{trans('messages.support_our_community_c')}}                            </p>
                        </div>
                    </div>
                </div>--}}
                <div class="row footer_2">
                    <div class="col-xl-7 parnership">
                        <h3 class="footer_title_2"> {{trans('messages.our_partnership')}}</h3>
                        <div class="row practice-center" style="margin-top: 10px;">
                            @foreach($allPartnership as $partnership)
                                <div class="col-xl-4" style="margin-top: 0px;">
                                    <div class="">
                                        <h3 class="title_address">
                                            {{$partnership->name}}
                                        </h3>
                                        @foreach($partnership->partnershipBranch as $branch)
                                            <p class="footer_content_address"><a href="{{$branch->link_website}}"> - {{$branch->name}}</a></p>
                                        @endforeach


                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-5 follow-us" >
                        <div class="footer_widget">
                            <h3 class="footer_title_2">
                               {{trans('messages.follow')}}  Didaudodi Mindfultravel
                            </h3>
                            <a href="https://www.facebook.com/didaudodioutdoor">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                            <a href="https://www.tiktok.com/@didaudodi_official?_t=8gxVAdjBKTa&_r=1">
                                  <img src="{{url('/frontend/images/tiktok.png')}}" alt="" style="width: 33px;margin-bottom: 12px;">

                            </a>
                            {{--<a href="#">
                                <i class="fa fa-instagram"></i>
                            </a>--}}
                            <a href="https://www.youtube.com/@didaudodichannel">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <!-- link that opens popup -->


    <!--Call here -->
    <div class="s-call-1">
        <div class="s_call">
            <div></div>
        </div>
        <div class="s_wheel">
            <a href="https://zalo.me/3839925299675446019" target="_blank" rel="nofollow"><span>Chat trên zalo</span><div><em></em></div></a>
            <!-- <a href="" target="_blank" rel="nofollow"><span>Chat ngay</span><div><img loading="lazy" width="400" height="300" src="/images/icons/icon-mes.png" alt="messenger"></div></a> -->
{{--
            <a href="https://goo.gl/maps/i7Tufrm2xLkcjNQn9" target="_blank" rel="nofollow"><span>Tìm cửa hàng</span><div><em></em></div></a>
--}}
            <a href="https://maps.app.goo.gl/45Fsxc46Ti8XRRrZ9" target="_blank" rel="nofollow"><span>Tìm cửa hàng</span><div><em></em></div></a>

            <a href="javascript:;" onclick="window.location.href='tel:0352 554 901 ';" target="_blank" rel="nofollow"><span>Gọi ngay</span><div><em></em></div></a>
        </div>
    </div>
    <button class="hide" ht-trigger="c-modal" ht-target="#formProduct"></button>
    <!-- <div id="formProduct" class="c-modal c-product">
        <div class="c-modal-box">
            <div class="c-modal-group" ht-skip="parent">
                <div class="c_close text--white" ht-close="c-modal"><i class="fa fa-times" aria-hidden="true"></i></div>
                <div id="detail"></div>
            </div>
        </div>
    </div> -->
    <!--end call -->


    <!-- JS here -->
    <script src="{{asset('frontend/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('frontend/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/js/ajax-form.js')}}"></script>
    <script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/js/scrollIt.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/js/wow.min.js')}}"></script>
    <script src="{{asset('frontend/js/nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/js/plugins.js')}}"></script>
    <script src="{{asset('frontend/js/gijgo.min.js')}}"></script>

    <!--contact js-->
    <script src="{{asset('frontend/js/contact.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.form.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('frontend/js/mail-script.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
    <script src="{{asset('vendor/laravel-admin/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    {{--<script src="https://www.google.com/recaptcha/api.js"></script>--}}
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
    </script>
   {{-- <script src="https://www.google.com/recaptcha/enterprise.js?render=6Lcuv-woAAAAABB8ZT2141ZCNCpq4xD5BxLg5YhT" async defer></script>--}}

    @yield('script')
    <script>
       // $('.change-language').
    </script>
    <script>
        $('.btn-xt').click(function(){
            if(  $('.mission_content').css('display') == '-webkit-box') {
                $('.mission_content').css('display','block');
                $(this).text('{{trans('messages.shrink')}}');
            } else {
                $('.mission_content').css('display','-webkit-box');
                $(this).text('{{trans('messages.see_more')}}');
            }

        });
        $('.our_tour_xt').click(function(){
            if(  $('.our_tour_content').css('display') == '-webkit-box') {
                $('.our_tour_content').css('display','block');
                $(this).text('{{trans('messages.shrink')}}');
            } else {
                $('.our_tour_content').css('display','-webkit-box');
                $(this).text('{{trans('messages.see_more')}}');
            }

        });

    </script>
    <script type="text/javascript">
        // $(window).load(function() {
        //     setTimeout(function() {
        //         $(".loader").hide();
        //         $(".loader").remove();
        //     }, 3500);

        // });
    </script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }

        });



            var owl4 = $('.owl-four');
            owl4.owlCarousel({
            items:5,
            loop:true,
            nav:true,
                navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
                lazyLoad: true,
            autoplay:true,
            autoplayTimeout:1500,
            autoplayHoverPause:true,
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
                    items:4,
                    nav:true,
                    loop:true
                },
                1620:{
                    items:5,
                    nav:true,
                    loop:true
                },
                /*2000:{
                    items:5,
                    nav:true,
                    loop:false
                }*/
            }
            });
        var owl3 = $('.owl-three');
        owl3.owlCarousel({
            items:1,
            loop:true,
            nav:true,
            navText: ['<i class="fa fa-chevron-left" ></i>','<i class="fa fa-chevron-right" ></i>'],
            margin:20,
            autoplay:true,
            autoplayTimeout:500,
            autoplayHoverPause:true,
            lazyLoad: true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                700:{
                    items:1,
                    nav:false
                },
                1500:{
                    items:1,
                    nav:true,
                    loop:false
                }
            }
        });


    </script>

    <script>
        var e = 0,
            t = ($(".s-call-1").click(function() {
                e % 2 == 0 ? $(".s-popup-1, .s-popup-3").css({
                    "z-index": 1e3,
                    transition: "none"
                }) : $(".s-popup-1, .s-popup-3").removeAttr("style"), e++
            }), $("body").on("click", '[ht-close="c-modal"], .lg-close', function() {
                $(".s-popup-1, .s-popup-3").removeAttr("style")
            }), $("body").on("click", ".size ul li", function() {
                $(this).addClass("is-select"), $(this).siblings().removeClass("is-select");
                var e = $(this).data("item"),
                    t = "";
                0 < e.price && 0 < e.price_market ? (t += '<span class="discount">' + _HTHelper.money(e.price) + "đ</span>", 0 < e.price_discount && (t += '<span class="market">' + _HTHelper.money(e.price_market) + "đ</span>"), $(this).closest(".parentPrice").find(".add-to-cart").removeClass("disabled")) : (t = '<span class="discount">Liên hệ</span>', $(this).closest(".parentPrice").find(".add-to-cart").addClass("disabled")), e.thumbPath && $(".p-slide-7 .p_thumb img, .b-card-77 .b_thumb img").attr("src", e.thumbPath.replace("100x100-", "")), $(this).closest(".parentPrice").find(".priceChange").html(t)
            }), $(".s-call-1 .s_call").click(function() {
                $(this).parent().toggleClass("is-active"), $("body").toggleClass("overlay")
            }), 5),
            i = ($("body").on("click", ".s-more-1.click2", function() {
                $(".s-review-1 .s-comment-1").length - t <= 5 && $(this).hide(), $(".s-comment-1:eq(" + t + ")").show(), t++, $(".s-comment-1:eq(" + t + ")").show(), t++, $(".s-comment-1:eq(" + t + ")").show(), t++, $(".s-comment-1:eq(" + t + ")").show(), t++, $(".s-comment-1:eq(" + t + ")").show(), t++
            }), $(".c-register .c_close").click(function() {
                $(".s-popup-1, .s-popup-3").removeClass("is-active"), setTimeout(function() {
                    $(".s-popup-1 .s_left").attr("ht-close", function(e, t) {
                        return "c-modal" == t ? null : "c-modal"
                    }), $(".s-popup-1 .s_left").attr("ht-trigger", function(e, t) {
                        return "c-modal" == t ? null : "c-modal"
                    })
                }, 500), setTimeout(function() {
                    $(".s-popup-3 .s_left").attr("ht-close", function(e, t) {
                        return "c-modal" == t ? null : "c-modal"
                    }), $(".s-popup-3 .s_left").attr("ht-trigger", function(e, t) {
                        return "c-modal" == t ? null : "c-modal"
                    })
                }, 500)
            }), $('.s-header-2 [ht-trigger="hd-menu"]').click(function() {
                $(".s-menu-1").addClass("is-active")
            }), $(".s-menu-1 .s_close").click(function() {
                $(".s-menu-1").removeClass("is-active")
            }), $(document).mouseup(function(e) {
                var t = $(".s-menu-1 .s_menu");
                t.parent().hasClass("is-active") && !t.is(e.target) && 0 === t.has(e.target).length && t.parent().removeClass("is-active")
            }), $(".s-menu-1 .s_top .s_icon").click(function() {
                $(this).toggleClass("is-active"), $(this).parent().siblings("ul").slideToggle(400)
            }), $(".s-menu-1 .s_top_2 .s_icon_2").click(function() {
                $(this).toggleClass("is-active"), $(this).parent().siblings("ul").slideToggle(400)
            }), window.innerWidth < 768 && $(".s-footer-7 .ft-title").click(function() {
                $(this).parent().find(".ft-menu").slideToggle(400)
            }), window.innerWidth < 1260 && $(".hd-user > span, .hd-user > a").click(function() {
                $(this).parent().toggleClass("is-active")
            }), $(".s-header-2 .slick-slider").slick({
                arrows: !1
            }), 0);
    </script>
</body>

</html>
