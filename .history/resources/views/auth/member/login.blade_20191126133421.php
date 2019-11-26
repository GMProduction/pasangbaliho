@extends('main.master')

@section('content')

<section id="login-reg" class="mt-1">
    <div class="container">
        <!-- Top content -->
        <div class="row  pt-2">
            <div class="col-md-6 col-sm-12 forms-right-icons">
                <div class="section-heading">
                    <h2>Sign In With <span>Us</span></h2>
                    <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique
                        fierentis ea saperet inimicu ut qui dolor oratio mnesarchum.
                    </p>
                </div>
                <div class="row">
                    <div class="col-xs-2 icon"><i class="fa fa-bullhorn"></i></div>
                    <div class="col-xs-10 datablock">
                        <h4>Powerful Features</h4>
                        <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea
                            saperet inimicu ut qui dolor oratio mnesarchum.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2 icon"><i class="fa fa-support"></i></div>
                    <div class="col-xs-10 datablock">
                        <h4>Customer Support</h4>
                        <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea
                            saperet inimicu ut qui dolor oratio mnesarchum.</p>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#ad"><span>Login as Advertiser</span></a></li>
                    <li><a data-toggle="tab" href="#cli"><span>Login as Client</span></a></li>

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
                                <form role="form" action="/login" class="login-form" method="POST">
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
                                    <button type="submit" class="btn">Sign in!</button>
                                </form>
                            </div>
                        </div>
        
                        <div class="social-login">
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
                        </div>
                    </div>
                    <div id="cli" class="tab-pane fade">
                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Client</h3>
                                    <p>Client dapat melakukan pemasangan iklan baliho</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="/loginClien" class="login-form" method="">
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
                                    <button type="submit" class="btn">Sign in!</button>
                                </form>
                            </div>
                        </div>
        
                        <div class="social-login">
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
                        </div>
                    </div>


                </div>

               

            </div>
        </div>
    </div>

</section>
@endsection