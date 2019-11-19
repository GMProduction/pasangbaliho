@extends('main.master')

@section('content')
<style>
   
</style>

<script>
    function landmark(a){
            $('#'+a).hover(function(){
                $('#icon'+a).attr('src', '{{asset("assets/img/landmark")}}/'+a+'-0.png')
                }, function(){
                $('#icon'+a).attr('src', '{{asset("assets/img/landmark")}}/'+a+'.png')
            })
        }
    
</script>

<div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <div class="fill" style="background-image:url('{{asset('assets/img/banner-slide-1.jpg')}}');"></div>
            <div class="carousel-caption slide-up">
                <h1 class="banner_heading">Providing The <span>Highest </span>Lorem</h1>
                <p class="banner_txt">Lorem ipsum dolor sit amet sit legimus copiosae instructior eiut vix denique
                    fierentis ea saperet inimicu utqui dolor oratio mnesarchum.</p>
                {{-- <div class="slider_btn">
                    <button type="button" class="btn btn-default slide">Learn More <i class="fa fa-caret-right"></i></button>
                    <button type="button" class="btn btn-primary slide">Learn More <i class="fa fa-caret-right"></i></button>
                </div> --}}
            </div>
        </div>

        <div class="item">
            <div class="fill" style="background-image:url('{{asset('assets/img/banner-slide-2.jpg')}}');"></div>
            <div class="carousel-caption slide-up">
                <h1 class="banner_heading">Providing The <span>Highest </span>Lorem</h1>
                <p class="banner_txt">Lorem ipsum dolor sit amet sit legimus copiosae instructior eiut vix denique
                    fierentis ea saperet inimicu utqui dolor oratio mnesarchum.</p>
                {{-- <div class="slider_btn">
                    <button type="button" class="btn btn-default slide">Learn More <i class="fa fa-caret-right"></i></button>
                    <button type="button" class="btn btn-primary slide">Learn More <i class="fa fa-caret-right"></i></button>
                </div> --}}
            </div>
        </div>

        <div class="item">
            <div class="fill" style="background-image:url('{{asset('assets/img/banner-slide-3.jpg')}}');"></div>
            <div class="carousel-caption slide-up">
                <h1 class="banner_heading">Providing The <span>Highest </span>Lorem</h1>
                <p class="banner_txt">Lorem ipsum dolor sit amet sit legimus copiosae instructior eiut vix denique
                    fierentis ea saperet inimicu utqui dolor oratio mnesarchum.</p>
                {{-- <div class="slider_btn">
                    <button type="button" class="btn btn-default slide">Learn More <i class="fa fa-caret-right"></i></button>
                    <button type="button" class="btn btn-primary slide">Learn More <i class="fa fa-caret-right"></i></button>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Left and right controls -->

    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <i class="fa fa-angle-left"
            aria-hidden="true"></i>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <i class="fa fa-angle-right"
            aria-hidden="true"></i>
        <span class="sr-only">Next</span>
    </a>

</div>
<br>
<div class="container" style="margin-top: -45px; z-index: 100 ">

    <div class="" id="" style="">
        <div class="borderCari p-4">
            <div class="row batas align-items-center">
                <div class="col col-md-3">
                    <h4 class="text-center alighText " style=""><span>Mau Pasang di Kota Mana ?</span></h4>
                </div>
                <div class="col-md-9">
                    <div class="row batas">
                        <div class="col-md-3 iconKategori col-xs-6">
                            <a href="#!" class="btn btn-primary btn-rounded btn-block" id="semarang"
                                onmouseover="landmark('semarang')" style="padding: unset; padding-top: 10px"><img
                                    id='iconsemarang' src="{{asset('assets/img/landmark/semarang.png')}}" alt="">
                                <h6>Semarang</h6>
                            </a>
                        </div>
                        <div class="col-md-3 iconKategori col-xs-6">
                            <a href="#!" class="btn btn-primary btn-rounded btn-block" id="salatiga"
                                onmouseover="landmark('salatiga')" style="padding: unset; padding-top: 10px"><img
                                    id='iconsalatiga' src="{{asset('assets/img/landmark/salatiga.png')}}" alt="">
                                <h6>Salatiga</h6>
                            </a>
                        </div>
                        <div class="col-md-3 iconKategori col-xs-6">
                            <a href="#!" class="btn btn-primary btn-rounded btn-block" id="solo"
                                onmouseover="landmark('solo')" style="padding: unset; padding-top: 10px"><img
                                    id='iconsolo' src="{{asset('assets/img/landmark/solo.png')}}" alt="">
                                <h6>Solo</h6>
                            </a>
                        </div>
                        <div class="col-md-3 iconKategori col-xs-6">
                            <a href="#!" class="btn btn-primary btn-rounded btn-block" id="sragen"
                                onmouseover="landmark('sragen')" style="padding: unset; padding-top: 10px"><img
                                    id='iconsragen' src="{{asset('assets/img/landmark/sragen.png')}}" alt="">
                                <h6>Sragen</h6>
                            </a>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3 iconKategori col-xs-6">
                            <a href="#!" class="btn btn-primary btn-rounded btn-block" id="wonogiri"
                                onmouseover="landmark('wonogiri')" style="padding: unset; padding-top: 10px"><img
                                    id='iconwonogiri' src="{{asset('assets/img/landmark/wonogiri.png')}}" alt="">
                                <h6>Wonogiri</h6>
                            </a>
                        </div>
                        <div class="col-md-3 iconKategori col-xs-6">
                            <a href="#!" class="btn btn-primary btn-rounded btn-block" id="sragen"
                                onmouseover="landmark('sragen')" style="padding: unset; padding-top: 10px"><img
                                    id='iconsragen' src="{{asset('assets/img/landmark/sragen.png')}}" alt="">
                                <h6>Sragen</h6>
                            </a>
                        </div>
                        <div class="col-md-3 iconKategori col-xs-6">
                            <a href="#!" class="btn btn-primary btn-rounded btn-block" id="sragen"
                                onmouseover="landmark('sragen')" style="padding: unset; padding-top: 10px"><img
                                    id='iconsragen' src="{{asset('assets/img/landmark/sragen.png')}}" alt="">
                                <h6>Sragen</h6>
                            </a>
                        </div>
                        <div class="col-md-3 iconKategori col-xs-6">
                            <a href="#!" class="btn btn-primary btn-rounded btn-block" id="sragen"
                                onmouseover="landmark('sragen')" style="padding: unset; padding-top: 10px"><i
                                    class="fa fa-forward fa-5x" aria-hidden="true"></i>
                                <h6>Show All</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row batas">
                <div class="col-md-1 iconKategori col-xs-6">
                    <a href="#!" class="btn btn-primary btn-rounded btn-block" id="semarang"
                        onmouseover="landmark('semarang')" style="padding: unset; padding-top: 10px"><img
                            id='iconsemarang' src="{{asset('assets/img/landmark/semarang.png')}}" alt="">
                        <h6>Semarang</h6>
                    </a>
                </div>
            </div> --}}
            <div class="" id="">
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-4 col-md-offset-1 col-md-5 col-sm-12 block">
                        <select name="" id="" class="form-control" style="height: 45px">
                            <option value="jenis">Jenis</option>
                            <option value="jenis">Jenis</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <select name="" id="" class="form-control" style="height: 45px">
                            <option value="jenis">Kota</option>
                            <option value="jenis">Kota</option>
                        </select>
                    </div>

                </div>
                <div class="row pt-3">
                    <div class="col-lg-offset-5 col-lg-2 col-lg-offset-2">
                        <a href="#!" class="btn btn-primary btn-block btn-sm btn-rounded" style=""><i
                                class="fas fa-search    "></i> Cari</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 50px">
<div class=" row ">
    <div class="section-heading text-center">
        <div class="col-md-12 col-xs-12">
            <h1>Our <span>Product</span></h1>
            <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique
                fierentis ea saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset nam
                nostrud euismod volumus ne mei.</p>
        </div>
    </div>
</div>
@include('item.productIndex')
</div>



<section id="testimonial">
    <div class="container">
        <div class="section-heading text-center">
            <div class="col-md-12 col-xs-12">
                <h1>What Our <span>Client Says</span></h1>
                <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique
                    fierentis ea saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset nam nostrud
                    euismod volumus ne mei.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-12 block ">
                <div class="testimonial_box">
                    <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea
                        saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset. </p>
                </div>
                <div class="arrow-down"></div>
                <div class="testimonial_user">
                    <div class="user-image"><img src="{{asset('assets/img/user1.png')}}" alt="user"
                            class="img-responsive" /></div>
                    <div class="user-info">
                        <h5>Lorem Ipsum</h5>
                        <p>Manager</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-12 block">
                <div class="testimonial_box">
                    <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea
                        saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset. </p>
                </div>
                <div class="arrow-down"></div>
                <div class="testimonial_user">
                    <div class="user-image"><img src="{{asset('assets/img/user1.png')}}" alt="user"
                            class="img-responsive" /></div>
                    <div class="user-info">
                        <h5>Lorem Ipsum</h5>
                        <p>Manager</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 block">
                <div class="testimonial_box">
                    <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea
                        saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset. </p>
                </div>
                <div class="arrow-down"></div>
                <div class="testimonial_user">
                    <div class="user-image"><img src="{{asset('assets/img/user1.png')}}" alt="user"
                            class="img-responsive" /></div>
                    <div class="user-info">
                        <h5>Lorem Ipsum</h5>
                        <p>Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


@endsection