<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

if(!isAuthenticated() || !$_GET["order_token"]) {
  Redirect::to(get_home_url());
  exit;
}


include_once(get_template_directory() . '/inc/app/Controllers/VieworderController.php');

$vieworderController = new VieworderController();
$order = $vieworderController->getOrder(get_home_url(), $_GET["order_token"]);

foreach($order as $key => $value) {
  if ($key === "order_metas") {
    continue;
  }
  $$key = $value;
}


get_header();

?>

<script>
  const token = "<?php echo $_SESSION["token"]; ?>";
</script>

<header id="header" style="background-image: url(<?php if (!get_theme_mod('header_img')) {echo get_template_directory_uri() . "/images/header.jpg";} else { echo esc_url(get_theme_mod('header_img'));} ?>)">
  <div class="container header-container">
    <div class="row">
      <div class="col-12">
        <div class="header-title-outer-wrapper">
          <div>
            <h1 class="header-title" id="headerTitle">Order Detail</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container py-5">

<?php
    if(Session::get("error")) {
      echo '<div class="message error-message">' . Session::get("error") . '</div>';
    }

    if(Session::get("success")) {
      echo '<div class="message error-message">' . Session::get("success") . '</div>';
    }
  ?>

  <div class="row mb-5">
    <h5 class="mb-3">Product(s) Information</h5>
    <?php
      foreach($order->order_metas as $product) {

        echo '<div class="col-md-4">';
          echo '<div class="card">';
            echo '<div class="card-body text-center">';
              foreach($product as $info) {
                echo '<h5 class="card-title mb-2">' . $info->title . '</h5>';
              }
              echo '<div class="price-wrapper mb-3"><h5>£' . $product->price . '</h5></div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';

      }
    ?>

  </div>

  <div class="row">

    <div class="col-md-4 mb-5">
       <h5 class="mb-3">Order Information</h5>

       <div class="mb-3">
          <label class="form-label">Total Price:</label>
          <input type="text" class="form-control" value="£<?php echo $total_price; ?>" readonly>
        </div>

       <div class="mb-3">
          <label class="form-label">Subtotal Price:</label>
          <input type="text" class="form-control" value="£<?php echo $sub_total; ?>" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Tracking Code:</label>
          <input type="text" class="form-control" value="<?php echo $tracking_number; ?>" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Shipping Type:</label>
          <input type="text" class="form-control" value="<?php echo $shipping_name; ?>" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Payment Status:</label>
          <input type="text" class="form-control" value="<?php echo $payment_status; ?>" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Order Status:</label>
          <input type="text" class="form-control" value="<?php echo $status; ?>" readonly>
        </div>

    </div>

    <div class="col-md-4">
      <h5 class="mb-3">Billing Address</h5>

      <div class="mb-3">
        <label class="form-label">First Name:</label>
        <input type="text" class="form-control" value="<?php echo $shipping_firstname; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Last Name:</label>
        <input type="text" class="form-control" value="<?php echo $shipping_lastname; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Company:</label>
        <input type="text" class="form-control" value="<?php echo $shipping_company; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Address:</label>
        <input type="text" class="form-control" value="<?php echo $shipping_address; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">City:</label>
        <input type="text" class="form-control" value="<?php echo $shipping_city; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Country:</label>
        <input type="text" class="form-control" value="<?php echo $shipping_country; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Zip Code:</label>
        <input type="text" class="form-control" value="<?php echo $shipping_zipcode; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="text" class="form-control" value="<?php echo $shipping_email; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Phone:</label>
        <input type="text" class="form-control" value="<?php echo $shipping_phone; ?>" readonly>
      </div>

    </div>

    <div class="col-md-4">
      <h5 class="mb-3">Delivery Address</h5>

      <div class="mb-3">
        <label class="form-label">First Name:</label>
        <input type="text" class="form-control" value="<?php echo $delivery_firstname; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Last Name:</label>
        <input type="text" class="form-control" value="<?php echo $delivery_lastname; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Company:</label>
        <input type="text" class="form-control" value="<?php echo $delivery_company; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Address:</label>
        <input type="text" class="form-control" value="<?php echo $delivery_address; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">City:</label>
        <input type="text" class="form-control" value="<?php echo $delivery_city; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Country:</label>
        <input type="text" class="form-control" value="<?php echo $delivery_country; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Zip Code:</label>
        <input type="text" class="form-control" value="<?php echo $delivery_zipcode; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="text" class="form-control" value="<?php echo $delivery_email; ?>" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label">Phone:</label>
        <input type="text" class="form-control" value="<?php echo $delivery_phone; ?>" readonly>
      </div>

    </div>

  </div>

</div>

<?php get_footer();

Session::remove("error");
Session::remove("success"); ?>

