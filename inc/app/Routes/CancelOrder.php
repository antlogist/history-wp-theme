<?php

include_once('../Classes/Request.php');
include_once('../Controllers/VieworderController.php');

if(Request::has('post')){
  $order = new VieworderController();
  $order->orderCancel();
} else {
  return null;
}
