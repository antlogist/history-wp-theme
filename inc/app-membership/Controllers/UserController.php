<?php
include_once('../Database/Database.php');
// include_once('../../app/Classes/Request.php');
// include_once('../../app/Classes/CSRFToken.php');
// include_once('../../app/Classes/Redirect.php');
// include_once('../../app/Classes/Session.php');

class UserController {
  private $conn;
  private $table = 'users';
  private $email = '';

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


  public function show() {

    $query = "SELECT * from " . $this->table . " WHERE email = " . "'" . $this->email . "'";

    $req = $this->conn->prepare($query);
    $req->execute();
    $num = $req->rowCount();

    if($num > 0) {

      $row = $req->fetch(PDO::FETCH_ASSOC);
      extract($row);

      $user = array(
        'id' => $id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'membership' => $membership,
        'last_visit' => $last_visit
      );

      echo "<pre>";
      var_dump($user);
      echo "</pre>";

    }
  }

  public function store() {

  }

}
