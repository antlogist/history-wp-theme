<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');
include_once('../../app-membership/Database/Database.php');
include_once('../../app-membership/Controllers/User.php');
include_once('../../app-membership/Controllers/UserController.php');
include_once('../../app-membership/Controllers/Order.php');
include_once('../../app-membership/Controllers/OrderController.php');

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
          Session::add('SESSION_USER_NAME', $result->data->billing_firstname);
          Session::add('SESSION_USER_EMAIL', $result->data->email);

          if (Session::has('error')) {
            Session::remove('error');
          }

          //Membership
          $userController = new UserController();
          $userController->store();

          $orderController = new OrderController();
          $order = $orderController->getMembershipOrder($_SESSION['SESSION_USER_EMAIL'], 162);

          if($order) {
            Session::add('SESSION_MEMBERSHIP_ID', 162);
            Session::add('SESSION_MEMBERSHIP_DATE', $order['createdAt']);
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
        if (Session::has('SESSION_USER_EMAIL')) {
          Session::remove('SESSION_USER_EMAIL');
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
    if (Session::has('SESSION_USER_EMAIL')) {
      Session::remove('SESSION_USER_EMAIL');
    }
    Session::add('error', "Token mismatch");
    Redirect::to($request->home_url . '/login/');

  }

  public function logout() {
    $request = Request::get('post');

    if(CSRFToken::verifyCSRFToken($request->token)) {

      if(isAuthenticated()){
        Session::remove('SESSION_USER_UUID');
        Session::remove('SESSION_USER_NAME');
        Session::remove('SESSION_USER_EMAIL');

        if(!Session::has('user_cart')){
            session_destroy();
            // session_regenerate_id(true);
        }
      }
      Redirect::to($request->home_url);
      exit;
    }
    Redirect::to($request->home_url);
  }

  private function register($request) {

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
          Session::add('SESSION_USER_NAME', $result->status->message->billing_firstname);

          //Membership
          $membership = new UserController();
          $membership->store();

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

  public function registerUser() {
    $request = Request::get('post');
    $this->register($request);
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
          'Content-Length: ' . strlen ($data_string) ]
      );

      $result = curl_exec($ch);
      $result = json_decode ($result);

      if ($result->status->success == 1) {
        Session::add('pass_change_email', $email);
        Session::add('success', 'Check your ' . $email . ', please');
        Redirect::to($request->homeUrl . '/reset/');
        exit();
      }

      Session::add('error', "Something went wrong");
      Redirect::to($request->homeUrl . '/forgot-password/');

    }
  }

  public function reset() {
    $request = Request::get('post');
    if(CSRFToken::verifyCSRFToken($request->token)) {
      $email = $request->email;
      $password = $request->password;
      $confirm_pass = $request->confirmPassword;
      $otp_code = $request->otpCode;
      if ($password === $confirm_pass) {
        if ( strlen ($password) < 6 ) {
          Session::add('error', "The password must be at least 6 characters");
          Redirect::to($request->homeUrl . '/reset/');
          exit();
        }

        $api_url = api_url . '/api/v1/reset-password?token=' . api_token;

        $data = [
          "email" => $email,
          "password" => $password,
          "confirm_password" => $confirm_pass,
          "otp" => $otp_code
        ];

        $data_string = json_encode ($data);

        $ch = curl_init ($api_url);
        curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen ($data_string) ]
        );

        $result = curl_exec($ch);
        $result = json_decode ($result);

        if ($result->status->success == 1) {
          Session::add('success', 'Your Password reset request received. Please check your email ' . $email . ' for Verification code');
          if (Session::has('SESSION_USER_NAME')) {
            Session::remove('SESSION_USER_NAME');
          }
          if (Session::has('SESSION_USER_UUID')) {
            Session::remove('SESSION_USER_UUID');
          }
          if (Session::has('SESSION_USER_EMAIL')) {
            Session::remove('SESSION_USER_EMAIL');
          }
          Redirect::to($request->homeUrl . '/reset/');
          exit();
        }

        Session::add('error', "Something went wrong");
        Redirect::to($request->homeUrl . '/reset/');
        exit();
      }

      Session::add('error', "Password is not same as Confirm Password");
      Redirect::to($request->homeUrl . '/reset/');
      exit();
    }

    Session::add('error', "Token mismatch");
    Redirect::to($request->homeUrl . '/reset/');
  }


}
