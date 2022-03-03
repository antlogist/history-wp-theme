<?php

class User {
  protected $conn;
  protected $table = 'users';
  protected $email = '';

  public function __construct() {

    if(!isAuthenticated()) {
      Session::add('error', "Malicious Activity");
      exit;
    }

    $uuid = Session::get('SESSION_USER_UUID');
    $api_url = api_url . '/api/v1/get-profile?token=' . api_token;
    $data = ["uuid" => $uuid];
    $data_string = json_encode ($data);
    $ch = curl_init ($api_url);
    curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen ( $data_string ) ]
    );
    $output = curl_exec ($ch);
    $this->email = json_decode ($output)->data->email;

    if($this->email === ''){
      Session::add('error', "Malicious Activity");
      exit;
    }

    $database = Database::getInstance();
    $this->conn = $database->conn;
  }
}
