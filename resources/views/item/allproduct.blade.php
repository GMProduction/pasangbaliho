<section id="portfolio" style="padding-top: 0px">
    <div class="">
       
        <div class="row">   
            @foreach ($produk as $p)
                
           <input type="hidden" name="id" value="{{$p->id_baliho}}">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 portfolio-item">
                <div class="portfolio-one">
                    <div class="portfolio-head">
                        <div class="portfolio-img"><img alt="" src="{{asset('assets/img/portfolio-1.jpg')}}"></div>
                        
                    </div>
                    <!-- End portfolio-head -->
                    <div class="portfolio-content">
                        <h5 class="title">{{$p->alamat}}</h5>
                        <p><span>{{$p->kota}}</span>
                            <br>{{$p->min_harga}} s/d {{$p->max_harga}}
                            <br>tersedia</p>
                            <a href="detail?id={{$p->id_baliho}}" class="btn btn-block btn-primary btn-sm">Detail</a>

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