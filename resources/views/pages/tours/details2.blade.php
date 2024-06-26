@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_tour')
@endsection
@section('content')
<style>

    /*@-webkit-keyframes fadeInDown {
        0% {
            opacity: 0;
            -webkit-transform: translateY(-200px);
        }
        100% {
            opacity: 1;
            -webkit-transform: translateY(0);
        }
    }

    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-200px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fadeInDown {
        -webkit-animation-name: fadeInDown;
        animation-name: fadeInDown;
    }*/
    /*.images-overview {
        margin: 2em auto;
        padding: 0;
        max-width: 600px;
        list-style: none;
        height: 15em;
    }*/

    .single-gallery-image{
        height: 250px;
        margin-top:0px!important;
        border-radius: 40px;
        z-index: 2000;
    }
    .single-image-overview:hover  .single-gallery-image{
        border-radius: 0px;
        transition: 1s;
    }

    /*.images-overview .single-gallery-image {
        float: left;
        width: 100px;
        height: 100px;
        margin: 0 5px;
        background: #ccc;
        text-align: center;
        line-height: 100px;
        opacity: 0;
        animation: fadeIn 1s ease-in both;
    }*/



    @keyframes fadeInP {
        from {
            opacity: 0;
            transform: translate3d(0, -180%, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    @keyframes rotateMenu {
        0% {
        transform: rotateX(-90deg)
        }
        70% {
        transform: rotateX(20deg)
        }
        100% {
        transform: rotateX(0deg)
        }
    }

    .decs-schedule {
        padding: 15px 25px 15px 25px;
        animation: rotateMenu 900ms ease-in-out forwards;
        transform-origin: top center;
    }
    .dis-none{
        display:none;
    }
    .dis-block{
        display:block;
    }

   /* .overview-area {
        margin-top: 100px;
    }*/
   /* .container{
        width:70%;
        margin:auto;
    }*/
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
    .section-icon{
        text-align: center;
        margin: auto;

        position: relative;
    }
    .section-icon img{
        border-radius: 50%;
        margin-bottom: 10px;
        width:75px;
    }
    .cacdiemden{
        font-size: 20px;
        text-align: center;
        margin-bottom: 15px;
    }

    .short_desc  {
        text-align: center;
        font-size: 22px!important;

    }
    .short_desc  p{
        font-size: 20px!important;
    }
    .short_desc  span {
        font-size: 20px!important;

    }

    .highlight-area {
        padding-bottom: 100px;
        margin-top: 80px;
    }
    .bg-pink-1{
        background: #f9f3ed!important;
    }
    .pop-color {
        padding-bottom: 43px;
        background-color: transparent;
        background-image: radial-gradient(at top center,#FFFFFF 0%,#F9F3ED00 65%),radial-gradient(at bottom left ,#FFFFFF 0%,#F9F3ED00 31%)
        ,radial-gradient(at bottom right ,#FFFFFF 0%,#F9F3ED00 43%),radial-gradient(at bottom  ,#FFFFFF 0%,#F9F3ED00 43%);
    }

    .c_margin{
        margin-top: auto;
        margin-bottom: auto;
    }
    .content-right{

    }
    .title-center{
        text-align: center;
        margin-top: 5px;
        margin-bottom: 10px;
    }
    .title-center h1 {
        font-size: 35px;
    }
    .mt-100{
        margin-top:100px;
    }
    .hightlight-underline-white {
        text-transform: uppercase;
        padding-bottom: 10px;
        display: inline-block;
        position: relative;
    }
    .hightlight-underline-white::before {
        content: "";
        top: -5px;
        width: 80%;
        position: absolute;
        margin: 0 10%;
        border-bottom: 3px solid #fff;
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


    .mb-10{
        margin-bottom: 10px;
    }
    .mb-20{
        margin-bottom: 20px;
    }
    .images-overview{
        width:90%;
        margin:auto;

    }
    @media (max-width: 800px) {
        .images-overview{
            width:100%;
            margin:auto;
        }
        .container{
            max-width: 100%;
        }
    }
    b{
        font-size: 25px!important;
        font-weight: 900!important;
    }
    @media (max-width: 1000px) {
        .cacdiemden {
            font-size: 16px;
        }
        .short_desc {
            font-size: 16px!important;
        }
        .content-trip span,p {
            font-size: 16px!important;
        }
    }
</style>

     <div class="overview-area">
         <div class="container mb-65">
                 <div class="section-icon fadeInUp wow" data-wow-delay="100ms">
                     <img src="{{url('/frontend/images/kinh-lup.png')}}" alt="">
                     <div class="title-center">
                         <h1 class="hightlight-underline-green">{{trans('messages.overview')}}</h1>
                     </div>
                 </div>
                 <div class="cacdiemden">
                     {!! $tour->place_overview !!}
                 </div>
             <input type="hidden" class="tour-id" value="{{$tour->id}}">
             @php $delayOV = 100 @endphp
             <div class="row images-overview owl-six owl-theme owl-carousel">
                 @if(is_array($tour->image))
                     @foreach($tour->image as $image)
                         <div class="single-image-overview fadeInDownBig wow" data-wow-delay="{{$delayOV}}ms">
                             <a href="{{url('/uploads/'.$image)}}" class="img-pop-up">
                                 <div class="single-gallery-image " style="background: url('/uploads/{{$image}}');"></div>
                             </a>
                         </div>
                         @php $delayOV = $delayOV + 200 @endphp
                     @endforeach
                 @endif
             </div>
             <div class="short_desc mt-30">
                 {!! $tour->short_description !!}
             </div>
         </div>
     </div>
<style>
    .image-l img{
        width: 100%;
        /*max-height: 400px;*/
        object-fit: cover;
    }
    @media (max-width: 1000px) {
        .image-l img{
            width: 100%;
            max-height: 400px!important;
            object-fit: cover;
        }
    }
    .image-l{
        margin-bottom: 10px;
    }
    .content-trip{
        align-items: center;
        justify-content: center;

    }
    .content-trip span{
        font-family: 'Open Sans', sans-serif;
        font-weight: 600;
        line-height: 1.7;
        color: #5d6162;
    }
    .content-trip h4 span{
       /* font-size:24px!important;*/
        color: #004e42!important;
        font-weight: 700;
        line-height: 1.7;

    }
/*    .content-trip p{
        font-size:22px!important;
        font-weight: 400;
    }
    .content-trip span{
        font-size:22px!important;
        font-weight: 600;
    }

    .content-trip h4 span{
        font-size:26px!important;
        color: #004e42!important;

    }
    .content-trip h4 strong{
        font-size:26px!important;
        color: #004e42!important;

    }
    .content-trip h1,h2,h3 span{
        font-size:26px!important;
        color: #004e42!important;

    }
    .content-trip h1,h2,h3 strong{
        font-size:26px!important;
        color: #004e42!important;
    }*/
    .content-right ul {
        list-style-image: url('sqpurple.gif');
    }
</style>
    <div class="highlight-area bg-pink-1 mt-100  pop-color">
        <div class="section-icon  fadeInUp wow" data-wow-delay="10ms" style="top:-45px">
            <img src="{{url('/frontend/images/hightlight.png')}}" alt="">
            <div class="title-center">
                <h1 class="hightlight-underline-white" >{{trans('messages.trip_highlights')}}</h1>
            </div>

        </div>

        <div class="container">
            <div class="row content-trip">
                <div class="col-xl-6 col-lg-11 image-l">
                    <img class="image-li  fadeInUp wow" data-wow-delay="50ms" src="{{url('/uploads/'.$tour->image_trip_highlights)}}" alt="">
                </div>
                <div class="col-xl-6 col-lg-11 c_margin content-right fadeInUp wow" data-wow-delay="50ms">
                    {!! $tour->trip_highlights !!}
                </div>
            </div>
        </div>

    </div>
    <style>

        #map{
            width: 100%;
            height:250px;
            animation: fadeIn 1s ease-in both;
            opacity: 0;
        }
        @media (max-width: 850px) {
            #map{
                width: 100%;
                max-height: 250px!important;
            }
        }
        .marker {
            background-image: url('/frontend/images/position5.png');
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }
        .mapboxgl-popup {
            max-width: 200px;
        }
        .mapboxgl-popup-content {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
        }
        .green-2{
            color: #024f43;
            font-style: normal;
            font-weight: 600;
            font-family:'Open Sans', sans-serif!important;
            font-size: 18px!important;
            line-height: 1.7;
        }
        .img-subtitle{
            width: 50px;
            height: 50px;
        }
        .img-subtitle img{
            width: 40px!important;
            height: 40px!important;
        }
        .decs-schedule p {
            font-family: 'Open Sans',sans-serif!important;
            font-size: 18px!important;
            font-weight: 500;
            line-height: 1.7;
            color: #151515;
        }
        .decs-schedule span {
            font-family: 'Open Sans',sans-serif!important;
            font-size: 18px!important;
            font-weight: 500;
            line-height: 1.7;
            color: #151515;
        }
        .decs-schedule img{
            width: 100%;
            height: 100%;
            /*margin-top: 10px;
            margin-bottom: 10px;*/
        }
        .meals{
            margin: 0 50px 0 0;
            float: right;
            position: relative;
            top: -5px;
        }
        .down-up-action{
            /*float:right;
            margin-left:auto;
            margin-top: auto;
            margin-bottom: auto;
            transition:0.5s;*/
            left: 99%!important;
            margin-left: -30px;
            margin-top: -8px;
            position: absolute;
            top: 37%!important;
        }
        @media (max-width : 1100px) {
            .meals{
                margin: 10px 0 0 0;
                float: none;
            }
            .down-up-action{
                /*float:right;
                margin-left:auto;
                margin-top: auto;
                margin-bottom: auto;
                transition:0.5s;*/
                left: 98%!important;

            }
        }
        .meals img{
            width: 40px;
            height: 40px;

        }
        .title-schedule{
            cursor: pointer;
            border: 1px solid #ffff;
            background: rgba(250, 241, 235, 0.71);
            margin-top:2px;
            padding: 15px 15px 15px 25px;
            border-radius:5px;
            display:block;
            /*grid-template-columns: 70%   30%;*/
            transition: 1s;
            position: relative;
        }

         @media (min-width: 900px) {
             .title-schedule:hover .day-title{
                 font-size: 21px!important;
                 transition: 0.5s;
                 color: #3a3a3a;
             }
             .title-schedule:hover .icon-close{
                 /*border: 1px solid #c5c5c5;*/
                 background: url('/frontend/images/donw-up7.png');
                 transform: rotate(-180deg);
                 background-size: 40px;
                 width: 40px;
                 height: 40px;
                 transition: 0.2s;
             }
         }
        .title-schedule  span {
            font-family: 'Open Sans', sans-serif!important;
            font-weight: 600;
            font-size:18px;
            font-style: normal;
            color: #4b4b4b;
        }
        .title-schedule-open{
            border: 1px solid #FFFFFF;
            background: #024f43;
            font-weight: 400;
        }
        .title-schedule-open span{
            color: #fff!important;
        }
        .title-schedule  .meals {
            font-family:  'Open Sans',sans-serif!important;
            font-weight: 600;
            font-size:16px!important;
            font-style: normal;
            color: #2b2b2b;
        }
        .icon-open{
            background: url('/frontend/images/down-up5.png');
            background-size: 35px;
            width: 35px;
            height: 35px;
            transition: 0.2s;
        }
        .icon-close{
            background: url('/frontend/images/down-up8.png');
            transform: rotate(-180deg);
            background-size: 35px;
            width: 35px;
            height: 35px;
            transition: 0.2s;
        }
        .tour-name{
            margin-bottom:10px;
        }

        @media (max-width: 800px) {
            .day-title{
                display: block;
                width: 95%;
            }
        }
        #map2{
            margin: auto;
            text-align: center;
        }
        #map2 img{
            /*width: 80%;
            object-fit: cover;
            */
            max-width: 100%;
        }
        @media (max-width: 800px) {
            #map2 img{
                width: 100%;
                object-fit: cover;
            }
        }
        @media (max-width: 1000px) {
            .decs-schedule p,span {
                font-size: 16px!important;
            }
        }
    </style>
    <div class="schedule-area mt-100">
        <div class="container">
            <div class="section-icon fadeInUp wow" data-wow-delay="200ms" >
                <img src="{{url('/frontend/images/kinh-lup.gif')}}" alt="" style="border-radius: 0">
                <div class="title-center">
                    <h1 class="hightlight-underline-green">{{trans('messages.itinerary')}}</h1>
                    <h2 class="tour-name">{{$tour->name}}</h2>
                </div>
            </div>
            <div id='map2' class="fadeInUp wow" data-wow-delay="200ms">
                <img src="{{url('/uploads/'.$tour->image_map)}}" alt="">
            </div>
            <div>

                @foreach($tour->tourSchedule as $key => $schedule)
                    <div class="schedule-day-{{$schedule->id}} ">
                        <div class="title-schedule" data-id="{{$schedule->id}}" data-position="{{$schedule->position}}">
                            <span class="icon-close icon-action-{{$schedule->id}} down-up-action">   </span>
                            <span class="day-title">{{$schedule->title}} </span>
                            @if($schedule->meal !== null)
                            <span class="meals meals-{{$schedule->id}} dis-none"><img src="{{url('/frontend/images/meal1.png')}}" alt=""> {{$schedule->meal}}</span>
                            @endif
                        </div>
                        <div class="content-schedule-{{$schedule->id}} dis-none decs-schedule mt-20 mb-20">
                            @if($schedule->sub_title != '')
                                <h4 class="green-2 font-bold mb-20"><span class="img-subtitle"><img src="{{url('/frontend/images/position7.png')}}" alt="" ></span>{{$schedule->sub_title}}</h4>
                            @endif
                            {!! $schedule->description !!}
                        </div>
                    </div>
                @endforeach
                <input type="hidden" class="region" value="{{$tour->region}}">
            </div>
        </div>
    </div>

<style>
    .area-button-contact{
        text-align: center;
    }
    .btn-enquire {
        background-color: white;
        border: 1px solid #7fb254!important;
        color: #7fb254!important;
        padding: 5px 15px 5px 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        font-weight: 900;
        font-size: 22px;
        transition: 0.5s;
        font-family: "Cormorant Garamond"!important;
    }
    .btn-enquire:hover{
        background-color: #7fb254;
        color: white!important;

    }
</style>
    <div class="area-button-contact mt-10">
        <button type="button" class="btn btn-enquire mt-20" data-toggle="modal" data-target="#model-enquire">
           <i class="fa fa-commenting-o"></i> {{trans('messages.enquire')}}
        </button>
    </div>

<style>
    .nav-link{
        background: #7fb254!important;
        font-weight: 500!important;
        transition: 0.5s;

    }
    .nav-tabs{
        padding: 0!important;
        border-bottom: 7px solid #004e42!important;
        transition: 0.2s;

    }
    .nav-link.active{
        background: #004e42!important;
        color:#FFFFFF!important;
        border-color: #004e42!important;
        transition: 0.5s;
    }
    .nav-link{
        font-size: 21px;
        margin-right: 2px;
        border: 0px!important;
        color:#FFFFFF!important;
        transition: 0.5s;
    }
    .tab-content{
        margin: auto;
        padding: 25px 20px 20px 20px;
        transition: 0.2s;
    }

    .nav-item:hover .nav-link{
        font-size: 24px!important;
        transition: 0.2s;
    }
    .nav-link.active:hover{
        background: #004e42!important;

    }

    .nav-link:hover{
        background: #7fb254 !important;
    }
    .tab-content span{
        font-size: 19px!important;
        font-family: 'Open Sans',sans-serif!important;
        font-weight: 500;
    }
    .tab-content p {
        font-size: 19px!important;
        font-family: 'Open Sans',sans-serif!important;
        font-weight: 500;
    }
    #myTabContent .active ul li {
        list-style: circle;
        display: list-item;
        color: #004e42;
    }
    #myTabContent .active ul{
        margin-left: 20px;
        margin-top: 10px;
    }
    #myTabContent table{
        width: 100%!important;
    }
    @media (max-width: 830px) {
        .nav-tabs{
            display:block;
        }
        .nav-link{
            width: 100%;
        }
        .tab-content{
            margin: auto;
            padding: 25px 0px 0px 0px;
            transition: 0.2s;
        }
        .tab-content span,p {
            font-size: 16px!important;
            font-family: 'Open Sans',sans-serif!important;
            font-weight: 500;
        }
        #myTabContent img {
            width: 100%;
            object-fit: cover;
            height: auto;
        }
    }
</style>
    <div class="important-info-area mt-100">
    <div class="container">
        <div class="section-icon fadeInUp wow" data-wow-delay="200ms">
            <img src="{{url('/frontend/images/kinh-lup-ds.gif')}}" alt="" style="border-radius: 0px">
            <div class="title-center">
                <h1 class="hightlight-underline-green">{{trans('messages.important_information')}}</h1>
            </div>
        </div>

        <div class="tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">

                @if ($tour->important_info_1 != '')
                    <li class="nav-item fadeInDown wow" data-wow-delay="100ms" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                            {{trans('messages.our_service')}}
                        </button>
                    </li>
                @endif
                @if ($tour->important_info_2 != '')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fadeInDown wow" data-wow-delay="200ms" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            {{trans('messages.tour_condition')}}
                        </button>
                    </li>
                @endif
                @if ($tour->important_info_3 != '')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fadeInDown wow" data-wow-delay="300ms" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                            {{trans('messages.condition_in_euro')}}
                        </button>
                    </li>
                @endif
                @if ($tour->important_info_4 != '')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fadeInDown wow" data-wow-delay="400ms" id="practice-tab" data-toggle="tab" data-target="#practice" type="button" role="tab" aria-controls="practice" aria-selected="false">
                            {{trans('messages.retreats_schedule')}}
                        </button>
                    </li>
                @endif

            </ul>
            <div class="tab-content" id="myTabContent">
                @if ($tour->important_info_1 != '')
                    <div class="tab-pane fade show active fadeIn wow" data-wow-delay="100ms" id="home" role="tabpanel" aria-labelledby="home-tab">{!! $tour->important_info_1 !!}</div>
                @endif
                @if ($tour->important_info_2 != '')
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">{!! $tour->important_info_2 !!}</div>
                @endif
                @if ($tour->important_info_3 != '')
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">{!! $tour->important_info_3 !!}</div>
                @endif
                @if ($tour->important_info_4 != '')
                        <div class="tab-pane fade" id="practice" role="tabpanel" aria-labelledby="practice-tab">{!! $tour->important_info_4 !!}</div>
                @endif
            </div>
        </div>

    </div>
