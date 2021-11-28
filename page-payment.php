<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

if(!isAuthenticated()) {
  Redirect::to(get_home_url());
  exit;
}

include_once(get_template_directory() . '/inc/app/Controllers/PaymentController.php');

$transaction_id = $_GET[ 'transaction_id' ];
$status         = $_GET[ 'status' ];
$payment_type   = $_GET[ 'payment_type' ];

if ($status == 'success' && $transaction_id) {
  $paymentController = new PaymentController();
  $result = $paymentController->getPaymentStatus($transaction_id, get_home_url(), $_SESSION["token"], $_SESSION["order_token"], $payment_type);
  $result = json_decode ($result);
}

get_header();

?>

<header id="header" style="background-image: url(<?php if (!get_theme_mod('header_img')) {echo get_template_directory_uri() . "/images/header.jpg";} else { echo esc_url(get_theme_mod('header_img'));} ?>)">
  <div class="container header-container">
    <div class="row">
      <div class="col-12">
        <div class="header-title-outer-wrapper">
          <div>
            <h1 class="header-title" id="headerTitle"><?php echo get_the_title(); ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container py-5">

<?php
  if($result) {
    echo "<h2 class='text-center'>" .$result->status->message . "</h2>";
    echo "<div class='buttons-wrapper my-5 text-center'>";
    echo "<a class='btn' href='" . get_home_url() . "/view-order/'>View Orders</a>";
    echo "</div>";
  } else {
    echo "<h2 class='text-center'>Something went wrong! Please Try again</h2>";
    echo "<div class='buttons-wrapper my-5 text-center'>";
    echo "<a class='btn' href='" . get_home_url() . "/view-order/'>View Orders</a>";
    echo "</div>";
  }
?>

</div>

<?php get_footer();

Session::remove("error");
Session::remove("success"); ?>

