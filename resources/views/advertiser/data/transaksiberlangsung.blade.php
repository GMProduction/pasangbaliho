@extends('advertiser.advertiser')
@section('content')

<div class=" backgroundGreen pb-1" style="">
    <h4 class="text-center pt-1 text-white">Transaksi</h4>
</div>



<div class="pr-4">
   
    {{-- <a href="#!">
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
    </a> --}}
    <div class="body table-responsive">
    <table class="table table-sm" >
            <tr>
                <th class="text-center">#</th>
                <th  class="text-center" style="width: 50px">Gambar</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Status</th>
                <th  class="text-center" colspan="2" style="width: 50px" >Aksi</th>
            </tr>
        @foreach ($trans as $d)
        <tbody>
            <tr>
                <td class="text-center" rowspan="2" style=" vertical-align: middle">1</td>
                <td class="text-center" rowspan="2"  ><img src="{{asset('assets/thumbnails/'.$d->url_foto)}}" alt="" height="60"></td>
                <td class="text-center border-bottom-0" style="padding-bottom: 0" >{{$d->nama_baliho}}</td>
                <td class="text-center" rowspan="2" style=" vertical-align: middle" >{{formatDateToSurat($d->tanggal_transaksi)}}</td>
                <td class="text-center" rowspan="2" style=" vertical-align: middle" >{{$d->status}}</td>
                <td class="text-center" rowspan="2"   style="width: 50px; vertical-align: middle" ><a href="berlangsung/detail?q={{$d->id_transaksi}}" style="width: 40px" class="btn  btn-sm  btn-info"><i class="fas fa-eye    "></i></a></td>
                <td class="text-center" rowspan="2"   style="width: 50px; vertical-align: middle"><a href="#!" class="btn btn-sm btn-danger" style="width: 40px"><i class="fas fa-trash    "></i></a></td>
            </tr>
            <tr>
                    <td class="text-center border-top-0" style="">{{$d->alamat}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
    </div>

   
</div>

@endsection