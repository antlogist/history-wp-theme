<?php

include_once('../Classes/Request.php');
include_once('../Controllers/ShopController.php');

if(Request::has('post')){
  $shop = new ShopController();
  $shop->addItem();
} else {
  return null;
}
