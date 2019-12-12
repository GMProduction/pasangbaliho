@extends('advertiser.advertiser')
@section('content')

<div class=" backgroundGreen p-1" style="">
    <h4 class="text-center pt-1 text-white">Iklan Terpasang</h4>
</div>

<div class="body table-responsive">
    <table class="table table-sm">
        <tr>
            <th class="text-center">#</th>
            <th class="text-center" style="width: 50px">Gambar</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Tanggal Mulai</th>
            <th class="text-center">Tanggal Selesai</th>
            <th class="text-center" colspan="2">Harga</th>
        </tr>
        @foreach ($trans as $d)
        <tbody>
            <tr>
                <td class="text-center" rowspan="2" style=" vertical-align: middle">1</td>
                <td class="text-center" rowspan="2"><img src="{{asset('assets/thumbnails/'.$d->url_foto)}}" alt=""
                        height="60"></td>
                <td class="border-bottom-0" style="padding-bottom: 0">{{$d->nama_baliho}}</td>
                <td class="text-center" rowspan="2" style=" vertical-align: middle">
                    {{formatDateToSurat($d->tanggal_awal)}}</td>
                <td class="text-center" rowspan="2" style=" vertical-align: middle">
                    {{formatDateToSurat($d->tanggal_akhir)}}</td>
                <td class="text-right" rowspan="2" style=" vertical-align: middle">{{formatuang($d->harga_deal)}}</td>
            </tr>
            <tr>
                <td class="border-top-0" style="">{{$d->alamat}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
@endsection