<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mindful Travel Didaudodi</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{'uploads/'.$logoWhite->items[0]->path_desktop}}">
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

    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>




    <style>
        body{
            font-family:"Cormorant Garamond",serif!important;

        }
        .header-area{
            padding-top: 0;
        }

        p,span,a{
            font-family:"Cormorant Garamond",serif!important;
            color:#333333;
            font-size: 25px;
            line-height: 1.3;
        }
        h1,h2,h3,h4{
            font-family:"Cormorant Garamond",serif!important;
            font-style:italic;
        }
        h1{
            font-size:55px;
        }
        .container{
            max-width: 85%;
        }
        b{
            color:#222;
            font-family:serif!important;
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
            font-weight: 900;
            font-size:18px;
        }
        .btn-earth:hover{
            background-color: darkcyan;
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
            background-color: darkcyan;
            color:white!important;
        }
        a{
            color:blue;
        }
        strong{
            font-weight: 700!important;
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
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
            font-style: normal;
        }
        .footer_title_1 {
            font-size: 40px;
            font-weight: 400;
            /* color: #fff; */
            /* margin-bottom: 45px; */
        }
        .footer_text {
            /* color: #fff; */
        }
        .footer_title_2 {
            font-size: 20px;
            font-weight: 600;
            font-style: normal;

            color: #c7c7c7;
            /* margin-bottom: 45px; */
        }
        .input-dk{
            margin-bottom: 20px;
        }
        .footer_2 {
            margin-top:50px;
        }
        .footer_content_address {
            font-size: 17px;
            font-weight: 500;
            margin-left: 10px;
            font-style: normal;
            margin-bottom: 0px;
            color:#9a9a9a;
        }
        .footer_widget a {
            font-size: 35px;
            color:black;
            margin-left:5px;
        }
    </style>



    <hr style="margin-top: 100px;">
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
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
                    <div class="col-xl-5">
                        <h3 class="footer_title_1">
                        {{trans('messages.support_our_community')}}
                        </h3>
                        <div class="">
                            <p class="footer_text">
                            {{trans('messages.support_our_community_c')}}                            </p>
                        </div>
                    </div>
                </div>
                <div class="row footer_2">
                    <div class="col-xl-7">
                        <h3 class="footer_title_2">- Our Parnership</h3>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-xl-4" style="margin-top: 20px;">
                                <div class="footer_widget">
                                    <h3 class="title_address">
                                    Iuteressere Monastery
                                    </h3>
                                    <p class="footer_content_address">Lieu dit Le Pey</p>
                                    <p class="footer_content_address">8 Rue des Fans</p>
                                    <p class="footer_content_address">77510 Villeneuve-sur-</p>

                                </div>
                            </div>
                            <div class="col-xl-4" style="margin-top: 20px;">
                                <div class="footer_widget">
                                    <h3 class="title_address">
                                    Plum Village France
                                    </h3>
                                    <p class="footer_content_address">Lieu dit Le Pey</p>
                                    <p class="footer_content_address">8 Rue des Fans</p>
                                    <p class="footer_content_address">77510 Villeneuve-sur-</p>

                                </div>
                            </div>
                            <div class="col-xl-4" style="margin-top: 20px;">
                                <div class="footer_widget">
                                    <h3 class="title_address">
                                    Plum Village France
                                    </h3>
                                    <p class="footer_content_address">Lieu dit Le Pey</p>
                                    <p class="footer_content_address">8 Rue des Fans</p>
                                    <p class="footer_content_address">77510 Villeneuve-sur-</p>

                                </div>
                            </div>
                            <div class="col-xl-4" style="margin-top: 20px;">
                                <div class="footer_widget">
                                    <h3 class="title_address">
                                    Plum Village France
                                    </h3>
                                    <p class="footer_content_address">Lieu dit Le Pey</p>
                                    <p class="footer_content_address">8 Rue des Fans</p>
                                    <p class="footer_content_address">77510 Villeneuve-sur-</p>

                                </div>
                            </div>
                            <div class="col-xl-4" style="margin-top: 20px;">
                                <div class="footer_widget">
                                    <h3 class="title_address">
                                    Healing Spring Monastery
                                    </h3>
                                    <p class="footer_text">8 Rue des Fans</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-5" >
                        <div class="footer_widget">
                            <h3 class="footer_title_2">
                              -  {{trans('messages.follow')}}  Didaudodi
                            </h3>
                            <a href="#">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-instagram"></i>
                            </a>
                            <a href="https://www.youtube.com/@didaudodireview">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <!-- link that opens popup -->

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
    <script>
        $(document).ready(function(){
            $(".single_offers").hover(function(){
                $('.offers_area').css("background-image", 'url(' + $(this).data('img') + ')' );

            }, function(){
                $('.offers_area').css("background-image", 'url(' + $(this).data('img') + ')' );
               /* var orderCode = $(this).data('order_code');*/
                /*$('.offers_area').css("background-color", "pink");*/
            });
        });
    </script>

    <script type="text/javascript">
        $(window).load(function() {
            setTimeout(function() {
                $(".loader").hide();
                $(".loader").remove();
            }, 3500);

        });
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

        var owl = $('.owl-two');
        owl.owlCarousel({
            items:3,
            loop:true,
            nav:true,
            navText: ['<i class="fa fa-chevron-left" ></i>','<i class="fa fa-chevron-right" ></i>'],
            margin:20,
            autoplay:true,
            autoplayTimeout:1000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                700:{
                    items:2,
                    nav:false
                },
                1500:{
                    items:3,
                    nav:true,
                    loop:false
                }
            }
            });

            var owl = $('.owl-three');
        owl.owlCarousel({
            items:4,
            loop:true,
            nav:true,
            navText: ['<i class="fa fa-chevron-left" ></i>','<i class="fa fa-chevron-right" ></i>'],
            margin:20,
            autoplay:true,
            autoplayTimeout:500,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                700:{
                    items:2,
                    nav:false
                },
                1500:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
            });


            var owl = $('.owl-four');
            owl.owlCarousel({
            items:5,
            loop:true,
            nav:true,
            navText: ['<i class="fa fa-chevron-left" ></i>','<i class="fa fa-chevron-right" ></i>'],
            margin:20,
            autoplay:true,
            autoplayTimeout:500,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                700:{
                    items:2,
                    nav:false
                },
                1500:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
            });

    </script>



</body>

</html>
