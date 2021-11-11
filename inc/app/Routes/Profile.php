<?php

include_once('../Classes/Request.php');
include_once('../Controllers/ProfileController.php');

if(Request::has('post')){
  // $profile = new ProfileController();
  // $profile->updateProfile();

  ProfileController::updateProfile();
} else {
  return null;
}
