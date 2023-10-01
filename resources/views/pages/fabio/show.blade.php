@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_about')
@endsection
@section('content')
<section class="about py-5">
	<div class="container" style="max-width:1200px">
		<div class="row">
			<div class="title-about">
				<h1> Fabio</h1>
			</div>
			<div class="content-about">
				<p>
					{!! $page->content !!}
				</p>
			</div>
		</div>

	</div>
</section>
<!-- //about -->
@endsection


