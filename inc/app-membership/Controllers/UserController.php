<?php
include_once('../Database/Database.php');
include_once('User.php');

class UserController extends User {

  public function show() {

    $query = "SELECT * from " . $this->table . " WHERE email = " . "'" . $this->jts_user->email . "'";

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

      $this->user = $user;
    }
  }

  public function store() {

    //Check if user exists in DB
    $this->show();

    $query;

    if($this->user) {

      $query = "UPDATE " . $this->table . " SET last_visit = NOW() WHERE id = " . $this->user['id'];

    } else {

      $query = "INSERT INTO " . $this->table . " (first_name, last_name, email, membership, last_visit)
      VALUES (
        '" . $this->jts_user->billing_firstname . "', '" . $this->jts_user->billing_lastname . "', '" . $this->jts_user->email . "', 1, NOW()
      )";

    }

    $req = $this->conn->prepare($query);
    $req->execute();

  }

}
