@extends('main.master')

@section('content')

<style>
    @media (max-width: 990px) {
        .balihoRelated {
            display: none;
        }
    }
</style>
<div id="portfolio " class="mt-3" style="min-height: 600px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-9">
                <div id="berita" class="">
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mt-5 balihoRelated mb-3">
                <div class="">
                    <div class="">
                        <h4 class="text-center warnatop p-3">Produk Baliho</h4>
                    </div>
                    @foreach ($produk as $p)
                    @php
                    $uri = $p->kategori.' '.$p->alamat.' '.$p->kota.' '.$p->provinsi;
                    $gantiTitik = str_replace(str_split('\\/:*?"<>|,.+-'),'',$uri);
                    $urlweb = str_replace(' ', '-', $gantiTitik);
                    $title =$p->alamat.', '.$p->kota.', '.$p->provinsi
                    @endphp
                    <a href="/produk/{{$urlweb}}/{{$p->id_baliho}}">
                        <div class="row p-2" style="height: 100px">
                            <div class="col-lg-4">
                                @if ($p->url_foto == null)
                                <img alt="" src="{{asset('assets/noimage.jpg')}}" width="120">
                                @else
                                <img alt="" src="{{asset('assets/thumbnails/'.$p->url_foto)}}" width="120" height="100">
                                @endif
                            </div>
                            <div class="col-lg-8">
                                <h5 class="title" title="{{$title}}">{{$p->alamat}} </h5>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    <a href="/product?d=all" class="btn btn-primary p-2 btn-block">Show more</a>
                </div>
                <hr>
                <div class="">
                    <div class="">
                        <h4 class="text-center warnatop p-3">Berita Lainnya</h4>
                    </div>
                    @foreach ($beritaSamping as $b)
                    @php
                    $uri = $b->judul;
                    $gantiTitik = str_replace(str_split('\\/:*?"<>|,.+-'),'',$uri);
                    $urlweb = str_replace(' ', '-', $gantiTitik);
                    @endphp
                    <a href="/news/details/{{$urlweb}}/{{$b->id_news}}">
                        <div class="row p-2" style="height: 100px">
                            <div class="col-lg-4">
                                @if ($p->url_foto == null)
                                <img alt="" src="{{asset('assets/noimage.jpg')}}" width="120">
                                @else
                                <img alt="" src="{{asset('assets/img/news/'.$b->gambar)}}" width="120" height="100">
                                @endif
                            </div>
                            <div class="col-lg-8">
                                <h5 class="title" title="{{$b->judul}}">{{$b->judul}} </h5>
                            </div>
                        </div>
                    </a>

                    @endforeach
                    <a href="/news" class="btn btn-primary p-2 btn-block">Show more</a>

                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($berita as $b)
<script>
    $(document).ready(function(){
    $('#berita').load('/news/details/{{$b->id_news}}');
})
</script>
@endforeach
@endsection