<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');
include_once('../Classes/Cart.php');
include_once('../Classes/APIRequest.php');

class ProductController {

  public function getProductBySlug() {
    $request = json_decode(file_get_contents('php://input'), true);
    $request = (object) $request;
    if (!CSRFToken::verifyCSRFToken($request->token, false)) {
      Session::add('error', "Token mismatch");
      echo json_encode(["fail" => "Token mismatch"]);
      exit();
    }

    //Get products
    $apiRequest = new APIRequest();
    $products = $apiRequest->getProductsContent();

    if(!$products) {
      Session::add('error', "Something went wrong");
      echo json_encode(["fail" => "Something went wrong"]);
      exit();
    }

    //Get product id
    $productId;
    foreach($products->data as $product) {
      if($product->slug == $request->slug) {
        $productId = $product->id;
      }
    }

    if (!$productId) {
      Session::add('error', "Product id not found");
      echo json_encode(["fail" => "Product id not found"]);
      exit();
    }

    //Get rpoduct
    $item = $apiRequest->getProduct($productId);

    if (!$item) {
      Session::add('error', "Item not found");
      echo json_encode(["fail" => "Item not found"]);
      exit();
    }


    // var_dump($products->data);
    echo json_encode($item);
  }

}
