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

    .fa-45x {
        font-size: 45pt;
    }

    .borderCari{
        box-shadow: 0px 0px 12px #ddd;
        border-radius: 1rem;
        z-index: 9999;
    }

    .coruselKecil {}
</style>

<script>
    function landmark(a){
            $('#'+a).hover(function(){
                $('#icon'+a).attr('src', '{{asset("assets/img/landmark")}}/'+a+'-0.png')
                }, function(){
                $('#icon'+a).attr('src', '{{asset("assets/img/landmark")}}/'+a+'.png')
            })
        }
    
</script>

<div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
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
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner ">
        @foreach ($slider as $s)
        @if ($loop->first)
        {{-- This is the first iteration --}}
        <div class="item active">
        @else
        <div class="item">
        @endif
            <div class="fill" style="background-image:url('{{asset('assets/'.$s->url_foto)}}');"></div>
            <div class="carousel-caption slide-up">
                <h1 class="banner_heading"> <span>{{$s->title}} </span></h1>
                <p class="banner_txt">{{$s->deskripsi}}</p>
                {{-- <div class="slider_btn">
                    <button type="button" class="btn btn-default slide">Learn More <i class="fa fa-caret-right"></i></button>
                    <button type="button" class="btn btn-primary slide">Learn More <i class="fa fa-caret-right"></i></button>
                </div> --}}
            </div>
        </div>
        @endforeach

      
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
<br>
<div class="container" style="margin-top: -45px; z-index: 100 ">

    <div class="" id="" style="">
        <div class="borderCari p-4" style="">
            <div class="row  align-items-center" style="">
                <div class="col col-md-3">
                    <h4 class="text-center alighText " style=""><span>Mau Pasang di Kota Mana ?</span></h4>
                </div>
                <div class="col-md-9 ">
                    <div class="row  " style="">

                        <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><img id=''
                                    src="{{asset('assets/img/landmark/surakarta.png')}}" alt="" height="60">
                                <h5><span>Surakarta</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><img id=''
                                    src="{{asset('assets/img/landmark/klaten.png')}}" alt="" height="60">
                                <h5><span>Klaten</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><img id=''
                                    src="{{asset('assets/img/landmark/boyolali.png')}}" alt="" height="60">
                                <h5><span>Boyolali</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><img id=''
                                    src="{{asset('assets/img/landmark/karanganyar.png')}}" alt="" height="60">
                                <h5><span>Karanganyar</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><img id=''
                                    src="{{asset('assets/img/landmark/sragen.png')}}" alt="" height="60">
                                <h5><span>Sragen</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><img id=''
                                    src="{{asset('assets/img/landmark/sukoharjo.png')}}" alt="" height="60">
                                <h5><span>Sukoharjo</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><img id=''
                                    src="{{asset('assets/img/landmark/wonogiri.png')}}" alt="" height="60">
                                <h5><span>Wonogiri</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><img id=''
                                    src="{{asset('assets/img/landmark/semarang.png')}}" alt="" height="60">
                                <h5><span>Semarang</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><img id=''
                                    src="{{asset('assets/img/landmark/salatiga.png')}}" alt="" height="60">
                                <h5><span>Salatiga</span></h5>
                            </a>
                        </div>
                        <div class="col col-md-6 col-xs-6 pb-3 pr-2 pl-2">
                            <a href="#!" class="text-center borderNyala pt-3" id="" style=""><i
                                    class="fas fa-forward  fa-45x  "></i>
                                <h5><span>Show More</span></h5>
                            </a>
                        </div>

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

<div class="container" style="padding-top: 50px">
    <div class=" row ">
        <div class="section-heading text-center">
            <div class="col-md-12 col-xs-12">
                <h1>Our <span>Product</span></h1>
                <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique
                    fierentis ea saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset nam
                    nostrud euismod volumus ne mei.</p>
            </div>
        </div>
    </div>

    @include('item.productIndex')
</div>

        </div>
    </section>


<section id="testimonial">
    <div class="container">
        <div class="section-heading text-center">
            <div class="col-md-12 col-xs-12">
                <h1>Contoh <span>Media Iklan</span> Yang Kita Miliki</h1>
                <p class="subheading">Pilih media iklan yang kalian inginkan.</p>
            </div>

        <div class="row">

            <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                <a href="/product/search?k=billboard" onclick="" class="text-center borderNyala pt-3" id="" style="background-color: white"><img id=''
                        src="{{asset('assets/img/media/billboard.png')}}" alt="" height="150">
                    <h5><span>Billboard</span></h5>
                </a>
            </div>
            <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                <a href="/product/search?k=videotron" class="text-center borderNyala pt-3" id="" style="background-color: white"><img id=''
                        src="{{asset('assets/img/media/videotron.png')}}" alt="" height="150">
                    <h5><span>Videotron</span></h5>
                </a>
            </div>
            <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                <a href="/product/search?k=Digital Display" class="text-center borderNyala pt-3" id="" style="background-color: white"><img id=''
                        src="{{asset('assets/img/media/digital.png')}}" alt="" height="150">
                    <h5><span>Digital Display</span></h5>
                </a>
            </div>
            <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                <a href="/product/search?k=Neon Box" class="text-center borderNyala pt-3" id="" style="background-color: white"><img id=''
                        src="{{asset('assets/img/media/neon.png')}}" alt="" height="150">
                    <h5><span>Neox Box</span></h5>
                </a>
            </div>
            <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                <a href="/product/search?k=Website & Blog" class="text-center borderNyala pt-3" id="" style="background-color: white"><img id=''
                        src="{{asset('assets/img/media/web.png')}}" alt="" height="150">
                    <h5><span>Wensite & Blog</span></h5>
                </a>
            </div>
            <div class="col col-md-2 col-xs-6 pb-3 pr-2 pl-2">
                <a href="/product/search?k=Parking Spot" class="text-center borderNyala pt-3" id="" style="background-color: white"><img id=''
                        src="{{asset('assets/img/media/parking.png')}}" alt="" height="150">
                    <h5><span>Parking Spot</span></h5>
                </a>
            </div>
          
    </div>


    </section>

   
    {{--  --}}

</html>