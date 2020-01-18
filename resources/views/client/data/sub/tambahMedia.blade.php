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
<form action="" id="formAdd" role="form" method="">
    {{ csrf_field() }}
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
                        <select class="form-control" id="jenmedia" name="jenmedia">
                            <option value="">- Jenis Media Iklan -</option>
                            @foreach ($kategori as $k)
                            <option value="{{$k->id_kategori}}">{{$k->kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="contoh : Baliho Jl. Adi Sucipto No. 190">
                    </div>


                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="prov">Provinsi :</label>
                                <select class="form-control" id="prov" name="prov">
                                    <option value="">- Pilih Provinsi -</option>
                                    @foreach ($provinsi as $k)
                                    <option value="{{$k->id_provinsi}}">{{$k->nama_provinsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kota">Kota :</label>
                                <select class="form-control" id="kota" name="kota">
                                    <option value="">- Jenis Kota -</option>
                                    @foreach ($kota as $k)
                                    <option value="{{$k->id_kota}}">{{$k->nama_kota}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="alamat">Alamat :</label>
                        <textarea class="form-control" id="alamat" name="alamat" cols="30" rows="3"
                            placeholder="contoh : Jl. Adi Sucipto No. 190"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi :</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="3"
                            placeholder="contoh : Kawasan Strategis, Ramai Lalu Lintas, Jalan antar Provinsi"></textarea>
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
                            <input type="text" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" name="harga" class="form-control" id="harga" placeholder="contoh : 60000000">
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tinggi">Tinggi :</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control noBorderRight" name="tinggi" id="tinggi"
                                        placeholder="contoh : 200">
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
                                        placeholder="contoh : 200">
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
                                <select name="orientasi" id="orientasi" name="orientasi" class="form-control">
                                    <option value="Potrait">Potrait</option>
                                    <option value="Landscape">Landscape</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="venue">Venue :</label>
                                <select name="venue" id="venue" class="form-control">
                                    <option value="">- Pilih Venue -</option>
                                    <option value="Street">Street</option>
                                    <option value="Mall">Mall</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="posisi">Posisi :</label>
                                <select name="posisi" id="posisi" class="form-control">
                                    <option value="">- Pilih Posisi -</option>
                                    <option value="Stand Alone">Stand Alone</option>
                                    <option value="Attach By Building">Attach By Building</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tampil">Tampil Muka :</label>
                                <select name="tampil" id="tampil" class="form-control">
                                    <option value="">- Pilih Tampil Muka -</option>
                                    <option value="1">1 Muka</option>
                                    <option value="2">2 Muka</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gambar1">Gambar 1 :</label>
                        <input type="file" class="form-control-file" name="gambar1" id="gambar1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="gambar2">Gambar 2 :</label>
                        <input type="file" class="form-control-file" name="gambar2" id="gambar2" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="gambar3">Gambar 3 :</label>
                        <input type="file" class="form-control-file" name="gambar3" id="gambar3" placeholder="">
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <a href="#!" onclick="addAsset()" class="btn btn-primary btn-block btn-lg">Save</a>
                        </div>
                        <div class="col">
                            <a href="/dashboardClient/asset" onclick="" class="btn btn-danger btn-block btn-lg">Close</a>
                        </div>
                    </div>




                </div>
            </div>
        </div>

    </div>
</form>
<script>
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

@endsection