@extends('advertiser.advertiser')
@section('content')

<style>
    body #process {
        background-color: #fff;
    }

    body #process .process-block {
        text-align: center;
    }

    body #process .process-icon {
        width: 90px;
        height: 90px;
        line-height: 100px;
        background-color: #ddd;
        border-radius: 100%;
        display: inline-block;
    }

    body #process .process-border {
        position: absolute;
        /* top: 100px; */
        /* left: 50%; */
        -webkit-transform: translateX(-50%) translateY(-50%);
        -ms-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
        line-height: 0;
        border-radius: 50%;
        border: 0 solid transparent;
        box-sizing: border-box;
        -webkit-transition: border 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transition: border 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    body #process .process-icon i {
        color: #fff;
        font-size: 25px;
    }

    body #process .process-icon-holder {
        width: 200px;
        height: 200px;
        background: #fff;
        text-align: center;
        line-height: 200px;
        border: 3px solid #ddd;
        vertical-align: middle;
        border-radius: 100%;
        margin: 0 auto 20px;
    }

    body #process .process-icon-holder::after {
        content: "";
        width: 20%;
        position: absolute;
        /* border-bottom: 2px dashed #ddd; */
        /* top: 30%; */
        /* left: 100%; */
        transform: translateX(-50%);
    }

    body #process .lastchild .process-icon-holder::after {
        border-bottom: 0px;
    }

    /*
@media screen and (max-width: 1024px) {
body #process .process-border {
	top: 27%;
}
}
@media screen and (max-width: 980px) {
body #process .process-border {
	top: 30%;
}
}
@media screen and (max-width: 768px) {
body #process .process-icon-holder::after {
	border: 0px;
}
body #process .process-border {
	top: 30%;
}
}

@media screen and (min-width: 641px) and (max-width: 767px) {
body #process .process-border {
	top: 34%;
}
}
@media screen and (min-width: 441px) and (max-width: 640px) {
body #process .process-border {
	top: 34%;
}
}
@media screen and (min-width: 375px) and (max-width: 440px) {
body #process .process-border {
	top: 31%;
}
}
@media screen and (min-width: 320px) and (max-width: 374px) {
body #process .process-border {
	top: 29%;
}
} */
</style>
<section id="about-page-section-">

    @foreach ($data as $d)


    <div class="row pb-3">
        <div class="col-lg-4" style="">
            <img src="{{asset('assets/original/'.$d->url_foto)}}" alt="" width="100%">
        </div>
        <div class="col-lg-8">
            <h4 class="warnaGreen">{{$d->nama_baliho}}</h4>
            <h5>{{$d->alamat}}, {{$d->kota}}, {{$d->provinsi}}</h5>
            <h5>{{formatDateToSurat($d->tanggal_awal)}} s/d {{formatDateToSurat($d->tanggal_akhir)}} ({{ $selisih }})
            </h5>
            <h5 class="pt-3">Harga : Rp. {{formatuang($d->harga_market)}} / Bulan</h5>
        </div>
    </div>
    <div class="body table-responsive table-borderless">
        <table class="table ">
            <tr>
                <td class="text-center">
                    <span class="fa-layers fa-fw fa-3x" style="">
                        <i class="fas fa-circle" id="permintaan" style="color:#DDDDDD"></i>
                        <i class="fa-inverse fas fa-file-invoice-dollar" data-fa-transform="shrink-6"></i>
                    </span>

                </td>
                <td class="text-center" rowspan="2" style="vertical-align: middle">
                    <i class="fa fa-arrow-right text-center fa-2x " id="panahNegoHarga"
                        style="color:#DDDDDD;vertical-align: middle !important "></i>
                </td>
                <td class="text-center">
                    <span class="fa-layers fa-fw fa-3x" style="">
                        <i class="fas fa-circle" id="negoHarga" style="color:#DDDDDD"></i>
                        <i class="fa-inverse fas fa-comments-dollar" data-fa-transform="shrink-6"></i>
                    </span>
                </td>

                <td class="text-center" rowspan="2" style="vertical-align: middle">
                    <i class="fa fa-arrow-right text-center fa-2x" id="panahPembayaran" style="color:#DDDDDD"></i>
                </td>
                <td class="text-center">
                    <span class="fa-layers fa-fw fa-3x" style="">
                        <i class="fas fa-circle" id="pembayaran" style="color:#DDDDDD"></i>
                        <i class="fa-inverse fas fa-money-bill" data-fa-transform="shrink-6"></i>
                    </span>
                </td>

                <td class="text-center" rowspan="2" style="vertical-align: middle">
                    <i class="fa fa-arrow-right text-center fa-2x" id="panahNegoMateri" style="color:#DDDDDD"></i>


                </td>
                <td class="text-center">
                    <span class="fa-layers fa-fw fa-3x" style="">
                        <i class="fas fa-circle" id="negoMateri" style="color:#DDDDDD"></i>
                        <i class="fa-inverse fas fa-image" data-fa-transform="shrink-6"></i>
                    </span>
                </td>



                <td class="text-center" rowspan="2" style="vertical-align: middle">
                    <i class="fa fa-arrow-right text-center fa-2x" id="panahSelesai" style="color:#DDDDDD"></i>

                </td>

                <td class="text-center">
                    <span class="fa-layers fa-fw fa-3x" style="">
                        <i class="fas fa-circle" id="selesai" style="color:#DDDDDD"></i>
                        <i class="fa-inverse fas fa-check" data-fa-transform="shrink-6"></i>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="text-center"><Span>Permintaan Harga</Span></td>
                <td class="text-center"><span>Harga Disetujui</span></td>
                <td class="text-center"><span>Pembayaran</span></td>
                <td class="text-center"><span>Kirim Materi</span></td>
                <td class="text-center"><span>Selesai</span></td>
            </tr>
        </table>
    </div>

    <br>
    <h5>Status Transaksi</h5>
    <div class="body table-responsive" style="">
        <table class="table table-hover" style="min-width: 500px">
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align: middle">Status</th>
                    <th class="text-center" style="vertical-align: middle">Keterangan</th>
                    <th class="text-center" style="vertical-align: middle" style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody class="">
                <tr>
                    @if (($d->status == 'permintaan'))

                    <td>Meminta Penawaran Harga</td>
                    <td class="text-center">Diproses</td>
                    <td class="text-center" style="vertical-align: middle">Menunggu</td>

                    @else
                    <td class="" style="vertical-align: middle">Meminta Penawaran Harga</td>
                    <td class="text-center" style="vertical-align: middle">Permintaan Telah Dikirim</td>
                    <td class="text-center" style="vertical-align: middle"><i
                            class="fas fa-check-circle col-green   "></i></td>
                    @endif
                </tr>

                <tr>
                    @if ($d->status == 'negoharga')
                    <td style="vertical-align: middle">Negosiasi Harga <span style="font-size: 10pt; font-weight: bold">
                            (Jika ingin mengajukan negisiasi harga silahkan chat admin) </span>
                    </td>
                    <td class="text-center" style="vertical-align: middle">Rp. {{formatuang($d->harga_deal)}}</td>

                    <td class="text-center" style="vertical-align: middle"><a href="#!"
                            class="btn btn-sm btn-info">Setuju</a>
                    </td>
                    @elseif(($d->status == 'negomateri') || ($d->status == 'pembayaran') || ($d->status == 'selesai'))
                    <td style="vertical-align: middle">Deal Harga</td>
                    <td class="text-center" style="vertical-align: middle">Rp. {{formatuang($d->harga_deal)}}</td>
                    <td class="text-center" style="vertical-align: middle"><i
                            class="fas fa-check-circle col-green   "></i></td>
                    @endif
                </tr>

                <tr>

                    @if ($d->status == 'pembayaran')
                    <td style="vertical-align: middle">Pembayaran (status : <b> {{$d->paymentStatus}} </b>) <a
                            href="#hisPembayaran" data-toggle="modal" data-target="#hisPembayaran"
                            class="btn btn-info bt-sm" aria-label="asdasd" alt="asd"
                            style="border-radius: 50%; width: 34px" data-toggle="tooltip" data-placement="top"
                            title="History Pembayaran"><i class="fa fa-history" aria-hidden="true"></i></a>
                    </td>
                    <td class="text-center" style="vertical-align: middle">Rp. {{formatuang($d->saldo)}}</td>
                    <td class="text-center" style="vertical-align: middle">
                        {{--  <a href="payment/{{$d->id_transaksi}}"
                        class="btn btn-warning btn-sm">Bayar Sekarang</a> --}}
                        <form method="post" action="/payment">
                            <input type="hidden" name="id_transaksi" value={{$d->id_transaksi}} />
                            <input type="submit" class="btn btn-warning" value="Bayar Sekarang" name="Submit">
                        </form>
                    </td>
                   
                    @elseif(($d->status == 'negomateri') || ($d->status == 'selesai'))
                    <td style="vertical-align: middle">Pembayaran (status : <b>{{$d->paymentStatus}}</b> )<a
                            href="#hisPembayaran" data-toggle="modal" data-target="#hisPembayaran"
                            class="btn btn-info bt-sm" aria-label="asdasd" alt="asd"
                            style="border-radius: 50%; width: 34px" data-toggle="tooltip" data-placement="top"
                            title="History Pembayaran"><i class="fa fa-history" aria-hidden="true"></i></a></td>
                    <td class="text-center" style="vertical-align: middle">Rp. {{formatuang($d->saldo)}}</td>
                    <td class="text-center" style="vertical-align: middle">
                        <form method="post" action="/payment">
                            <input type="hidden" name="id_transaksi" value={{$d->id_transaksi}} />
                            <input type="submit" class="btn btn-warning" value="Bayar Sekarang" name="Submit">
                        </form>
                        {{--  <a href="payment/{{$d->id_transaksi}}"
                        class="btn btn-warning btn-sm">Bayar Sekarang</a> --}}
                    </td>
                    @endif
                </tr>
                <tr>

                    @if ($d->status == 'negomateri')
                    <td style="vertical-align: middle">Negosiasi Materi <span
                            style="font-size: 10pt; font-weight: bold">
                            (Silahan kirim materi melalui WA admin) </span></td>
                    <td class="text-center" style="vertical-align: middle">Kirim Materi</td>
                    <td class="text-center" style="vertical-align: middle">Proses</td>
                    @elseif(($d->status == 'selesai'))
                    <td style="vertical-align: middle">Negosiasi Materi</td>
                    <td class="text-center" style="vertical-align: middle">Kirim Materi</td>
                    <td class="text-center" style="vertical-align: middle"><i
                            class="fas fa-check-circle col-green   "></i></td>
                    @endif
                </tr>
            </tbody>

        </table>
        @if(($d->status == 'selesai'))
        <h3 class="text-center pt-3">Iklan anda akan segera kami pasang</h3>
        <h4 class="text-center">Mohon tunggu beberapa hari</h4>
        <h4 class="text-center">Terima Kasih</h4>
        @endif
    </div>



    <div id="hisPembayaran" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="">
            <div class="modal-content">

                <div class="modal-body">
                    <h5>History Pembayaran</h5>
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <td class="text-center">Tanggal</td>
                                <td class="text-center">Bank</td>
                                <td class="text-center">Nominal</td>
                                <td class="text-center">Status</td>
                                <td class="text-center">Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment as $p)
                            <tr>
                                <td>{{formatDateToSurat($p->created_at)}}</td>
                                <td class="text-center">{{$p->vendor}}</td>
                                <td class="text-right">{{formatRupiah($p->nominal)}}</td>
                                <td class="text-center">{{$p->status}}</td>
                                <td>{{$p->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
               // alert('{{$d->status}}');
                if(('{{$d->status}}' == 'permintaan') || ('{{$d->status}}' == 'negoharga') || ('{{$d->status}}' == 'negomateri') || ('{{$d->status}}' == 'pembayaran') || ('{{$d->status}}' == 'selesai')){
                    $('#permintaan').addClass('warnaGreen');
                }if(('{{$d->status}}' == 'negoharga') || ('{{$d->status}}' == 'negomateri') || ('{{$d->status}}' == 'pembayaran') || ('{{$d->status}}' == 'selesai')){
                    $('#negoHarga').addClass('warnaGreen');
                    $('#panahNegoHarga').addClass('warnaGreen');
                }
                if(('{{$d->status}}' == 'negomateri') || ('{{$d->status}}' == 'pembayaran') || ('{{$d->status}}' == 'selesai')){
                    $('#pembayaran').addClass('warnaGreen');
                    $('#panahPembayaran').addClass('warnaGreen');
                }
                if(('{{$d->status}}' == 'negomateri') || ('{{$d->status}}' == 'selesai')){
                    $('#negoMateri').addClass('warnaGreen');
                    $('#panahNegoMateri').addClass('warnaGreen');
                }
                if('{{$d->status}}' == 'selesai'){
                    $('#selesai').addClass('warnaGreen');
                    $('#panahSelesai').addClass('warnaGreen');
                }
            })
    </script>


    <script src="{{asset('js/font-awesome.min.js')}}"></script>
    <script src="{{asset('js/sha1.js')}}"></script>
    <script>
        $(document).ready(function () {
            var sh = iPay88Signature("5Z1cr9UxDkID01270"+{{$d->id_transaksi}}+""+{{$d->harga_deal}}+"00IDR");
        $('#Signature').val(sh);
        })

    </script>
</section>
@endforeach

<br>
<br>
<br>
<br>
@endsection