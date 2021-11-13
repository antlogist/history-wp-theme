<?php

include_once('../Classes/Request.php');
include_once('../Controllers/ProfileController.php');

if(Request::has('post')){
  ProfileController::updateProfile();
} else {
  return null;
}
