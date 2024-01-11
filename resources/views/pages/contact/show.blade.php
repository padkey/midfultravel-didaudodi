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
    .content_contact p,span {
        font-weight: 200;
        line-height: 165%;
        font-size: 22px!important;
        font-family: 'Playfair Display', serif!important;
        letter-spacing: 0.5px!important;
        color: rgba(77,66,58,0.76)!important;
        line-height: 165%;
    }
    .content-about p,span {
        font-weight: 200;
        line-height: 165%;
        font-size: 22px;
        font-family: 'Playfair Display', serif!important;
        letter-spacing: 0.5px!important;
        color: rgba(77,66,58,0.76)!important;
        line-height: 165%;
    }
    .title_contact h1{
        color: #8b572a;
        text-transform: uppercase;
        font-family: 'Playfair Display', serif!important;
    }
    .container-about{
        width: 75%;
        margin: auto;
    }
    @media (max-width: 900px) {
        .content-about p,span {
            font-size: 18px!important;
        }
    }
 </style>

 @if($page != null)
    <section class="mb-100">
            <div class="container-about">
				<div class="row">
					<div class="col-lg-8">
						<div class="title_contact">
							<h1>{{$page->title}}</h1>
						</div>
						<div class="content_contact">
                            {!! $page->content !!}
						</div>

						{{--<div class="media_contact row">
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
						</div>--}}
					</div>

				</div>
                <div class="row">
						<div class="col-lg-8">
							<div class="title_contact">
								<h1>{{trans('messages.get_in_touch')}}</h1>
							</div>
							<form action="#">
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<textarea class="form-control w-100 message"  cols="30" rows="9"  placeholder=" {{trans('messages.message')}}"></textarea>
                                            <p class="errorMessage error"></p>
                                        </div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control name"  type="text"  placeholder="{{trans('messages.name')}}">
                                            <p class="errorName error"></p>
                                        </div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control email"  type="email" placeholder="{{trans('messages.email')}}">
                                            <p class="errorEmail error"></p>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
                                            <input class="form-control phone" type="text" placeholder="{{trans('messages.phone_number')}}">
                                            <p class="errorPhone error"></p>
                                        </div>
									</div>
                                    <div class="col-12">
                                        <div id="html_element" data-callback="recaptchaCallback" ></div>
                                        <p class="errorCaptcha error"></p>
                                    </div>
								</div>
								<div class="form-group mt-3">
									<button type="button" class="button button-contactForm boxed-btn btn-enquire-submit">Send</button>
								</div>
							</form>
						</div>

                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->
 @endif
@endsection

@section('script')
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('html_element', {
                'sitekey' : '{{ config('services.recaptcha.site_key') }}'
            });
        };
        function recaptchaCallback() {
            $('.errorCaptcha').html('');
        };
    </script>
    <script>
        $('.btn-enquire-submit').click(function (e){
            //e.preventDefault();
            //alert(grecaptcha.getResponse());
            var _token = $('input[name="_token"]').val();
            let message = $('.message').val();
            let name =  $('.name').val();
            let email  = $('.email').val();
            let phone = $('.phone').val();
            let tourId = 0; //$('.tour-id').val();
            alert(name);
            validateFormEnquire();
            var checkValidate = validateFormEnquire();
            if(checkValidate) {  //true
                $.ajax({
                    url:'{{url('/tour-enquire')}}',
                    method:'POST',
                    data: {
                        message:message,
                        name:name,
                        email:email,
                        phone:phone,
                        tourId:tourId,
                        _token:_token,
                        recaptcha_token:grecaptcha.getResponse()
                    },
                    success(data){
                        grecaptcha.reset();
                        Swal.fire({
                            title: "Good job!",
                            text: "Cảm ơn bạn, chúng tôi sẽ phản hồi trong thời gian sớm nhất!",
                            type: "success",
                            showConfirmButton: true,
                        }).then(
                            function (isConfirm) {
                                if (isConfirm) {
                                    $('#model-enquire').modal('hide');
                                }
                            },
                        );
                    },error: function() {
                        grecaptcha.reset();
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong!",
                            type: "error",
                        }).then(
                            function (isConfirm) {
                                if (isConfirm) {
                                    $('#model-enquire').modal('hide');
                                }
                            },
                        );
                    },
                });

            }
        })
        function validateFormEnquire(){
            $('.error').html('');
            let i = 1;
            if($('.message').val() == ''){
                $('.errorMessage').html('{{trans('messages.require_message')}}');
                i = 0;
            }
            if($('.name').val() == ''){
                $('.errorName').html('{{trans('messages.require_name')}}');
                i = 0;
            }
            if($('.email').val() == ''){
                $('.errorEmail').html('{{trans('messages.require_email')}}');
                i = 0;
            }
            if($('.phone').val() == ''){
                $('.errorPhone').html('{{trans('messages.require_phone')}}');
                i = 0;
            }else {
                let isNumeric = /^\d+$/
                if ($('.phone').val() && !isNumeric.test($('.phone').val())) {
                    i = 1;
                    $('.errorPhone').html('{{trans('messages.error_number_phone')}}');
                    i = 0;
                } /*else {
                        let to_phone_arr = $('.customer_phone').val().split("");
                        if (Number(to_phone_arr[0]) !== 0) { //check first number
                            i = 1;
                            $('.errorPhone').html('Số điện thoại không đúng');
                        }
                        let lengthPhone = to_phone_arr.length;
                        if (lengthPhone !== 10) { //check
                            i = 1;
                            $('.errorPhone').html('Số điện thoại phải có 10 số');
                        }
                    }*/
            }
            if (grecaptcha && grecaptcha.getResponse().length > 0)  { //check recaptcha

            } else {
                $('.errorCaptcha').html('{{trans('messages.error_captcha')}}');
                i = 0;
            }
            if(i==0){
                return false;
            } else {
                return true;
            }
        }
    </script>
@endsection
