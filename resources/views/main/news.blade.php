@extends('main.master')

@section('content')
<div style="min-height: 700px" class="p-4">
    <div class="container">
            <h3>Berita Terkini</h3>
    </div>
    @foreach ($berita as $b)
    @php
    use PHPHtmlParser\Dom;
    $dom->loadStr($b->isi, []);
    $html = $dom->outerHtml;
       
    @endphp
    <div>{{$html}}</div>
    <div>{{parseBerita($b->isi)}}</div>
    <div></div>
<div>{{!!  $isi !!}}</div>
    @endforeach
</div>

    
@endsection