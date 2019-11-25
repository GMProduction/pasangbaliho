<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/skin.css')}}">
    <link rel="stylesheet" href="{{asset('css/padding.css')}}">
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropdown.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/index.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/dropdown.js')}}"></script>
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>

    <style>
        .menu li:hover {
            /* background-color: darkgray; */

        }
    </style>
</head>

<body id="wrapper">

    <section id="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-7 top-header-links">
                    <ul class="contact_links">
                        <li><i class="fa fa-phone"></i><a href="#">+91 848 594 5080</a></li>
                        <li><i class="fa fa-envelope"></i><a href="#">sales@aspiresoftware.in</a></li>
                    </ul>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5 social">
                    <ul class="social_links">
                        <li><a href="#"><i class="fab fa-facebook  "></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fab fa-skype"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        </div>

    </section>

    <header>
        <nav class="navbar navbar-inverse" style="">
            <div class="container">
                <div class="row">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">
                            {{-- <h1>Baliho</h1><span>Baliho Solutions</span> --}}
                            <img src="{{asset('assets/img/pasangbaliho.png')}}" class="imgLogo" alt="" height="40">
                        </a>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse navbar-right">
                        <ul class="nav navbar-nav">
                            <li id="navhome" class=""><a href="/">Home</a></li>
                            <li id="navproduct" class=""><a href="/product?d=all">Product</a></li>
                            <li id="navnews" class=""><a href="/news">News</a></li>
                            @if (auth()->guard('member')->check())
                            <li id="" class="nav-item dropdown"><a href="#!" id="navbarDropdown" class="dropdown-toggle"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{auth()->guard('member')->user()->nama}} <i
                                        class="fas fa-chevron-down    "></i></a>
                                <ul class="dropdown-menu nav navbar-nav" aria-labelledby="navbarDropdown">
                                    <li id="dashboard" class=""><a href="/dashboard" class="drop">Dashboard</a></li>
                                    <li id="navlogout"><a href="/logout" class="drop">Sign Out</a></li>
                                </ul>
                            </li>
                            @elseif (auth()->guard('advertiser')->check())
                            <li id="" class="nav-item dropdown"><a href="#!" id="navbarDropdown" class="dropdown-toggle"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{auth()->guard('advertiser')->user()->nama}} <i
                                        class="fas fa-chevron-down    "></i></a>
                                <ul class="dropdown-menu nav navbar-nav" aria-labelledby="navbarDropdown">
                                    <li id="dashboard" class=""><a href="/dashboard" class="drop">Dashboard</a></li>
                                    <li id="navlogout"><a href="/logout" class="drop">Sign Out</a></li>
                                </ul>
                            </li>
                            {{-- Notifikasi  --}}
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button">
                                    <i class="fas fa-bell " style="font-size: 15pt"></i>
                                   @foreach ($jumNotif as $j)
                            <span class="label-count"> {{$j->count}}</span>
                                   @endforeach
                                      
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">NOTIFICATIONS</li>
                                    <li class="body">
                                        <ul class="menu">
                                            @foreach ($notif as $n)
                                            <li style="">
                                                <a href="javascript:void(0);" style="" class="btn btn-block">
                                                    <div class="icon-circle bg-light-green">
                                                        <i class="fas fa-user-alt    "></i>
                                                    </div>
                                                    <div class="menu-info">
                                                        <h4>{{$n->isi}}</h4>
                                                        <p>
                                                            <i class="fas fa-clock    "></i>
                                                            {{berapaMenitSekarang($n->created_at)}}
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="javascript:void(0);">View All Notifications</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- #END# Notifications -->
                            @else
                            <li id="navlogin"><a href="login">Sign In</a></li>
                            <li id="navregistration"><a href="registration">Sign Up</a></li>
                            @endif


                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </nav>
    </header>
    <!--/.nav-ends -->

    <div id="content">
        @yield('content')
    </div>



    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 block">
                    <div class="footer-block">
                        <h4>Address</h4>
                        <hr />
                        <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea
                            saperet inimicu ut qui dolor oratio mnesarchum.
                        </p>
                        {{-- <a href="#" class="learnmore">Learn More <i class="fa fa-caret-right"></i></a> --}}
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12 block">
                    <div class="footer-block">
                        <h4>About us</h4>
                        <hr />
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fas fa-phone    "></i></a></li>
                            <li><a href="#">Portfolio</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Sign In</a></li>
                            <li><a href="#">Sign Up</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12 block">
                    <div class="footer-block">
                        <h4>Community</h4>
                        <hr />
                        <ul class="footer-links">
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Forum</a></li>
                            <li><a href="#">Free Goods</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12 <block></block>">
                    <div class="footer-block">
                        <h4>Recent Posts</h4>
                        <hr />
                        <ul class="footer-links">
                            {{-- <li>
                                <a href="#" class="post">Lorem ipsum dolor sit amet</a>
                                <p class="post-date">May 25, 2017</p>
                            </li>
                            <li>
                                <a href="#" class="post">Lorem ipsum dolor sit amet</a>
                                <p class="post-date">May 25, 2017</p>
                            </li>
                            <li>
                                <a href="#" class="post">Lorem ipsum dolor sit amet</a>
                                <p class="post-date">May 25, 2017</p>
                            </li> --}}

                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <section id="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 btm-footer-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 copyright">
                    Developed by <a href="#">Gennosys</a>
                </div>
            </div>
        </div>
    </section>

  




</html>