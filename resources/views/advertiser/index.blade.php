@extends('advertiser.advertiser')

@section('content')

<div id="login-reg" style="padding-top: 0px">
    <div class="form-box">
        <div class="form-top">
            <div class="form-top-left">
                <h3>Login to our site</h3>
                <p>Enter username and password to log on:</p>
            </div>
            <div class="form-top-right">
                <i class="fa fa-key"></i>
            </div>
        </div>
        <div class="form-bottom">
            <form role="form" action="login" class="login-form" method="POST">
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
</div>
@endsection