<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');

class ProfileController {

  private $profile;
  private $homeUrl;

  function __construct(string $homeUrl, string $token) {
    $this->homeUrl = $homeUrl;
    if (Session::has('SESSION_USER_UUID') && Session::has('token') && CSRFToken::verifyCSRFToken($token)) {
      $uuid = Session::get('SESSION_USER_UUID');
      $api_url = api_url . '/api/v1/get-profile?token=' . api_token;
      $data = ["uuid" => $uuid];
      $data_string = json_encode ($data);
      $ch = curl_init ($api_url);
      curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt ($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_HTTPHEADER, [
          'Content-Type: application/json',
          'Content-Length: ' . strlen ( $data_string ) ]
      );
      $output = curl_exec ($ch);
      $this->profile = json_decode ($output);
    } else {
      Session::remove('SESSION_USER_UUID');
      Session::remove('SESSION_USER_NAME');
      Redirect::to($this->homeUrl);
    }

    if (!$this->profile->status->success == 1) {
      Session::remove('SESSION_USER_UUID');
      Session::remove('SESSION_USER_NAME');
      Redirect::to($this->homeUrl);
    }

  }

  public function getProfile() : Object {
    return $this->profile;
  }


  static function updateProfile() {
    $request = Request::get('post');
    if(CSRFToken::verifyCSRFToken($request->token)) {
      $api_url = api_url . '/api/v1/update-profile?token=' . api_token;

      $data = [
        "name"                => $request->billingFirstname . $request->billingLastname,
        "email"               => $request->email,
        "billing_firstname"   => $request->billingFirstname,
        "billing_lastname"    => $request->billingLastname,
        "billing_address"     => $request->billingAddress,
        "billing_city"        => $request->billingCity,
        "billing_zipcode"     => $request->billingZipcode,
        "billing_country"     => $request->billingCountry,
        "billing_county"      => $request->billingCounty,
        "billing_phone"       => $request->billingPhone,
        "billing_company"     => $request->billingCompany,
        "shipping_firstname"  => $request->shippingFirstname,
        "shipping_lastname"   => $request->shippingLastname,
        "shipping_address"    => $request->shippingAddress,
        "shipping_city"       => $request->shippingCity,
        "shipping_zipcode"    => $request->shippingZipcode,
        "shipping_country"    => $request->shippingCountry,
        "shipping_county"     => $request->shippingCounty,
        "shipping_phone"      => $request->shippingPhone,
        "shipping_company"    => $request->shippingCompany,
        "uuid"                => Session::get("SESSION_USER_UUID")
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

      Session::add('success', "Profile has been updated successfully!");
      Redirect::to($request->homeUrl . '/profile/');
      exit;
    }
    Session::add('error', "Token mismatch");
    Redirect::to($request->homeUrl . '/profile/');
  }

}
