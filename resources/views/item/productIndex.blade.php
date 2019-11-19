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
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 portfolio-item">
                <div class="portfolio-one">
                    <div class="portfolio-head">
                        <div class="portfolio-img"><img alt="" src="{{asset('assets/img/portfolio-1.jpg')}}"></div>
                        {{-- <div class="portfolio-hover">
                            <a class="portfolio-link" href="#"><i class="fa fa-link"></i></a>
                            <a class="portfolio-zoom" href="#"><i class="fa fa-search"></i></a>
                        </div> --}}
                    </div>
                    <!-- End portfolio-head -->
                    <div class="portfolio-content">
                        <h5 class="title">{{$p->alamat}}</h5>
                        <p><span>{{$p->kota}}</span>
                            <br>{{$p->min_harga}} s/d {{$p->max_harga}}
                            <br>tersedia</p>
                            <a href="detail?id={{$p->id_baliho}}&n={{$p->nama_baliho}}&l={{$p->alamat}},{{$p->kota}},{{$p->provinsi}}" class="btn btn-block btn-primary btn-sm">Detail</a>

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