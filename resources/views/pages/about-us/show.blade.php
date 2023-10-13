@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_about')
@endsection
@section('content')
    @if($page != null)
        <section class="about">
            <div class="container" style="max-width:1200px">
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
