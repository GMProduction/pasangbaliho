@extends('advertiser.advertiser')
@section('content')

<style>
    [type=radio] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    [type=radio]+img {
        cursor: pointer;
    }

    /* CHECKED STYLES */
    [type=radio]:checked+img {
        outline: 2px solid #f00;
    }
</style>
<script>

</script>
@foreach ($data as $d)
<a href="/dashboard/berlangsung/detail/{{$d->id_transaksi}}" class="btn btn-primary"><i class="fa fa-arrow-left"
        aria-hidden="true"></i> Kembali</a>
<h3>Pembayaran</h3>
<h4>{{$d->nama_baliho}}</h4>
<h4>Kekurangan Pembayaran : Rp. {{formatuang($d->saldo)}}</h4>
<div id="accordion">
    <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne" style="cursor: pointer">
            <h5 class="mb-0">
                Pembayaran Manual
            </h5>
            <p class="mb-0">Setelah melakukan pembayaran melalui rekening yang tersedia silahkan upload bukti pembayaran
                pada form
                yang telah disediakan</p>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-3 pt-2">
                        <div class="row">
                            <div class="col-lg-12 col-sm-6 col-6">
                                <label>
                                    <input type="radio" name="bank" id="bca" value="BCA" checked onclick="showRec()">
                                    <img src="{{asset('assets/img/bank/bca.webp')}}">
                                </label>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-6">
                                <label>
                                    <input type="radio" name="bank" id="bni" value="BNI" onclick="showRec()">
                                    <img src="{{asset('assets/img/bank/bni.webp')}}">
                                </label>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-6">
                                <label>
                                    <input type="radio" name="bank" id="bri" value="BRI" onclick="showRec()">
                                    <img src="{{asset('assets/img/bank/bri.webp')}}">
                                </label>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-6">
                                <label>
                                    <input type="radio" name="bank" id="mandiri" value="Mandiri" onclick="showRec()">
                                    <img src="{{asset('assets/img/bank/mandiri.webp')}}">
                                </label>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-6">
                                <label>
                                    <input type="radio" name="bank" id="danamon" value="Danamon" onclick="showRec()">
                                    <img src="{{asset('assets/img/bank/danamon.webp')}}">
                                </label>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-6">
                                <label>
                                    <input type="radio" name="bank" id="jateng" value="Bank Jateng" onclick="showRec()">
                                    <img src="{{asset('assets/img/bank/jateng.webp')}}">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 pt-2">
                        <h4 id="noRek">127172721 17217</h4>
                        <h5 id="cabang">Cabang Solo</h5>
                        <h5>An : PT. Aksara Solopos</h5>

                    </div>
                    <div class="col-lg-4 pt-2">
                        <h4>Bukti Pembayaran Anda</h4>
                        <form action="" id="formTrans">
                            @csrf
                            <input type="hidden" value="{{$d->id_transaksi}}" name="idTrans" id="id">
                            <input type="hidden" value="" name="bank" id="bank">
                            <div class="form-group ">
                                <label for="rekening">No. Rekening :</label>
                                <input type="text" class="form-control" name="rekening" id="rekening"
                                    placeholder="123455678">
                            </div>
                            <div class="form-group ">
                                <label for="nama">Atas Nama :</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="123455678">

                            </div>
                            <div class="form-group">
                                <label for="harga">Nominal :</label>
                                <input type="text" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency"
                                    name="nominal" class="form-control" id="nominal" placeholder="contoh : 60000000"
                                    oninvalid="this.setCustomValidity('Not Valid')"
                                    onchange="try{setCustomValidity('')}catch(e){}" oninput="setCustomValidity(' ')">
                            </div>
                            <a class="btn btn-primary btn-block" href="#!" onclick="addTrans()">Simpan</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo" style="cursor: pointer">
            <h5 class="mb-0">Metode Pembayaran Cek Otomatis</h5>
            <p class="mb-0">Jika anda memilih metode pembayaran <b>Cek Otomatis</b> maka transaksi anda akan langsung di
                sek oleh
                sistem</p>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <div class="col-4 pb-3">
                    <label for="nominalCek">Nominal :</label>
                    <input type="text" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" name="nominalCek"
                        class="form-control" id="nominalCek" placeholder="contoh : 60000000" onchange="gantiValue()" value="{{formatkoma($d->saldo)}}"
                        oninvalid="this.setCustomValidity('Not Valid')" onchange="try{setCustomValidity('')}catch(e){}"
                        oninput="setCustomValidity(' ')">
                </div>
                <div class="col-4">


                    <form name="ePayment" method="POST" action="https://sandbox.ipay88.co.id/epayment/entry.asp" onsubmit="return bayarCek()">
                        @csrf
                        <input type="hidden" name="MerchantCode" value="ID01270">
                        <input type="hidden" name="PaymentId" value="">
                        <input type="hidden" hidden name="RefNo" value="{{$d->id_transaksi}}">
                        <input type="hidden" name="Amount" id="nominalKirim" value="">
                        <input type="hidden" name="Currency" value="IDR">
                        <input type="hidden" name="ProdDesc" value="{{$d->kategori}}, {{$d->nama_baliho}}">
                        <input type="hidden" name="UserName" value="{{$d->namaAd}}">
                        <input type="hidden" name="UserEmail" value="{{$d->email}}">
                        <input type="hidden" name="UserContact" value="{{$d->telp}}">
                        <input type="hidden" name="Remark" value="">
                        <input type="hidden" name="Lang" value="UTF-8">
                        <input type="hidden" name="Signature" id="Signature" value="">
                        <input type="hidden" name="ResponseURL" value="https://www.pasangbaliho.com/test">
                        <input type="hidden" name="BackendURL" value="https://www.pasangbaliho.com/eror">
                        <input type="submit" name="Submit" onclick="" class="btn btn-warning" value="Bayar Sekarang">
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="{{asset('js/sha1.js')}}"></script>

