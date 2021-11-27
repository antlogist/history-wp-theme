<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');

class VieworderController {
  private $orders;
  private $order;
  private $homeUrl;

  private function ordersRequest(string $homeUrl) {
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

  private function orderRequest(string $homeUrl, string $order_token) {
    if (Session::has('SESSION_USER_UUID')) {
      $uuid = Session::get('SESSION_USER_UUID');
      $api_url = api_url . '/api/v1/get-order-details?token=' . api_token;
      $data = ["order_token" => $order_token];
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
      $this->order = json_decode ($output)->data;
    } else {
      Session::remove('SESSION_USER_UUID');
      Session::remove('SESSION_USER_NAME');
      Redirect::to($this->homeUrl);
      exit;
    }
  }

  private function orderCancelRequest(string $homeUrl, string $order_token) {
    if (Session::has('SESSION_USER_UUID')) {
      $uuid = Session::get('SESSION_USER_UUID');
      $api_url = api_url . '/api/v1/cancel-order?token=' . api_token;
      $data = ["order_token" => $order_token];
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
      echo $output;
    } else {
      Session::remove('SESSION_USER_UUID');
      Session::remove('SESSION_USER_NAME');
      Redirect::to($this->homeUrl);
      exit;
    }
  }

  public function getOrders(string $homeUrl) {
    $this->ordersRequest($homeUrl);
    return $this->orders;
  }

  public function getOrder(string $homeUrl, string $token) {
    $this->orderRequest($homeUrl, $token);
    return $this->order;
  }

  public function orderCancel() {
    $request = json_decode(file_get_contents('php://input'), true);
    $request = (object) $request;

    if (CSRFToken::verifyCSRFToken($request->token, false)) {
      $this->orderCancelRequest($request->home_url, $request->order_token);
      exit;
    }
    Redirect::to($request->home_url);
  }

}