</div>

<!-- companion -->
<style>
    .companion-container{
        width: 100%;
        margin: auto;
    }
    .companion-area{
       /* padding: 0;*/
        /*margin: 0;*/
        box-sizing: border-box;
        font-family: Poppins;
        /*padding-top: 10px;*/
        padding-bottom: 100px;
    }
    .team-profile{
        max-width: 1200px;
        margin: auto;
        /*display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;*/
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
        animation: fadeIn 1s ease-in both;
        opacity: 0;
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
    /*@media (max-width: 1280px) and (min-width: 1190px) {
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
    }*/
 /*   @media (max-width: 1190px) and (min-width: 1100px) {
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
        color: #313131;
        margin-bottom: 5px;
        font-weight: 500;
        font-size: 12px;
    }
    .caption p{
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
    .desc-companion span{
        font-family: "Playfair Display"!important;
        font-size: 15px;
        margin: 2px 0 12px 0;
        color: rgba(77,66,58,0.76)!important;
        letter-spacing: 0.5px!important;
        color: rgba(77,66,58,0.76)!important;
        line-height: 165%;
    }
    .desc-companion p{
        font-family: "Playfair Display"!important;
        font-size: 15px;
        margin: 2px 0 12px 0;
        color: rgba(77,66,58,0.76)!important;
        letter-spacing: 0.5px!important;
        color: rgba(77,66,58,0.76)!important;
        line-height: 165%;
    }
    .title-companion{
        text-align: center;
        margin-top: 50px;
        margin-bottom: 40px;

    }
    .title-companion h1 {
        color: #8b572a;
    }
    .owl-carousel .owl-stage-outer {
        /*overflow: inherit;*/
    }
    .mt-180{
        margin-top:180px;
    }
