<?php

include_once('../Classes/Request.php');
include_once('../Controllers/CheckoutController.php');


if(Request::has('post')){
  $product = new CheckoutController();
  $product->checkout();
} else {
  return null;
}
