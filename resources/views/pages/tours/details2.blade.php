@extends('frontend_layout')
@section('header')
    @include('pages.include.header_about')
@endsection
@section('banner')
    @include('pages.include.banner_tour')
@endsection
@section('content')
<style>

    @keyframes rotateMenu {
        0% {
        transform: rotateX(-90deg)
        }
        70% {
        transform: rotateX(20deg)
        }
        100% {
        transform: rotateX(0deg)
        }
    }

    .decs-schedule {
        padding: 15px 25px 15px 25px;
        animation: rotateMenu 900ms ease-in-out forwards;
        transform-origin: top center;
    }
    .dis-none{
        display:none;
    }
    .dis-block{
        display:block;
    }
    .title-schedule{
        cursor: pointer;
        border: 1px solid #ffff;
        background: rgba(250, 241, 235, 0.71);
        margin-top:2px;
        padding: 15px 15px 15px 25px;
        border-radius:5px;
        display:grid;
        grid-template-columns: 85% 15%;
        transition: 1s;
    }
    .title-schedule:hover{
        border: 1px solid #c5c5c5;
    }
    .title-schedule  span {
        font-family: sans-serif!important;
        font-weight: 600;
        font-size:20px;
        font-style: normal;
        color: #2b2b2b;
    }
    .title-schedule-open{
        border: 1px solid #FFFFFF;
        background: #024f43;
        font-weight: 400;
    }
    .title-schedule-open span{
        color: #fff!important;
    }
    .down-up-action{
        float:right;
        margin-left:auto;
        margin-top: auto;
        margin-bottom: auto;
        transition:0.5s;
    }
    .icon-open{
        background: url('/frontend/images/down-up3.png');
        background-size: 35px;
        width: 35px;
        height: 35px;

    }
    .icon-close{
        background: url('/frontend/images/down-up2.png');
        transform: rotate(-180deg);
        background-size: 35px;
        width: 35px;
        height: 35px;
    }
   /* .overview-area {
        margin-top: 100px;
    }*/
   /* .container{
        width:70%;
        margin:auto;
    }*/
    @media (max-width: 800px) {
        /*.container{
            width:95%;
            margin:auto;
        }*/
        .hightlight-underline-white::before  {
            content: "";
            position: absolute;
            bottom: -10px;
            height: 1px;
            width: 80%!important;
            margin: 0 auto 0 10%!important;
            display: block;
        }
        .hightlight-underline-green::before  {
            content: "";
            position: absolute;
            bottom: -10px;
            height: 1px;
            width: 80%!important;
            margin: 0 auto 0 10%!important;
            display: block;
        }
    }
    .section-icon{
        text-align: center;
        margin: auto;

        position: relative;
    }
    .section-icon img{
        border-radius: 50%;
        margin-bottom: 10px;
    }
    .cacdiemden{
        font-size: 18px;
        text-align: center;
    }

    .short_desc  {
        text-align: center;
        font-size: 24px!important;

    }
    .short_desc  p{
        font-size: 24px!important;
    }
    .short_desc  span {
        font-size: 24px!important;

    }
    .cacdiemden{
        font-size: 24px;

    }
    .highlight-area {
        padding-bottom: 150px;
        margin-top: 80px;
    }
    .bg-pink-1{
        background: #faf1eb!important;
    }

    .c_margin{
        margin-top: auto;
        margin-bottom: auto;
    }
    .title-center{
        text-align: center;
        margin-top: 5px;
        margin-bottom: 35px;
    }
    .title-center h1 {
        font-size: 45px;
    }
    .mt-100{
        margin-top:100px;
    }
    .hightlight-underline-white {
        text-transform: uppercase;
        padding-bottom: 10px;
        display: inline-block;
        position: relative;
    }
    .hightlight-underline-white::before {
        content: "";
        top: -5px;
        width: 80%;
        position: absolute;
        margin: 0 10%;
        border-bottom: 3px solid #fff;
    }

    .hightlight-underline-green {
        text-transform: uppercase;
        padding-bottom: 10px;
        display: inline-block;
        position: relative;
    }
    .hightlight-underline-green::before {
        content: "";
        top: -5px;
        width: 80%;
        position: absolute;
        margin: 0 10%;
        border-bottom: 3px solid #024f43;
    }
    .single-gallery-image{
        height: 300px;
    }
    .mb-10{
        margin-bottom: 10px;
    }
    .mb-20{
        margin-bottom: 20px;
    }
