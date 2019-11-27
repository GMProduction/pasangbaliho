<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/collapse.css')}}">
    <link rel="stylesheet" href="{{asset('css/skin.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">

    {{-- <link rel="stylesheet" href="{{asset('css/padding.css')}}"> --}}


    <script src="{{asset('js/jquery.min.js')}}"></script>

    {{-- <style>
        .sticky {
            position: fixed;
            font-size: 13px;
            line-height: 30px;
            height: 30px;
            width: 100%;
            background: #fff;
            text-align: left;
            top: 0px;
            -webkit-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
            -moz-box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
            box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
        }

        body #faq {}
    </style> --}}
</head>

<body id="">
    {{-- 
   <header>
        <nav class="navbar navbar-inverse" style="height: 70px !important; ">
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
                        <a class="navbar-brand" href="/" style="padding-top: 0px; padding-bottom: 0px">
                            <h1>Baliho</h1><span>Baliho Solutions</span>
                        </a>
                    </div>
                    {{-- <div id="navbar" class="">
                        <ul class="nav navbar-nav">

                            @if (auth()->guard('member')->check())
                            <li id="" class="nav-item dropdown"><a href="#!" id="navbarDropdown" class="dropdown-toggle"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{auth()->guard('member')->user()->nama}} <i
        class="fas fa-chevron-down    "></i></a>
    <ul class="dropdown-menu nav navbar-nav" aria-labelledby="navbarDropdown">
        <li id="navlogout"><a href="logout" class="drop">Sign Out</a></li>
    </ul>
    </li>

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

    <div class="container-fluid" style="">
        <div id="faq" style="" class="">
            <div class="row" style="">
                <div class="col-md-2 " style="">
                    <div id="" class="">
                        <ul class="nav flex-column " style="position: fixed; z-index: 9999; width: 200px; top: 100px">
                            <li>


                            </li>
                            <li class="nav-item">
                                <a class="nav-link "
                                    href="/dashboard/profil/{{auth()->guard('advertiser')->user()->id}}">
                                    <i class="fas fa-user" style="width: 20px"></i>
                                    <span data-feather="home" style="padding-left: 2%">
                                        Profil</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="/dashboard/berlangsung">
                                    <i class="fas fa-user" style="width: 20px"></i>
                                    <span data-feather="home" style="padding-left: 2%">
                                        Transaksi</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="/dashboard/berlangsung">
                                    <i class="fas fa-user" style="width: 20px"></i>
                                    <span data-feather="home" style="padding-left: 2%">
                                        History</span>
                                </a>
                            </li>
                            <li class="nav-item active" role="tab" id="headingfour">
                                <a role="button" data-toggle="collapse" class="" data-parent="#accordion"
                                    href="#transcolap" aria-expanded="true" aria-controls="transcolap">
                                    <i class="fas fa-boxes    "></i>
                                    <span style="padding-left: 2%">Transaksi</span>
                                </a>
                                <ul id="transcolap" class="nav flex-column collapse" role="tabpanel"
                                    aria-labelledby="headingfour">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/dashboard/berlangsung" style="padding-left: 20%">
                                            Sedang Berlangsung
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/dashboard/addProduk" style="padding-left: 20%">
                                            Riwayat Transaksi
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-9 col-sm-10">
                    <div id="content">
                        @yield('content')
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                </div>
            </div>
        </div>
    </div> --}}

    <!-- Bootstrap NavBar -->
    <nav class="navbar navbar-expand-md navbar-dark backgroundGreen fixed-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">

            <span class="menu-collapsed">Advertiser</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                 {{--
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-bell  fa-fw mr-3  "></i></a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li> --}}

                <!-- This menu is hidden in bigger devices with d-sm-none. 
                 The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
                {{-- <li class="nav-item dropdown d-sm-block d-md-none">
                    <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                        <a class="dropdown-item" href="#">Dashboard</a>
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Tasks</a>
                        <a class="dropdown-item" href="#">Etc ...</a>
                    </div>
                </li><!-- Smaller devices menu END --> --}}
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="#" class="nav-link">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-tachometer-alt fa-fw mr-3"></span>
                            <span class="menu-collapsed">Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboard/profile/{{auth()->guard('advertiser')->user()->id}}" class="nav-link ">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-user fa-fw mr-3"></span>
                            <span class="menu-collapsed">Profile</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboard/berlangsung" class="nav-link">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-file-invoice-dollar fa-fw mr-3"></span>
                            <span class="menu-collapsed">Transaksi</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="#" class="nav-link">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-history fa-fw mr-3"></span>
                            <span class="menu-collapsed">History</span>
                        </div>
                    </a>
                </li>

            </ul>

        </div>
        <form class="form-inline">
            <ul class="navbar-nav">
                <li class="nav-item " style="">
                    <a class="nav-link" href="/" style="padding: 0; margin: 0"><i class="fa fa-home  fa-fw mr-3 fa-2x "></i></a>
                </li>
                {{-- <li class="nav-item ">
                    <a class="nav-link" href="#"><i class="fa fa-bell "></i>
                        <span
                        class="badge badge-pill badge-danger">5</span>
                    </a>
                </li> --}}

            </ul>
        </form>
    </nav><!-- NavBar END -->


    <!-- Bootstrap row -->
    <div class="row" id="body-row">
        <!-- Sidebar -->
        <div id="sidebar-container" class="sidebar-expanded d-none d-md-block position-fixed"
            style="z-index: 9999; margin-top: 56px">
            <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
            <!-- Bootstrap List Group -->
            <ul class="list-group">
                <!-- Separator with title -->
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>MAIN MENU</small>
                </li>
                <!-- /END Separator -->
                <!-- Menu with submenu -->
                <a href="/dashboard" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-tachometer-alt fa-fw mr-3"></span>
                        <span class="menu-collapsed">Dashboard</span>
                    </div>
                </a>
                <a href="/dashboard/profile/{{auth()->guard('advertiser')->user()->id}}"
                    class="bg-dark list-group-item list-group-item-action ">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Profile</span>
                    </div>
                </a>

                <a href="/dashboard/berlangsung" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-file-invoice-dollar fa-fw mr-3"></span>
                        <span class="menu-collapsed">Transaksi</span>
                    </div>
                </a>
                <a href="#" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-history fa-fw mr-3"></span>
                        <span class="menu-collapsed">History</span>
                    </div>
                </a>
                <!-- Separator with title -->
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>OTHER</small>
                </li>
                <!-- /END Separator -->

                <a href="/dashboard/notifikasi" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-envelope-o fa-fw mr-3"></span>
                        <span class="menu-collapsed">Notifikasi <span
                            @foreach ($jumNotif as $j)
                                class="badge badge-pill badge-primary ml-2">{{$j->count}}</span></span>
                                @endforeach
                    </div>
                </a>
                <!-- Separator without title -->
                <li class="list-group-item sidebar-separator menu-collapsed"></li>
                <!-- /END Separator -->
                <a href="logout" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
                        <span class="menu-collapsed">Logout</span>
                    </div>
                </a>
                {{-- <a href="#" data-toggle="sidebar-colapse"
                    class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                        <span id="collapse-text" class="menu-collapsed">Collapse</span>
                    </div>
                </a>
                <!-- Logo -->
                <li class="list-group-item logo-separator d-flex justify-content-center">
                    <img src='https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg' width="30"
                        height="30" />
                </li> --}}
            </ul><!-- List Group END-->
        </div><!-- sidebar-container END -->

        <!-- MAIN -->
        <div class="col offset-md-2 pl-4" style="padding-top: 70px">

            <div id="content">
                @yield('content')
            </div>
           


        </div><!-- Main Col END -->

    </div><!-- body-row END -->

    
    <script src="{{asset('css/bootstrap4/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/collapse.js')}}"></script>

    <script src="{{asset('js/jquery.countTo.js')}}"></script>

</html>