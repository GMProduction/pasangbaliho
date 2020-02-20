@extends('main.master')

@section('content')

<style>
    .verifikasi {
        padding-top: 4rem;
    }

    @media (min-width: 768px) {
        .verifikasi {
            padding-top: 120px;
        }
    }
</style>


<div class="container verifikasi " style="min-height: 550px">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-offset-4 col-sm-4 border">
                <h4>Silahkan Lengkapi Data</h4>

                <div id="login-reg" class="pt-2">
                    <div class="form-box">
                        <form action="verifikasi" role="form" class="login-form" id="formVefirikasi" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{auth()->guard('advertiser')->user()->id}}">
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-building"></i></span>
                                <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" value=""
                                    placeholder="Nama Instansi" aria-describedby="basic-addon1">

                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon " id="basic-addon1"><i class="fa fa-phone"></i></span>
                                <span class="input-group-addon " id="basic-addon1"
                                    style="border-right: 0; border-left: 0">+62</i></span>
                                <input type="number" name="telp" id="telp" class="form-control " value=""
                                    placeholder="87812345678" aria-describedby="basic-addon1">

                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-home"></i></span>
                                <textarea rows="0" cols="100" name="alamat" id="alamat" class="form-control" value=""
                                    placeholder="Address" aria-describedby="basic-addon1"></textarea>

                            </div>
                            <div class="">
                                <div class="social-login-buttons">
                                    <a class="btn btn-link-1 btn-link-1-twitter btn-block" href="#!"
                                        onclick="cekVerifikasi()">
                                        Lanjutkan
                                    </a>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    function cekVerifikasi() {
        var n = $('#nama_instansi').val();
        var h = $('#telp').val();
        var a = $('#alamat').val();
        if(n === ''  || h === '' || a === ''){
            Swal.fire({
                title: 'Silahkan isi data dengan benar',
                icon: 'warning'
            });
        }else{
            Swal.fire({
            title: 'Cek',
            text: "Apakah data yang anda masukkan sudah benar",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Benar'
        }).then((result) => {
            if (result.value) {
                document.getElementById('formVefirikasi').action = 'verifikasi';
                document.getElementById('formVefirikasi').method = 'POST';
                document.getElementById('formVefirikasi').submit();

            }
        })
        }
        
    }

</script>

@endsection