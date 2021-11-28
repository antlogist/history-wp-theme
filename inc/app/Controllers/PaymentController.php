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

  public function getPaymentToken() {
    $request = json_decode(file_get_contents('php://input'), true);
    $request = (object) $request;
    if (!CSRFToken::verifyCSRFToken($request->token, false)) {
      Session::add('error', "Token mismatch");
      echo json_encode(["fail" => "Token mismatch"]);
      exit();
    }

    $this->paymentTokenReq($request->order_token, $request->home_url);
  }
}
