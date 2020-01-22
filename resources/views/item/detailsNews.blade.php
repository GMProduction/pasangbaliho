<style>
    P {
        font-size: 14pt;
        line-height: 30px !important;
        text-align: justify;
        text-indent: 50px;
    }
</style>
<div class="container-fluid">


    @foreach ($berita as $b)
    <div class="p-3">
        <h1>{{$b->judul}}</h1>
        <img src="{{asset('assets/img/news/BannerUnderConstruction.jpg')}}" style="width: 100%" alt="">
        <div class="row ">

            <div class="col-lg-2 iklan" style=" ">
            </div>
            <div class="col-lg-10" style="">
                
                @php
                echo htmlspecialchars_decode($b->isi);
                @endphp
            </div>
        </div>
    </div>
    @endforeach
</div>