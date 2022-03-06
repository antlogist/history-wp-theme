<?php

class Order {
  protected $conn;
  protected $table = 'orders';

  public function __construct() {

    if(!isAuthenticated()) {
      Session::add('error', "Malicious Activity");
      exit;
    }

    $database = Database::getInstance();
    $this->conn = $database->conn;
  }
}
