<html lang="en">

<head>

    <link rel="stylesheet" href="{{asset('css/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap4/css/bootstrap.min.css')}}">

</head>

<body class="container">
    <div class="text-center pt-4  mt-5 shadow pb-4">
        <img src="{{asset('assets/img/pasangbaliho.png')}}" class="" alt="" height="40">

        <h1 class="display-3">Terima Kasih</h1>
        <p class="lead">Setelah anda melakukan pembayaran ke nomor virtual account yg diberikan, sistem akan segera
            memproses pembayaran anda.</p>
        <hr>

        <p class="lead">
            <a class="btn btn-primary btn-sm" href="/dashboard" role="button">Kembali ke Dashboard</a>
        </p>
    </div>

    <?php

$merchantcode 	= $_REQUEST["MerchantCode"];
$paymentid 	= $_REQUEST["PaymentId"];
$refno 		= $_REQUEST["RefNo"];
$amount 	= $_REQUEST["Amount"];
$ecurrency 	= $_REQUEST["Currency"];
$remark 	= $_REQUEST["Remark"];
$transid 	= $_REQUEST["TransId"];
$authcode 	= $_REQUEST["AuthCode"];
$estatus 	= $_REQUEST["Status"];
$errdesc 	= $_REQUEST["ErrDesc"];
$signature	= $_REQUEST["Signature"];

?>

<input type="text" value="{{$merchantcode}}">
<input type="text" value="{{$paymentid}}">
<input type="text" value="{{$refno}}">
<input type="text" value="{{$amount}}">
<input type="text" value="{{$remark}}">
<input type="text" value="{{$transid}}">
<input type="text" value="{{$authcode}}">
<input type="text" value="{{$estatus}}">
<input type="text" value="{{$errdesc}}">
<input type="text" value="{{$signature}}">

</body>

<script src="{{asset('css/bootstrap4/js/bootstrap.min.js')}}"></script>

</html>