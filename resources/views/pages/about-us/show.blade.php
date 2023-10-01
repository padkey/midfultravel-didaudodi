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
				<h1> Didaudodi</h1>
			</div>
			<div class="content-about">
			<p class="mt-4"> là nhà điều hành du lịch dựa vào cộng đồng, có trách nhiệm, cam kết thúc đẩy trải nghiệm du lịch có đạo đức dựa trên các giá trị và nguyên tắc của người dân bản địa và cộng đồng địa phương nơi nó hoạt động để họ có thể được hưởng toàn quyền quản lý du lịch ở vùng đất của họ. Các hoạt động du lịch mà chúng tôi thực hiện được thiết kế để người dân địa phương có thể sửa chữa, mở rộng và viết lại lịch sử của họ thông qua những khoảnh khắc đối thoại trong đó khách du lịch nhận được thông tin về thực tế xã hội, văn hóa, lịch sử, chính trị và tinh thần của lãnh thổ.</p>

			</div>
		</div>

	</div>
</section>
<!-- //about -->
@endsection