</style>
<div class="companion-area bg-pink-1 mt-180">
    <div class="section-icon wow fadeInUp" data-wow-delay="100ms" style="top:-45px;">
        <img src="{{url('/frontend/images/companion.png')}}" alt=" ">
        <div class="title-center">
            <h1 class="hightlight-underline-white" >{{trans('messages.companions')}}</h1>
        </div>
    </div>
    {{--<div class="title-companion ">
        <img src="{{url('/frontend/images/partnership.png')}}" alt="" style="border-radius:0px;">
        <h1 class="hightlight-underline-white" >{{trans('messages.companions')}}</h1>
    </div>--}}
    <div class="companion-container">
        <input type="hidden" value="{{count($tour->companion)}}" class="companionNumber">
        <div class="team-profile owl-five owl-carousel  owl-theme">
            @if($companions != null)
                @foreach($tour->companion as $companion)
                    <div class="profile-card wow fadeInUp" data-wow-delay="100ms">
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
                @endforeach
            @endif
        </div>
    </div>
</div>
<style>
    .image-partner{
       /* position: relative;*/
    }
    .details-partner{
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
    }
    .show-details-partner{
        display:none;
    }
    .details-partner:hover .desc-partner{
        background: #004e42!important;

    }

    .desc-partner{
        padding: 5px!important;
        bottom:0px;
        background: black;
        width: calc(100% );
        padding: 0 0 0 10px;
        transition:0.5s;
    }
    .desc-partner h3{
        color: #FFFFFF;
        font-size: 26px;
    }
    .desc-partner p{
        color: #FFFFFF!important;
        font-size: 17px;
    }
    .image-partner img{
        width: 100%;
        object-fit: cover;
    }

    .mt-20 {
        margin-top:20px;
    }
    .
