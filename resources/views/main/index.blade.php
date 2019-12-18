@extends('main.master')

@section('content')
<link rel="stylesheet" href="{{asset('css/icon.css')}}">



<style>
    .coruselKecil {}

    .captionSLider {
        position: absolute;
        /* left: 15%;                            */
        /* right: 70%; */
        padding-left: 20px;
        bottom: 30%;
        z-index: 10;
        /* padding-top: 20px; */
        padding-bottom: 50px;
        /* color: #fff; */
        text-align: left;
        /* text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6); */

    }

    .captionSLider .judul {
        font-size: 24px;
        font-weight: bolder;
        padding-left: 0px;
        /* margin-top: 60px; */
        text-transform: uppercase;

    }





    .captionSLider .des {
        font-size: 14px;
        font-weight: bolder;
        padding-left: 0px;
        /* margin-top: 60px; */
        line-height: 5px
    }



    @media (max-width : 400px) {
        .slider {
            height: 130px !important;
        }
    }


    @media (max-width : 900px) {
        .captionSLider {
            position: unset !important;

        }

        #portfolio {
            padding-left: 2% !important;
            padding-right: 2% !important;
        }

        .captionSLider .judul {
            font-size: 90% !important;
            margin-bottom: 0px;
        }

        .captionSLider .des {
            font-size: 80% !important;
            line-height: 15px;
        }
    }

  
</style>

<script>


</script>

<div id="portfolio" class=" mt-0 pt-3 mb-2 pb-2 contrainer" style="">
    <div class="slider slideHeader border" style="width: 100%">
        @foreach ($slider as $s)
        <div>
            <img src="{{asset('assets/img/slider/'.$s->url_fotoWeb)}}" style="width: 100%" alt="">
            <div style="" class="captionSLider slide-up">
                <p class="judul"><span>{{$s->title}}</span></p>
                <p class="des " style="">{{$s->deskripsi}}</p>
            </div>
        </div>

        @endforeach
    </div>
</div>


<br>
<div class="container pencarian" style="margin-top: -45px;  ">

    <div class="" id="" style="">
        <div class="borderCari p-4" style="">
            <div class="row  align-items-center pb-4" style="">
                <div class="col col-md-3">
                    <h4 class="text-center alighText " style=""><span>Mau Pasang di Kota Mana ?</span></h4>
                </div>
                <div class="col col-md-9 ">
                    <div class="" style="">
                        <div class="kotaMediaBesar">


                            <div class="col col-md-3 col-xs-6 pb-3 pr-2 pl-2">
                                <a href="/product/search?c=surakarta"
                                    class="text-center borderNyala pt-3 borderSUrakarta" id=""
                                    style="height: 223px"><img id=''
                                        src="{{asset('assets/img/landmark/surakarta.png')}}" alt="" height="130"
                                        class="" style="padding-top: 30px; padding-bottom: 0px">
                                    <h5><span>Surakarta</span></h5>
                                </a>
                            </div>
                            <div class="col col-md-9 pr-0 pl-0 ">
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
                                        style=""><img id='' src="{{asset('assets/img/landmark/karanganyar.png')}}"
                                            alt="" height="60">
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
                        </div>
                        <div class="col col-md-9 pr-0 pl-0 kotaMediaKecil" style="">
                            <div class="slider multiple-items">
                                <div>
                                    <div class="p-2">
                                        <a href="/product/search?c=klaten" class="text-center borderNyala pt-2" id=""
                                            style=""><img id='' src="{{asset('assets/img/landmark/surakarta.png')}}"
                                                alt="" height="50" style="display: unset">
                                            <h5><span>Surakarta</span></h5>
                                        </a>
                                    </div>

                                </div>
                                <div>
                                    <div class="p-2">
                                        <a href="/product/search?c=klaten" class="text-center borderNyala pt-2" id=""
                                            style=""><img id='' src="{{asset('assets/img/landmark/klaten.png')}}" alt=""
                                                height="50" style="display: unset">
                                            <h5><span>Klaten</span></h5>
                                        </a>
                                    </div>

                                </div>
                                <div>
                                    <div class="p-2">
                                        <a href="/product/search?c=klaten" class="text-center borderNyala pt-2" id=""
                                            style=""><img id='' src="{{asset('assets/img/landmark/boyolali.png')}}"
                                                alt="" height="50" style="display: unset">
                                            <h5><span>Boyolali</span></h5>
                                        </a>
                                    </div>

                                </div>
                                <div>
                                    <div class="p-2">
                                        <a href="/product/search?c=klaten" class="text-center borderNyala pt-2" id=""
                                            style=""><img id='' src="{{asset('assets/img/landmark/karanganyar.png')}}"
                                                alt="" height="50" style="display: unset">
                                            <h5><span>Karanganyar</span></h5>
                                        </a>
                                    </div>

                                </div>
                                <div>
                                    <div class="p-2">
                                        <a href="/product/search?c=klaten" class="text-center borderNyala pt-2" id=""
                                            style=""><img id='' src="{{asset('assets/img/landmark/sragen.png')}}" alt=""
                                                height="50" style="display: unset">
                                            <h5><span>Sragen</span></h5>
                                        </a>
                                    </div>

                                </div>
                                <div>
                                    <div class="p-2">
                                        <a href="/product/search?c=klaten" class="text-center borderNyala pt-2" id=""
                                            style=""><img id='' src="{{asset('assets/img/landmark/sukoharjo.png')}}"
                                                alt="" height="50" style="display: unset">
                                            <h5><span>Sukoharjo</span></h5>
                                        </a>
                                    </div>

                                </div>
                                <div>
                                    <div class="p-2">
                                        <a href="/product/search?c=klaten" class="text-center borderNyala pt-2" id=""
                                            style=""><img id='' src="{{asset('assets/img/landmark/wonogiri.png')}}"
                                                alt="" height="50" style="display: unset">
                                            <h5><span>Wonogiri</span></h5>
                                        </a>
                                    </div>

                                </div>
                                <div>
                                    <div class="p-2">
                                        <a href="/product/search?c=klaten" class="text-center borderNyala pt-2" id=""
                                            style=""><img id='' src="{{asset('assets/img/landmark/semarang.png')}}"
                                                alt="" height="50" style="display: unset">
                                            <h5><span>Semarang</span></h5>
                                        </a>
                                    </div>


                                </div>
                                <div>
                                    <div class="p-2">
                                        <a href="/product/search?c=klaten" class="text-center borderNyala pt-2" id=""
                                            style=""><img id='' src="{{asset('assets/img/landmark/salatiga.png')}}"
                                                alt="" height="50" style="display: unset">
                                            <h5><span>Salatiga</span></h5>
                                        </a>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>


                </div>
            </div>



            <div class="" id="">
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-4 col-md-offset-1 col-md-5 col-sm-12 block mb-2">
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

