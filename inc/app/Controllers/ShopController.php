<?php
include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');
include_once('../Classes/Cart.php');

class ShopController {
  public function addItem() {
    $request = json_decode(file_get_contents('php://input'), true);
    $request = (object) $request;
    if (CSRFToken::verifyCSRFToken($request->token, false)) {
      if (!$request->product_id) {

        Session::add('error', "Malicious Activity");
        echo json_encode(["fail" => "Malicious Activity"]);
        exit;
      }
      Cart::add($request);

      $countItems = count(Session::get("user_cart"));

      Session::add('success', "Product added to cart successfully");

      echo json_encode(["success" => "Product added to cart successfully", "countItems" => $countItems]);
      exit;
    }

    Session::add('error', "Token mismatch");
    echo json_encode(["fail" => "Token mismatch"]);
    exit;
  }
}