</style>
<div class="partner-area mt-100">
    <div class="container">
        <div class="section-icon wow fadeInUp" data-wow-delay="100ms">
            <img src="{{url('/frontend/images/partnership.png')}}" alt="" style="border-radius:0px;">
            <div class="title-center">
                <h1 class="hightlight-underline-green">{{trans('messages.our_partnership')}}</h1>
            </div>
        </div>

        <div class="row">
            @foreach($tour->partnershipBranch as $partnershipBranch)
            <div class="col-md-6 mt-20 wow fadeIn" data-wow-delay="100ms">
                <a href="{{$partnershipBranch->link_website}}" class="details-partner">
                    <div class="image-partner" >
                        <img src="{{url('/uploads/'.$partnershipBranch->image)}}" alt=""  style="">
                    </div>
                    <div class="desc-partner">
                        <h3 style="margin-left: 5px;">{{$partnershipBranch->name}}</h3>
                        <p style="margin-left: 5px;">{{trans('messages.address')}} : {{$partnershipBranch->address}}</p>
                    </div>
                </a>
            </div>
            @endforeach
            {{--<div class="col-md-6 mt-20">
                <a href="" class="details-partner">
                    <div class="image-partner" >
                        <img src="{{url('/frontend/images/m5.jpg')}}" alt=""  style="">
                    </div>
                    <div class="desc-partner">
                        <h2>Iuteressere Monastery</h2>
                        <p>Chi nhanh : Lieu dit Le Pey</p>
                    </div>
                </a>
            </div>
        </div>--}}

    </div>
