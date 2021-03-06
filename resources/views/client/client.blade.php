<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Client Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/collapse.css')}}">
    <link rel="stylesheet" href="{{asset('css/skin.css')}}">
    <link rel="stylesheet" href="{{asset('css/client.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/padding.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>



    <style>
        @media (max-width : 767px) {
            .iconHome {
                visibility: hidden;
            }
        }
    </style>



</head>

<body id="">

    <!-- Bootstrap NavBar -->
    <nav class="navbar navbar-expand-md navbar-dark backgroundGreen fixed-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/dashboardClient">

            <span class="menu-collapsed">Client Dashboard</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown d-sm-block d-md-none ">
                    <a href="/" class="nav-link">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-home fa-fw mr-3"></span>
                            <span class="menu-collapsed">Home</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboardClient" class="nav-link navdashboard">
                        <div class="d-flex w-100 justify-content-start align-items-center ">
                            <span class="fa fa-tachometer-alt fa-fw mr-3"></span>
                            <span class="menu-collapsed">Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                <a href="/dashboardClient/profile/{{auth()->guard('client')->user()->id_client}}" class="nav-link navprofile">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-user fa-fw mr-3"></span>
                            <span class="menu-collapsed">Profile</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboardClient/asset" class="nav-link navasset">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-file-invoice-dollar fa-fw mr-3"></span>
                            <span class="menu-collapsed">Asset</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboardClient/disewa" class="nav-link navdisewa">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-file-invoice-dollar fa-fw mr-3"></span>
                            <span class="menu-collapsed">Disewa</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboardClient/history" class="nav-link navhistory">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-history fa-fw mr-3"></span>
                            <span class="menu-collapsed">History</span>
                        </div>
                    </a>
                </li>
             
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/logoutClient" class="nav-link navhistory">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-history fa-fw mr-3"></span>
                            <span class="menu-collapsed">Logout</span>
                        </div>
                    </a>
                </li>

            </ul>

        </div>
        <form class="form-inline iconHome">
            <ul class="navbar-nav">
                <li class="nav-item " style="">
                    <a class="nav-link" href="/" style="padding: 0; margin: 0"><i
                            class="fa fa-home  fa-fw mr-3 fa-2x "></i></a>
                </li>


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
                <a href="/dashboardClient" class="bg-dark list-group-item list-group-item-action navdashboard">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-tachometer-alt fa-fw mr-3"></span>
                        <span class="menu-collapsed">Dashboard</span>
                    </div>
                </a>

                <a href="/dashboardClient/profile/{{auth()->guard('client')->user()->id_client}}" class="bg-dark list-group-item list-group-item-action navprofile ">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Profile</span>
                    </div>
                </a>
                <a href="/dashboardClient/asset" class="bg-dark list-group-item list-group-item-action navasset ">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Asset</span>
                    </div>
                </a>

                <a href="/dashboardClient/disewa" class="bg-dark list-group-item list-group-item-action navdisewa">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-file-invoice-dollar fa-fw mr-3"></span>
                        <span class="menu-collapsed">Disewa</span>
                    </div>
                </a>
                <a href="/dashboardClient/history" class="bg-dark list-group-item list-group-item-action navhistory">
                    <div class="d-flex w-100 justify-content-start align-items-center ">
                        <span class="fa fa-history fa-fw mr-3"></span>
                        <span class="menu-collapsed">History</span>
                    </div>
                </a>
                <!-- Separator with title -->
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>OTHER</small>
                </li>
                <!-- /END Separator -->

               
                <!-- Separator without title -->
                {{-- <li class="list-group-item sidebar-separator menu-collapsed"></li> --}}
                <!-- /END Separator -->
                <a href="/logoutClient" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
                        <span class="menu-collapsed">Logout</span>
                    </div>
                </a>

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
    <script src="{{asset('js/client.js')}}"></script>

    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/currency.js')}}"></script>




    <script src="{{asset('js/jquery.countTo.js')}}"></script>

</html>