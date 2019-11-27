@extends('main.master')

@section('content')
<style>
    .borderNyala {
        border: 1px solid #c0c0c0;
        border-radius: 1rem;
        text-decoration: none;
    }

    .borderNyala:hover {
        border: 1px solid #26A69A;
        box-shadow: 0px 0px 12px #ddd;
    }
    .borderSUrakarta {
            /* height: 223; */
        }

    @media (max-width: 950px) {
        .borderSUrakarta {
            height: unset !important;
        }
        .borderSUrakarta > img {
            height: 60pt !important;
            padding: 0px;
        }


    }

    .fa-45x {
        font-size: 45pt;
    }



    .coruselKecil {}
</style>



<div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    {{-- <ol class="carousel-indicators">
        @php
        $i = 0;
        @endphp

        @foreach ($slider as $g)

        @if ($loop->first)
        <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
    @else
    <li data-target="#myCarousel" data-slide-to="{{$i}}" class=""></li>
    @endif
    @php
    $i ++;
    @endphp

    @endforeach
    </ol> --}}

    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        <li data-target="#myCarousel" data-slide-to="3" class=""></li>
        <li data-target="#myCarousel" data-slide-to="4" class=""></li>

    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner ">
        {{-- @foreach ($slider as $s)
        @if ($loop->first)
        <div class="item active">
            @else
            <div class="item">
                @endif
                <div class="fill" style="background-image:url('{{asset('assets/'.$s->url_foto)}}');"></div>
    <div class="carousel-caption slide-up">
        <h1 class="banner_heading"> <span>{{$s->title}} </span></h1>
        <p class="banner_txt">{{$s->deskripsi}}</p>

    </div>
</div>
@endforeach
</div> --}}
<div class="item active">
    <div class="fill" style="background-image:url('{{asset('assets/img/slider/BillboardWebsite.png')}}');"></div>
    <div class="carousel-caption slide-up">
        {{-- <h1 class="banner_heading"> <span>sdfsdf </span></h1>
        <p class="banner_txt">asasdasdasdas asd asd as das das das ddad</p> --}}

    </div>
</div>
<div class="item">
    <div class="fill" style="background-image:url('{{asset('assets/img/slider/Digital Website.png')}}');"></div>
    <div class="carousel-caption slide-up">
        {{-- <h1 class="banner_heading"> <span>sdfsdf </span></h1>
            <p class="banner_txt">asdad</p> --}}

    </div>
</div>
<div class="item">
    <div class="fill" style="background-image:url('{{asset('assets/img/slider/Videotron Website.png')}}');"></div>
    <div class="carousel-caption slide-up">
        {{-- <h1 class="banner_heading"> <span>sdfsdf </span></h1>
                <p class="banner_txt">asdad</p> --}}

    </div>
</div>
<div class="item">
    <div class="fill" style="background-image:url('{{asset('assets/img/slider/Website & Blog Website.png')}}');"></div>
    <div class="carousel-caption slide-up">
        {{-- <h1 class="banner_heading"> <span>sdfsdf </span></h1>
                    <p class="banner_txt">asdad</p> --}}

    </div>
</div>
<!-- Left and right controls -->

<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <i class="fa fa-angle-left"
        aria-hidden="true"></i>
    <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <i class="fa fa-angle-right"
        aria-hidden="true"></i>
    <span class="sr-only">Next</span>
</a>

