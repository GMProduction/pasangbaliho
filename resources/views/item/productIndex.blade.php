<style>

</style>
<section id="portfolio" style="padding-top: 0px">
    <div class="">
        {{-- <div class="row">
            <div class="section-heading text-center">
                <div class="col-md-12 col-xs-12">
                    <h1>Our <span>Product</span></h1>
                    <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique
                        fierentis ea saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset nam
                        nostrud euismod volumus ne mei.</p>
                </div>
            </div>
        </div> --}}
        <div class="row">
            @foreach ($produk as $p)
            <input type="hidden" name="id" value="{{$p->id_baliho}}">
            {{-- @for ($i = 0; $i < 8; $i++)  --}}
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 portfolio-item" style="">

                <div class="portfolio-one" >
                    <div class="portfolio-head" >
                        <div class="portfolio-img containerImg" style="">
                            @if ($p->url_foto == null)
                            <img alt="" src="{{asset('assets/noimage.jpg')}}">
                            @else
                            <img alt="" src="{{asset('assets/thumbnails/'.$p->url_foto)}}">
                            @endif
                            <div class="bottom-left pr-2 pl-2 backgroundGreen "
                                style=" font-size: 8pt; border-radius: 0.5rem; font-weight: bolder">
                                {{$p->kategori}}, {{$p->orientasi}}</div>
                        </div>
                        @php
                        $uri = $p->kategori.' '.$p->alamat.' '.$p->kota.' '.$p->provinsi;
                        $urlweb = setUrl($uri);
                        $title =$p->alamat.', '.$p->kota.', '.$p->provinsi
                        @endphp


                        {{-- <div class="portfolio-hover">
                            <a class="portfolio-link" href="#"><i class="fa fa-link"></i></a>
                            <a class="portfolio-zoom" href="#"><i class="fa fa-search"></i></a>
                        </div> --}}
                    </div>
                    <!-- End portfolio-head -->
                    <div class="portfolio-content">
                        <h6 class="title" title="{{$title}}">{{$p->alamat}} </h6>
                        {{-- <h6 class="title" title="{{$title}}" style="font-size: 12pt">{{$p->kota}}, {{$p->provinsi}}
                        </h6> --}}
                        <p class=""   style="min-height: 96px">
                            {{-- <span>{{$p->kategori}}, {{$p->orientasi}} </span> --}}
                            <span>Ukuran : {{$p->lebar}} cm x {{$p->tinggi}} cm</span>
                            <br><b>Kisaran Harga :
                                <br>
                                @if ($p->tampil_harga == 'satu harga')
                                Rp. {{formatuang($p->harga_market)}} / Bulan</b>
                            
                            @elseif($p->tampil_harga == 'range')
                            Rp. {{formatuang($p->harga_market)}} s/d
                            <br> Rp. {{formatuang($p->harga_max)}} / Bulan</b>
                            @elseif($p->tampil_harga == 'tidak terlihat')

                            Hubungi admin</b>
                            
                            @endif

                        </p>
                                <a href="/produk/{{$urlweb}}/{{$p->id_baliho}}"
                                    class="btn btn-block btn-primary btn-sm">Detail</a>
                            
                    </div>
                    <!-- End portfolio-content -->
                </div>
                <!-- End portfolio-item -->
            </div>
            {{-- @endfor --}}
            @endforeach
        </div>

    </div>



</section>