</style>
	<!-- Start Sample Area -->
	<{{--section class="sample-text-area">
		<div class="container box_1170">
			<h3 class="text-heading">Chuyến đi cộng đồng khám phá đất nước sau chiến tranh</h3>
			<p class="sample-text">
Một chuyến đi du lịch có trách nhiệm coi cuộc gặp gỡ với người dân địa phương là thời điểm trung tâm của trải nghiệm du lịch, khiến chuyến đi trở thành cơ hội không thể bỏ qua để so sánh các nền văn hóa khác nhau, tìm hiểu những dân tộc khác, truyền thống, thói quen và phong tục của họ, với quan điểm về văn hóa. trao đổi. Hơn nữa, đây còn là cơ hội để hiểu sâu hơn về một nền văn hóa khác với nền văn hóa của mình, tiếp xúc trực tiếp với thực tế xã hội của một đất nước, những khó khăn, bi kịch và hy vọng thay đổi của nó.
“Gặp Việt Nam, hành trình cộng đồng khám phá đất nước ngoài chiến tranh” là trải nghiệm đưa du khách tìm hiểu về lịch sử và tinh thần của một dân tộc chống lại bộ máy quân sự hung hãn của Mỹ nửa sau thế kỷ 20, và thậm chí trước cả cuộc xâm lược của Pháp, Trung Quốc và Mông Cổ. Bằng cách đấu tranh, người dân Việt Nam đã giữ được nền văn hóa ngàn năm vẫn còn tồn tại cho đến ngày nay trong gia đình, trong các tu viện Phật giáo trên núi và trong sự đa dạng của các dân tộc gồm 53 nhóm khác nhau. Chính trong sự đa dạng này, chúng ta sẽ "vượt ra ngoài chiến tranh", để khám phá và hiểu những điểm giao thoa văn hóa rất hấp dẫn về mặt con người: chúng ta sẽ ở bên các gia đình, chúng ta sẽ hiểu rõ hơn về những người nông dân, chúng ta sẽ đắm mình vào những vấn đề hàng ngày liên quan đến phần lớn người dân Việt Nam, chúng ta sẽ tập Thái Cực Quyền, và chúng ta sẽ đến thăm những địa điểm linh thiêng mà Thiền sư vĩ đại "Thích Nhất Hạnh", ứng cử viên giải Nobel Hòa bình, thường xuyên lui tới vì hoạt động chống lại chiến tranh ở Việt Nam, qua đời vào ngày 22 tháng 1 năm 2022, để cùng tham dự các buổi lễ và thực hành tâm linh cùng với các đệ tử của mình. Chúng tôi cũng sẽ đến thăm những "cảnh quan hoàn hảo về mặt hình học" rất nổi tiếng do các đồn điền trồng lúa tạo ra và chúng tôi sẽ đến thăm các dự án nhỏ của các tổ chức phi chính phủ, có giá trị cấu trúc và kinh tế xã hội to lớn cho nhiều cộng đồng và các nhóm dân tộc nhỏ. Ứng cử viên giải Nobel Hòa bình vì hoạt động chống chiến tranh ở Việt Nam, đã qua đời vào ngày 22 tháng 1 năm 2022, để cùng tham dự các buổi lễ và thực hành tâm linh cùng với các đệ tử của mình. Chúng tôi cũng sẽ đến thăm những "cảnh quan hoàn hảo về mặt hình học" rất nổi tiếng do các đồn điền trồng lúa tạo ra và chúng tôi sẽ đến thăm các dự án nhỏ của các tổ chức phi chính phủ, có giá trị cấu trúc và kinh tế xã hội to lớn cho nhiều cộng đồng và các nhóm dân tộc nhỏ. Ứng cử viên giải Nobel Hòa bình vì hoạt động chống chiến tranh ở Việt Nam, đã qua đời vào ngày 22 tháng 1 năm 2022, để cùng tham dự các buổi lễ và thực hành tâm linh cùng với các đệ tử của mình. Chúng tôi cũng sẽ đến thăm những "cảnh quan hoàn hảo về mặt hình học" rất nổi tiếng do các đồn điền trồng lúa tạo ra và chúng tôi sẽ đến thăm các dự án nhỏ của các tổ chức phi chính phủ, có giá trị cấu trúc và kinh tế xã hội to lớn cho nhiều cộng đồng và các nhóm dân tộc nhỏ.
Kết thúc chuyến đi, chúng ta còn có cơ hội thư giãn trên những bãi biển tuyệt vời của Việt Nam để tái tạo cơ thể và tinh thần trước khi trở lại cuộc sống thường ngày.
			</p>
		</div>
	</section>--}}
	<!-- End Sample Area -->
     <div class="overview-area">
         <div class="container mb-65">
                 <div class="section-icon">
                     <img src="{{url('/frontend/images/kinh-lup.png')}}" alt="">
                     <div class="title-center">
                         <h1 class="hightlight-underline-green">OVERVIEW</h1>
                     </div>
                 </div>
                 <div class="cacdiemden">
                     {!! $tour->place_overview !!}
                 </div>


             <div class="row images-overview owl-six owl-theme owl-carousel">
                 @foreach($tour->image as $image)
                     <div >
                         <a href="{{url('/uploads/'.$image)}}" class="img-pop-up">
                             <div class="single-gallery-image" style="background: url('/uploads/{{$image}}');"></div>
                         </a>
                     </div>
                 @endforeach
             </div>

             <div class="short_desc mt-30">
                 {!! $tour->short_description !!}
             </div>
         </div>
     </div>
