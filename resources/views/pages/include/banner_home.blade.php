<style>
    .slider_bg_1{
        background-image: url("uploads/{{$bannerHomeImage->items[0]->path_desktop}}");
        /*width:100%;*/
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
    .logo-top{
       width: 480px;
        margin-left: 10px;
    }

    .logo-top img{
        width: 100%;
    }
    .logo-image{
        /*margin-top: 50px;*/
        /*margin-left: 40px;*/
        /*filter: blur(5px);*/
/*        opacity: 0;
        filter: blur(5px);
       !*transform: translateY(100%);*!
        transition: all 2s;*/

    }
    .logo-bottom{
        /*margin: auto;*/
        width: 400px;
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
            /*
            width: 55%;
            */
            margin:auto;
           /* margin-top: 80px;*/
            max-width: 350px;
        }

    }
    /* Mobile desktop :768px. */
    @media (min-width: 100px) and (max-width: 700px) {
        .logo-image {
            /*width: 100%;*/
            margin:auto;
            /*margin-top: 80px;*/
            max-width: 350px;

        }
    }

    @media  (min-height: 800px) and (max-height: 950px) {
        .logo-image {
           /* width: 100%;*/
            /*margin-top: 100px;*/
            margin-left: 40px;
        }
        .logo-top{
            margin-top: 100px;
        }
    }
    @media  (min-height: 500px) and (max-height: 750px) {
        .logo-image {
            /*margin-top: 80px;*/
            margin-left: 40px;
        }
        .logo-top{
            width: 350px;
            margin-top: 100px;
        }
        .logo-bottom{
            width: 300px;
        }
    }
    @media(max-width: 1206px) {
        .logo-image {
            margin: auto;
        }
    }

</style>
<div class="slider_area" style="margin-top:-13px;">
    <div class="slider_active owl-three owl-carousel owl-theme">
        <div class="single_slider d-flex align-items-center  slider_bg_1">
            <div class="container" style="margin-top: 10px; ">
                 <div class=" logo-top logo-image wow fadeIn" data-wow-delay="0.1s">
                     <a href="/">
{{--
                         <img src="{{url('uploads/'.$logoWhite->items[0]->path_desktop)}}" alt="">
--}}
                         <img src="{{url('uploads/'.$logoWhite->items[0]->path_desktop)}}" alt="">
{{--
                         <h1 style="color: white; font-size:80px;">Didaudodi <br> Mindful Travel - DMT</h1>
--}}
                    </a>
                </div>
               <div class="logo-image logo-bottom wow fadeIn" data-wow-delay="0.2s">
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
