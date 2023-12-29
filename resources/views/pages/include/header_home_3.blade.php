<header>
    <style>
        .header-area{
            position: fixed;
            top:0;
            left: 0;
            padding: 1.3rem 10%;
            width: 100%;

            display: flex;
            z-index: 100;
            align-items: center;
            justify-content: space-between;
        }
        .header-area::before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: red;
            background: rgba(0,0,0,0.1);
            backdrop-filter: blur(50px);
            z-index: -1;
        }
        .header-area::after{
            content:'';
            position:absolute;
            top:0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,transparent,rgba(255,255,255,.4),transparent);
            transition: 0.5s;
        }
        .logo-img {
            width: 100px;
            display: block;
        }
        .logo-img img{
            width: 100%;
        }
        .navbar a{
            color: #FFFFFF;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.5rem;
            margin-left: 1.15rem;
            font-family: "Raleway",sans-serif!important;
        }
        .icons {
            position: absolute;
            right: 5%;
            font-size: 2.8rem;
            color: #FFFFFF;
            cursor: pointer;
            display: none;
        }
        @media (max-width: 992px) {
            .header{
                padding: 1.3rem 5%;
            }
        }
        @media (max-width: 768px){
            .icons{
                display: inline-flex;
            }
            #check:checked~.icons #menu-icon {
                display: none;
            }
            .icons #close-icon #menu-icon{
                display: none;
            }
            #check:checked~.icons #close-icon{
                display: block;
            }
            .navbar {
                position: absolute;
                top:100%;
                left: 0;
                height: 0;
                width: 100%;
                background: rgba(0,0,0,0.1);
                backdrop-filter: blur(50px);
                box-shadow:  0.5rem 1rem rgb(0,0,0,0.1);
                overflow: hidden;
                transition: 1s ease;
            }
            #check:checked~ .navbar {
                display: block;
                height: 17.7rem;
            }
           /* .navbar {
                display: block;
                font-size: 1.1rem;
                margin: 1.5rem 0;
                text-align: center;
                width: 100%;
                transform: translateY(-50px);
                transition: 1s ease;
            }*/
            /*#check:checked~ .navbar a{
                height: 17.7rem;
             }*/
            .navbar a {
                display: block;
                font-size: 1.1rem;
                margin: 1.5rem;
                text-align: center;
                transition: 1s ease;
            }
            #check:checked~.navbar a {
                transform: translateY(0);
                transition-delay: calc(.15s * var(--i));
            }
        }
        .icons #close-icon{
            display: none;
        }
    </style>
    <div class="header-area">
        <a class="logo-img" href="/">
            <img src="{{url('uploads/'.$logoBlack->items[0]->path_desktop)}}" alt="">
        </a>
        <input type="checkbox" id="check">
        <label for="check" class="icons">
            <i class="fa fa-bars" id="menu-icon"></i>
            <i class="fa fa-times" id="close-icon"></i>
        </label>
        <nav class="navbar">
            <a href="" style="--i:0;">Home</a>
            <a href="" style="--i:1;">About</a>
            <a href="" style="--i:2;">Shop</a>
            <a href="" style="--i:3;">Mindful travel</a>
        </nav>

    </div>
</header>
