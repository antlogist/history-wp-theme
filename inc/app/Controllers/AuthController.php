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
          Session::add('SESSION_USER_UUID', $result->data->uuid);
          Session::add('SESSION_USER_NAME', $result->data->name);
          if (Session::has('error')) {
            Session::remove('error');
          }
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

  public function logout() {
    $request = Request::get('post');

    if(CSRFToken::verifyCSRFToken($request->token)) {

      if(isAuthenticated()){
        Session::remove('SESSION_USER_ID');
        Session::remove('SESSION_USER_NAME');

        if(!Session::has('user_cart')){
            session_destroy();
            // session_regenerate_id(true);
        }
      }
      Redirect::to($request->home_url);
    }
  }

  public function register() {
    $request = Request::get('post');

    if(CSRFToken::verifyCSRFToken($request->token)) {
      $firstname = $request->firstName;
      $lastname = $request->lastName;
      $email = $request->email;
      $password = $request->password;
      $confirm_pass = $request->confirmPassword;

      if ($password === $confirm_pass) {

        if ( strlen ($password) < 6 ) {

          Session::add('error', "The password must be at least 6 characters");
          Redirect::to($request->homeUrl . '/register/');
          exit();

        }

        $api_url = api_url . '/api/v1/register?token=' . api_token;

        $data = [
          "firstname" => $firstname,
          "lastname" => $lastname,
          "email" => $email,
          "password" => $password,
        ];

        $data_string = json_encode ($data);
        $ch = curl_init ($api_url);
        curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen ( $data_string ) ]
        );

        $result = curl_exec ($ch);
        $result = json_decode ($result);

        if ($result->status->success == '1') {
          Session::add('SESSION_USER_UUID', $result->status->message->uuid);
          Session::add('SESSION_USER_NAME', $result->status->message->name);
          Redirect::to($request->homeUrl);
          exit();
        } else {
          Session::add('error', "Something went wrong");
          Redirect::to($request->homeUrl . '/register/');
        }
      }

      Session::add('error', "Password is not same as Confirm Password");
      Redirect::to($request->homeUrl . '/register/');

      exit();
    }

    Session::add('error', "Token mismatch");
    Redirect::to($request->homeUrl . '/register/');
  }


  public function forgot() {
    $request = Request::get('post');

    if(CSRFToken::verifyCSRFToken($request->token)) {

      $email = $request->email;
      $api_url = api_url . '/api/v1/forgot-password?token=' . api_token;

      $data = [
        "email" => $email
      ];

      $data_string = json_encode ( $data );
      $ch = curl_init ($api_url);
      curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt ($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_HTTPHEADER, [
          'Content-Type: application/json',
          'Content-Length: ' . strlen ( $data_string ) ]
      );

      $result = curl_exec($ch);
      $result = json_decode ($result);

      if ($result->status->success == 1) {
        Session::add('pass_change_email', $email);
        Session::add('success', 'Check your ' . $email . ', please');
        Redirect::to($request->homeUrl . '/forgot-password/');
        exit();
      }

      Session::add('error', "Something went wrong");
      Redirect::to($request->homeUrl . '/forgot-password/');

    }
  }


}
