<style>
    .breadcam_bg_1{
        background-image: url("frontend/images/banner2.png");

    }
    .about-page-logo {
       justify-content:center;
       display:flex;

    }
    .about-page-area{
        height: 48vh;
        align-items:center!important;
        display:flex!important;
        /* justify-content:center; */
    }
    .logo-img{
        width: 80%;
        margin: auto;
    }
    .logo-img img{
        width: 100%;
    }
</style>
<div class="about-page-area row">
    <div class="col-xl-1">

    </div>
    <div class="col-xl-4 about-page-logo">
        <div class="logo-img">
            <a href="/">
                <img src="{{url('uploads/'.$logoBlack->items[0]->path_desktop)}}" alt="">
            </a>
        </div>
    </div>


</div>


