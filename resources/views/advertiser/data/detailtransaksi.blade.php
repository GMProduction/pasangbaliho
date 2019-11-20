@extends('advertiser.advertiser')
@section('content')
<section id="about-page-section-">

    @foreach ($data as $d)


    <div class="row">
        <div class="col-lg-4">
            <img src="{{asset('assets/img/iphone62.png')}}" alt="" width="100%">
        </div>
        <div class="col-lg-8">
            <h4>{{$d->nama_baliho}}</h4>
            <h5>{{$d->alamat}}, {{$d->kota}}, {{$d->provinsi}}</h5>
            <h5>{{$d->tanggal_awal}} s/d {{$d->tanggal_akhir}}</h5>
        </div>
    </div>

    <div id="process">
        <div class="row">
            <div class="col-md-1 col-sm-1  ">
                <span class="process-icon text-center " id="permintaan" style=""><i
                        class="fas fa-file-invoice-dollar    " style="font-size: 28pt"></i></span>
            </div>
            <div class="col-md-1 col-sm-1 ">
                <span class="process-icon text-center " style="background-color: transparent; color: red !important"><i
                        class="fa fa-arrow-right fa-3x" id="panahNegoHarga" style="color: #DDDDDD"></i></span>
            </div>
            <div class="col-md-1 col-sm-1">
                <span class="process-icon text-center" id="negoHarga"><i class="fas fa-comments-dollar"
                        style="font-size: 28pt"></i></span>
            </div>
            <div class="col-md-1 col-sm-1 ">
                <span class="process-icon text-center" style="background-color: transparent; color: red !important"><i
                        class="fa fa-arrow-right fa-3x" id="panahNegoMateri" style="color: #DDDDDD""></i></span>
            </div>
            <div class=" col-md-1 col-sm-1">
                        <span class="process-icon text-center" id="negoMateri"><i class="fas fa-images    "
                                style="font-size: 28pt"></i></span>
            </div>
            <div class="col-md-1 col-sm-1 ">
                <span class="process-icon text-center" style="background-color: transparent; color: red !important"><i
                        class="fa fa-arrow-right fa-3x" id="panahPembayaran" style="color: #DDDDDD"></i></span>
            </div>
            <div class="col-md-1 col-sm-1">
                <span class="process-icon text-center" id="pembayaran"><i class="fas fa-money-bill    "
                        style="font-size: 28pt"></i></span>
            </div>
            <div class="col-md-1 col-sm-1 ">
                <span class="process-icon text-center" style="background-color: transparent; color: red !important"><i
                        class="fa fa-arrow-right fa-3x" id="panahSelesai" style="color: #DDDDDD"></i></span>
            </div>
            <div class="col-md-1 col-sm-1">
                <span class="process-icon text-center" id="selesai"><i class="fa fa-check" aria-hidden="true"
                        style="font-size: 28pt"></i></span>
            </div>
        </div>
    </div>
    <h5>Status Transaksi</h5>
    <table class="table table-md" border>
        <tr>
            <td align="center">Status</td>
            <td align="center">Keterangan</td>
            <td align="center" colspan="2">Aksi</td>
        </tr>
        <tr>
            @if (($d->status == 'permintaan'))

            <td>Meminta Penawaran Harga</td>
            <td align="center">Menunggu</td>
            <td align="center" colspan="2">Menunggu</td>

            @else
            <td>Meminta Penawaran Harga</td>
            <td align="center">Permintaan Telah Dikirim</td>
            <td align="center" colspan="2">Selesai</td>
            @endif
        </tr>

        <tr>
            @if ($d->status == 'negoharga')
            <td>Negosiasi Harga</td>
            <td align="center">Rp. 200.000</td>
            <td align="center"><a href="" class="btn btn-xs">Nego</a></td>
            <td align="center"><a href="" class="btn btn-xs">Nego</a></td>
            @elseif(($d->status == 'negomateri') || ($d->status == 'pembayaran') || ($d->status == 'selesai'))
            <td>Deal Harga</td>
            <td align="center">Rp. 200.000</td>
            <td align="center" colspan="2">Selesai</td>
            @endif
        </tr>
        <tr>
            
            @if ($d->status == 'negomateri')
            <td>Negosiasi Materi</td>
            <td align="center">Kirim Materi</td>
            <td align="center" colspan="2">Proses</td>
            @elseif(($d->status == 'pembayaran') || ($d->status == 'selesai'))
            <td>Negosiasi Materi</td>
            <td align="center">Kirim Materi</td>
            <td align="center" colspan="2">Selesai</td>
            @endif
        </tr>
        <tr>
            
            @if ($d->status == 'pembayaran')
            <td>Proses Pembayaran</td>
            <td align="center">Rp. 200.000</td>
            <td align="center" colspan="2">Proses</td>
            @elseif(($d->status == 'selesai'))
            <td>Proses Pembayaran</td>
            <td align="center">Rp. 200.000</td>
            <td align="center" colspan="2">Selesai</td>
            @endif
        </tr>

    </table>

    </table>
    <script>
        $(document).ready(function(){
               // alert('{{$d->status}}');
                if(('{{$d->status}}' == 'permintaan') || ('{{$d->status}}' == 'negoharga') || ('{{$d->status}}' == 'negomateri') || ('{{$d->status}}' == 'pembayaran') || ('{{$d->status}}' == 'selesai')){
                    $('#permintaan').addClass('backgroundGreen');
                }if(('{{$d->status}}' == 'negoharga') || ('{{$d->status}}' == 'negomateri') || ('{{$d->status}}' == 'pembayaran') || ('{{$d->status}}' == 'selesai')){
                    $('#negoHarga').addClass('backgroundGreen');
                    $('#panahNegoHarga').addClass('warnaGreen');
                }
                if(('{{$d->status}}' == 'negomateri') || ('{{$d->status}}' == 'pembayaran') || ('{{$d->status}}' == 'selesai')){
                    $('#negoMateri').addClass('backgroundGreen');
                    $('#panahNegoMateri').addClass('warnaGreen');
                }
                if(('{{$d->status}}' == 'pembayaran') || ('{{$d->status}}' == 'selesai')){
                    $('#pembayaran').addClass('backgroundGreen');
                    $('#panahPembayaran').addClass('warnaGreen');
                }
                if('{{$d->status}}' == 'selesai'){
                    $('#selesai').addClass('backgroundGreen');
                    $('#panahSelesai').addClass('warnaGreen');
                }
            })
    </script>

    @endforeach

</section>
@endsection