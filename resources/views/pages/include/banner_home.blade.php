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
    .logo-image{
        width: 30%;
    }
    @media (max-width:1900px) {
        .logo-image {
            width: 30%;
        }
    }
    /* Tablet desktop :768px. */
    @media  (min-width: 768px) and (max-width: 993px) {
        .logo-image {
            width: 50%;
            margin:auto;
        }
    }
    /* Mobile desktop :768px. */
    @media (min-width: 100px) and (max-width: 700px) {
        .logo-image {
            width: 100%;
            margin:auto;

        }
    }
</style>
<div class="slider_area" style="margin-top:-13px;">
    <div class="slider_active owl-carousel">
        <div class="single_slider d-flex align-items-center  slider_bg_1">
            <div class="container" style="margin-top: 10px; ">
                <div class="logo-image">
                    <a href="/">
                        <img src="{{url('uploads/'.$logoWhite->items[0]->path_desktop)}}" alt="">
                    </a>
                </div>
                <div class="logo-image">
                    <a href="/">
                        <img src="{{url('uploads/'.$sloganImage->items[0]->path_desktop)}}" alt="">
                    </a>
                </div>
                {{--<div class="row">
                    <div class="col-xl-1">

                    </div>
                    <div class="col-xl-4">

                    </div>
                    <div class="col-xl-4">

                    </div>
                </div>
                <div class="row">
                <div class="col-xl-1">

                </div>
                <div class="col-xl-4">

                    </div>
                    <div class="col-xl-4">

                    </div>
                </div>--}}
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
