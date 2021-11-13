<?php

include_once('../Classes/APIRequest.php');

$products = new APIRequest();
$products->getProducts();
