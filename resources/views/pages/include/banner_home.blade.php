<style>
    .slider_bg_1{
        background-image: url("frontend/images/k3.jpg");
    }
    .slider_bg_2{
        background-image: url("frontend/images/tnh12.png");
    }    
    .single_slider {
        height: 90vh!important;
    }
    .slider_text h1{
        color:white;
    }
    .owl-carousel .owl-item img {
       
    }
</style>
<div class="slider_area">
    <div class="slider_active owl-carousel">
        <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
            <div class="container" style="margin-top: -10px;">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="logo-img">
                            <a href="/">
                                <img src="{{url('frontend/images/nl1.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-5">
                        <div class="slider_text text-left">
                          <!-- <h2>{{trans('messages.slogan')}}</h2>  -->
                          <h1 >"Save the Environment and you will Save the Life and Future."</h1>
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