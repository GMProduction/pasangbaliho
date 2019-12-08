@extends('main.master')

@section('content')

<section id="process">
    <div class="container">
        <div class="section-heading text-center">
            <div class="col-md-12 col-xs-12">
                <h1>Anda Ingin <span>Mendaftar</span> Sebagai Apa?</h1>
                <p class="subheading">Anda mempunyai Perusahaan dibidang periklanan? atau anda ingin memasang iklan intuk produk anda? Silahkan mendaftar jangan ragu !</p>
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
                    <p>Ditujukan untuk perusahaan yang bergerak dibidang jasa pemasangan iklan</p>
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
                    <p>Ditujukan untuk perusahaan / orang yang ingin memasang iklan</p>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection