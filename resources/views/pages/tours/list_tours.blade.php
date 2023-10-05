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
        .single_offers:hover{
            /* background: beige; */
            /* background: #faf1eb; */
            box-shadow: 10px 10px 15px 10px rgba(221,221,221,0.3);
        }
        .offers_content{
            margin-left: 15px ;
        }

        .offers_area {
            padding-bottom: 0;
            padding-top: 0px;
            margin-bottom:50px;
        }
        .title-offer{
            color: #8b572a;
        }
        .single_offers:hover {
            transform: scale(1.1);
            transition: 0.1s;
        }

        .section_title h1{
            margin-bottom:50px;
            font-style: normal;
        }
    </style>
    <div class="offers_area">
        <div class="container  mb-40">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-20 mt-10">
                        <h1>Tất cả các chuyến du lịch</h1>
                    </div>
                </div>
            </div>
			<div class="row" >
                @foreach($tours as $tour)
                <div class="col-xl-4 col-md-4">
                    <div class="single_offers">
                        <div class="about_thumb">
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
                            <i class="fa fa-map-marker" aria-hidden="true"></i> Asia
                            <p class="short-desc"> {{$tour->short_description}} </p>
                            <a href="/tours/{{$tour->url}}" class="btn btn-earth">{{trans('messages.more_infomation_&_register')}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
    <!-- offers_area_end -->



@endsection
