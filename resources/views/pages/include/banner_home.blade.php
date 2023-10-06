<style>
    .slider_bg_1{
        background-image: url("uploads/{{$bannerHomeImage->items[0]->path_desktop}}");
    }
    .slider_bg_2{
        background-image: url("frontend/images/tnh12.png");
    }
    .single_slider {
        /* height: 90vh!important; */
    }
    .slider_text h1{
        color:white;
    }
    .owl-carousel .owl-item img {

    }
    .logo-img{
        width: 550px!important;

    }
    @media (max-width:1900px) {
        .logo-img {
            width: 400px!important;
            margin: auto;
        }
    }

</style>
<div class="slider_area" style="margin-top:-13px;">
    <div class="slider_active owl-carousel">
        <div class="single_slider d-flex align-items-center  slider_bg_1">
            <div class="" style="margin-top: 90px; ">
                <div class="row">
                    <div class="col-xl-3">

                    </div>
                    <div class="col-xl-5">
                        <div class="logo-img">
                            <a href="/">
                                <img src="{{url('uploads/'.$logoWhite->items[0]->path_desktop)}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-xl-3">

                </div>
                <div class="col-xl-5">
                        <div class="logo-img">
                            <a href="/">
                                <img src="{{url('uploads/'.$sloganImage->items[0]->path_desktop)}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="single_slider  d-flex align-items-center justify-content-center slider_bg_2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <h3>You deserve to be happy</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
