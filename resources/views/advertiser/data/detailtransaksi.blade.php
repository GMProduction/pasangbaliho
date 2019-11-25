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


    <div class="row ">
        <div class="col-lg-4" style="height: 300px">
            <img src="{{asset('assets/'.$d->url_foto)}}" alt="" width="100%">
        </div>
        <div class="col-lg-8">
            <h4>{{$d->nama_baliho}}</h4>
            <h5>{{$d->alamat}}, {{$d->kota}}, {{$d->provinsi}}</h5>
            <h5>{{formatDateToSurat($d->tanggal_awal)}} s/d {{formatDateToSurat($d->tanggal_akhir)}}</h5>
        </div>
    </div>

    <div class="row align-items-center">
        <div class="col-md-2" style="">
            <div class="fa-4x">
                <span class="fa-layers fa-fw fa-2x" style="">
                    <i class="fas fa-circle" id="permintaan" style="color:#DDDDDD"></i>
                    <i class="fa-inverse fas fa-file-invoice-dollar" data-fa-transform="shrink-6"></i>
                </span>
            </div>
            <h6 class="text-center">Permintaan Harga</h6>
        </div>
        <div class="col-md-1" style="">
            <div class="fa-2x">
                <span class="fa-layers fa-fw fa-2x" style="">
                    <i class="fa fa-arrow-right text-center" id="panahNegoHarga" style="color:#DDDDDD"></i>
                </span>
            </div>
            <br>
        </div>
        <div class="col-md-2" style="">
            <div class="fa-4x">
                <span class="fa-layers fa-fw fa-2x" style="">
                    <i class="fas fa-circle" id="negoHarga" style="color:#DDDDDD"></i>
                    <i class="fa-inverse fas fa-comments-dollar" data-fa-transform="shrink-6"></i>
                </span>
            </div>
            <h6 class="text-center">Nego Harga</h6>
        </div>
        <div class="col-md-1" style="">
            <div class="fa-2x">
                <span class="fa-layers fa-fw fa-2x" style="">
                    <i class="fa fa-arrow-right text-center" id="panahNegoMateri" style="color:#DDDDDD"></i>
                </span>
            </div>
            <br>
        </div>
        <div class="col-md-2" style="">
            <div class="fa-4x">
                <span class="fa-layers fa-fw fa-2x" style="">
                    <i class="fas fa-circle" id="negoMateri" style="color:#DDDDDD"></i>
                    <i class="fa-inverse fas fa-image" data-fa-transform="shrink-6"></i>
                </span>
            </div>
            <h6 class="text-center">Kirim Materi</h6>
        </div>
        <div class="col-md-1" style="">
            <div class="fa-2x" style="">
                <span class="fa-layers fa-fw fa-2x" style="">
                    <i class="fa fa-arrow-right text-center" id="panahPembayaran" style="color:#DDDDDD"></i>
                </span>
            </div>
            <br>
        </div>
        <div class="col-md-2" style="">
            <div class="fa-4x">
                <span class="fa-layers fa-fw fa-2x" style="">
                    <i class="fas fa-circle" id="pembayaran" style="color:#DDDDDD"></i>
                    <i class="fa-inverse fas fa-money-bill" data-fa-transform="shrink-6"></i>
                </span>
            </div>
            <h6 class="text-center">Pembayaran</h6>
        </div>


    </div>

    {{-- <div id="process" style="">
        <div class="row justify-content-center">
            <div class="col-md-2 col-sm-6 bg-red " style="border-radius: 100%">
                <span class="process-icon text-center pl-0" id="" style=""><i
                        class="fas fa-file-invoice-dollar    " style="font-size: 28pt"></i></span>
                <span class="" style="">Penawaran</span>
            </div>
            <div class="col-md-1 col-sm-6 ">
                <span class="process-icon text-center " style="background-color: transparent; color: red !important"><i
                        class="fa fa-arrow-right fa-3x" id="" style="color: #DDDDDD"></i></span>

            </div>
            <div class="col-md-1 col-sm-6">
                <span class="process-icon text-center" id=""><i class="fas fa-comments-dollar"
                        style="font-size: 28pt"></i></span>
                <h6 class="text-center bg-red" style="">Nego</h6>
            </div>
            <div class="col-md-1 col-sm-6 ">
                <span class="process-icon text-center" style="background-color: transparent; color: red !important"><i
                        class="fa fa-arrow-right fa-3x" id="" style="color: #DDDDDD""></i></span>
            </div>
            <div class=" col-md-1 col-sm-6">
                        <span class="process-icon text-center" id=""><i class="fas fa-images    "
                                style="font-size: 28pt"></i></span>
                        <span class="" style="">Materi</span>
            </div>
            <div class="col-md-1 col-sm-6 ">
                <span class="process-icon text-center" style="background-color: transparent; color: red !important"><i
                        class="fa fa-arrow-right fa-3x" id="" style="color: #DDDDDD"></i></span>
            </div>
            <div class="col-md-1 col-sm-6">
                <span class="process-icon text-center" id="pembayaran"><i class="fas fa-money-bill    "
                        style="font-size: 28pt"></i></span>
                <span class="" style="">Pembayaran</span>
            </div>
            <div class="col-md-1 col-sm-6 ">
                <span class="process-icon text-center" style="background-color: transparent; color: red !important"><i
                        class="fa fa-arrow-right fa-3x" id="panahSelesai" style="color: #DDDDDD"></i></span>
            </div>
            <div class="col-md-1 col-sm-6">
                <span class="process-icon text-center" id="selesai"><i class="fa fa-check" aria-hidden="true"
                        style="font-size: 28pt"></i></span>
                <span class="" style="">Selesai</span>
            </div>
        </div>
    </div> --}}
    <br>
    <h5>Status Transaksi</h5>
    <div class="body table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">Status</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center" colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody class="">
                <tr>
                    @if (($d->status == 'permintaan'))

                    <td>Meminta Penawaran Harga</td>
                    <td class="text-center">Diproses</td>
                    <td class="text-center" colspan="2">Menunggu</td>

                    @else
                    <td>Meminta Penawaran Harga</td>
                    <td class="text-center">Permintaan Telah Dikirim</td>
                    <td class="text-center" colspan="2"><i class="fas fa-check-circle col-green   "></i></td>
                    @endif
                </tr>

                <tr>
                    @if ($d->status == 'negoharga')
                    <td>Negosiasi Harga</td>
                    <td class="text-center">Rp. 200.000</td>
                    <td class="text-center" style="width: 50px"><a href="#!" class="btn btn-sm btn-light">Nego</a></td>
                    <td class="text-center" style="width: 50px"><a href="#!" class="btn btn-sm btn-light">Setuju</a></td>
                    @elseif(($d->status == 'negomateri') || ($d->status == 'pembayaran') || ($d->status == 'selesai'))
                    <td>Deal Harga</td>
                    <td class="text-center">Rp. 200.000</td>
                    <td class="text-center" colspan="2"><i class="fas fa-check-circle col-green   "></i></td>
                    @endif
                </tr>
                <tr>

                    @if ($d->status == 'negomateri')
                    <td>Negosiasi Materi</td>
                    <td class="text-center">Kirim Materi</td>
                    <td class="text-center" colspan="2">Proses</td>
                    @elseif(($d->status == 'pembayaran') || ($d->status == 'selesai'))
                    <td>Negosiasi Materi</td>
                    <td class="text-center">Kirim Materi</td>
                    <td class="text-center" colspan="2"><i class="fas fa-check-circle col-green   "></i></td>
                    @endif
                </tr>
                <tr>

                    @if ($d->status == 'pembayaran')
                    <td>Proses Pembayaran</td>
                    <td class="text-center">Rp. 200.000</td>
                    <td class="text-center" colspan="2">Proses</td>
                    @elseif(($d->status == 'selesai'))
                    <td>Proses Pembayaran</td>
                    <td class="text-center">Rp. 200.000</td>
                    <td class="text-center" colspan="2"><i class="fas fa-check-circle col-green   "></i></td>
                    @endif
                </tr>
            </tbody>

        </table>
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
                    $('#negoMateri').addClass('warnaGreen');
                    $('#panahNegoMateri').addClass('warnaGreen');
                }
                if(('{{$d->status}}' == 'pembayaran') || ('{{$d->status}}' == 'selesai')){
                    $('#pembayaran').addClass('warnaGreen');
                    $('#panahPembayaran').addClass('warnaGreen');
                }
                if('{{$d->status}}' == 'selesai'){
                    $('#selesai').addClass('warnaGreen');
                    $('#panahSelesai').addClass('warnaGreen');
                }
            })
    </script>

    @endforeach
    <script src="{{asset('js/font-awesome.min.js')}}"></script>
</section>

<br>
<br>
<br>
<br>
@endsection