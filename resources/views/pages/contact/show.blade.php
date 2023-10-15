@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_about')
@endsection
@section('content')
 <!-- ================ contact section start ================= -->
 <style>
	.title_contact{
		margin-bottom:40px;
	}
	.content_contact {
		margin-bottom:40px;

	}

 </style>
 <style>
     .container-about{
         width: 75%;
         margin: auto;
     }
 </style>
 @if($page != null)
    <section class="">
            <div class="container-about">
				<div class="row">
					<div class="col-lg-8">
						<div class="title_contact">
							<h1>{{$page->title}}</h1>
						</div>
						<div class="content_contact">
                            {!! $page->content !!}
						</div>

						<!-- <div class="media_contact row">
							<div class="media contact-info col-lg-4">
								<span class="contact-info__icon"><i class="ti-home"></i></span>
								<div class="media-body">
									<h3>Buttonwood, California.</h3>
									<p>Rosemead, CA 91770</p>
								</div>
							</div>
							<div class="media contact-info col-lg-4">
								<span class="contact-info__icon"><i class="ti-tablet"></i></span>
								<div class="media-body">
									<h3>+1 253 565 2365</h3>
									<p>Mon to Fri 9am to 6pm</p>
								</div>
							</div>
							<div class="media contact-info col-lg-4">
								<span class="contact-info__icon"><i class="ti-email"></i></span>
								<div class="media-body">
									<h3>support@colorlib.com</h3>
									<p>Send us your query anytime!</p>
								</div>
							</div>
						</div> -->
					</div>

				</div>
                <div class="row">
						<div class="col-lg-8">
							<div class="title_contact">
								<h1>{{trans('messages.get_in_touch')}}</h1>
							</div>
							<form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Name"></textarea>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
										</div>
									</div>
								</div>
								<div class="form-group mt-3">
									<button type="submit" class="button button-contactForm boxed-btn">Send</button>
								</div>
							</form>
						</div>

                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->
 @endif
@endsection
