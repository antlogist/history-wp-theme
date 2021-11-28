<?php

include_once('../Classes/Request.php');
include_once('../Controllers/PaymentController.php');

if(Request::has('post')){
  $payment = new PaymentController();
  $payment->getPaymentToken();
} else {
  return null;
}