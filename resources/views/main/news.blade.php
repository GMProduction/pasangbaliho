@extends('main.master')

@section('content')
<link rel="stylesheet" href="{{asset('css/news.css')}}">


<div id="portfolio" class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6  pt-0 pl-0 pr-1 ">
            <div id="" class="  p-3 contrainer" style="">
                <div class="slider slideHeader border" style="width: 100%">
                    @foreach ($beritaCorusel as $b)
                    @php
                    $uri = $b->judul;
                    $gantiTitik = str_replace('.','',$uri);
                    $urlweb = str_replace(' ', '-', $gantiTitik);

                    @endphp
                    <a href="/news/details/{{$urlweb}}/{{$b->id_news}}" style="" class="">
                        @if ($b->gambar == null)
                        <img alt="" src="{{asset('assets/noimage.jpg')}}" height="250" style="width: 100%">
                        @else
                        <img src="{{asset('assets/img/news/'.$b->gambar)}}" style="width: 100%" height="250" alt="">
                        @endif
                        {{-- <h3 class="P-3" style="">{{$b->judul}} S</h3> --}}
                        <div class="p-3 " title="{{$b->judul}}">
                            <h3 class="judulOver">{{$b->judul}}</h3>
                        </div>
                    </a>
                    @endforeach
                    {{-- <div>
                        <img src="{{asset('assets/img/slider/BillboardWebsite.png')}}" style="width: 100%"
                    height="200px" alt="">
                    <div style="" class="">
                        <p class=""><span>Judul</span></p>
                        <p class=" " style="">Deskripsi</p>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6  pt-3 pl-3 pr-0 ">
        @foreach ($beritaCorusel as $b)
        @php
        $uri = $b->judul;
        $gantiTitik = str_replace('.','',$uri);
        $urlweb = str_replace(' ', '-', $gantiTitik);

        @endphp
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pb-2 ">
            <a href="/news/details/{{$urlweb}}/{{$b->id_news}}" style="" class="">
                <div class="p-2 border" style="height: 152px">
                    @if ($b->gambar == null)
                    <img alt="" src="{{asset('assets/noimage.jpg')}}" height="120" style="width: 100%">
                    @else
                    <img src="{{asset('assets/img/news/'.$b->gambar)}}" style="width: 100%" height="115px" alt="">
                    @endif

                    <label style="margin-bottom: 0px" class="judulOverKecil" title="{{$b->judul}}">{{$b->judul}}</label>
                </div>
            </a>
        </div>
        @endforeach

    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-9  mt-4 ">
        <div style="" class="mb-3 backgroundGreen">
            <h3 class="p-3 " style="color: white">Berita Terkini</h3>
        </div>
        @foreach ($berita as $b)
        @php
        $uri = $b->judul;
        $gantiTitik = str_replace('.','',$uri);
        $urlweb = str_replace(' ', '-', $gantiTitik);

        @endphp
        <div class="row  p-4">
            <div class="col-lg-3 col-md-3 col-sm-3 img-fluid">
                @if ($b->gambar == null)
                <img alt="" src="{{asset('assets/noimage.jpg')}}" height="120" style="width: 100%">
                @else
                <img src="{{asset('assets/img/news/'.$b->gambar)}}" style="width: 100%" height="120" alt="">
                @endif
            </div>
            <div class="col-lg-9 ">
                <h5>{{$b->judul}}</h5>
                <div class="text isiBerita" style="">
                    @php
                    echo htmlspecialchars_decode($b->isi);
                    @endphp
                </div>
                <a href="/news/details/{{$urlweb}}/{{$b->id_news}}" class="">Read More</a>
            </div>
        </div>
        @endforeach
    </div>
    {{$berita->links()}}
</div>

{{-- 
<div class=" col-12 col-sm-12 col-md-6 col-lg-6  py-0 pl-3 pr-1 ">
    <div class="col-6 col-md-6 bg-red">
        asd
    </div>
    <div class="col-6 col-md-6 bg-red">
        asd
    </div>
    <div class="col-6 col-md-6 bg-red">
        asd
    </div>
    <div class="col-6 col-md-6 bg-red">
        asd
    </div>
</div>


</div>

<div style="min-height: 700px" class="p-4">
    <div class="container">
        <h3>Berita Terkini</h3>
    </div>
    @foreach ($berita as $b)
    <div class="isiBerita" style="">
        @php
        echo htmlspecialchars_decode($b->isi);
        @endphp
    </div>

    @endforeach
</div> --}}

<script>
   
</script>

<script src="{{asset('js/slider.js')}}"></script>


@endsection