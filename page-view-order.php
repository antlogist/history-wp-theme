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

$vieworderController = new VieworderController();
$orders = $vieworderController->getOrders(get_home_url());

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
            <h1 class="header-title" id="headerTitle">Orders</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container py-5">
  <div class="table-responsive mb-5">
    <table class="table align-middle" id="ordersTable">
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

        foreach($orders as $order) {
          $created_at = $order->created_at;
          $total_price = $order->total_price;
          $payment_status = $order->payment_status;
          $order_token = $order->order_token;
          $status = $order->status;
          if($status == "cancel"){
            $payment_status = "canceled";
          }
          ?>

          <tr>

            <td style="min-width: 150px;"><?php echo $created_at; ?></td>
            <td><?php echo '£' . $total_price; ?></td>
            <td class="text-center"><?php echo $payment_status; ?></td>

            <!--Action-->
            <td class="text-end" style="min-width: 250px;">
              <?php if($payment_status === 'pending') { ?>
                <button class="btn mx-1 pay" @click="pay('<?php echo $order_token; ?>')"><small>Pay</small></button>
                <button class="btn mx-1 cancel"><small>Cancel</small></button>
                <a href="<?php echo get_home_url(); ?>/order-details/?order_token=<?php echo $order_token; ?>" class="btn ms-1 view"><small>View</small></a>
              <?php } else { ?>
                <a href="<?php echo get_home_url(); ?>/order-details/?order_token=<?php echo $order_token; ?>" class="btn ms-1 view"><small>View</small></a>
              <?php } ?>
            </td>

          </tr>


        <?php

        }

        if(count($orders) < 1) {
          echo "<tr><td class='text-center' colspan=4><h2>Orders not found</h2></td></tr>";
        }
      ?>

      </tbody>

    </table>
  </div>

</div>

<?php get_footer();

Session::remove("error");
Session::remove("success"); ?>

