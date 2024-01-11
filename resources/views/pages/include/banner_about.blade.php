<style>
    .breadcam_bg_1{
        /*background-image: url("frontend/images/banner2.png");
*/
    }
    .logo-img {
    }
    .about-page-logo {
       justify-content:center;
       display:flex;

    }
    .about-page-area{
        /*height: 48vh;*/
        align-items:center!important;
        display:flex!important;
        width: 90%;
        margin: auto;
    }
    .logo-img{
        width: 75%;
        margin: auto;
        margin-bottom: 40px;
        margin-top: 40px;
    }
    .logo-img img{
        width: 100%;
        max-width: 500px;
    }
    @media (max-width: 800px) {
        .about-page-area {
            margin: auto;
        }
    }

</style>
<div class="about-page-area ">
    <div class="about-page-logo">
        <div class="logo-img">
            <a href="/">
                <img src="{{url('uploads/'.$logoBlack->items[0]->path_desktop)}}" alt="">
            </a>
        </div>
    </div>
</div>


