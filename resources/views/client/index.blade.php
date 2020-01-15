@extends('client.client')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div class="row">


    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="/dashboardClient/asset" style="text-decoration: none;">
            <div class="info-box-3 bg-red hover-zoom-effect">
                <div class="icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="content">
                    <div class="text">MEDIA IKLAN</div>
                    @foreach ($media as $m)
                    <div class="number">{{$m->count}}</div>
                    @endforeach
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="/dashboardClient/disewa" style="text-decoration: none;">
            <div class="info-box-3 bg-blue hover-zoom-effect">
                <div class="icon">
                    <i class="fa fa-check-square" aria-hidden="true"></i>
                </div>
                <div class="content">
                    <div class="text">ASSET DIGUNAKAN</div>
                    @foreach ($sewa as $m)
                    <div class="number">{{$m->count}}</div>
                    @endforeach
                </div>
            </div>
        </a>
    </div>

</div>



@endsection