<style>
    .image-l img{
        width: 100%;
        max-height: 450px;
        object-fit: cover;
    }
    .image-l{
        margin-bottom: 10px;
    }
    .content-trip{
        align-items: center;
        justify-content: center;
    }

</style>
    <div class="highlight-area bg-pink-1 mt-100 ">
        <div class="section-icon" style="top:-45px">
            <img src="{{url('/frontend/images/hightlight.png')}}" alt="">
            <div class="title-center">
                <h1 class="hightlight-underline-white" >TRIP HIGHLIGHTS</h1>
            </div>

        </div>

        <div class="container">
            <div class="row content-trip">
                <div class="col-xl-6 col-lg-11 image-l">
                    <img src="{{url('/uploads/'.$tour->image_trip_highlights)}}" alt="">
                </div>
                <div class="col-xl-6 col-lg-11 c_margin">
                    {!! $tour->trip_highlights !!}
                </div>
            </div>
        </div>

    </div>
    <style>

        #map{
            width: 100%;
            height:500px;
        }
        .marker {
            background-image: url('/frontend/images/position5.png');
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }
        .mapboxgl-popup {
            max-width: 200px;
        }
        .mapboxgl-popup-content {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
        }
        .green-2{
            color: #024f43;
            font-style: normal;
            font-weight: 600;
            font-family: "Raleway", sans-serif!important;
            font-size: 18px!important;

        }
        .img-subtitle{
            width: 50px;
            height: 50px;
        }
        .img-subtitle img{
            width: 40px;
            height: 40px;
        }
        .decs-schedule p {
            font-family: 'Open Sans', sans-serif!important;
            font-size: 16px!important;
        }
    </style>
    <div class="schedule-area mt-100">
        <div class="container">
            <div class="section-icon">
                <img src="{{url('/frontend/images/kinh-lup.gif')}}" alt="" style="border-radius: 0">
                <div class="title-center">
                    <h1 class="hightlight-underline-green">LỊCH TRÌNH</h1>
                    <h2>{{$tour->name}}</h2>
                </div>
            </div>
            <div id='map'></div>
            <div>
                @foreach($tour->tourSchedule as $key => $schedule)
                    <div class="schedule-day-{{$schedule->id}}">
                        <div class="title-schedule" data-id="{{$schedule->id}}" data-position="{{$schedule->position}}">
                            <span>{{$schedule->title}}</span> <span class="icon-close icon-action-{{$schedule->id}} down-up-action">   </span>
                        </div>
                        <div class="content-schedule-{{$schedule->id}} dis-none decs-schedule mt-20 mb-20">
                            <h4 class="green-2 font-bold mb-20"><span class="img-subtitle"><img src="{{url('/frontend/images/position7.png')}}" alt="" ></span>{{$schedule->sub_title}}</h4>
                            {!! $schedule->description !!}
                        </div>
                    </div>

                @endforeach
                <input type="hidden" class="region" value="{{$tour->region}}">
            </div>
        </div>
    </div>

    <div class="important-info-area mt-100">
    <div class="container">
        <div class="section-icon">
            <img src="{{url('/frontend/images/kinh-lup-ds.gif')}}" alt="" style="border-radius: 0px">
            <div class="title-center">
                <h1 class="hightlight-underline-green">IMPORTANT INFORMATION</h1>
            </div>
        </div>

        <div class="schedule-day-1">
            {!! $tour->important_information !!}
        </div>

    </div>
