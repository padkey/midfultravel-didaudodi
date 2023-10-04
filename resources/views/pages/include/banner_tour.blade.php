<style>
    .about-page-logo {
        padding: 170px;
        background-size: cover;
        padding: 120px 0px 60px 188px;
    }
    .title-package{
    margin-top:50px;
    }
    .title-package h3{
    font-weight: 900;
    font-size: 60px;
    color: #fff;
    }
    .banner_package{
    background-image: url("/uploads/{{$tour->image_thumbnail}}");
    background-size: cover;
    background-position: center center;
    /* text-align: center; */
    padding: 120px 0 50px 0;
    margin:auto;
    }

    .event-label{
    display: inline-block;
    background: #222;
    text-transform: uppercase;
    border-radius: 3px;
    padding: 0 6px;
    color: white;
    margin: 0 5px 6px 0;
    font-weight: 600;
    font-size: 30px;
}
.trangthai-open{
    background: #8b572a!important;
}
.trangthai-close{
    background: black!important;
}
.date-start-end{
    font-weight: 900;
    font-size: 35px;
    color: #fff;
}
.container-package{
    max-width: 1200px;
    margin: auto;
}
</style>
<div class="banner_package bradcam_area breadcam_bg">
    <div class="container-package">
        <div class="logo-img">
            <a href="/">
                <img src="{{url('frontend/images/nlw.png')}}" alt="">
            </a>
        </div>
        <div class="title-package">
            @php
            $date = date_create($tour->date_start);
            $date_start= date_format($date, 'd/m/Y');
            $date = date_create($tour->date_end);
            $date_end= date_format($date, 'd/m/Y');
            @endphp
            <p><span class="event-label trangthai-open">ĐĂNG KÝ MỞ</span> <span class="event-label"> {{$tour->type_tour}}</span></p>
            <p class="date-start-end">{{$date_start}} - {{$date_end}}</p>
            <h3 class="">{{$tour->name}}</h3>
        </div>
    </div>
</div>
