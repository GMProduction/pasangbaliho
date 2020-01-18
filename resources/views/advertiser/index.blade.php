@extends('advertiser.advertiser')

@section('content')


<div class="row">

    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="/dashboard/berlangsung" style="text-decoration: none;">
        <div class="info-box-3 bg-red hover-zoom-effect">
            <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div class="content">
                <div class="text">TRANSAKSI BERLANGSUNG</div>
                @foreach ($jumTrans as $n)
                <div class="number">{{$n->count}}</div>
                @endforeach

            </div>
        </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="/dashboard/berjalan" style="text-decoration: none;">
        <div class="info-box-3 bg-blue hover-zoom-effect">
            <div class="icon">
                <i class="fa fa-check-square" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text">IKLAN TERPASANG</div>
                @foreach ($jumIklan as $n)
                <div class="number">{{$n->count}}</div>
                @endforeach
            </div>
        </div>
        </a>
    </div>
    {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-light-blue hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">access_alarm</i>
            </div>
            <div class="content">
                <div class="text">ALARM</div>
                <div class="number">07:00 AM</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-cyan hover-zoom-effect">
            <div class="icon">
                <i class="material-icons">gps_fixed</i>
            </div>
            <div class="content">
                <div class="text">LOCATION</div>
                <div class="number">Turkey</div>
            </div>
        </div>
    </div> --}}
</div>
<h5>Transaksi Berlangsung</h5>
<div class="body table-responsive">
    <table class="table table-sm">
        <tr>
            <th class="text-center">#</th>
            <th class="text-center" style="width: 50px">Gambar</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Status</th>
            <th class="text-center">Tanggal Mulai</th>
            <th class="text-center">Tanggal Berakhir</th>
        </tr>
        @foreach ($trans as $d)
        <tbody>
            <tr>
                <td class="text-center" style=" vertical-align: middle">{{$loop->iteration }}</td>
                <td class="text-center" style=" vertical-align: middle"><img
                        src="{{asset('assets/thumbnails/'.$d->url_foto)}}" alt="" height="60"></td>
                <td class="text-center " style=" vertical-align: middle">{{$d->nama_baliho}}</td>
                <td class="text-center" style=" vertical-align: middle">{{formatDateToSurat($d->tanggal_transaksi)}}
                </td>
                <td class="text-center" style=" vertical-align: middle">{{$d->status}}</td>
                <td class="text-center" style=" vertical-align: middle">{{formatDateToSurat($d->tanggal_awal)}}</td>
                <td class="text-center" style=" vertical-align: middle">{{formatDateToSurat($d->tanggal_akhir)}}</td>
            </tr>

        </tbody>
        @endforeach
    </table>
</div>

@endsection