<style>
    P {
        font-size: 14pt;
        line-height: 30px !important;
        text-align: justify;
        text-indent: 50px;
        margin-bottom: 1px;
    }
</style>
<div class="">

    @foreach ($berita as $b)
    <div class="p-3">
        <h1>{{$b->judul}}</h1>
        {{-- <img src="{{asset('assets/img/news/BannerUnderConstruction.jpg')}}" style="width: 100%" alt="">
        --}}
        @if ($b->gambar == null)
        <img alt="" src="{{asset('assets/noimage.jpg')}}" height="400" style="width: 100%">
        @else
        <img src="{{asset('assets/img/news/'.$b->gambar)}}" style="width: 100%" height="400" alt="">
        @endif
        <div class="row ">
            <div class="col-lg-2 iklan" style=" ">
            </div>
            <div class="col-lg-10 col-md-12" style="">
                @php
                echo htmlspecialchars_decode($b->isi);
                @endphp
            </div>
        </div>
    </div>
    @endforeach
</div>