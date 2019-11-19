@extends('advertiser.advertiser')
@section('content')

<h4 class="pb-4">Transaksi Sedang Berlangsung</h4>



<div class="pr-4">
    @foreach ($data as $d)
    <a href="#!">
        <div class="row">
            <div class="col-lg-2">
                <img src="{{asset('assets/img/iphone62.png')}}" alt="" width="100%">
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        {{$d->nama_baliho}}
                    </div>
                    <div class="col-lg-12">
                        {{$d->alamat}}, {{$d->kota}}, {{$d->provinsi}}
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <p> {{$d->tanggal_transaksi}}</p>
            </div>
            <div class="col-lg-2">
                <a href="berlangsung/detail?q={{$d->id_transaksi}}" class="btn btn-primary">Detail</a>
            </div>
            <div class="col-lg-2">
                <a href="" class="btn btn-primary ">Detail</a>
            </div>
        </div>
    </a>

    <table class="table" border>
        <thead>
            <tr>
                <th>#</th>
                <th style="width: 50px">Gambar</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Status</th>
                <td align="center" colspan="3" style="max-width: 10px !important">Aksi</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td aiign="center"><img src="{{asset('assets/img/iphone62.png')}}" alt="" width="100"></td>
                <td>{{$d->nama_baliho}}</td>
                <td>{{$d->tanggal_transaksi}}</td>
                <td>Status</td>
                <td><a href="#!" class="btn btn-secondary"><i class="fas fa-eye    "></i></a></td>
                <td><a href="#!" class="btn btn-secondary"><i class="fas fa-eye    "></i></a></td>
                <td><a href="#!" class="btn btn-secondary"><i class="fas fa-eye    "></i></a></td>
            </tr>
        </tbody>
    </table>

    @endforeach
</div>

@endsection