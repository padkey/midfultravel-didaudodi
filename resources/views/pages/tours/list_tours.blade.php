@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_about')
@endsection
@section('content')
    <!-- offers_area_start -->
    <style>
        .bg-pink{
            background-color: #faf1eb!important;
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
            padding-bottom: 80px;
            padding-top: 20px;
            margin-bottom:50px;
            background-size: cover;
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
            font-size: 20px;
            font-family: 'Playfair'!important;
            color: rgba(77,66,58,0.76)!important;
            letter-spacing: 0.5px!important;
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
            color: white;
            margin: 0 5px 6px 0;
            font-weight: 600;
            font-size: 18px;
            font-family: 'Playfair'!important;
            letter-spacing:0.3px;

        }
        .trangthai-open{
            background: #c1955d!important;
            font-family: 'Playfair'!important;
        }
        .trangthai-close{
            background: black!important;
            font-family: 'Playfair'!important;

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
        }
        .single_offers h2{
            font-weight: 100;
        }

        .offers_content{
            padding: 15px 15px 25px 15px ;
        }
        .offers_content b{
            color: #4c423a;
        }
        .title-offer h2{
            color: #4c423a;
            text-transform: uppercase;
            font-family: 'Playfair'!important;
            font-weight: 600;
        }
        .single_offers:hover {
            box-shadow: 10px 10px 15px 10px rgba(221,221,221,0.3);
            transform:  translateY(-2%);
            /* transform: scale(1.1); */
            transition: 0.1s;
        }

        .section_title h1{
            text-align:center;
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

        .title-top{
            position: relative;
            top: 25px;
        }
        .bg-bg{
            /* background-color:beige!important;*/
            background-color:white!important;

        }
        .bg-w{
            background-color:#FFFFFF!important;
        }
        .title-ttp{
            text-align: left;
            border-top: 1px solid #4c423a;
            padding: 10px 0 10px 0;
        }
        .title-ttp h1{
            color: #8b572a;
            text-transform: uppercase;
            font-family: 'Playfair';
            color: #4c423a;
            margin: 0;
        }
        .title-ttp h3{
            font-family: 'Great Vibes',handwriting!important;
            color: #c1955d;
            font-size: 30px;
            margin: 0;
        }
        .position_tour {
            width: 43px;
            display: flex;
            font-weight: 200;
            line-height: 165%;
            font-size: 24px;
            font-family: 'Playfair'!important;
            letter-spacing: 0.5px!important;
            color: rgb(77, 66, 58) !important;
            line-height: 165%;
        }
        .position_tour img {
            width: 100%;
            object-fit: cover;
        }

    </style>
    <div class="offers_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-20 mt-10">
                        <h1>{{trans('messages.all_tours')}}</h1>
                    </div>
                </div>
            </div>
			<div class="row" >
                @php $delayT = 150; @endphp
                @foreach($tours as $tour)
                <div class="col-xl-4 col-md-6 mt-30 wow fadeInDownBig" data-wow-delay="{{$delayT}}ms">
                    <div class="single_offers">
                        <div class="about_thumb about_thumb_tour">
                            <img src="{{url('uploads/'.$tour->image_thumbnail)}}" alt="">
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
                            <p class="position_tour" ><img src="{{url('/frontend/images/position.gif')}}" alt=""> {{$tour->region}} </p>
                            <p class="short-desc"> {{$tour->short_description}} </p>
                            <a href="/tours/{{$tour->url}}" class="btn primary-btn">{{trans('messages.more_infomation_&_register')}}</a>
                        </div>
                    </div>
                </div>
                    @php $delayT = $delayT + 150; @endphp
                @endforeach
            </div>
    </div>
    </div>
    <!-- offers_area_end -->



@endsection
