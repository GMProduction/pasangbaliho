@extends('main.master')

@section('content')

<section id="process">
    <div class="container">
        <div class="section-heading text-center">
            <div class="col-md-12 col-xs-12">
                <h1>What <span>We Do</span></h1>
                <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique
                    fierentis ea saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset nam nostrud
                    euismod volumus ne mei.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6 block process-block">
                <div class="process-icon-holder">
                    <a href="registration-client">
                        <div class="process-border">
                            <span class="process-icon"><i class="fa fa-store feature_icon"></i></span></div>
                        <div class=""></div>
                    </a>
                </div>

                <div class="process-text-block">
                    <h4><a href="#">Client</a></h4>
                    <p>Member dapat mengajukan penawaran untuk pemasangan baliho</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 block process-block">
                <div class="process-icon-holder">
                    <a href="registration-advertiser">
                        <div class="process-border">
                            <span class="process-icon">
                                <i class="fa fa-shopping-cart feature_icon"></i></span></div>
                        <div class=""></div>
                    </a>
                </div>

                <div class="process-text-block">
                    <h4><a href="#">Advertiser</a></h4>
                    <p>Member dapat men-display produk yang ditawarkan</p>
                    <p>Member dapat men-display produk yang ditawarkan</p>
                    <p>Member dapat men-display produk yang ditawarkan</p>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection