@extends('main.master')

@section('content')

<link rel="stylesheet" href="{{asset('css/product.css')}}">
<section id="about-page-section-3">




    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                <div class="row" style="">

                    <div class="col-md-12">

                        <div id="myCarousel" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                @php
                                $i = 0;
                                @endphp

                                @foreach ($foto as $g)

                                @if ($loop->first)
                                <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
                                @else
                                <li data-target="#myCarousel" data-slide-to="{{$i}}" class=""></li>
                                @endif
                                @php
                                $i ++;
                                @endphp

                                @endforeach

                                {{-- <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li> --}}
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @foreach ($foto as $f)
                               
                                @if ($loop->first)
                                <div class="item active">
                                    @else
                                    <div class="item ">
                                        @endif
                                        <div class="fill"
                                            style="background-image:url('{{asset('assets/'.$f->url_foto)}}');">
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                                <!-- Left and right controls -->

                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <i
                                        class="fa fa-angle-left" aria-hidden="true"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <i
                                        class="fa fa-angle-right" aria-hidden="true"></i>
                                    <span class="sr-only">Next</span>
                                </a>

                            </div>


                            {{--                         
                        <div class="pro-img-details">
                            <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                        </div>
                        <div class="pro-img-list">

                            <a href="#">
                                <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{asset('assets/img/iphone62.png')}}" alt="">
                            </a>
                        </div> --}}
                    </div>
                </div>

            </div>
            @foreach ($produkDetail as $p)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-align ">
                <div class="section-heading">
                    <h2>{{$p->nama_baliho}}</h2>
                    <p style="font-size: 14pt">{{$p->alamat}}, {{$p->kota}}, {{$p->provinsi}}</p>
                    <p class=""><i class="fa fa-clock"></i> Tersedia</p>

                </div>
                <label style="font-size: 12pt">Spesifikasi</label>
                <table class="table table-noborder" style="max-width: 300px; border: 0">
                    <tr>
                        <td>Jenis Media</td>
                        <td>{{$p->kategori}}</td>
                    </tr>
                    <tr>
                        <td>Orientasi</td>
                        <td>Horizontal</td>
                    </tr>
                    <tr>
                        <td>Ukuran</td>
                        <td>{{$p->ukuran_baliho}}</td>
                    </tr>
                    <tr>
                        <td>Posisi</td>
                        <td>Attached to Building</td>
                    </tr>
                    <tr>
                        <td>Lighting</td>
                        <td>No</td>
                    </tr>
                </table>
                <label style="font-size: 12pt" class="pb-1">Kisaran Harga Rp. {{formatuang($p->max_harga)}} / Bulan</label><br>
                <label style="font-size: 12pt">Dipesan : </label>
                @forelse ($dipesan as $d)
                {{-- <p>Tanggal {{$d->tanggal_awal}} s/d {{$d->tanggal_akhir}}</p> --}}
                <p>{{formatDateToSurat($d->tanggal_awal)}} s/d {{formatDateToSurat($d->tanggal_aakhir)}}</p>
                @empty
                <p>Belum Ada</p>
                @endforelse



                {{-- <a type="button" class="btn btn-primary slide" href="#tglPenawaran">Ajukan Penawaran <i
                        class="fa fa-caret-right"></i></a> --}}



                @if(auth()->guard('advertiser')->check())
                <button class="btn btn-primary " type="button" data-toggle="modal"
                    data-target="#tglPenawaran">Permintaan
                    Penawaran</button>
                @else
                <button class="btn btn-primary " type="button" onclick="test()">Permintaan
                    Penawaran</button>
                @endif
            </div>

        </div>



        <div id="tglPenawaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Tanggal Pemasangan</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-bottom">
                            <form role="form" action="addTransaksi" class="login-form" method="POST">
                                @csrf
                                <input type="hidden" name="id_baliho" value="{{$p->id_baliho}}">
                                @if (auth()->guard('advertiser')->check())
                                <input type="hidden" name="id_advertiser"
                                    value="{{auth()->guard('advertiser')->user()->id}}">
                                @endif


                                <div class="input-group form-group">
                                    {{-- <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span> --}}
                                    <label for="mulai">Tanggal Mulai</label>
                                    <input type="date" id="mulai" class="form-control" name="mulai"
                                        placeholder="Tanggal Mulai" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group form-group">
                                    <label for="selesai">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="selesai" name="selesai"
                                        placeholder="Tanggal Selesai" aria-describedby="basic-addon1">
                                </div>
                                <button type="submit" class="btn">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="mt-5" id="about">
            <div class="  ">
                <div class="text-block p-4">
                    <p style="font-size: 14pt">Deskripsi</p>
                    <p class="">{{$p->deskripsi}}</p>
                </div>
            </div>
        </div>


        <style>
            #map {
                width: 100%;
                height: 500px;
                background-color: grey;
            }

            .mapouter {
                position: relative;
                text-align: right;
                height: 500px;
                width: 100%;
            }

            .gmap_canvas {
                overflow: hidden;
                background: none !important;
                height: 500px;
                width: 100%;
            }
        </style>
        <div class="row p-4 pt-5">
            <div class="col-lg-6 col-md-12">
                <p style="font-size: 14pt">Map</p>
                <div id="">

                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas"
                                src="https://maps.google.com/maps?hl=en&amp;q={{$p->latitude}},{{$p->logitude}}&amp;&amp;ie=UTF8&amp;t=&amp;z=18&amp;iwloc=B&amp;output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>

                    </div>
                </div>

                {{-- <div style="width: 100%"><iframe width="100%" height="500"
                        src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=-7.553315,110.743877&amp;&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a
                            href="https://www.maps.ie/coordinates.html">latitude longitude finder</a></iframe></div>
                <br /> --}}

            </div>
            <div class="col-lg-6 col-md-12">
                <p style="font-size: 14pt">Street View</p>
                <div id="street"></div>
                {{-- @include('item.streetview') --}}
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function () {
        $('#street').load('/showStreetView/{{$p->id_baliho}}');
    })

    </script>

    @endforeach
</section>
<script>
    function test() {
           
            Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Register',
  confirmButtonText: 'Login'
}).then((result) => {
  if (result.value) {
    Swal.fire(
      'Login!',
      'Your file has been deleted.',
      'success'
    )
  }else if(
    result.dismiss === Swal.DismissReason.cancel
  ){
    Swal.fire(
      'Register!',
      'cencel.',
      'info'
    )
  }
})
        }
</script>
@endsection