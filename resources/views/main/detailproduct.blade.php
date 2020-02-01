@extends('main.master')

@section('content')

<link rel="stylesheet" href="{{asset('css/product.css')}}">
<link rel="stylesheet" href="{{asset('css/icon.css')}}">
<link rel="stylesheet" href="{{asset('css/loading.css')}}">

<div class="" id="loading" style="height: 120%; width:100%; position: absolute; z-index: 99; background-color: white" >
    <div class="d-flex justify-content-center align-items-center" style="margin-top: 20%;  left: 50%; top: 50%">
        <div id="fountainG" class="">
            <div id="fountainG_1" class="fountainG"></div>
            <div id="fountainG_2" class="fountainG"></div>
            <div id="fountainG_3" class="fountainG"></div>
            <div id="fountainG_4" class="fountainG"></div>
            <div id="fountainG_5" class="fountainG"></div>
            <div id="fountainG_6" class="fountainG"></div>
            <div id="fountainG_7" class="fountainG"></div>
            <div id="fountainG_8" class="fountainG"></div>
        </div>
    </div>
</div>
<section id="about-page-section-3" class="" >
<div id="detailSH" class="">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                <div class="row pb-2" style="">

                    <div class="col-md-12">

                        <div id="myCarousel" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                @php
                                $i = 0;
                                @endphp

                                @foreach ($foto as $g)

                                @if ($loop->first)
                                <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
                                @else
                                <li data-target="#myCarousel" data-slide-to="{{$i}}" class=""></li>
                                @endif
                                @php
                                $i ++;
                                @endphp

                                @endforeach

                                {{-- <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li> --}}
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @foreach ($foto as $f)

                                @if ($loop->first)
                                <div class="item active">
                                    @else
                                    <div class="item ">
                                        @endif
                                        <div class="fill"
                                            style="background-image:url('{{asset('assets/original/'.$f->url_foto)}}');">
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                                <!-- Left and right controls -->

                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <i
                                        class="fa fa-angle-left" aria-hidden="true"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <i
                                        class="fa fa-angle-right" aria-hidden="true"></i>
                                    <span class="sr-only">Next</span>
                                </a>

                            </div>


                            {{--                         
                        <div class="pro-img-details">
                            <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                        </div>
                        <div class="pro-img-list">

                            <a href="#">
                                <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                            </a>
                        </div> --}}
                    </div>
                </div>

            </div>
            @foreach ($produkDetail as $p)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-align ">
                <div class="section-heading">
                    <h3><span>{{$p->nama_baliho}}</span></h3>
                    <p style="font-size: 14pt">{{$p->alamat}}, {{$p->kota}}, {{$p->provinsi}}</p>


                </div>
                <label style="font-size: 14pt" class="pb-1">Kisaran Harga :
                    @if ($p->tampil_harga == 'satu harga')
                    Rp. {{formatuang($p->harga_market)}} / Bulan

                    @elseif($p->tampil_harga == 'range')
                    Rp. {{formatuang($p->harga_market)}} s/d
                    Rp. {{formatuang($p->harga_max)}} / Bulan
                    @elseif($p->tampil_harga == 'tidak terlihat')

                    Hubungi admin

                    @endif
                </label>
                <br>
                <label style="font-size: 12pt">Spesifikasi</label>
                <table class="table table-noborder" style="max-width: 300px; border: 0">
                    <tr>
                        <td>Jenis Media</td>
                        <td>{{$p->kategori}}</td>
                    </tr>

                    <tr>
                        <td>Orientasi</td>
                        <td>{{$p->orientasi}}</td>
                    </tr>
                    <tr>
                        <td>Ukuran</td>
                        <td>{{$p->tinggi}} x {{$p->lebar}}</td>
                    </tr>
                    <tr>
                        <td>Posisi</td>
                        <td>Attached to Building</td>
                    </tr>

                </table>
                @foreach ($dipesan as $d)
                @if ($loop->first)
                <label style="font-size: 12pt">Baliho Ini Tidak Tersedia Tanggal : </label>
                @endif


                @endforeach
                <div class="row">
                    @foreach ($dipesan as $d)
                    {{-- This is the first iteration --}}


                    {{-- <p>Tanggal {{$d->tanggal_awal}} s/d {{$d->tanggal_akhir}}</p> --}}
                    <div class="col-md-6 col-sm-12">
                        <p>- {{formatDateToSurat($d->tanggal_awal)}} s/d {{formatDateToSurat($d->tanggal_akhir)}}</p>
                    </div>



                    @endforeach
                </div>




                {{-- <a type="button" class="btn btn-primary slide" href="#tglPenawaran">Ajukan Penawaran <i
                        class="fa fa-caret-right"></i></a> --}}

                @php
                    $title =$p->kategori.', '.$p->alamat.', '.$p->kota.', '.$p->provinsi
                @endphp

                @if(auth()->guard('advertiser')->check())
                <button class="btn btn-primary " type="button" data-toggle="modal"
                    data-target="#tglPenawaran">Permintaan
                    Penawaran</button>
                @elseif(auth()->guard('client')->check())
                <button class="btn btn-primary " type="button" onclick="testClient()"
                    data-target=" #tglPenawaran">Permintaan
                    Penawaran</button>
                @else

                <button class="btn btn-primary " type="button" onclick="test()">Permintaan
                    Penawaran</button>
                @endif
                <a href="https://wa.me/628975050520?text=Saya ingin menanyakan harga {{$title}}" target="_blank" class="btn btn-primary" style="padding: 11px 11px 10px 10px" ><i class="fa fa-comment fa-2x"
                        aria-hidden="true" ></i></a>
                        {{-- <a href="#!" onclick="cha()"  class="btn btn-primary" style="padding: 11px 11px 10px 10px" >asd<i class="fa fa-comment fa-2x"
                            aria-hidden="true" ></i></a> --}}
            </div>

        </div>

        <script>
            function cha(){
                Tawk_API.toggle();
                Tawk_API.onLoad = function(){
    Tawk_API.toggle();
    Tawk_API.addTags(tags, callback);

Tawk_API.onLoad = function(){
    Tawk_API.addTags(['hello', 'world'], function(error){});
};
};
            }
            
            </script>


        <div id="tglPenawaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Tanggal Pemasangan</h5>

                    </div>
                    <div class="modal-body">
                        <div class="form-bottom">
                            <form role="form" action="/product/addTransaksi" class="login-form" method="POST">
                                @csrf
                                <input type="hidden" name="id_baliho" value="{{$p->id_baliho}}">
                                <input type="hidden" name="harga" value="{{$p->harga_market}}">
                                @if (auth()->guard('advertiser')->check())
                                <input type="hidden" name="id_advertiser"
                                    value="{{auth()->guard('advertiser')->user()->id}}">
                                @endif


                                <div class="input-group form-group">
                                    {{-- <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span> --}}
                                    <label for="mulai">Tanggal Mulai</label>
                                    <input type="date" id="mulai" class="form-control" name="mulai"
                                        placeholder="Tanggal Mulai" onchange="tgl()">
                                </div>
                                <div class="input-group form-group">
                                    <label for="selesai">Tanggal Selesai</label>
                                    <input type="date" id="selesai" class="form-control" name="selesai"
                                        placeholder="Tanggal Selesai" aria-describedby="basic-addon1">
                                </div>
                                <button type="submit" class="btn">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="mt-5" id="about">
            <div class="  ">
                <div class="text-block p-4">
                    <p style="font-size: 14pt">Deskripsi</p>
                    <p class="" style="text-transform: uppercase; font-synthesis: weight">{{$p->deskripsi}}</p>
                </div>
            </div>
        </div>


        <style>
            #map {
                width: 100%;
                height: 500px;
                background-color: grey;
            }

            .mapouter {
                position: relative;
                text-align: right;
                height: 500px;
                width: 100%;
            }

            .gmap_canvas {
                overflow: hidden;
                background: none !important;
                height: 500px;
                width: 100%;
            }

            .object-fit_contain {
                object-fit: cover
            }

            .showmore:hover {
                background-color: black !important;


            }
        </style>
        <div class="row p-4 pt-5">
            <div class="col-lg-6 col-md-12">
                <p style="font-size: 14pt">Map</p>
                <div id="">

                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas"
                                src="https://maps.google.com/maps?hl=en&amp;q={{$p->latitude}},{{$p->longitude}}&amp;&amp;ie=UTF8&amp;t=&amp;z=18&amp;iwloc=B&amp;output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>

                    </div>
                </div>

                {{-- <div style="width: 100%"><iframe width="100%" height="500"
                        src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=-7.553315,110.743877&amp;&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a
                            href="https://www.maps.ie/coordinates.html">latitude longitude finder</a></iframe></div>
                <br /> --}}

            </div>
            <div class="col-lg-6 col-md-12">
                <p style="font-size: 14pt">Street View</p>
                <div id="street"></div>
                {{-- @include('item.streetview') --}}
            </div>
        </div>

        <div class="mt-5 ">
            <h5><span>Kota Serupa</span></h5>
            <div class="mt-0 pt-0" id="portfolio" style="width: 100%;">
                <div class="slider related-media " id="">
                    @foreach ($related as $p)
                    <div class="p-2">
                        <div class="portfolio-item">
                            <input type="hidden" name="id" value="{{$p->id_baliho}}">
                            <div class="portfolio-one">
                                <div class="portfolio-head">
                                    <div class="portfolio-img containerImg" style="">
                                        @if ($p->url_foto == null)
                                        <img alt="" src="{{asset('assets/noimage.jpg')}}" class="object-fit_contain"
                                            style="" height="129">
                                        @else
                                        <img alt="" src="{{asset('assets/thumbnails/'.$p->url_foto)}}"
                                            class="object-fit_contain"  height="129">
                                        @endif
                                        <div class="bottom-left pr-2 pl-2 "
                                            style=";background-color: green; font-size: 8pt; border-radius: 0.5rem; font-weight: bolder">
                                            {{$p->kategori}}, {{$p->orientasi}}</div>
                                    </div>
                                    @php
                                    $uri = $p->kategori.' '.$p->alamat.' '.$p->kota.' '.$p->provinsi;
                                    $gantiTitik = str_replace('.','',$uri);
                                    $urlweb = str_replace(' ', '-', $gantiTitik);
                                    $title =$p->alamat.', '.$p->kota.', '.$p->provinsi
                                    @endphp



                                </div>


                                <div class="portfolio-content">
                                    <h6 class="title" title="{{$title}}">{{$p->alamat}} </h6>
                                    {{-- <h6 class="title" title="{{$title}}" style="font-size: 12pt">{{$p->kota}},
                                    {{$p->provinsi}}
                                    </h6> --}}
                                    <p class="" style="min-height: 96px">
                                        {{-- <span>{{$p->kategori}}, {{$p->orientasi}} </span> --}}
                                        <span>Ukuran : {{$p->lebar}} cm x {{$p->tinggi}} cm</span>
                                        <br><b>Kisaran Harga :
                                            <br>
                                            @if ($p->tampil_harga == 'satu harga')
                                            Rp. {{formatuang($p->harga_market)}} / Bulan</b>

                                        @elseif($p->tampil_harga == 'range')
                                        Rp. {{formatuang($p->harga_market)}} s/d
                                        <br> Rp. {{formatuang($p->harga_max)}} / Bulan</b>
                                        @elseif($p->tampil_harga == 'tidak terlihat')

                                        Hubungi admin</b>

                                        @endif

                                    </p>
                                    <a href="/m/{{$urlweb}}/{{$p->id_baliho}}"
                                        class="btn btn-block btn-primary btn-sm">Detail</a>

                                </div>
                                <!-- End portfolio-content -->
                            </div>
                            <!-- End portfolio-item -->
                        </div>
                        {{-- @endfor --}}
                    </div>


                    @endforeach
                    <div class="p-2">
                        <div class="portfolio-item">
                            <input type="hidden" name="id" value="">
                            <div class="portfolio-one" style="box-shadow: none">
                                <div class="portfolio-head">
                                    <div class="portfolio-img hidden" style="">
                                        <img alt="" src="{{asset('assets/noimage.jpg')}}" class="object-fit_contain"
                                            style="">

                                    </div>




                                </div>
                                @if ($loop->last)
                                <h2 style="" class="text-center">
                                    <a href="/product/search?c={{$p->kota}}" style="" class="btn" style=""><i
                                            class="fa fa-forward fa-4x" aria-hidden="true"></i></a>
                                    <h4 class="text-center">Tampilkan Semua</h4>
                                    {{-- asda --}}
                                </h2>

                                @endif

                                <div class="portfolio-content hidden">
                                    <h6 class="title" title="" style="font-size: 12pt"></h6>
                                    <p class="pb-1"><span></span>
                                        <br><span>Ukuran :cm</span>
                                        <br><b>Kisaran Harga :
                                            <br>Rp. / Bulan</b>
                                    </p>
                                    <a href="" class="btn btn-block btn-primary btn-sm">Detail</a>

                                </div>
                                <!-- End portfolio-content -->
                            </div>
                            <!-- End portfolio-item -->
                        </div>
                        {{-- @endfor --}}
                    </div>
                </div>

            </div>
        </div>


        <div class="mt-5 ">
            <h5><span>Kategori Serupa</span></h5>
            <div class="mt-0 pt-0" id="portfolio" style="width: 100%;">
                <div class="slider related-media " id="">
                    @foreach ($kategori as $p)
                    <div class="p-2">
                        <div class="portfolio-item">

                            <input type="hidden" name="id" value="{{$p->id_baliho}}">
                            <div class="portfolio-one">
                                <div class="portfolio-head">
                                    <div class="portfolio-img containerImg" style="">
                                        @if ($p->url_foto == null)
                                        <img alt="" src="{{asset('assets/noimage.jpg')}}" class="object-fit_contain"
                                            style="">
                                        @else
                                        <img alt="" src="{{asset('assets/thumbnails/'.$p->url_foto)}}"
                                            class="object-fit_contain">
                                        @endif
                                        <div class="bottom-left pr-2 pl-2 "
                                            style=";background-color: green; font-size: 8pt; border-radius: 0.5rem; font-weight: bolder">
                                            {{$p->kategori}}, {{$p->orientasi}}</div>
                                    </div>
                                    @php
                                    $uri = $p->kategori.' '.$p->alamat.' '.$p->kota.' '.$p->provinsi;
                                    $gantiTitik = str_replace('.','',$uri);
                                    $urlweb = str_replace(' ', '-', $gantiTitik);
                                    $title =$p->alamat.', '.$p->kota.', '.$p->provinsi
                                    @endphp



                                </div>


                                <div class="portfolio-content">
                                    <h6 class="title" title="{{$title}}">{{$p->alamat}} </h6>
                                    {{-- <h6 class="title" title="{{$title}}" style="font-size: 12pt">{{$p->kota}},
                                    {{$p->provinsi}}
                                    </h6> --}}
                                    <p class="" style="min-height: 96px">
                                        {{-- <span>{{$p->kategori}}, {{$p->orientasi}} </span> --}}
                                        <span>Ukuran : {{$p->lebar}} cm x {{$p->tinggi}} cm</span>
                                        <br><b>Kisaran Harga :
                                            <br>
                                            @if ($p->tampil_harga == 'satu harga')
                                            Rp. {{formatuang($p->harga_market)}} / Bulan</b>

                                        @elseif($p->tampil_harga == 'range')
                                        Rp. {{formatuang($p->harga_market)}} s/d
                                        <br> Rp. {{formatuang($p->harga_max)}} / Bulan</b>
                                        @elseif($p->tampil_harga == 'tidak terlihat')

                                        Hubungi admin</b>

                                        @endif

                                    </p>
                                    <a href="/m/{{$urlweb}}/{{$p->id_baliho}}"
                                        class="btn btn-block btn-primary btn-sm">Detail</a>

                                </div>
                                <!-- End portfolio-content -->
                            </div>
                            <!-- End portfolio-item -->
                        </div>
                        {{-- @endfor --}}
                    </div>


                    @endforeach
                    <div class="p-2">
                        <div class="portfolio-item">
                            <input type="hidden" name="id" value="">
                            <div class="portfolio-one" style="box-shadow: none">
                                <div class="portfolio-head">
                                    <div class="portfolio-img hidden" style="">
                                        <img alt="" src="{{asset('assets/noimage.jpg')}}" class="object-fit_contain"
                                            style="">

                                    </div>




                                </div>
                                @if ($loop->last)
                                <h2 style="" class="text-center">
                                    <a href="/product/search?k={{$p->kategori}}" style="" class="btn" style=""><i
                                            class="fa fa-forward fa-4x" aria-hidden="true"></i></a>
                                    <h4 class="text-center">Tampilkan Semua</h4>
                                    {{-- asda --}}
                                </h2>

                                @endif

                                <div class="portfolio-content hidden">
                                    <h6 class="title" title="" style="font-size: 12pt"></h6>
                                    <p class="pb-1"><span></span>
                                        <br><span>Ukuran :cm</span>
                                        <br><b>Kisaran Harga :
                                            <br>Rp. / Bulan</b>
                                    </p>
                                    <a href="" class="btn btn-block btn-primary btn-sm">Detail</a>

                                </div>
                                <!-- End portfolio-content -->
                            </div>
                            <!-- End portfolio-item -->
                        </div>
                        {{-- @endfor --}}
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
        $('#street').load('/showStreetView/{{$p->id_baliho}}');
    })

    </script>

    @endforeach
    </div>
</section>

<script src="{{asset('js/detailProduk.js')}}"></script>


@endsection