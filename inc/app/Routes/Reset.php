<?php

include_once('../Classes/Request.php');
include_once('../Controllers/AuthController.php');

if(Request::has('post')){
  $auth = new AuthController();
  $auth->reset();
} else {
  return null;
}