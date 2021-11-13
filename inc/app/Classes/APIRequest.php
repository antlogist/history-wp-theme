<?php
include_once("../../../../../../wp-config.php");

class APIRequest {

  public function getProducts() {
    $api_url = api_url . '/api/v1/get-products?token=' . api_token;
    $ch = curl_init ($api_url);
    $response = curl_exec ($ch);
    curl_close($ch);
  }
}