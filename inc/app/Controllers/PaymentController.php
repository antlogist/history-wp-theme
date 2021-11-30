<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');
include_once('../Classes/APRequest.php');

class PaymentController {

  private function paymentTokenReq($order_token, $home_url) {

    $api_url = api_url . '/api/v1/create-payment-token?token=' . api_token;

    $data = [
      "order_token" => $order_token,
      "return_url" => $home_url . '/payment',
      "cancel_url" => $home_url . '/payment',
    ];

    $data_string = json_encode ( $data );
    $ch = curl_init ( $api_url );
    curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data_string );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen ( $data_string ) ]
    );
    $output = curl_exec ( $ch );
    echo json_encode(payment_url . json_decode($output)->data->payment_token);
  }

  private function paymentCheckReq($transaction_id, $home_url) {
    $api_url = api_url . '/api/v1/check-payment?token=' . api_token;

    $data = [
      "transaction_id" => $transaction_id
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
    $output = curl_exec ($ch);
  }

  private function updateOrder($order_token, $transaction_id, $payment_type, $home_url) {
    $api_url = api_url . '/api/v1/update-order?token=' . api_token;

    $data = [
      "order_token" => $order_token,
      "transaction_id" => $transaction_id,
      'payment_type' => $payment_type
    ];

    $data_string = json_encode ($data);
    $ch = curl_init ($api_url);
    curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "POST") ;
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen ($data_string) ]
    );
    $output = curl_exec ($ch);
    Session::remove("order_token");
  }

  public function getPaymentToken() {
    $request = json_decode(file_get_contents('php://input'), true);
    $request = (object) $request;
    if (!CSRFToken::verifyCSRFToken($request->token, false)) {
      Session::add('error', "Token mismatch");
      echo json_encode(["fail" => "Token mismatch"]);
      exit();
    }

    Session::add("order_token", $request->order_token);

    $this->paymentTokenReq($request->order_token, $request->home_url);
  }

  public function getPaymentStatus($transaction_id, $home_url, $token, $order_token, $payment_type) {
    if (!CSRFToken::verifyCSRFToken($token, false)) {
      Session::add('error', "Token mismatch");
      echo json_encode(["fail" => "Token mismatch"]);
      Redirect::to($this->homeUrl);
      exit();
    }
    $transaction = $this->paymentCheckReq($transaction_id, $home_url);
    $transaction = json_decode ($transaction);

    if ($transaction -> status -> success == 1) {
      $this->updateOrder($order_token, $transaction_id, $payment_type, $home_url);
    }

  }
}