</div>

<!-- companion -->
<style>
    .companion-container{
        width: 85%;
        margin: auto;
    }
    .companion-area{
       /* padding: 0;*/
        /*margin: 0;*/
        box-sizing: border-box;
        font-family: Poppins;
        loading:"lazy";
        /*padding-top: 10px;*/
        padding-bottom: 100px;
    }
    .team-profile{
        max-width: 1200px;
        margin: auto;
        /*display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;*/
    }
    .profile-card{
        position: relative;
        width: 280px;
        height: 280px;
        background-color: #fff;
        padding: 30px;
        /**/border-radius: 10%;
        box-shadow: -5px 8px 45px rgba(51, 51, 51, 0.126);
        transition: all .4s;
        margin: 50px 0px;

    }
    @media (max-width: 1750px) and (min-width: 1620px) {
        .profile-card{
            width: 250px;
            height: 250px;
        }
        .profile-card .img img{
            height: 200px;
        }
    }

    @media (max-width: 1420px) {
        .profile-card{
            width: 250px;
            height: 250px;
        }
        .profile-card .img img{
            height: 200px;
        }
    }
    @media (max-width: 1280px) and (min-width: 1190px) {
        .profile-card{
            width: 220px;
            height: 220px;
        }
        .profile-card .img img{
            height: 165px;
        }
        .profile-card .caption{
            transform: translateY(-265px);
        }
        .profile-card  .desc-companion{
            -webkit-line-clamp: 13;
        }
    }
    @media (max-width: 1190px) and (min-width: 1100px) {
        .profile-card{
            width: 280px;
            height: 280px;
        }
        .profile-card .img img{
            height: 220px;
        }
    }
    @media (max-width: 1100px) and (min-width: 900px) {
        .profile-card{
            width: 250px;
            height: 250px;
        }
        .profile-card .img img{
            height: 200px;
        }
    }
    @media (max-width: 970px) and (min-width: 890px) {
        .profile-card{
            width: 220px;
            height: 220px;
        }
        .profile-card .img img{
            height: 165px;
        }
        .profile-card .caption{
            transform: translateY(-265px);
        }
        .profile-card  .desc-companion{
            -webkit-line-clamp: 13;
        }
    }
    @media (max-width: 890px) and (min-width: 730px) {
        .profile-card{
            width: 280px;
            height: 280px;
        }
        .profile-card .img img{
            height: 220px;
        }
    }
    @media (max-width: 730px) and (min-width: 660px) {
        .profile-card{
            width: 250px;
            height: 250px;
        }
        .profile-card .img img{
            height: 200px;
        }
    }
    @media (max-width: 660px) and (min-width: 599px) {
        .profile-card{
            width: 220px;
            height: 220px;
        }
        .profile-card .img img{
            height: 165px;
        }
        .profile-card .caption{
            transform: translateY(-265px);
        }
        .profile-card  .desc-companion{
            -webkit-line-clamp: 12;
        }
    }
    @media (max-width: 599px) {
        .profile-card{
            width: 250px;
            height: 250px;
            margin: auto;
            margin-top: 50px;
            margin-bottom: 50px;

        }
        .profile-card .img img{
            height: 200px;
        }
    }
    .profile-card:hover{
        border-radius: 10px;
        height: 500px;
    }
    .profile-card .img{
        position: relative;
        width: 100%;
        height: 100%;
        transform: translateY(-80px);
        border-radius: 50%;
        background: #fff;

    }
    .profile-card:hover img{
        border-radius: 10px;
    }
    .img img{
        width: 100%;
        border-radius: 50%;
        transition: all .4s;
        z-index: 99;
        height: 220px;
        object-fit: cover;
    }
    .caption{
        transform: translateY(-210px);
        opacity: 0;
        pointer-events: none;
        transition: all .5s;
    }
    .profile-card:hover .caption{
        opacity: 1;
        pointer-events: all;
    }

    .name-companion {
        text-align: center;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .name-companion h3{
        font-size: 25px;
        color: #8B572A;
        /*
        font-weight: 600;
        */
    }
    .caption p{
        font-size: 17px;
        font-weight: 500;
        margin: 2px 0 12px 0;
    }
    .caption .social-links i:hover{
        color: #0c52a1;
    }
    .desc-companion {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 10;
        -webkit-box-orient: vertical;
    }
    .title-companion{
        text-align: center;
        margin-top: 50px;
        margin-bottom: 40px;

    }
    .title-companion h1 {
        color: #8b572a;
    }
    .owl-carousel .owl-stage-outer {
        /*overflow: inherit;*/
    }
    .mt-180{
        margin-top:180px;
    }
</style>
<div class="companion-area bg-pink-1 mt-180">
    <div class="section-icon" style="top:-45px;">
        <img src="{{url('/frontend/images/companion.png')}}" alt="" ">
        <div class="title-center">
            <h1 class="hightlight-underline-white" >{{trans('messages.companions')}}</h1>
        </div>
    </div>
    {{--<div class="title-companion ">
        <img src="{{url('/frontend/images/partnership.png')}}" alt="" style="border-radius:0px;">
        <h1 class="hightlight-underline-white" >{{trans('messages.companions')}}</h1>
    </div>--}}
    <div class="companion-container">

        <div class="team-profile owl-five owl-carousel  owl-theme">
            @if($companions != null)
                @foreach($companions as $companion)
                    <div class="profile-card">
                        <div class="img">
                            <img src="{{url('uploads/'.$companion->avatar)}}" alt=""  >
                            <div class="name-companion">
                                <h3>{{$companion->name}}</h3>
                            </div>
                        </div>
                        <div class="caption">
                            <div class="desc-companion">
                                {!! $companion->content !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<style>
    .image-partner{
       /* position: relative;*/
    }
    .details-partner{
        position: relative;
    }
    .show-details-partner{
        display:none;
    }
    .details-partner:hover .desc-partner{
        opacity: 100%;

    }
    .desc-partner{
        position: absolute;
        bottom:0px;
        background: black;

        opacity: 80%;
        width: calc(100% );
        padding: 0 0 0 10px;
        transition:0.5s;
    }
    .desc-partner h2{
        color: #FFFFFF;
    }
    .desc-partner p{
        color: #FFFFFF;
    }
    .image-partner img{
        width: 100%;
        object-fit: cover;
    }

    .mt-20 {
        margin-top:20px;
    }
</style>
<div class="partner-area mt-100">
    <div class="container">
        <div class="section-icon">
            <img src="{{url('/frontend/images/partnership.png')}}" alt="" style="border-radius:0px;">
            <div class="title-center">
                <h1 class="hightlight-underline-green">PartnerShip</h1>
            </div>
        </div>

        <div class="row">
            @foreach($tour->partnershipBranch as $partnershipBranch)
            <div class="col-md-6 mt-20">
                <a href="/partnership-branch/{{$partnershipBranch->url}}" class="details-partner ">
                    <div class="image-partner" >
                        <img src="{{url('/uploads/'.$partnershipBranch->image)}}" alt=""  style="">
                    </div>
                    <div class="desc-partner">
                        <h2>{{$partnershipBranch->name}}</h2>
                        <p>Address : {{$partnershipBranch->address}}</p>
                    </div>
                </a>
            </div>
            @endforeach
            {{--<div class="col-md-6 mt-20">
                <a href="" class="details-partner">
                    <div class="image-partner" >
                        <img src="{{url('/frontend/images/m5.jpg')}}" alt=""  style="">
                    </div>
                    <div class="desc-partner">
                        <h2>Iuteressere Monastery</h2>
                        <p>Chi nhanh : Lieu dit Le Pey</p>
                    </div>
                </a>
            </div>
        </div>--}}

    </div>
</div>
    <style>
        .contact{

        }
        .modal-header{
            background-color: #80b157;
        }
        .modal-title{
            color: white;
        }
        .title-contact{
            max-width:800px;
            margin: auto;
        }
    </style>
<div class="contact mt-180 bg-pink-1">
    <div class="container">
        <div class="section-icon">
            <img src="{{url('/frontend/images/message1.png')}}" alt="" style="border-radius:0px; top: -45px">
            <div class="title-center" style=" margin-bottom: 0px;">
                <h1 class="hightlight-underline-green">GET IN TOUCH</h1>
                <h2 class="title-contact">We love to talk travel. If you have any questions, please don't hesitate to get in touch. We're here to help!</h2>
                <button type="button" class="btn btn-shop mt-20" data-toggle="modal" data-target="#exampleModalCenter">
                    Enquire
                </button>
            </div>
        </div>
    </div>
</div>
{{--  <div class="book_btn d-none d-lg-block">
      <a href="#test-form" class="popup-with-form">Requỉe</a>
  </div>--}}
<!-- end-companion -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h1 class="modal-title" id="exampleModalLongTitle">Contact Us</h1>
                        <p class="modal-title">
                            We're experts who take pride in tailor-made itineraries that suit any need. Please fill in the form below and a member of our team will be in touch shortly.
                        </p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="row mt-20">
                            <div class="col-xl-6">
                                <input  class="form-control" placeholder="Name">
                            </div>
                            <div class="col-xl-6">
                                <input class="form-control"  placeholder="Phone">
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-xl-6">
                                <input class="form-control" placeholder="Email">
                            </div>

                        </div>
                        <div class="row mt-20">
                            <div class="col-xl-12">
                                <textarea class="form-control" placeholder="Message"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer mt-30">
                    <button type="button" class="btn btn-shop">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidG9hbmNodW9uZyIsImEiOiJjbG80MG9zOXkwbWthMm11ZGFtcXFvdTZlIn0.VBX96EkqFGqhVwBrwSpw8A';
        // Mã jQuery xử lý sau khi trang đã tải xong
        var features = @php echo $geojson;@endphp;

        features = JSON.stringify(features);
        features = JSON.parse(features);

        const geojson = {
            'type': 'FeatureCollection',
            'features':features.features
        };
        //console.log( geojson.features);
        let region = $('.region').val();
        let center= [102.084961,3.557283];
        if(region == 'Asia'){
            center = [102.084961,3.557283]
        } else if (region == 'The Americas') {

        } else if (region == 'Africa') {

        } else if (region == 'Europe') {

        } else if (region == 'Oceania') {

        }

        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [ 106.65957339778778,10.82464603273621], // starting position [lng, lat]
           // projection:'globe',
          //  projection: 'globe',

            zoom: 2
        });


            // add markers to map
        for (const feature of geojson.features) {
            // create a HTML element for each feature
            const el = document.createElement('div');
            el.className = 'marker';

            // make a marker for each feature and add it to the map
            new mapboxgl.Marker(el)
                .setLngLat(feature.features.geometry.coordinates)
                .setPopup(
                    new mapboxgl.Popup({ offset: 25 }) // add popups
                        .setHTML(
                      //   `<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`
                        )
                )
                .addTo(map);
        }

        $('.title-schedule').click(function(){
            let position = $(this).data('position');
            position = position.split(',');
            let lng = parseFloat(position[1]);
            let lat = parseFloat(position[0]);
           // console.log(position)

            // change color title end show description
            let id = $(this).data('id');
            if ($('.content-schedule-'+id).hasClass('dis-none')) {  // none => block
                // cho map di chuyển tới tọa độ
                map.flyTo({
                    center: [lng,lat], // Tọa độ vị trí cần zoom
                    zoom: 13 // Mức độ zoom cho vị trí cần zoom
                });
                // đổi màu và show nội dung
                $('.content-schedule-'+id).removeClass('dis-none');
                $('.content-schedule-'+id).addClass('dis-block');
                $(this).addClass('title-schedule-open');
                $('.icon-action-'+id).removeClass('icon-close');
                $('.icon-action-'+id).addClass('icon-open');

            } else {
                map.flyTo({
                    center: [lng,lat], // Tọa độ vị trí cần zoom
                    zoom:2 // Mức độ zoom cho vị trí cần zoom
                });
                // đổi màu và ẩn nội dung
                $('.content-schedule-'+id).addClass('dis-none');
                $('.content-schedule-'+id).removeClass('dis-block');
                $(this).removeClass('title-schedule-open');
                $('.icon-action-'+id).removeClass('icon-open');
                $('.icon-action-'+id).addClass('icon-close');
            }
        })


        var owl6 = $('.owl-six');
        owl6.owlCarousel({
            items:3,
            loop:true,
            nav:true,
            margin:10,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
            autoplay:true,
            autoplayTimeout:1500,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,

                    nav:true,
                    loop:true,
                },
                600:{
                    items:2,
                    nav:true,
                    loop:true
                },

                890:{
                    items:3,
                    nav:true,
                    loop:true

                },
                1190:{
                    items:3,
                    nav:true,
                    loop:true
                },
                1620:{
                    items:3,
                    nav:true,
                    loop:true
                },
                /*2000:{
                    items:5,
                    nav:true,
                    loop:false
                }*/
            }
        });
    </script>
@endsection
