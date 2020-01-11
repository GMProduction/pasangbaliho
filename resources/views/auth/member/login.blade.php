@extends('main.master')

@section('content')

<section id="login-reg" class="mt-1">
    <div class="container">
        <!-- Top content -->
        <div class="row  pt-2">
            <div class="col-md-6 col-sm-12 forms-right-icons">
                <div class="section-heading">
                    <h2 class="warnaGreen">Login <span></span></h2>
                    <p class="subheading">Ini adalah halaman login untuk anda yang sudah mendaftar sebagai Client / Advertiser. Jika anda belum mempunyai akun, silahkan klik <a href="/registration">Register</a> untuk mendaftar.
                    </p>
                </div>
                <div class="row">
                    <div class="col-xs-2 icon"><i class="fa fa-user"></i></div>
                    <div class="col-xs-10 datablock">
                        <h4>Klien</h4>
                        <p>Untuk anda yang sudah mempunyai akun sebagai Perusahaan yang bergerak di bidang jasa pemasangan iklan.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2 icon"><i class="fa fa-user"></i></div>
                    <div class="col-xs-10 datablock">
                        <h4>Advertiser</h4>
                        <p>Untuk anda yang sudah mempunyai akun sebagai Perusahaan / Orang yang ingin mempromosikan produk anda dengan media iklan yang kami miliki.</p>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#ad"><span>Sebagai Advertiser</span></a></li>
                    <li><a data-toggle="tab" href="#cli"><span>Sebagai Klien</span></a></li>

                </ul>

                <div class="tab-content">
                    <div id="ad" class="tab-pane fade in active">
                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Advertiser</h3>
                                    <p>Dapat melakukan pemesanan baliho</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="/loginAdvertiser" class="login-form" method="POST">
                                    @csrf
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                        <input type="text" class="form-control" name="email" placeholder="email"
                                            aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-unlock"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder="Password"
                                            aria-describedby="basic-addon1">
                                    </div>
                                    <button type="submit" class="btn btn-link-1 btn-link-1-twitter btn-block"> <i class="fas fa-sign-in-alt"></i> Masuk</button>
                                    <a class="btn btn-link-1 btn-link-1-google-plus btn-block" href="{{ route('login.provider', 'google') }}">
                                        <i class="fab fa-google"></i> Google
                                    </a>
                                </form>
                            </div>
                        </div>
        
                        {{-- <div class="social-login">
                            <h3>...or login with:</h3>
                            <div class="social-login-buttons">
                                <a class="btn btn-link-1 btn-link-1-facebook" href="#">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                <a class="btn btn-link-1 btn-link-1-twitter" href="#">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                                <a class="btn btn-link-1 btn-link-1-google-plus" href="#">
                                    <i class="fa fa-google-plus"></i> Google Plus
                                </a>
                            </div>
                        </div> --}}
                    </div>
                    <div id="cli" class="tab-pane fade">
                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Klien</h3>
                                    <p>Klien dapat melakukan pemasangan iklan baliho</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="/loginClient" class="login-form" method="POST">
                                    @csrf
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                        <input type="text" class="form-control" name="email" placeholder="email"
                                            aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-unlock"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder="Password"
                                            aria-describedby="basic-addon1">
                                    </div>
                                    <button type="submit" class="btn btn-link-1 btn-link-1-twitter btn-block"> <i class="fas fa-sign-in-alt"></i> Masuk</button>
                                    <a class="btn btn-link-1 btn-link-1-google-plus btn-block" href="{{ route('login.provider', 'google') }}">
                                        <i class="fab fa-google"></i> Google
                                    </a>
                                </form>

                                {{-- <h3>Masih Dalam Perbaikan</h3> --}}
                            </div>
                                
                        </div>
        
                        {{-- <div class="social-login">
                            <h3>...or login with:</h3>
                            <div class="social-login-buttons">
                                <a class="btn btn-link-1 btn-link-1-facebook" href="#">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                <a class="btn btn-link-1 btn-link-1-twitter" href="#">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                                <a class="btn btn-link-1 btn-link-1-google-plus" href="#">
                                    <i class="fa fa-google-plus"></i> Google Plus
                                </a>
                            </div>
                        </div> --}}
                    </div>


                </div>

               

            </div>
        </div>
    </div>
    <script>
        if('{{session("status")}}'){
                // alert('{{session("status")}}');
                Swal.fire({
     title: '{{session("status")}}',
     icon: 'info'
     
    })
            }
    </script>

</section>
@endsection