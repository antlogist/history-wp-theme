<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

if(!isAuthenticated()) {
  Redirect::to(get_home_url());
  exit;
}

include_once(get_template_directory() . '/inc/app/Controllers/VieworderController.php');

$vieworderController = new VieworderController(get_home_url());
$orders = $vieworderController->getOrders();

get_header();

?>

<header id="header" style="background-image: url(<?php if (!get_theme_mod('header_img')) {echo get_template_directory_uri() . "/images/header.jpg";} else { echo esc_url(get_theme_mod('header_img'));} ?>)">
  <div class="container header-container">
    <div class="row">
      <div class="col-12">
        <div class="header-title-outer-wrapper">
          <div>
            <h1 class="header-title" id="headerTitle">ORders</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container py-5">
  <div class="table-responsive mb-5">
    <table class="table align-middle">
      <thead>
        <tr>
          <th class="text-left">Date</th>
          <th>Price</th>
          <th class="text-center">Payment Status</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php
            // echo "<pre>";
            // print_r($orders);
            // echo "</pre>";
            foreach($orders as $order) {
              $created_at = $order->created_at;
              $total_price = $order->total_price;
              $payment_status = $order->payment_status;
              $order_token = $order->order_token;

              echo "<tr>";
                echo "<td style='min-width: 150px;'> " . $created_at . "</td>";
                echo "<td> " . $total_price . "</td>";
                echo "<td class='text-center'> " . $payment_status . "</td>";
                //Action
                echo "<td class='text-end' style='min-width: 250px;' data-token='" . $order_token ."'>";
                  if($payment_status === 'pending') {
                    echo "<button class='btn mx-1 pay'>Pay</button>";
                    echo "<button class='btn mx-1 view'>View</button>";
                  } else {
                    echo "<button class='btn view'>View</button>";
                  }
                echo "</td>";
              echo "</tr>";
            }
          ?>
      </tbody>
    </table>
  </div>

</div>

<?php get_footer();

Session::remove("error");
Session::remove("success"); ?>

