<?php

include_once('../Controllers/CartController.php');

$cartItems = new CartController();
$cartItems->getCartItems();
