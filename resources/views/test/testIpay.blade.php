{{-- @extends('main.master')

@section('content')

<form method="post" name="ePayment" action="https://sandbox.ipay88.co.id/epayment/entry.asp">
<input type="text" name="MerchantCode" value="ID01270">
<input type="text" name="PaymentId" value="">
<input type="text" name="RefNo" value="A00999">
<input type="text" name="Amount" value="1000000">
<input type="text" name="Currency" value="IDR">
<input type="text" name="ProdDesc" value="Photo Print">
<input type="text" name="UserName" value="John Tan">
<input type="text" name="UserEmail" value="john@hotmail.com">
<input type="text" name="UserContact" value="0126500100">
<input type="text" name="Remark" value="">
<input type="text" name="Lang" value="UTF-8">
<input type="text" name="Signature" value="AhPXTShKKmxiVpOYTydUqKMXYLY=">
<input type="text" name="ResponseURL" value="https://www.pasangbaliho.com/testResponse">
<input type="text" name="BackendURL" value="https://www.pasangbaliho.com/testBackend
">
<input type="submit" value="Proceed with Payment" name="Submit">
</form> --}}

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

// $merchantcode 	= $_REQUEST["MerchantCode"];
// $paymentid 	= $_REQUEST["PaymentId"];
// $refno 		= $_REQUEST["RefNo"];
// $amount 	= $_REQUEST["Amount"];
// $ecurrency 	= $_REQUEST["Currency"];
// $remark 	= $_REQUEST["Remark"];
// $transid 	= $_REQUEST["TransId"];
// $authcode 	= $_REQUEST["AuthCode"];
// $estatus 	= $_REQUEST["Status"];
// $errdesc 	= $_REQUEST["ErrDesc"];
// $signature	= $_REQUEST["Signature"];

?>


</body>

<script src="{{asset('css/bootstrap4/js/bootstrap.min.js')}}"></script>

</html>