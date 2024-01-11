@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_about')
@endsection
@section('content')
    <style>
        .bg-pink{
            background-color: #f9f3ed;
        }
        .container-about{
            width: 75%;
            margin: auto;
        }
        .content-about p,span {
            font-weight: 200;
            line-height: 165%;
            font-size: 22px!important;
            font-family: 'Playfair Display', serif!important;
            letter-spacing: 0.5px!important;
            color: rgba(77,66,58,0.76)!important;
            line-height: 165%;
        }
        .title-about h1{
            color: #8b572a;
            text-transform: uppercase;
            text-align: center;
            font-family: 'Playfair Display', serif!important;
        }
        .content-about {
            width: 100%;
        }

        @media (max-width: 900px) {
            .content-about p,span  {
                font-size: 18px!important;
            }
            .content-about img{
                width: 100%;
                object-fit: cover;
                height: auto;
            }
        }
    </style>
    @if($page != null)
    <section class="about mb-100 pt-30">
        <div class="container-about ">
            <div class="row">
                <div class="title-about">
                    <h1> {{$page->title}}</h1>
                </div>
                <div class="content-about">
                    <p>
                        {!! $page->content !!}
                    </p>
                </div>
            </div>

        </div>
    </section>
    @endif
<!-- //about -->
@endsection


