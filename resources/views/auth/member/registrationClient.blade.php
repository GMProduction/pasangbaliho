@extends('main.master')

@section('content')

<section id="login-reg">
    <div class="container">
        <!-- Top content -->
        <div class="row">
            <div class="col-md-6 col-sm-12 forms-right-icons">
                <div class="section-heading">
                    <h2><span>Pendaftaran</span> Klien</h2>
                    <p class="subheading">Untuk anda yang sudah mempunyai akun sebagai Perusahaan yang bergerak di bidang jasa pemasangan iklan..
                    </p>
                </div>
                <div class="row">
                    <div class="col-xs-2 icon"><i class="fa fa-laptop"></i></div>
                    <div class="col-xs-10 datablock">
                        <h4>Akses Penuh</h4>
                        <p>Anda dapat memasukkan berbagai jenis media iklan yang anda miliki</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2 icon"><i class="fa fa-bullhorn"></i></div>
                    <div class="col-xs-10 datablock">
                        <h4>Dashboard</h4>
                        <p>Tersedia dashboard klien untuk menambah aset, melihat aset yang dipesan, dll.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2 icon"><i class="fa fa-cog"></i></div>
                    <div class="col-xs-10 datablock">
                        <h4>Solusi Pemasaran</h4>
                        <p>Jadikan pasangbaliho.com sebagai solusi pemasaran media iklan anda!</p>
                    </div>
                </div>
            </div>
            <!--forms-right-icons-->
            <div class="col-md-6 col-sm-12">
                <div class="form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Daftar Sekarang</h3>
                            <p>Silahkan isi data dengan benar</p>
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
                                <input type="text" name="nama_instansi" class="form-control @error('perusahaan') is-invalid @enderror"
                                    value="{{old('nama_instansi')}}" placeholder="Nama Instansi" aria-describedby="basic-addon1"
                                    value="{{old('nama_instansi')}}">

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
                                <div class="col-md-6">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i
                                                class="fa fa-lock"></i></span>
                                        <input type="password" name="password" id="password" class="form-control" style="border-right: 0"
                                            placeholder="Password" aria-describedby="basic-addon1">
                                        <span class="input-group-addon " style="border-left: 0" id="" style=""><i
                                                id="ico" class="fas fa-eye-slash" onclick="showPassword()"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i
                                                class="fa fa-lock"></i></span>
                                        <input type="password" name="re-password" id="re-password" class="form-control"
                                            style="border-right: 0" placeholder="Retype Password"
                                            aria-describedby="basic-addon1">
                                        <span class="input-group-addon " style="border-left: 0" id="" style=""><i
                                                id="icoRe" class="fas fa-eye-slash" onclick="showRePassword()"></i></span>
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
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-1">
                                    <input type="checkbox" required name="terms"
                                        onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');"
                                        id="field_terms">  
                                </div>
                                <div class="col-md-11 col-sm-11 col-xs-11">
                                    <label for="terms" style="font-size: 10pt">Dengan masuk atau mendaftar saya menerima
                                        <a href="/s&k" target="_blank"
                                            title="You may read our terms and conditions by clicking on this link"
                                            class="text-primary">Syarat dan
                                            Ketentuan</a>
                                        pasangbaliho.com.</label>

                                </div>
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
        if(p === ''){
            Swal.fire({
                title: 'Password masih kosong',
                icon: 'warning'
            })
        }else {
        if(p === r){
            if($('#field_terms').prop('checked')){
            document.getElementById('formRegister').action = 'addClient';
        document.getElementById('formRegister').method = 'POST';
        document.getElementById('formRegister').submit();
    }else{
                Swal.fire({
                title: 'Silahkan centang Syarat & Ketentuan untuk Mendaftar',
                icon: 'warning'
            });
            }
        }else {
            $('#pas').html('incorect retype Password')
             $('#password').val('');
            $('#re-password').val('');
        }
    }

       
    }

    function showPassword(){
    if($('#ico').hasClass("fa-eye")){        
        $('#ico').removeClass("fa-eye");
        $('#ico').addClass("fa-eye-slash");
        document.getElementById('password').type = 'password';
        
    }else{
        $('#ico').removeClass("fa-eye-slash");
        $('#ico').addClass("fa-eye");
        document.getElementById('password').type = 'text';
       
    }
    }
    function showRePassword(){
        if($('#icoRe').hasClass("fa-eye")){        
        $('#icoRe').removeClass("fa-eye");
        $('#icoRe').addClass("fa-eye-slash");
       
        document.getElementById('re-password').type = 'password';
    }else{
        $('#icoRe').removeClass("fa-eye-slash");
        $('#icoRe').addClass("fa-eye");
      
        document.getElementById('re-password').type = 'text';
    }
    }
</script>
@endsection