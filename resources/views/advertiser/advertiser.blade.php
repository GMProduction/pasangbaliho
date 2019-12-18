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
        <a class="navbar-brand" href="/">

            <span class="menu-collapsed">Advertiser</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="#" class="nav-link">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-home fa-fw mr-3"></span>
                            <span class="menu-collapsed">Home</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboard" class="nav-link">
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
                    <a href="/dashboard/berjalan" class="nav-link">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-file-invoice-dollar fa-fw mr-3"></span>
                            <span class="menu-collapsed">Berjalan</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboard/history" class="nav-link">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-history fa-fw mr-3"></span>
                            <span class="menu-collapsed">History</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboard/notifikasi" class="nav-link">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-envelope-o fa-fw mr-3"></span>
                            <span class="menu-collapsed">Notifikasi <span @foreach ($jumNotif as $j)
                                    class="badge badge-pill badge-primary ml-2">{{$j->count}}</span></span>
                            @endforeach
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown d-sm-block d-md-none">
                    <a href="/dashboard/notifikasi" class="nav-link">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
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
                <a href="/dashboard/berjalan" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-ad fa-fw mr-3"></span>
                        <span class="menu-collapsed">Berjalan</span>
                    </div>
                </a>
                <a href="/dashboard/history" class="bg-dark list-group-item list-group-item-action">
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
                        <span class="menu-collapsed">Notifikasi <span @foreach ($jumNotif as $j)
                                class="badge badge-pill badge-primary ml-2">{{$j->count}}</span></span>
                        @endforeach
                    </div>
                </a>
                <!-- Separator without title -->
                <li class="list-group-item sidebar-separator menu-collapsed"></li>
                <!-- /END Separator -->
                <a href="/logout" class="bg-dark list-group-item list-group-item-action">
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

    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5df7972443be710e1d224eb6/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
   
        Tawk_API.visitor = {
        name : '{{auth()->guard("advertiser")->user()->nama}}',
        email : '{{auth()->guard("advertiser")->user()->email}}'
        };
    
        
    
    </script>
</body>

</html>