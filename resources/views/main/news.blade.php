@extends('main.master')

@section('content')

<style>
    p {
        /* width: 200px;
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis; */

        /* overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        max-height: 3.6em; */
    }

    .text {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        line-height: 16px;
        max-height: 30px;

        /* The number of lines to be displayed */
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .isiBerita p{
        padding-bottom: 0px;
    }
</style>

<div id="portfolio" class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6  py-0 pl-3 pr-1 ">

            <div id="portfolio" class=" mt-0 pt-3 mb-2 pb-2 contrainer" style="">
                <div class="slider slideHeader border" style="width: 100%">
                    <div>
                        <img src="{{asset('assets/img/slider/BillboardWebsite.png')}}" style="width: 100%"
                            height="200px" alt="">
                        <div class="pr-2 pl-2">


                            <h4>text 2</h4>
                            <div style="" class="">
                                <div class="text" style=""><span class="">Lorem ipsum dolor sit amet, consectetur
                                        adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore
                                        magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat. Duis aute irure dolor in reprehenderit
                                        in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur. Excepteur sint occaecat cupidatat non proident,
                                        sunt in culpa qui officia deserunt mollit anim id est
                                        laborum.Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et dolore
                                        magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                        ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                                        aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                        cupidatat non proident, sunt in culpa qui officia deserunt
                                        mollit anim id est laborum. </span></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <img src="{{asset('assets/img/slider/BillboardWebsite.png')}}" style="width: 100%"
                            height="200px" alt="">
                        <div style="" class="">
                            <p class=""><span>Judul</span></p>
                            <p class=" " style="">Deskripsi</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-9 border">
            <div>
                Berita Terkini
            </div>
            <div class="row">
                <div class="col-lg-3 border img-fluid">
                    <img src="{{asset('assets/img/slider/BillboardWebsite.png')}}" class="" height="200" width="200"
                        alt="">
                </div>
                <div class="col-lg-9 border">
                    asd
                </div>
            </div>
        </div>
    </div>
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
    // use PHPHtmlParser\Dom;
    // $dom->loadStr($b->isi, []);
    // $html = $dom->outerHtml;
    echo htmlspecialchars_decode($b->isi);
    @endphp
    </div>
    <div> coba{{!! trim($b->isi,'a') !!}}</div>

    <div>test {{!! parseBerita($b->isi) !!}}</div>
    {{-- <div>control {{!! $isi !!}}
</div> --}}
{{-- <div></div> --}}
{{-- <div>garing {{!!  $isi !!}}
</div> --}}
@endforeach
</div>

<script src="{{asset('js/slider.js')}}"></script>


@endsection