<div class="container">

</div>








<section id="testimonial" style="min-height: 300px" style="">
    <div class="container">
        <div class="section-heading text-center">
            <div class="row">
                <div class="col-lg-12 col-xs-12 ">
                    <h1><span class="">Media Iklan</span> Yang Kita Miliki</h1>
                    <p class="subheading warnaHijauTua">Pilih media iklan yang kamu inginkan.</p>
                </div>
            </div>



            <div class="row container">

                <div class="slider  multiple-items-media " id="">
                    <div>
                        <div class="p-2">
                            <a href="/product/search?k=billboard" onclick=""
                                class="text-center borderNyala pt-3 mediaImg" id="" style="background-color: white"><img
                                    id='' src="{{asset('assets/img/media/billboard.png')}}" alt="" height="100">
                                <h5><span>Billboard</span></h5>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="p-2">
                            <a href="/product/search?k=videotron" class="text-center borderNyala pt-3 mediaImg" id=""
                                style="background-color: white"><img id=''
                                    src="{{asset('assets/img/media/videotron.png')}}" alt="" height="100">
                                <h5><span>Videotron</span></h5>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="p-2">
                            <a href="/product/search?k=Digital Display" class="text-center borderNyala pt-3 mediaImg"
                                id="" style="background-color: white"><img id=''
                                    src="{{asset('assets/img/media/digital.png')}}" alt="" height="100">
                                <h5><span>Digital Display</span></h5>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="p-2">
                            <a href="/product/search?k=Neon Box" class="text-center borderNyala pt-3 mediaImg" id=""
                                style="background-color: white"><img id='' src="{{asset('assets/img/media/neon.png')}}"
                                    alt="" height="100">
                                <h5><span>Neox Box</span></h5>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="p-2">
                            <a href="/product/search?k=Website & Blog" class="text-center borderNyala pt-3 mediaImg"
                                id="" style="background-color: white"><img id=''
                                    src="{{asset('assets/img/media/web.png')}}" alt="" height="100">
                                <h5><span>Website & Blog</span></h5>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="p-2">
                            <a href="/product/search?k=Parking Spot" class="text-center borderNyala pt-3 mediaImg" id=""
                                style="background-color: white"><img id=''
                                    src="{{asset('assets/img/media/parking.png')}}" alt="" height="100">
                                <h5><span>Parking Spot</span></h5>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

</section>


<div class="container" style="">

    <div class="row">
        <div class="col-lg-2 iklan" style=" ">


        </div>
        <div class="col-lg-10 colProduk">
            <h3 class="text-left judulProdukCenter mt-0 pb-2 "><span>Rekomendasi Produk Untuk Anda</span></h3>
            <p class="subheading"></p>
            @include('item.productIndex')
        </div>
    </div>


</div>
<script src="{{asset('js/slider.js')}}"></script>
<script>



</script>


{{--  --}}

@endsection