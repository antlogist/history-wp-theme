<?php
include_once('../Database/Database.php');
include_once('User.php');

class UserController extends User {

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
