@extends('client.client')

@section('content')



<div class="row">
    lasdi : {{auth()->guard('clients')-check() }}

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-pink hover-zoom-effect">
            <div class="icon">
                <i class="fas fa-bell    "></i>
            </div>
            <div class="content">
                <div class="text">NOTIFICATION</div>
                <div class="number">3</div>
            </div>
        </div>

    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-red hover-zoom-effect">
            <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div class="content">
                <div class="text">TRANSAKSI BERLANGSUNG</div>
                <div class="number">s</div>
               
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-blue hover-zoom-effect">
            <div class="icon">
                <i class="fa fa-check-square" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text">IKLAN TERPASANG</div>
                <div class="number">s</div>
            </div>
        </div>
    </div>
  
</div>


@endsection