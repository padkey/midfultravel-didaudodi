@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection

@section('content')
    <!-- Start Sample Area -->
    <section class="sample-text-area">
        <div class="container box_1170">
            <p class="sample-text">
                {!! $partnershipBranch->description !!}
            </p>
        </div>
    </section>

@endsection
