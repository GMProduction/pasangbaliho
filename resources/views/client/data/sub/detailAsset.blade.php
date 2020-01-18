@extends('client.client')

@section('content')
<link rel="stylesheet" href="{{asset('css/inputimg.css')}}">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
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
<a href="/dashboardClient/asset" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>

<form action="" id="formAdd" role="form" method="" class="pt-2">
    {{ csrf_field() }}
    @foreach ($asset as $a)

    <div class="row clearfix">

        <div class="col-lg-6 col-md-6 col-sm-12">

            <div class="card" style="height: 760px">
                <div class="header">
                    <h2 class="pb-2">
                        Informasi Media Iklan
                    </h2>
                </div>
                <div class="body">

                    <div class="form-group">
                        <label for="media">Jenis Media Iklan :</label>
                        <input type="text" class="form-control" id="media" name="media" value="{{$a->kategori}}"
                            readonly placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$a->nama_baliho}}"
                            readonly placeholder="contoh : Baliho Jl. Adi Sucipto No. 190">
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="prov">Provinsi :</label>
                                <input type="text" class="form-control" id="media" name="media" value="{{$a->provinsi}}"
                                    readonly placeholder="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kota">Kota :</label>
                                <input type="text" class="form-control" id="media" name="media" value="{{$a->kota}}"
                                    readonly placeholder="">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="alamat">Alamat :</label>
                        <textarea class="form-control" id="alamat" name="alamat" cols="30" rows="3"
                            placeholder="contoh : Jl. Adi Sucipto No. 190" readonly>{{$a->alamat}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi :</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="3"
                            placeholder="contoh : Kawasan Strategis, Ramai Lalu Lintas, Jalan antar Provinsi"
                            readonly>{{$a->deskripsii}}</textarea>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card" style="height: 760px">
                <div class="header">
                    <h2 class="pb-2">
                        Informasi Umum
                    </h2>
                </div>
                <div class="body">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="harga">Harga :</label>
                            <input type="text" readonly value="{{formatkoma($a->harga_client)}}"
                                pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" name="harga"
                                class="form-control" id="harga" placeholder="contoh : 60000000">
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tinggi">Tinggi :</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control noBorderRight" name="tinggi" id="tinggi"
                                        value="{{$a->tinggi}}" readonly placeholder="contoh : 200">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text noBorderLeft" style="">cm</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="lebar">Lebar :</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control noBorderRight" name="lebar" id="lebar"
                                        value="{{$a->lebar}}" readonly placeholder="contoh : 200">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text noBorderLeft">cm</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="orientasi">Orientasi :</label>
                                <input type="text" class="form-control" id="media" name="media"
                                    value="{{$a->orientasi}}" readonly placeholder="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="venue">Venue :</label>
                                <input type="text" class="form-control" id="media" name="media" value="{{$a->venue}}"
                                    readonly placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="posisi">Posisi :</label>
                                <input type="text" class="form-control" id="media" name="media" value="{{$a->posisi}}"
                                    readonly placeholder="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tampil">Tampil Muka :</label>
                                <input type="text" class="form-control" id="media" name="media"
                                    value="{{$a->tampilan}} Muka" readonly placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-row pb-3">
                        <div class="col">
                            <img alt="" src="{{asset('assets/noimage.jpg')}}" width="" style="" class="img-fluid">
                        </div>
                        <div class="col">
                            <img alt="" src="{{asset('assets/noimage.jpg')}}" width="" class="img-fluid">
                        </div>
                        <div class="col">
                            <img alt="" src="{{asset('assets/noimage.jpg')}}" width="" class="img-fluid">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <img alt="" src="{{asset('assets/noimage.jpg')}}" width="" class="img-fluid">
                        </div>
                        <div class="col">
                            <img alt="" src="{{asset('assets/noimage.jpg')}}" width="" class="img-fluid">
                        </div>
                        <div class="col">
                            <img alt="" src="{{asset('assets/noimage.jpg')}}" width="" class="img-fluid">
                        </div>
                    </div>

                    {{-- <div class="form-row">
                        <div class="col">
                            <a href="#!" onclick="" class="btn btn-primary btn-block btn-lg">Save</a>
                        </div>
                        <div class="col">
                            <a href="/dashboardClient/asset" onclick=""
                                class="btn btn-danger btn-block btn-lg">Close</a>
                        </div>
                    </div> --}}




                </div>
            </div>
        </div>

    </div>


</form>
<script>
    $(document).ready(function() {
        $('#jenmedia').val('{{$a->kategori}}');
        // document.getElementById('jenmedia').getElementsByTagName('option')['{{$a->kategori}}'].selected = 'selected';
    });
    function addAsset() {
        var je = $('#jenmedia').val();
        var na = $('#nama').val();
        var pro = $('#prov').val();
        var ko = $('#kota').val();
        var ala = $('#alamat').val();
        var des = $('#deskripsi').val();
        var har = $('#harga').val();
        var t = $('#tinggi').val();
        var l = $('#lebar').val();
        var or = $('#orientasi').val();
        var ven = $('#venue').val();
        var pos = $('#posisi').val();
        var tam = $('#tampil').val();
        if (je === '' || na === "" || pro === "" || ko === "" || ala === "" || des === "" || har === "" || t === "" || l === "" || or === "" || ven === "" || pos === "" || tam === ""  ){
            swal.fire({
                icon: 'warning',
                text: 'Form masih ada yang belum di isi, Harap di lengkapi !'
            });
        }else{
            swal.fire({
                icon: 'info',
                text: 'Apakah anda yakin akan menyimpan data ?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(result.value){
                    swal.fire({
                        icon: 'success',
                        text: 'Data berhasil disimpan !'
                    }).then((result) => {
                            document.getElementById('formAdd').action = 'addAsset';
                            document.getElementById('formAdd').method = 'POST';
                            document.getElementById('formAdd').submit();
                    })
                }
            })
           
        }
        
    }
</script>
@endforeach
@endsection