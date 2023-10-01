@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_tour')
@endsection
@section('content')
	<!-- Start Sample Area -->

	<section class="sample-text-area">
		<div class="container-package box_1170">
			<h3 class="text-heading">Chuyến đi cộng đồng khám phá đất nước sau chiến tranh</h3>
			<p class="sample-text">
				{!! $tour->content !!}
		 </p>
		</div>
	</section>

	<!-- End Sample Area -->
    
@endsection