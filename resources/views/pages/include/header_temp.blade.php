<header>
    <style>

    </style>
    <div class="header-area" style="background: white;    opacity: 80%;    position: relative;">
        <div id="sticky-header" class="main-header-area" >
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
                        .sticky{
                            background:white!important;
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
                            margin-left: 15px;
                            bottom: 10px;
                        }
                        .f-l:hover{
                            transform:  translateY(-15%);
                            transition: 0.1s;
                        }
                        .f-r a{
                            color:black!important;
                            font-size: 16px;
                            font-family:"Raleway",sans-serif!important;
                        }
                        .f-l a{
                            color:black!important;
                            font-size: 16px;
                            font-family:"Raleway",sans-serif!important;
                        }
                        .mobile_menu li{
                            float:none!important;
                            margin:30px;
                        }
                        .mobile_menu .slicknav_icon-bar{
                            background: black !important;
                        }
                        .main-header-area{
                            padding: 25px 0 0 0!important;
                        }
                        @media (max-width: 1200px) {
                            .main-header-area{
                                padding: 50px 0 0 0!important;
                            }
                        }
                    </style>
                    <div class="">
                        <div class="trangchu-title">

                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-6">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">

                                    @php
                                        $language = \Session::get('website_language', config('app.locale'));
                                        if($language == 'vi'){
                                            $language = 'VietNam';
                                        }else {
                                            $language = 'English';
                                        }
                                    @endphp
                                    <li class="f-r"><a href="">{{$language}} <i class="ti-angle-down"></i></a>
                                        <ul class="submenu" style="    width: fit-content!important;">
                                            <li><a href="{!! route('user.change-language', ['en']) !!}">English</a></li>
                                            <li><a href="{!! route('user.change-language', ['vi']) !!}">VietNam</a></li>
                                        </ul>
                                    </li>
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
