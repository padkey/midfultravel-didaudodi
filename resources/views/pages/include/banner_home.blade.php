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
        width: 26%;
        margin-top: 50px;
        margin-left: 40px;

    }
    /*@media (max-width:2200px) {
        .logo-image {
            width: 26%;
            margin-top: 50px;
            margin-left: 40px;

        }
    }*/
    /* Tablet desktop :768px. */
    @media  (min-width: 700px) and (max-width: 993px) {
        .logo-image {
            width: 55%;
            margin:auto;
            margin-top: 80px;
        }
    }
    /* Mobile desktop :768px. */
    @media (min-width: 100px) and (max-width: 700px) {
        .logo-image {
            width: 100%;
            margin:auto;
            margin-top: 80px;

        }
    }

    /*@media  (min-height: 800px) and (max-height: 950px) {
        .logo-image {
            width: 23%;
            margin-top: 100px;
            margin-left: 40px;
        }
        .logo-top{
            margin-top: 100px;
        }
    }*/
    /*@media  (min-height: 500px) and (max-height: 700px) {
        .logo-image {
            width: 20%;
            margin-top: 80px;
            margin-left: 40px;
        }
        .logo-top{
            margin-top: 100px;
        }
    }*/
</style>
<div class="slider_area" style="margin-top:-13px;">
    <div class="slider_active owl-carousel">
        <div class="single_slider d-flex align-items-center  slider_bg_1">
            <div class="container" style="margin-top: 10px; ">
                <div class="logo-image logo-top">
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
