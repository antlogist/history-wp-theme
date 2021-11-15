<?php
include_once('../Classes/Request.php');
include_once('../Controllers/CartController.php');


if(Request::has('post')){
  $cart = new CartController();
  $cart->updateQuantity();
} else {
  return null;
}