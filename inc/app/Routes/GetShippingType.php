<?php

include_once('../Classes/Request.php');
include_once('../Controllers/ShippingTypeController.php');


if(Request::has('post')){
  $types = new ShippingTypeController();
  $types->getShippingType();
} else {
  return null;
}
