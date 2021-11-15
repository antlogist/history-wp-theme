<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');
include_once('../Classes/APIRequest.php');

class CartController {

  public function getCartItems() {
    $apiRequest = new APIRequest();
    try {
      $result = array();
      $cartTotal = 0;
      $cartTotalVat = 0;
      $currency = "";

      if(!Session::has("user_cart") || count(Session::get("user_cart")) < 1) {
        echo json_encode([
          "fail" => "No items in the cart"
        ]);
        exit;
      }
      $index = 0;
      foreach(Session::get("user_cart") as $cart_items) {
        $productId = $cart_items["product_id"];
        $quantity = $cart_items["quantity"];
        $item = $apiRequest->getProduct($productId);

        if(!$item) {
          continue;
        }

        $currency = $item->currency->symbol;

        $totalPrice = $item->data->price * $quantity;
        $cartTotal = $totalPrice + $cartTotal;
        $totalPrice = number_format($totalPrice, 2);

        $totalPriceVat = $item->data->vat_price * $quantity;
        $cartTotalVat = $totalPriceVat + $cartTotalVat;
        $totalPriceVat = number_format($totalPriceVat, 2);

        array_push($result, [
          "index" => $index,
          "id" => $item->data->id,
          "title" => $item->data->title,
          "image" => $item->data->thumb,
          "description" => $item->data->description,
          "price" => $item->data->price,
          "vat_percent" => $item->data->vat_percent,
          "vat_price" => $item->data->vat_price,
          "total" => $totalPrice,
          "quantity" => $quantity,
          "currency" => $item->currency->symbol
        ]);
        $index++;
      }

      $cartTotal = number_format($cartTotal, 2);
      $cartTotalVat = number_format($cartTotalVat, 2);
      $vat = $cartTotalVat - $cartTotal;
      $vat = number_format($vat, 2);

      Session::add("cartTotal", $cartTotal);

      echo json_encode(["items" => $result, "cartTotal" => $cartTotal, "currency" => $currency, "cartTotalVat" => $cartTotalVat, "vat" => $vat, "authenticated" => isAuthenticated()]);
      exit;

    } catch(\Exception $ex){
      echo $ex;
    }
  }

  public function updateQuantity() {
    $request = json_decode(file_get_contents('php://input'), true);
    $request = (object) $request;
    if (!$request->product_id) {
      Session::add('error', "Malicious Activity");
      exit;
    }
    $index = 0;
    $quantity = '';

    foreach($_SESSION["user_cart"] as $cart_items) {
      $index++;
      foreach($cart_items as $key => $value) {
        if ($key == "product_id" && $value == $request->product_id) {
          switch($request->operator) {
            case "+":
              $quantity = $cart_items["quantity"] + 1;
              break;
            case "-":
              $quantity = $cart_items["quantity"] - 1;
              if($quantity < 1){
                $quantity = 1;
              }
              break;
          }

          array_splice($_SESSION["user_cart"], $index-1, 1,
            array([
              "product_id" => $request->product_id,
              "quantity" => $quantity
            ]));
        }
      }
    }

  }
}
