<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

if(!isAuthenticated()) {
  Redirect::to(get_home_url() . '/login');
  exit;
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

  <?php if(count(Session::get("user_cart")) < 1) {

    echo "<h2 class='text-center mb-4'>Your shopping cart is empty</h2>";
    echo "<div class='buttons-wrapper text-center'><a class='btn' href='" . get_home_url() . "/shop'>Continue Shopping</a></div>";

  } else { ?>
    <div id="shoppingCart">
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <th>#</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th style="text-align: center;">Action</th>
          </thead>
          <tr v-for="item in items">
            <th scope="row">{{ item.index + 1 }}</th>
            <td><img :src="'<?php echo api_url; ?>/uploads/gallerythumb/' + item.image.split(',')[0]" alt="" class="w-100" style="max-width: 50px;"></td>
            <td>{{ item.title }}</td>
            <td>{{ item.currency }}{{ item.price }}</td>
            <td>
              <button @click.prevent="updateQuantity(item.id, '-')" style="cursor: pointer; padding: 0; width: 25px; height: 25px;"> - </button>
                {{ item.quantity}}
              <button @click.prevent="updateQuantity(item.id, '+')" style="cursor: pointer; padding: 0; width: 25px; height: 25px;"> + </button>
            </td>
            <td>{{ item.currency }}{{ item.total }}</td>
            <td style="text-align: center;">
              <button @click="removeItem(item.index)" style="cursor: pointer; padding: 0; width: 25px; height: 25px;">x</button>
            </td>
          </tr>
        </table>
      </div>

      <div class="row">
        <div class="col-md-6 offset-md-6">
          <table class="table align-middle">
            <tr>
              <td>Subtotal:</td>
              <td style="text-align: right;">{{ currency }}{{ cartTotal }}</td>
            </tr>
            <tr>
              <td>Tax:</td>
              <td style="text-align: right;">{{ currency }}{{ vat }}</td>
            </tr>
            <tr>
              <td><b>Total <small>(vat included)</small>:</b></td>
              <td style="text-align: right;"><b>{{ currency }}{{ cartTotalVat }}</b></td>
            </tr>
          </table>
        </div>
      </div>

    </div>
  <?php } ?>

</div>

<?php get_footer();

Session::remove("success");
Session::remove("error"); ?>
