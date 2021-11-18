<?php
include_once("../../../../../../wp-config.php");

class APIRequest {

  public function getProducts() {
    $api_url = api_url . '/api/v1/get-products?token=' . api_token;
    $ch = curl_init ($api_url);
    $response = curl_exec ($ch);
    curl_close($ch);
  }

  public function getProductsContent() {
    $api_url = api_url . '/api/v1/get-products?token=' . api_token;
    $result = file_get_contents($api_url, false, null);
    $result = json_decode($result);
    return $result;
  }

  public function getProduct($productId) {
    $api_url = api_url . '/api/v1/get-product?token=' . api_token . '&product_id=' . $productId;
    $result = file_get_contents($api_url, false, null);
    $result = json_decode($result);
    return $result;
  }
}