<script>
    $(document).ready(function () {
       showRec();
       var sh = iPay88Signature("5Z1cr9UxDkID01270"+{{$d->id_transaksi}}+""+{{$d->saldo}}+"00IDR");
        $('#Signature').val(sh);
    })
       
    function gantiValue(){
        var s = $('#nominalCek').val();
        var a = s.split(',').join('');
        $('#nominalKirim').val(a+'00');
        var sh = iPay88Signature("5Z1cr9UxDkID01270"+{{$d->id_transaksi}}+""+a+"00IDR");
        $('#Signature').val(sh);
    }

    function bayarCek(){
        // var s = document.forms["ePayment"]["Amount"].value;
        var s = $('#nominalCek').val();
        var h = s.split(',').join('');
        if (s === '' || s === '0') {
            swal.fire({
                text : 'Silahkan masukkan nominal pembayaran !',
                icon : 'warning'
            });
            return false;
        }else{
            if(h === '{{$d->saldo}}'){
            swal.fire({
                icon: 'info',
                text: 'Apakah anda akan membayar senilai '+s+' ?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal'
            })
            return false;
            }
        }
    }
      

function showRec(params) {
if(document.getElementById("bca").checked == true){
$('#noRek').html('0152513001');
$('#cabang').html('Cabang Solo Slamet Riyadi');
$('#bank').val('BCA');
}else if(document.getElementById("bni").checked == true){
$('#noRek').html('0028035567');
$('#cabang').html('Cabang Solo Slamet Riyadi');
$('#bank').val('BNI');
}else if(document.getElementById("bri").checked == true){
$('#noRek').html('0334.01.000631.30.1');
$('#cabang').html('Cabang Slamet Riyadi');
$('#bank').val('BRI');
}else if(document.getElementById("mandiri").checked == true){
$('#noRek').html('1380004513615');
$('#cabang').html('Cabang Slamet Riyadi');
$('#bank').val('Mandiri');
}else if(document.getElementById("danamon").checked == true){
$('#noRek').html('57104390');
$('#cabang').html('Cabang Solo - Sudirman');
$('#bank').val('Danamon');
}else if(document.getElementById("jateng").checked == true){
$('#noRek').html('1-002-00841-2');
$('#cabang').html('Cabang Surakarta');
$('#bank').val('Bank Jateng');
}
}

function addBuktiTraks(){
    var r = $('#rekening').val();
    var n = $('#nama').val();
    var nom = $('#nominal').val();

    swal.fire(
        
    )
}

function addTrans() {
var id = '{{$d->id_transaksi}}';
var n = $('#nama').val();
var rek = $('#rekening').val();
var ban = $('#bank').val();

swal.fire({
                icon: 'info',
                text: 'Apakah data yang anda masukkan sudah benar ?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(result.value){
                   
                            document.getElementById('formTrans').action = 'bayar';
                            document.getElementById('formTrans').method = 'POST';
                            document.getElementById('formTrans').submit();
                }
            })

// $.ajax({
//     url:'bayar',
//     dataType:"json",
//     type: 'POST',
//     data: {
//         idTrans : id,
//         bank : ban,
//         rekening : rek,
//         nama : n
//     },
//     success:function(data){
//         alert('Sukses');
//     },
//     error: function(data) {
//         alert(data);
//     },
// });

}

</script>

@endforeach
@endsection