<style>
    #mainNavigation a {
        font-family: 'Cabin', sans-serif;
        font-size:14px;
        text-transform:uppercase;
        letter-spacing:2px;
        text-shadow:1px 1px 2px rgba(0,0,0,0.4)
    }

    .dropdown-menu {
        background:#03727d
    }
    a.dropdown-toggle {
        color:#dfdfdf !important
    }
    a.dropdown-item:hover {
        color:#03727d !important
    }
    .nav-item a{
        color:#dfdfdf;
    }
    .nav-item a:hover {
        color:#fff
    }
    .nav-item{
        min-width:12vw;
    }
    #mainNavigation {
        position:fixed;
        top:0;
        left:0;
        width:100%;
        z-index:123;
        padding-bottom:120px;
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#000000+0,000000+100&0.65+0,0+100;Neutral+Density */
        background: -moz-linear-gradient(top,  rgba(0,0,0,0.65) 0%, rgba(0,0,0,0) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#00000000',GradientType=0 ); /* IE6-9 */
    }
    #navbarNavDropdown.collapsing .navbar-nav,
    #navbarNavDropdown.show .navbar-nav{
        background:#037582;
        padding:12px;
    }

    .logo-img {
        width: 100px;
        display: block;
    }
    .logo-img img{
        width: 100%;
    }
</style>
<div id="mainNavigation">
    <nav role="navigation">
        <div class="py-3 text-center border-bottom">
            <a class="logo-img" href="/">
                <img src="{{url('uploads/'.$logoBlack->items[0]->path_desktop)}}" alt="">
            </a>
        </div>
    </nav>
    <div class="navbar-expand-md">
        <div class="navbar-dark text-center my-2">
            <button class="navbar-toggler w-75" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> <span class="align-middle">Menu</span>
            </button>
        </div>
        <div class="text-center mt-3 collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"> Fabio Cappiello</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Sản Phẩm Của Chúng Tôi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Liên Hệ</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"> Du Lịch Chánh Niệm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Thực Hành Chánh Niệm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên Hệ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Shop
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Blog</a></li>
                        <li><a class="dropdown-item" href="#">About Us</a></li>
                        <li><a class="dropdown-item" href="#">Contact us</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
