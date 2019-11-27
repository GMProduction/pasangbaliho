@extends('main.master')

@section('content')

<section id="login-reg">
    <div class="container">
        <!-- Top content -->
        <div class="row">
            <div class="col-md-6 col-sm-12 forms-right-icons">
                <div class="section-heading">
                    <h2><span>Client</span> Member</h2>
                    <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique
                        fierentis ea saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset nam
                        nostrud euismod volumus ne mei.
                    </p>
                </div>
                <div class="row">
                    <div class="col-xs-2 icon"><i class="fa fa-laptop"></i></div>
                    <div class="col-xs-10 datablock">
                        <h4>100% Responsive</h4>
                        <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea
                            saperet inimicu ut qui dolor oratio mnesarchum.</p>
                    </div>
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
                    <div class="col-xs-2 icon"><i class="fa fa-cog"></i></div>
                    <div class="col-xs-10 datablock">
                        <h4>Customer Support</h4>
                        <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea
                            saperet inimicu ut qui dolor oratio mnesarchum.</p>
                    </div>
                </div>
            </div>
            <!--forms-right-icons-->
            <div class="col-md-6 col-sm-12">
                <div class="form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Sign up now</h3>
                            <p>Fill in the form below to get instant access</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil-alt"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" id="formRegister" action="" class="login-form" method="">
                            @csrf
                            @error('nama')
                            <span class="msg invalid-feedback" style="color:red" role="alert">
                                {{$message}}
                            </span>
                            @enderror
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                    value="{{old('nama')}}" placeholder="Full Name" aria-describedby="basic-addon1"
                                    value="{{old('nama')}}">

                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-building"></i></span>
                                <input type="text" name="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror"
                                    value="{{old('perusahaan')}}" placeholder="Nama Perusahaan" aria-describedby="basic-addon1"
                                    value="{{old('perusahaan')}}">

                            </div>
                            <div class="row ">
                                <div class="col-md-6">
                                    @error('email')
                                    <span class="msg invalid-feedback" style="color:red" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    @error('telp')
                                    <span class="msg invalid-feedback" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i
                                                class="fa fa-envelope"></i></span>
                                        <input type="email" name="email"
                                            class="form-control  @error('email') is-invalid @enderror"
                                            value="{{old('email')}}" placeholder="Email"
                                            aria-describedby="basic-addon1">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon " id="basic-addon1"><i
                                                class="fa fa-phone"></i></span>
                                        <input type="tel" name="telp"
                                            class="form-control  @error('telp') is-invalid @enderror"
                                            value="{{old('telp')}}" placeholder="Phone No."
                                            aria-describedby="basic-addon1">

                                    </div>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-6">
                                    @error('password')
                                    <span class="msg invalid-feedback" style="color:red" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                    <span class="msg invalid-feedback" id="pas" style="color:red" role="alert">

                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i
                                                class="fa fa-lock"></i></span>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Password" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-md-5 col-xs-10">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i
                                                class="fa fa-lock"></i></span>
                                        <input type="password" name="re-password" id="re-password" class="form-control"
                                            placeholder="Retype Password" aria-describedby="basic-addon1">

                                    </div>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon noBorder eye btn btn-sm" id="" style=""
                                            onclick="showPassword()"><i id="ico"
                                                class="fas fa-eye-slash    "></i></span>
                                    </div>
                                </div>
                            </div>
                            @error('alamat')
                            <span class="msg invalid-feedback" style="color:red" role="alert">
                                {{$message}}
                            </span>
                            @enderror
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-home"></i></span>
                                <textarea rows="0" cols="100" name="alamat"
                                    class="form-control  @error('alamat') is-invalid @enderror" value=""
                                    placeholder="Address" aria-describedby="basic-addon1">{{old('alamat')}}</textarea>

                            </div>
                            <div class="    ">
                                <div class="social-login-buttons">
                                    <a class="btn btn-link-1 btn-link-1-twitter btn-block" href="#!"
                                        onclick="sendRegister()">
                                        <i class="fas fa-sign-in-alt"></i> Sign Up me !
                                    </a>
                                    <a class="btn btn-link-1 btn-link-1-google-plus btn-block" href="#">
                                        <i class="fab fa-google"></i> Google
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</section>

<script>
    function sendRegister(){
        var p = $('#password').val();
        var r = $('#re-password').val();
        if(p === r){
            document.getElementById('formRegister').action = 'addClient';
        document.getElementById('formRegister').method = 'POST';
        document.getElementById('formRegister').submit();
        }else {
            $('#pas').html('incorect retype Password')
             $('#password').val('');
            $('#re-password').val('');
        }

       
    }

    function showPassword(){
    if($('#ico').hasClass("fa-eye")){        
        $('#ico').removeClass("fa-eye");
        $('#ico').addClass("fa-eye-slash");
        document.getElementById('password').type = 'password';
        document.getElementById('re-password').type = 'password';
    }else{
        $('#ico').removeClass("fa-eye-slash");
        $('#ico').addClass("fa-eye");
        document.getElementById('password').type = 'text';
        document.getElementById('re-password').type = 'text';
    }
    }
</script>
@endsection