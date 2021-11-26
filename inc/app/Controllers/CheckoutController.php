<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');
include_once('../Classes/Cart.php');
include_once('../Classes/APRequest.php');

class CheckoutController {

  private $requestResult;
  private $homeUrl;

  public function generalSettingsReq($data = []) {

    $api_url = api_url . '/api/v1/get-general-settings?token=' . api_token;

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
    $this->requestResult = json_decode ( $output );
  }

  public function setOrder($data) {

    $api_url = api_url . '/api/v1/order?token=' . api_token;

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
    $this->requestResult = json_decode ( $output );
  }

  public function getGeneralSettings() {
    return $this->requestResult;
  }

  public function checkout() {
    $request = json_decode(file_get_contents('php://input'), true);
    $request = (object) $request;

    //Shipping
    if(Session::has("shipping")) {
      $request->shipping_type = Session::get("shipping")["type"];
    } else {
      $request->shipping_type = null;
    }

    //Total Price
    $request->sub_total = Session::get("cartTotal");
    $request->total_price = Session::get("cartTotalShipping");
    $request->vat = "0";
    $request->couponcode = "";

    //Product
    $apiRequest = new APIRequest();
    $product = [];
    foreach(Session::get("user_cart") as $cart_items) {
      $productId = $cart_items["product_id"];
      $quantity = $cart_items["quantity"];

      $item = $apiRequest->getProduct($productId);

      if(!$item) {
        continue;
      }

      array_push($product, [
        // "artwork" => "",
        "description" => "",
        "external_info" => "",
        "height" => $item->data->height,
        "id" => $item->data->id,
        "image" => $item->data->thumb,
        "image_name" => "",
        "price" => $item->data->price,
        "qty" => $quantity,
        "slug" => $item->data->slug,
        "title" => $item->data->title,
        "total" => $totalPrice,
        "type" => $item->data->product_type,
        "user_questions" => "",
        "variations" => "",
        "width" => $item->data->width,
        "weight" => $item->data->weight,
      ]);

    }

    $request->product = $product;

    $this->setOrder($request);

    if($this->requestResult->status->success === true) {
      echo json_encode($this->requestResult->data->order_token);
      exit;
    } else {
      echo json_encode([
        "fail" => "Something went wrong"
      ]);
    }

  }
}
