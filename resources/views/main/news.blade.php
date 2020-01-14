@extends('main.master')

@section('content')
<div style="min-height: 700px" class="p-4">
    <div class="container">
        <h3>Berita Terkini</h3>
    </div>
    @foreach ($berita as $b)
    @php
    // use PHPHtmlParser\Dom;
    // $dom->loadStr($b->isi, []);
    // $html = $dom->outerHtml;

    @endphp
    <div> coba{{!! trim($b->isi,'a') !!}}</div>
    {{-- <div>coba {{ htmlspecialchars_decode($b->isi) }}</div> --}}
    <div>test {{!! parseBerita($b->isi) !!}}</div>
    {{-- <div>control {{!! $isi !!}}</div> --}}
    {{-- <div></div> --}}
    {{-- <div>garing {{!!  $isi !!}}</div> --}}
    @endforeach
</div>


@endsection