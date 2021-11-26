<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');

class VieworderController {
  private $orders;
  private $homeUrl;

  function __construct(string $homeUrl) {
    if (Session::has('SESSION_USER_UUID')) {
      $uuid = Session::get('SESSION_USER_UUID');
      $api_url = api_url . '/api/v1/get-orders?token=' . api_token;
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
      $this->orders = array_reverse(json_decode ($output)->data);
    } else {
      Session::remove('SESSION_USER_UUID');
      Session::remove('SESSION_USER_NAME');
      Redirect::to($this->homeUrl);
      exit;
    }
  }

  public function getOrders() {
    // echo "<pre>";
    // print_r($this->orders);
    // echo "</pre>";
    return $this->orders;
  }

}