</div>
    <style>
        .contact{

        }
        .modal-header{
            background-color: #80b157;
        }
        .modal-title{
            color: white;
        }
        .title-contact{
            max-width:800px;
            margin: auto;
            font-size: 28px;
        }
        .btn-enquire-yellow {
            background-color: #ffe277;
            color: black!important;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-weight: 700;
        }
    </style>
<div class="contact mt-180 bg-pink-1">
    <div class="container ">
        <div class="section-icon wow zoomIn" data-wow-delay="10ms">
            <img src="{{url('/frontend/images/message1.png')}}" alt="" style="border-radius:0px; top: -45px">
            <div class="title-center" style=" margin-bottom: 0px;">
                <h1 class="hightlight-underline-green">{{trans('messages.get_in_touch')}}</h1>
                <h2 class="title-contact">{{trans('messages.get_in_touch_desc')}}</h2>
                <button type="button" class="btn btn-enquire-yellow mt-20" data-toggle="modal" data-target="#model-enquire">
                    {{trans('messages.enquire')}}
                </button>
            </div>
        </div>
    </div>
</div>
{{--  <div class="book_btn d-none d-lg-block">
      <a href="#test-form" class="popup-with-form">Requỉe</a>
  </div>--}}
<!-- end-companion -->
    <style>
        .error {
            color:red;
            font-weight: bold;
            margin-left: 5px;
        }
    </style>

    <!-- Modal -->
    <div class="modal fade" id="model-enquire" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h1 class="modal-title" id="exampleModalLongTitle">{{trans('messages.contact_us')}}</h1>
                        <p class="modal-title">
                            {{trans('messages.contact_us_desc')}}
                        </p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-xl-6">
                                <input  class="form-control mt-20 name" placeholder="{{trans('messages.name')}} ">
                                <p class="errorName error"></p>
                            </div>
                            <div class="col-xl-6">
                                <input class="form-control mt-20 phone"  placeholder="{{trans('messages.phone_number')}} " >
                                <p class="errorPhone error"></p>

                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-xl-6">
                                <input class="form-control email" placeholder="{{trans('messages.email')}} ">
                                <p class="errorEmail error"></p>
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-xl-12">
                                <textarea class="form-control message" placeholder="{{trans('messages.message')}} "></textarea>
                                <p class="errorMessage error"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="html_element" data-callback="recaptchaCallback" ></div>
                                <p class="errorCaptcha error"></p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer mt-30">
                        {{-- <button type="button" class="btn btn-shop btn-enquire-submit g-recaptcha"
                                 data-sitekey="{{ env('RECAPTCHA_SITE_KEY')  }}"
                                 data-callback='onSubmit'
                                 data-action='submit'>{{trans('messages.submit')}}   </button>
                         <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY')  }}"></div>--}}
                        <button type="button" class="btn btn-shop btn-enquire-submit" >{{trans('messages.submit')}} </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
        <script type="text/javascript">
            var onloadCallback = function() {
                grecaptcha.render('html_element', {
                    'sitekey' : '{{ config('services.recaptcha.site_key') }}'
                });
            };
            function recaptchaCallback() {
                $('.errorCaptcha').html('');
            };
        </script>
        <script>
            $('.btn-enquire-submit').click(function (e){
                //e.preventDefault();
                //alert(grecaptcha.getResponse());
                var _token = $('input[name="_token"]').val();
                let message = $('.message').val();
                let name =  $('.name').val();
                let email  = $('.email').val();
                let phone = $('.phone').val();
                let tourId =  $('.tour-id').val();
                validateFormEnquire();
                var checkValidate = validateFormEnquire();
                if(checkValidate) {  //true
                    $.ajax({
                        url:'{{url('/tour-enquire')}}',
                        method:'POST',
                        data: {
                            message:message,
                            name:name,
                            email:email,
                            phone:phone,
                            tourId:tourId,
                            _token:_token,
                            recaptcha_token:grecaptcha.getResponse()
                        },
                        success(data){
                            grecaptcha.reset();
                            Swal.fire({
                                title: "Good job!",
                                text: "Cảm ơn bạn, chúng tôi sẽ phản hồi trong thời gian sớm nhất!",
                                type: "success",
                                showConfirmButton: true,
                            }).then(
                                function (isConfirm) {
                                    if (isConfirm) {
                                        $('#model-enquire').modal('hide');
                                    }
                                },
                            );
                        },error: function() {
                            grecaptcha.reset();
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong!",
                                type: "error",
                            }).then(
                                function (isConfirm) {
                                    if (isConfirm) {
                                        $('#model-enquire').modal('hide');
                                    }
                                },
                            );
                        },
                    });

                }
            })
            function validateFormEnquire(){
                $('.error').html('');
                let i = 1;
                if($('.message').val() == ''){
                    $('.errorMessage').html('{{trans('messages.require_message')}}');
                    i = 0;
                }
                if($('.name').val() == ''){
                    $('.errorName').html('{{trans('messages.require_name')}}');
                    i = 0;
                }
                if($('.email').val() == ''){
                    $('.errorEmail').html('{{trans('messages.require_email')}}');
                    i = 0;
                }
                if($('.phone').val() == ''){
                    $('.errorPhone').html('{{trans('messages.require_phone')}}');
                    i = 0;
                }else {
                    let isNumeric = /^\d+$/
                    if ($('.phone').val() && !isNumeric.test($('.phone').val())) {
                        i = 1;
                        $('.errorPhone').html('{{trans('messages.error_number_phone')}}');
                        i = 0;
                    } /*else {
                        let to_phone_arr = $('.customer_phone').val().split("");
                        if (Number(to_phone_arr[0]) !== 0) { //check first number
                            i = 1;
                            $('.errorPhone').html('Số điện thoại không đúng');
                        }
                        let lengthPhone = to_phone_arr.length;
                        if (lengthPhone !== 10) { //check
                            i = 1;
                            $('.errorPhone').html('Số điện thoại phải có 10 số');
                        }
                    }*/
                }
                if (grecaptcha && grecaptcha.getResponse().length > 0)  { //check recaptcha

                } else {
                    $('.errorCaptcha').html('{{trans('messages.error_captcha')}}');
                    i = 0;
                }
                if(i==0){
                    return false;
                } else {
                    return true;
                }
            }
        </script>
