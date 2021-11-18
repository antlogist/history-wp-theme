<?php

include_once('../Classes/Request.php');
include_once('../Controllers/ProductController.php');


if(Request::has('post')){
  $product = new ProductController();
  $product->getProductBySlug();
} else {
  return null;
}
