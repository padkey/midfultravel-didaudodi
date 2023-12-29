<!-- header-start -->
<style>
    ul#navigation li a {
        font-family: "Raleway",sans-serif!important;
    }
    .logo-img {
        width: 100px;
        display: block;
    }
    .logo-img img{
        width: 100%;
    }

    .navigation {
        background: #FFFFFF;
    }
    .navigation > .container-nav {
        max-width: 90%;
        margin: auto;
    }
    .navigation .navbar{
        position: relative;
        width: 100%;
        display: block;
    }
    .navigation .navbar .logo-toggle-container{
        position: absolute;
        left: 50%;
        top: 5px;
        transform: translateX(-50%);
    }

    .navbar .menu{
        text-align: right;
    }
    @media (min-width: 1024px) {
        .navigation .menu{
            display: block!important;
            height: auto!important;
        }
    }
    .navigation .menu li{
        display: inline-block;
        padding: 30px 5px;
    }
    .navigation .menu li a {
        display: block;
        padding: 8px 15px;
        text-decoration: none;
        font-weight: 700;
        letter-spacing: 1px;
        color: #333;
        font-size: 14px;
        font-family: "Raleway",sans-serif!important;

    }
    .navigation .menu li:nth-child(1),
    .navigation .menu li:nth-child(2),
    .navigation .menu li:nth-child(3),
    .navigation .menu li:nth-child(4){
        float: left;
    }

</style>
<header>
    <div class="header-area ">
        <div class="navigation">
            <div class="container-nav">
                <div class="navbar">
                    <div class="logo-toggle-container">
                        <a class="logo-img" href="/">
                            <img src="{{url('uploads/'.$logoBlack->items[0]->path_desktop)}}" alt="">
                        </a>
                        <span class="toggle-box">
                        <span></span>
                        <span></span>
                        <span></span>
                        </span>
                    </div>
                    <ul class="menu">
                        <li><a href="/">{{trans('messages.home')}}</a></li>
                        <li><a href="/about-us">{{trans('messages.about_us')}}</a></li>
                        <li><a href="/fabio">Fabio Cappiello</a></li>
                        <li><a href="/contact">{{trans('messages.contact')}}</a></li>
                        <li><a href="/tours/list-tours">{{trans('messages.our_products')}}</a></li>

                        <li><a href="/list-blogs/mindful-traveling">{{trans('messages.mindful_traveling')}}</a></li>
                        <li><a href="/list-blogs/mindfulness-practice">{{trans('messages.mindfulness_practice')}}</a></li>
                        <li><a class="btn-shop " href="https://didaudodi.com/" target='_blank' style="padding: 10px 20px 10px 20px;border-radius:0;top:-10px">{{trans('messages.shop')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->
{{--
<div class="container-fluid p-0">
    <div class="row align-items-center no-gutters">
        <div class="col-xl-5 col-lg-6">
            <div class="main-menu  d-none d-lg-block">
                <nav>
                    <ul id="navigation">
                        <li><a class="active" href="index.html">{{trans('messages.home')}}</a></li>
                        <li><a href="/tours/list-tours">{{trans('messages.our_products')}}</a></li>
                        <li><a href="/about-us">{{trans('messages.about_us')}}</a></li>
                        --}}
{{--<li><a href="#">blog <i class="ti-angle-down"></i></a>
                            <ul class="submenu">
                                <li><a href="blog.html">blog</a></li>
                                <li><a href="single-blog.html">single-blog</a></li>
                            </ul>
                        </li>--}}{{--

                        --}}
{{--<li><a href="#">pages <i class="ti-angle-down"></i></a>
                            <ul class="submenu">
                                <li><a href="elements.html">elements</a></li>
                            </ul>
                        </li>--}}{{--

                        <li><a href="/contact">{{trans('messages.contact')}}</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2">
            <div class="logo-img">
                <a href="index.html">
                    <img src="{{url('uploads/'.$logoBlack->items[0]->path_desktop)}}" alt="">
                </a>
            </div>
        </div>
        <div class="col-xl-5 col-lg-4 d-none d-lg-block">
            --}}
{{--<div class="book_room">
                <div class="socail_links">
                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="book_btn d-none d-lg-block">
                    --}}{{--
--}}
{{--<a class="popup-with-form" href="#test-form">Book A Room</a>--}}{{--
--}}
{{--
                    <a class="btn-shop " href="https://didaudodi.com/" target='_blank' style="padding: 10px 20px 10px 20px;border-radius:0;top:-10px">{{trans('messages.shop')}}</a>

                </div>
            </div>--}}{{--

            <div class="main-menu  d-none d-lg-block">
                <nav>
                    <ul id="navigation">
                        <li><a href="/list-blogs/mindful-traveling">{{trans('messages.mindful_traveling')}}</a></li>
                        <li><a href="/list-blogs/mindfulness-practice">{{trans('messages.mindfulness_practice')}}</a></li>
                        --}}
{{--<li><a href="/about-us">{{trans('messages.about_us')}}</a></li>--}}{{--

                        --}}
{{--<li><a href="#">blog <i class="ti-angle-down"></i></a>
                            <ul class="submenu">
                                <li><a href="blog.html">blog</a></li>
                                <li><a href="single-blog.html">single-blog</a></li>
                            </ul>
                        </li>--}}{{--

                        --}}
{{--<li><a href="#">pages <i class="ti-angle-down"></i></a>
                            <ul class="submenu">
                                <li><a href="elements.html">elements</a></li>
                            </ul>
                        </li>--}}{{--

                        <li>   <a class="btn-shop " href="https://didaudodi.com/" target='_blank'
                                  style="padding: 10px 20px 10px 20px;border-radius:0;top:-10px;top: 10px;">
                                {{trans('messages.shop')}}</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-12">
            <div class="mobile_menu d-block d-lg-none"></div>
        </div>
    </div>
</div>--}}