<script>
    var element = document.querySelector('.content-right');
   // alert(element.offsetHeight)
    $('.image-li').css('height',element.offsetHeight);
</script>
<script>
        /*mapboxgl.accessToken = 'pk.eyJ1IjoidG9hbmNodW9uZyIsImEiOiJjbG80MG9zOXkwbWthMm11ZGFtcXFvdTZlIn0.VBX96EkqFGqhVwBrwSpw8A';
        // Mã jQuery xử lý sau khi trang đã tải xong
        var features = ;

        features = JSON.stringify(features);
        features = JSON.parse(features);

        const geojson = {
            'type': 'FeatureCollection',
            'features':features.features
        };
        //console.log( geojson.features);
        let region = $('.region').val();
      //  let center= [102.084961,3.557283];
        if(region == 'Asia'){
            center = [102.084961,3.557283]
        } else if (region == 'The Americas') {
            center = [19.59069779479588, -99.01175929463237]
        } else if (region == 'Africa') {
            center = [18.941603970405783, -98.0341575352991]
        } else if (region == 'Europe') {
            center = [47.5797552796308, 14.165981015213825]
        } else if (region == 'Oceania') {
            center= [102.084961,3.557283];
        }

        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12',
            center: center, // starting position [lng, lat]
           // projection:'globe',
          //  projection: 'globe',

            zoom: 2
        });


            // add markers to map
        for (const feature of geojson.features) {
            // create a HTML element for each feature
            const el = document.createElement('div');
            el.className = 'marker';

            // make a marker for each feature and add it to the map
            new mapboxgl.Marker(el)
                .setLngLat(feature.features.geometry.coordinates)
                .setPopup(
                    new mapboxgl.Popup({ offset: 25 }) // add popups
                        .setHTML(
                      //   `<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`
                        )
                )
                .addTo(map);
        }*/

        $('.title-schedule').click(function(){
            /*let position = $(this).data('position');
            position = position.split(',');
            let lng = parseFloat(position[1]);
            let lat = parseFloat(position[0]);*/
           // console.log(position)

            // change color title end show description
            let id = $(this).data('id');
            if ($('.content-schedule-'+id).hasClass('dis-none')) {  // none => block
                // cho map di chuyển tới tọa độ
                /*map.flyTo({
                    center: [lng,lat], // Tọa độ vị trí cần zoom
                    zoom: 13 // Mức độ zoom cho vị trí cần zoom
                });*/
                // đổi màu và show nội dung
                $('.content-schedule-'+id).removeClass('dis-none');
                $('.content-schedule-'+id).addClass('dis-block');
                $(this).addClass('title-schedule-open');
                $('.icon-action-'+id).removeClass('icon-close');
                $('.icon-action-'+id).addClass('icon-open');
                // show meal
                $('.meals-'+id).addClass('dis-block');
                $('.meals-'+id).removeClass('dis-none');

            } else {
                /*map.flyTo({
                    center: [lng,lat], // Tọa độ vị trí cần zoom
                    zoom:2 // Mức độ zoom cho vị trí cần zoom
                });*/
                // đổi màu và ẩn nội dung
                $('.content-schedule-'+id).addClass('dis-none');
                $('.content-schedule-'+id).removeClass('dis-block');
                $(this).removeClass('title-schedule-open');
                $('.icon-action-'+id).removeClass('icon-open');
                $('.icon-action-'+id).addClass('icon-close');
                //hidden meal
                $('.meals-'+id).addClass('dis-none');
                $('.meals-'+id).removeClass('dis-block');
            }
        })


        var owl6 = $('.owl-six');
        owl6.owlCarousel({
            loop:true,
            nav:true,
            margin:20,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
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
                /*1190:{
                    items:3,
                    nav:true,
                    loop:true
                },*/
                /*1620:{
                    items:3,
                    nav:true,
                    loop:true
                },*/
                /*2000:{
                    items:5,
                    nav:true,
                    loop:false
                }*/
            }
        });
    </script>
    <script>
        let companionNumber = parseInt($('.companionNumber').val());
        var owl5 = $('.owl-five');
        owl5.owlCarousel({
            loop:true,
            nav:true,
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
                    items:companionNumber,
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
