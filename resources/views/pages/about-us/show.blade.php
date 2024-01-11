@extends('frontend_layout')

        @section('header')
            @include('pages.include.header_about')
        @endsection
        @section('banner')
            @include('pages.include.banner_about')
        @endsection
        @section('content')

            @if($page != null)
                <style>
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
                        font-style: normal;
                    }
                    .title-about h1{
                        color: #8b572a;
                        text-transform: uppercase;
                        text-align: center;
                        font-family: 'Playfair Display', serif!important;
                    }
                    .pop-color {
                        background-color: transparent;
                        background-image: radial-gradient(at top center,#FFFFFF 0%,#F9F3ED00 65%),radial-gradient(at bottom left ,#FFFFFF 0%,#F9F3ED00 31%)
                        ,radial-gradient(at bottom right ,#FFFFFF 0%,#F9F3ED00 43%),radial-gradient(at bottom  ,#FFFFFF 0%,#F9F3ED00 43%);
                    }
                    .bg-pink{
                        background-color: #f9f3ed;
                    }
                    .content-about {
                        width: 100%;
                    }
                    .content-about img{
                        width: 100%;
                        object-fit: cover;
                        height: auto;
                    }
                    @media (max-width: 900px) {
                        .content-about p,span{
                            font-size: 20px!important;
                        }
                    }
                </style>
                <section class="about mb-100">
                    <div class="container-about">
                        <div class="row">
                            <div class="title-about">
                                <h1>{{$page->title}}</h1>
                            </div>
                            <div class="content-about">
                                <p class="mt-4">
                                    {!! $page->content !!}
                                </p>
                            </div>
                        </div>

                    </div>
                </section>
            @endif
            <!-- //about -->
        @endsection

