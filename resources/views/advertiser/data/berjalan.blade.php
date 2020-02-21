@extends('advertiser.advertiser')
@section('content')

<style>
    .tbSWarna:hover{
        background-color: red !important;
    }
</style>

<div class=" backgroundGreen p-1" style="">
    <h4 class="text-center pt-1 text-white">Iklan Terpasang</h4>
</div>

<div class="body table-responsive">
    <table class="table table-sm  ">
        <tr>
            <th class="text-center">#</th>
            <th class="text-center" style="width: 50px">Gambar</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Tanggal Mulai</th>
            <th class="text-center">Tanggal Selesai</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Aksi</th>
        </tr>

        <tbody>
            @foreach ($berjalan as $key => $d)
                <tr class="">
                    <td class="text-center" rowspan="2" style=" vertical-align: middle">{{$berjalan->firstItem() + $key}}</td>
                    <td class="text-center" rowspan="2"><img src="{{asset('assets/thumbnails/'.$d->url_foto)}}" alt=""
                            height="60"></td>
                    <td class="border-bottom-0 text-center" style="padding-bottom: 0">{{$d->kategori}}</td>
                    <td class="text-center" rowspan="2" style=" vertical-align: middle">
                        {{formatDateToSurat($d->tanggal_awal)}}</td>
                    <td class="text-center" rowspan="2" style=" vertical-align: middle">
                        {{formatDateToSurat($d->tanggal_akhir)}}</td>
                    <td class="text-right" rowspan="2" style=" vertical-align: middle">{{formatuang($d->harga_deal)}}
                    </td>
                    <td class="text-center" rowspan="2" style=" vertical-align: middle">
                        <a href="berjalan/detail/{{$d->id_transaksi}}" style="width: 40px" class="btn  btn-sm  btn-info"><i class="fas fa-eye    "></i></a>
                    </td>
                </tr>
                <tr class="">
                    <td class="border-top-0 text-center" style="">{{$d->alamat}}</td>
                </tr>
            @endforeach
        </tbody>

        {{$berjalan->links()}}

    </table>
</div>
@endsection