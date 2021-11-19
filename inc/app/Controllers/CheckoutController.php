<?php

include_once("../../../../../../wp-config.php");
include_once('../Classes/Request.php');
include_once('../Classes/CSRFToken.php');
include_once('../Classes/Redirect.php');
include_once('../Classes/Session.php');
include_once('../Classes/Cart.php');

class CheckoutController {

  private $settings;
  private $homeUrl;

  public function generalSettingsReq(string $homeUrl) {

    $this->homeUrl = $homeUrl;

    $api_url = api_url . '/api/v1/get-general-settings?token=' . api_token;

    $data = [];
    $data_string = json_encode ( $data );
    $ch = curl_init ( $api_url );
    curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data_string );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen ( $data_string ) ]
    );
    $output = curl_exec ( $ch );
    $this->settings = json_decode ( $output );
  }

  public function getGeneralSettings() {
    return $this->settings;
  }



}
