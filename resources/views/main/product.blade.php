@extends('main.master')

@section('content')
<section id="portfolio">
    <div class="container">
        <div class="borderCari pt-4 pb-4">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 iconKategori">
                    <select name="" id="" class="form-control">
                        <option value="">media</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 iconKategori">
                    <select name="" id="" class="form-control">
                        <option value="">media</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 iconKategori">
                    <select name="" id="" class="form-control">
                        <option value="">media</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 iconKategori">
                    <select name="" id="" class="form-control">
                        <option value="">media</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
    <div class="pt-5 container">
        <div class="row">
            <div class="col-md-3">
                asd
            </div>
            <div class="col-md-9">
                    @include('item.productindex')
                    {{$produk->links()}}
            </div>

        </div>
       
    </div>




</section>
@endsection