</div>
</div>
<br>
<div class="container" style="margin-top: -45px;  ">

    <div class="" id="" style="">
        <div class="borderCari p-4" style="">
            <div class="row  align-items-center" style="">
                <div class="col col-md-3">
                    <h4 class="text-center alighText " style=""><span>Mau Pasang di Kota Mana ?</span></h4>
                </div>
                <div class="col col-md-9 ">
                    <div class="" style="">

                        <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="/product/search?c=surakarta" class="text-center borderNyala pt-3 borderSUrakarta" id=""
                                style="height: 223px"><img id='' src="{{asset('assets/img/landmark/surakarta.png')}}" alt=""
                                    height="130" class="" style="padding-top: 30px; padding-bottom: 0px">
                                <h5><span>Surakarta</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-9 pr-0 pl-0">
                            <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                                <a href="/product/search?c=klaten" class="text-center borderNyala pt-3" id=""
                                    style=""><img id='' src="{{asset('assets/img/landmark/klaten.png')}}" alt=""
                                        height="60">
                                    <h5><span>Klaten</span></h5>
                                </a>
                            </div>
                            <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                                <a href="/product/search?c=boyolali" class="text-center borderNyala pt-3" id=""
                                    style=""><img id='' src="{{asset('assets/img/landmark/boyolali.png')}}" alt=""
                                        height="60">
                                    <h5><span>Boyolali</span></h5>
                                </a>
                            </div>
                            <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                                <a href="/product/search?c=karanganyar" class="text-center borderNyala pt-3" id=""
                                    style=""><img id='' src="{{asset('assets/img/landmark/karanganyar.png')}}" alt=""
                                        height="60">
                                    <h5><span>Karanganyar</span></h5>
                                </a>
                            </div>
                            <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                                <a href="/product/search?c=sragen" class="text-center borderNyala pt-3" id=""
                                    style=""><img id='' src="{{asset('assets/img/landmark/sragen.png')}}" alt=""
                                        height="60">
                                    <h5><span>Sragen</span></h5>
                                </a>
                            </div>
                            <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                                <a href="/product/search?c=sukoharjo" class="text-center borderNyala pt-3" id=""
                                    style=""><img id='' src="{{asset('assets/img/landmark/sukoharjo.png')}}" alt=""
                                        height="60">
                                    <h5><span>Sukoharjo</span></h5>
                                </a>
                            </div>
                            <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                                <a href="/product/search?c=wonogiri" class="text-center borderNyala pt-3" id=""
                                    style=""><img id='' src="{{asset('assets/img/landmark/wonogiri.png')}}" alt=""
                                        height="60">
                                    <h5><span>Wonogiri</span></h5>
                                </a>
                            </div>
                            <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                                <a href="/product/search?c=semarang" class="text-center borderNyala pt-3" id=""
                                    style=""><img id='' src="{{asset('assets/img/landmark/semarang.png')}}" alt=""
                                        height="60">
                                    <h5><span>Semarang</span></h5>
                                </a>
                            </div>
                            <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                                <a href="/product/search?c=salatiga" class="text-center borderNyala pt-3" id=""
                                    style=""><img id='' src="{{asset('assets/img/landmark/salatiga.png')}}" alt=""
                                        height="60">
                                    <h5><span>Salatiga</span></h5>
                                </a>
                            </div>
                        </div>

                        {{-- <div class="col col-md-6 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="/product/search?d=all" class="text-center borderNyala pt-3" id="" style=""><i
                                    class="fas fa-forward  fa-45x  "></i>
                                <h5><span>Show More</span></h5>
                            </a>
                        </div> --}}

                    </div>


                </div>
            </div>



            <div class="" id="">
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-4 col-md-offset-1 col-md-5 col-sm-12 block">
                        <select name="" id="kategori" class="form-control" style="height: 45px">
                            <option value="">Semua Kategori</option>
                            <option value="Videotron">Videotron</option>
                            <option value="Baliho">Baliho</option>
                            <option value="Billboard">Billboard</option>
                            <option value="Neon Box">Neon Box</option>
                            <option value="Banner">Banner</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <select name="" id="kota" class="form-control" style="height: 45px">
                            <option value="">Semua Kota</option>
                            @foreach ($kota as $k)
                            <option value="{{$k->nama_kota}}">{{$k->nama_kota}}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
                <div class="row pt-3">
                    <div class="col-lg-offset-5 col-lg-2 col-lg-offset-2">
                        <a href="#!" class="btn btn-primary btn-block btn-sm btn-rounded" style=""
                            onclick="cariProdukIndex()"><i class="fas fa-search    "></i> Cari</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<section id="testimonial" style="min-height: 300px" style="">
    <div class="container">
        <div class="section-heading text-center">
            <div class="col-md-12 col-xs-12 ">
                <h1><span class="">Media Iklan</span> Yang Kita Miliki</h1>
                <p class="subheading warnaHijauTua">Pilih media iklan yang kamu inginkan.</p>
            </div>

            <div class="row">

                <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                    <a href="/product/search?k=billboard" onclick="" class="text-center borderNyala pt-3" id=""
                        style="background-color: white"><img id='' src="{{asset('assets/img/media/billboard.png')}}"
                            alt="" height="100">
                        <h5><span>Billboard</span></h5>
                    </a>
                </div>
                <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                    <a href="/product/search?k=videotron" class="text-center borderNyala pt-3" id=""
                        style="background-color: white"><img id='' src="{{asset('assets/img/media/videotron.png')}}"
                            alt="" height="100">
                        <h5><span>Videotron</span></h5>
                    </a>
                </div>
                <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                    <a href="/product/search?k=Digital Display" class="text-center borderNyala pt-3" id=""
                        style="background-color: white"><img id='' src="{{asset('assets/img/media/digital.png')}}"
                            alt="" height="100">
                        <h5><span>Digital Display</span></h5>
                    </a>
                </div>
                <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                    <a href="/product/search?k=Neon Box" class="text-center borderNyala pt-3" id=""
                        style="background-color: white"><img id='' src="{{asset('assets/img/media/neon.png')}}" alt=""
                            height="100">
                        <h5><span>Neox Box</span></h5>
                    </a>
                </div>
                <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                    <a href="/product/search?k=Website & Blog" class="text-center borderNyala pt-3" id=""
                        style="background-color: white"><img id='' src="{{asset('assets/img/media/web.png')}}" alt=""
                            height="100">
                        <h5><span>Website & Blog</span></h5>
                    </a>
                </div>
                <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                    <a href="/product/search?k=Parking Spot" class="text-center borderNyala pt-3" id=""
                        style="background-color: white"><img id='' src="{{asset('assets/img/media/parking.png')}}"
                            alt="" height="100">
                        <h5><span>Parking Spot</span></h5>
                    </a>
                </div>

            </div>


</section>


<div class="container" style="padding-top: 50px">
    <div class=" row ">
        <div class="section-heading text-center">
            <div class=" col-md-offset-2 col-md-10 col-xs-12">
                <h1><span>Product</span></h1>
                <p class="subheading">Produk Baliho.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-10">
            @include('item.productIndex')
        </div>
    </div>


</div>


{{--  --}}

@endsection