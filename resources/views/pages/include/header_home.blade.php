<header>
        <div class="header-area" >
        <!-- style="background: black;" -->
            <div id="sticky-header" class="main-header-area" style="padding: 25px 0 0 0;">
                <div class="container-fluid p-0" style="max-width:95%">
                    <div class="row align-items-center no-gutters">
                        <!-- <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="/">
                                    <img src="{{url('frontend/images/2.png')}}" alt="">
                                </a>
                            </div>
                        </div> -->
                        <style>

                            .trangchu-title {
                                margin-bottom: 22px;
                            }
                            .trangchu-title a{
                                color:white;
                                font-weight: 700;
                            }
                            .trangchu-title:hover{
                                transform: scale(1.1);
                                transition: 1s;
                            }
                            .f-l{
                                float:left;
                                margin-left: 15px;

                            }
                            .f-r{
                                float:right;
                                margin-left: 10px;
                            }
                            .f-l a{
                                font-size: 16px;
                                font-family:"Raleway",sans-serif!important;
                            }
                            .f-r a{
                                font-size: 16px;
                                font-family:"Raleway",sans-serif!important;
                            }
                            .mobile_menu li{
                                float:none!important;
                                margin:30px;
                            }
                            /*.f-r .submenu {
                                background-color: transparent!important;
                            }
                            .f-r .submenu li a {
                                color: #FFFFFF!important;
                                padding: 10px!important;
                                width: 93px;

                            }
                            .menu-language{
                                background-color: transparent!important;
                            }
                            .menu-language a{
                                padding: 8px 10px!important;
                                width: 93px;
                            }
                            .btn-language{
                                font-family:"Raleway",sans-serif!important;
                                font-weight: 500;
                                font-size:15px;
                                top: -10px;
                                border: 1px solid silver;
                                padding: 10px!important;

                            }
                            .f-r .submenu a:hover{
                                color: black!important;
                                background: rgba(255, 255, 255, 0.8);
                                border: 1px solid silver;
                            }*/

                        </style>
                        <div class="">
                            <div class="trangchu-title">

                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-6">
                            <div class="main-menu  d-none d-lg-block ">
                                <nav>
                                    <ul id="navigation">
                                        <li class="f-l"><a href="/">{{trans('messages.home')}}</a></li>
                                        <li class="f-l"><a href="/about-us">{{trans('messages.about_us')}}</a></li>
										<li class="f-l"><a href="/fabio">Fabio Cappiello</a></li>
										<li class="f-l"><a href="/tours/list-tours">{{trans('messages.our_products')}}</a></li>
                                        <li class="f-l"><a href="">{{trans('messages.blog')}} <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                @foreach($categoryPost as $cate)
                                                    <li><a href="/list-blogs/{{$cate->url}}">{{$cate->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        {{--<li class="f-l"><a href="/list-blogs/mindful-traveling">{{trans('messages.mindful_traveling')}}</a></li>
                                        <li class="f-l"><a href="/list-blogs/mindfulness-practice">{{trans('messages.mindfulness_practice')}}</a></li>--}}
                                        <li class="f-l"><a href="/contact">{{trans('messages.contact')}}</a></li>
                                        <li class="f-r">
                                             <a class="btn-shop " href="https://didaudodi.com/" target='_blank' style="padding: 10px 20px 10px 20px;border-radius:0;top:-10px">{{trans('messages.shop')}}</a>
                                        </li>
                                        @php
                                            $language = \Session::get('website_language', config('app.locale'));
                                            if($language == 'vi'){
                                                $language = 'VietNam';
                                            }else {
                                                $language = 'English';
                                            }
                                        @endphp
                                        <li class="f-r">
                                            <a  href="">{{$language}} <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="{!! route('user.change-language', ['en']) !!}">English</a></li>
                                                <li><a href="{!! route('user.change-language', ['vi']) !!}">VietNam</a></li>
                                            </ul>
                                        </li>
                                        {{--<li class="f-r">
                                            <!-- Example single danger button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-language dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{$language}}
                                                </button>
                                                <div class="dropdown-menu menu-language">
                                                    <a class="dropdown-item" href="#">English</a>
                                                    <a class="dropdown-item" href="#">VietNam</a>
                                                </div>
                                            </div>
                                        </li>--}}
                                    </ul>
                                </nav>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <p></p>
