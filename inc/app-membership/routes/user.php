<?php

include_once('../../app/Classes/Request.php');
include_once('../Controllers/UserController.php');

// if(Request::has('GET')) {
//   UserController::show();
// }

$user = new UserController();
$user->show();
