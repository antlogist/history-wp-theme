<?php

if(!isset($_SESSION)) session_start();

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');

class AuthController {

  public function login() {
    $request = Request::get('post');

    if(CSRFToken::verifyCSRFToken($request->token)) {
      $login_email = $request->email;
      $login_pass = $request->password;
      $api_url = api_url . '/api/v1/login?token=' . api_token;
      $data = [
        "email" => $login_email,
        "password" => $login_pass,
      ];
      $data_string = json_encode ( $data );
      $ch = curl_init ( $api_url );
      curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt ($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_HTTPHEADER, [
          'Content-Type: application/json',
          'Content-Length: ' . strlen ($data_string) ]
      );
      $result = curl_exec ( $ch );

      $result = json_decode ( $result );
      $result = (object) array_merge ((array) $result, ['checkout' => $checkout]);
      if ($result -> status == 'success') {
        if ($result -> data -> uuid) {
          Session::add('SESSION_USER_UUID', $result -> data -> uuid);
          Session::add('SESSION_USER_NAME', $result -> data -> name);
          if (Session::has('error')) {
            Session::remove('error');
          }
          $output = $result;
          Redirect::to($request->home_url);
        }
      } else {
        if (Session::has('SESSION_USER_NAME')) {
          Session::remove('SESSION_USER_NAME');
        }
        if (Session::has('SESSION_USER_UUID')) {
          Session::remove('SESSION_USER_UUID');
        }
        Session::add('error', $result -> message);
        $output = $result;
        Redirect::to($request->home_url . '/login/');
      }

      exit();

    }

    if (Session::has('SESSION_USER_NAME')) {
      Session::remove('SESSION_USER_NAME');
    }
    if (Session::has('SESSION_USER_UUID')) {
      Session::remove('SESSION_USER_UUID');
    }
    Session::add('error', "Token mismatch");
    Redirect::to($request->home_url . '/login/');

  }
}

