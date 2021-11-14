<?php

include_once("Session.php");

class CSRFToken {
  /**
   * Generate token
   * @private
   * @return mixed
   */
  static function _token() {
    if (!Session::has("token")) {
      $randomToken = str_replace("=", "",base64_encode(openssl_random_pseudo_bytes(32)));
      Session::add("token", $randomToken);
    }

    return Session::get("token");
  }

  /**
   * Verify token
   * @param $requestToken
   * @param $regenerate
   * @return boolean
   */
  static function verifyCSRFToken($requestToken, $regenerate = true) {
    if (Session::has("token") && Session::get("token") === $requestToken) {
      if ($regenerate) {
        Session::remove("token");
      }
      return true;
    }
    return false;
  }
}