@extends('main.master')

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
<input type="text" name="BackendURL" value="https://www.pasangbaliho.com/testBackend">
<input type="submit" value="Proceed with Payment" name="Submit">
</form>
