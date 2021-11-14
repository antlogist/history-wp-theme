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
        exit;
      }
      Cart::add($request);

      Session::add('success', "Product added to cart successfully");
      exit;
    }

    Session::add('error', "Token mismatch");
    exit;
  }
}
