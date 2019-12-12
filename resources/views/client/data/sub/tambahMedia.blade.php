@extends('client.client')

@section('content')

<style>
    .noBorderLeft {
        border-left: none !important;
    }

    .noBorderRight {
        border-right: none !important;
    }

    .input-group-text {
        background-color: transparent !important;
    }
</style>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 class="pb-2">
                    Tambah Media Iklan
                </h2>
            </div>
            <div class="body">
                <form action="">
                    <div class="form-group">
                        <label for="media">Jenis Media Iklan</label>
                        <select class="form-control" id="media">
                            @foreach ($kategori as $k)
                            <option value="{{$k->id_kategori}}">{{$k->kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="cth : Surakarta">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="" class="form-control" id="alamat" cols="30" rows="3"
                            placeholder="cth : Jl. Slamet Riyadi No. 132"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="prov">Provinsi</label>
                        <select class="form-control" id="prov">
                                @foreach ($provinsi as $k)
                                <option value="{{$k->id_provinsi}}">{{$k->nama_provinsi}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <select class="form-control" id="kota">
                            @foreach ($kota as $k)
                            <option value="{{$k->id_kota}}">{{$k->nama_kota}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tinggi">Tinggi</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control noBorderRight" id="lebtinggiar"
                                placeholder="cth : 200">
                            <div class="input-group-prepend">
                                <div class="input-group-text noBorderLeft" style="">cm</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lebar">Lebar</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control noBorderRight" id="lebar" placeholder="cth : 200">
                            <div class="input-group-prepend">
                                <div class="input-group-text noBorderLeft">cm</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" placeholder="cth : 200000">
                    </div>
                    <div class="form-group">
                        <label for="venue">Venue</label>
                        <input type="text" class="form-control" id="venue" placeholder="cth : Jalan">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection