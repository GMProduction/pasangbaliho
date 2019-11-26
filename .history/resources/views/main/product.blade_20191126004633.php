@extends('main.master')

@section('content')

<div class="flash-data" data-flashdata=""></div>
<section id="portfolio">
    <div class="container">
        <div class="borderCari pt-4 pb-4">
            <div class="row pb-3">

                <div class="col-lg-3 col-md-6 col-sm-12 iconKategori">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" value="{{old('kategori')}}">
                        <option value="">Kategori</option>
                        <option value="Videotron">Videotron</option>
                        <option value="Baliho">Baliho</option>
                        <option value="Billboard">Billboard</option>
                        <option value="Neon Box">Neon Box</option>
                        <option value="Banner">Banner</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 iconKategori">
                    <label for="kota">Kota</label>
                    <select name="kota" id="kota" class="form-control">
                        <option value="">Semua Kota</option>
                        @foreach ($kota as $k)
                        <option value="{{$k->nama_kota}}">{{$k->nama_kota}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 iconKategori">
                    <label for="sort">Sort By</label>
                    <select name="sort" id="sort" class="form-control">
                        <option value="">Sort By</option>
                        <option value="">Termurah</option>
                        <option value="">Terkecil</option>
                        <option value="">Terbesar</option>

                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 iconKategori">
                    <label for="">Text</label>
                    <input type="text" name="txtCari" id="txtCari" class="form-control" value="{{old('txtCari')}}">
                </div>
            </div>
            <div class="row justify-content-center p-3">
                <div>
                    <button type="submit" id="btn-cari" class="btn btn-sm btn-block btn-primary"
                        onclick="cariProduk()">Cari</button>
                </div>

            </div>
        </div>
    </div>
    <div class="pt-5 container">
        <div class="row p-4">

            <div class="">
                {{-- @include('item.productindex') --}}

                <section id="portfolio" style="padding-top: 0px">
                    <div class="">
                        {{-- <div class="row">
                                <div class="section-heading text-center">
                                    <div class="col-md-12 col-xs-12">
                                        <h1>Our <span>Product</span></h1>
                                        <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique
                                            fierentis ea saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset nam
                                            nostrud euismod volumus ne mei.</p>
                                    </div>
                                </div>
                            </div> --}}
                        <div class="row">
               
                                
                            
                            @forelse ($produk as $p)

                            <input type="hidden" name="id" value="{{$p->id_baliho}}">
                            {{-- @for ($i = 0; $i < 8; $i++)  --}}
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 portfolio-item">
                                <div class="portfolio-one" style="">
                                    <div class="portfolio-head">
                                        <div class="portfolio-img">
                                            @if ($p->url_foto == null)
                                            <img alt="" src="{{asset('assets/noimage.jpg')}}">
                                            @else
                                            <img alt="" src="{{asset('assets/'.$p->url_foto)}}">
                                            @endif
                                        </div>
                                        {{-- <div class="portfolio-hover">
                                                <a class="portfolio-link" href="#"><i class="fa fa-link"></i></a>
                                                <a class="portfolio-zoom" href="#"><i class="fa fa-search"></i></a>
                                            </div> --}}
                                    </div>
                                    <!-- End portfolio-head -->
                                    <div class="portfolio-content">
                                        <h5 class="title">{{$p->kategori}}</h5>
                                        <p class="pb-1">
                                            <span>{{$p->alamat}}, {{$p->kota}}</span>
                                            <br><b>Kisaran Harga :
                                                <br>Rp. {{formatuang($p->harga_market)}} / Bulan</b>
                                        </p>
                                            <a href="/product/detail?id={{$p->id_baliho}}&n={{$p->nama_baliho}}&l={{$p->alamat}},{{$p->kota}},{{$p->provinsi}}"
                                                class="btn btn-block btn-primary btn-sm">Detail</a>

                                    </div>
                                    <!-- End portfolio-content -->
                                </div>
                                <!-- End portfolio-item -->
                            </div>
                            {{-- @endfor --}}
                            @empty
                            <div style="min-height: 300px">
                                    <h1 class="text-center"><i class="fa fa-search fa-3x" aria-hidden="true"></i></h1>
                                    <h2 class="text-center">No result Found </h2>

                            </div>
                            @endforelse
                        </div>

                    </div>



                </section>



                {{$produk->links()}}
            </div>

        </div>

    </div>

    <script>
        // function cariProduk() {
        //     var k = $('#kategori').val();
        //     var ko = $('#kota').val();
        //     var p = $('#prov').val();
        //     var t = $('#txtCari').val();
        //     var kota = "";
        //     var kate = "";
            

        //     if(ko !== ""){
        //         ko = '&&c='+ko;
        //     }
        //     if(k !== ''){
        //         k = 'k='+k;
        //     }
        //     if(t !== ''){
        //         t = '&&t='+t;
        //     }
        //     if(p !== ''){
        //         p = '&&p='+p
        //     }

        //         document.location = '/product/search?'+k+p+ko+t;
           
        //     // alert(ko)
           
        // }
    </script>




</section>
@endsection