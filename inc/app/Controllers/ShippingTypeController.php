<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');

class ShippingTypeController {
  public $types = [];
  private $url = api_url . '/api/v1/get-shipping-types?token=' . api_token;

  private function typesRequest($country, $weight, $postCode, $productIds) {
    $data = [
      "weight" => $weight,
      "country" => $country,
      "product_ids" => $productIds,
      "post_code" => $postCode
    ];

    $data_string = json_encode ($data);

    $ch = curl_init ($this->url);
    curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen ($data_string) ]
    );
    $output = curl_exec ($ch);

    $this->types = json_decode ($output)->data;
    curl_close($ch);

  }

  public function getShippingType() {
    $request = json_decode(file_get_contents('php://input'), true);
    $request = (object) $request;

    $products = $request->items;

    $weight = 0;
    $productIds = [];

    foreach($products as $product) {
      if ($product['weight']) {
        $weight = $weight + $product['weight'];
      }
      array_push($productIds, $product['id']);
    }

    $this->typesRequest($request->country, $weight, $request->post_code, $productIds);

    echo json_encode($this->types);
  }

  public function updateShippingType() {
    $request = json_decode(file_get_contents('php://input'), true);
    $request = (object) $request;

    $shipping = [
      "code" =>$request->shipping_code,
      "name" =>$request->shipping_name,
      "price" =>$request->shipping_price,
      "type" =>$request->shipping_type,
    ];

    if(!Session::has("shipping")) {
      Session::add("shipping", $shipping);
      Session::add("cartTotalShipping", number_format($_SESSION["cartTotal"] + $shipping["price"], 2));
    } else {
      $_SESSION["cartTotalShipping"] = number_format($_SESSION["cartTotal"] + $shipping["price"], 2);
      $_SESSION["shipping"] = $shipping;
    }

    echo json_encode($_SESSION["cartTotalShipping"]);
  }
}
