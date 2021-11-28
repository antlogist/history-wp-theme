<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

if(!isAuthenticated() || !Session::has("user_cart") || count(Session::get("user_cart")) < 1) {
  Redirect::to(get_home_url());
  exit;
}

unset($_SESSION['shipping']);
$_SESSION["cartTotalShipping"] = $_SESSION["cartTotal"];
// unset($_SESSION['cartTotalShipping']);

include_once(get_template_directory() . '/inc/app/Controllers/ProfileController.php');
include_once(get_template_directory() . '/inc/app/Controllers/CheckoutController.php');

$profileController = new ProfileController(get_home_url());
$profile = $profileController->getProfile()->data;

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
  <div id="checkout">

    <div v-if="isLoading" class="event-loader">
      <div class="lds-ripple"><div></div><div></div></div>
    </div>

    <?php
      if(Session::get("error")) {
        echo '<div class="message error-message">' . Session::get("error") . '</div>';
      }

      if(Session::get("success")) {
        echo '<div class="message success-message">' . Session::get("success") . '</div>';
      }
    ?>

    <div class="row">

      <div class="col-md-4 order-2">

        <div id="orderDetails">
          <div class="mb-2">
            <h2>Order Details</h2>
          </div>

          <div v-if="isProductsLoading">
            <table class="table table-bordered">
              <h5>Product Total</h5>
              <tr v-for="row in 5">
                <td>
                  <div class="color" style="width: 100%; height: 35px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
                </td>
                <td>
                  <div class="color" style="width: 100%; height: 35px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
                </td>
                <td>
                  <div class="color" style="width: 100%; height: 35px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
                </td>
                <td>
                  <div class="color" style="width: 100%; height: 35px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
                </td>
              </tr>
            </table>
          </div>

          <div v-else>
            <table class="table table-bordered align-middle">
              <h5>Product Total</h5>
              <thead class="align-middle">
                <th>Name</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Total</th>
              </thead>
              <tbody>
                <tr v-for="item in items">
                  <td>
                    {{ item.title }}
                  </td>
                  <td>
                    {{ item.currency }}{{ item.price }}
                  </td>
                  <td>
                    {{ item.quantity}}
                  </td>
                  <td>
                    {{ item.currency }}{{ item.total }}
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4">
                    <b>Subtotal: {{ currency }}{{ cartTotalVat }}</b>
                  </td>

                </tr>
              </tfoot>
            </table>
          </div>

        </div>

        <div id="shippingTypes">

          <div v-if="isShippingLoading">
            <table class="table table-bordered">
            <h5>Shipping Types</h5>
              <tr v-for="row in 2">
                <td>
                  <div class="color" style="width: 100%; height: 35px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
                </td>
              </tr>
            </table>
          </div>

          <div v-else>

            <form id="shippingTypesForm">
              <div class="mb-2">
                <h5>Shipping Types</h5>
              </div>

              <div class="form-check" v-for="checkbox in shippingTypes">
                <input :checked="<?php if ($_SESSION["shipping"]) { echo $_SESSION["shipping"]["type"];} else { echo 0; }  ?> == checkbox.type_id" :value="checkbox.type_id" class="form-check-input" type="radio" name="shipping" :id="'check' + checkbox.type_id">
                <label class="form-check-label" :for="'check' + checkbox.type_id">
                  {{ checkbox.name }} {{ currency }}{{ checkbox.price }}
                </label>
              </div>
            </form>
          </div>

        </div>

        <div id="cartTotalShipping" class="mt-4">

          <div v-if="isShippingLoading">
            <table class="table table-bordered">
              <tr>
                <td>
                  <div class="color" style="width: 100%; height: 35px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
                </td>
              </tr>
            </table>
          </div>

          <div v-else>
            <h2>Total: {{ currency }}{{ cartTotalShipping == 0 ? '<?php echo $_SESSION["cartTotalShipping"]; ?>' : cartTotalShipping }}</h2>
          </div>

        </div>

        <div class="checkboxes">
          <div class="check-wrapper my-4">
              <form id="checkboxesForm">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Yes" id="newsletterCheck" name="Newsletter">
                  <label class="form-check-label" for="newsletterCheck">
                    Newsletter
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Yes" id="acceptCheck" name="Accept_terms_and_conditions">
                  <label class="form-check-label" for="acceptCheck">
                    Accept terms and conditions
                  </label>
                </div>
              </form>
            </div>
        </div>



        <div class="buttons-wrapper mb-3">
            <button class="btn" @click="placeOrder();">Place Order</button>
          </div>
      </div>

      <div class="col-md-8 order-1">
          <form class="w-100" id="profileInfo" name="profileInfo">
            <input type="hidden" name="user_id" value="<?php echo $profile->id; ?>">
            <input type="hidden" name="billing_email" value="<?php echo $profile->email; ?>">
            <input type="hidden" name="delivery_email" value="<?php echo $profile->email; ?>">
            <div class="row mb-5">
              <div class="col-md-12 mb-2">
                <h2>Billing Details</h2>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="mb-3 col-md-6">
                      <div>
                        <label for="billingFirstName" class="form-label">First Name</label>
                      </div>
                      <input class="w-100 form-control billing-input" type='text' name='billing_firstname' id='billingFirstname' maxlength="50" value="<?php echo $profile->billing_firstname; ?>" />
                    </div>

                    <div class="mb-3 col-md-6">
                      <div>
                        <label for="billingLastname" class="form-label">Last Name</label>
                      </div>
                      <input class="w-100 form-control billing-input" type='text' name='billing_lastname' id='billingLastname' maxlength="50" value="<?php echo $profile->billing_lastname; ?>" />
                    </div>
                </div>

                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="billingAddress" class="form-label">Address</label>
                  </div>
                  <input class="w-100 form-control billing-input" type='text' name='billing_address' id='billingAddress' maxlength="50" value="<?php echo $profile->billing_address; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="billingCity" class="form-label">City</label>
                  </div>
                  <input class="w-100 form-control billing-input" type='text' name='billing_city' id='billingCity' maxlength="50" value="<?php echo $profile->billing_city; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="billingCounty" class="form-label">County</label>
                  </div>
                  <input class="w-100 form-control billing-input" type='text' name='billing_county' id='billingCounty' maxlength="50" value="<?php echo $profile->billing_county; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="billingCountry" class="form-label">Country</label>
                  </div>
                  <select class="w-100 form-select billing-input" name="billing_country" id="billingCountry">
                    <option value="">Select a country...</option>
                    <?php echo countriesOption($profile->billing_country); ?>
                  </select>
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="billingZipcode" class="form-label">Zip Code</label>
                  </div>
                  <input class="w-100 form-control billing-input" type='text' name='billing_post_code' id='billingZipcode' maxlength="50" value="<?php echo $profile->billing_zipcode; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="billingPhone" class="form-label">Phone Number</label>
                  </div>
                  <input class="w-100 form-control billing-input" type='text' name='billing_phone' id='billingPhone' maxlength="50" value="<?php echo $profile->billing_phone; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="billingCompany" class="form-label">Company</label>
                  </div>
                  <input class="w-100 form-control billing-input" type='text' name='billing_company' id='billingCompany' maxlength="50" value="<?php echo $profile->billing_company; ?>" />
                </div>

            </div>

            <div class="buttons-wrapper mb-5 d-flex align-items-center">
              <a href="#" class="btn copy-billing" id="copyBilling">Copy</a>
              <small style="margin-left: 1rem;">Shipping Address same as Billing Address</small>
            </div>

            <div class="row mb-3">
              <div class="col-md-12 mb-2">
                <h2>Shipping Details</h2>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="mb-3 col-md-6">
                      <div>
                        <label for="shippingFirstname" class="form-label">First Name</label>
                      </div>
                      <input class="w-100 form-control shipping-input" type='text' name='delivery_firstname' id='shippingFirstname' maxlength="50" value="<?php echo $profile->shipping_firstname; ?>" />
                    </div>

                    <div class="mb-3 col-md-6">
                      <div>
                        <label for="shippingLastname" class="form-label">Last Name</label>
                      </div>
                      <input class="w-100 form-control shipping-input" type='text' name='delivery_lastname' id='shippingLastname' maxlength="50" value="<?php echo $profile->shipping_lastname; ?>" />
                    </div>
                </div>

                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="shippingAddress" class="form-label">Address</label>
                  </div>
                  <input class="w-100 form-control shipping-input" type='text' name='delivery_address' id='shippingAddress' maxlength="50" value="<?php echo $profile->shipping_address; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="shippingCity" class="form-label">City</label>
                  </div>
                  <input class="w-100 form-control shipping-input" type='text' name='delivery_city' id='shippingCity' maxlength="50" value="<?php echo $profile->shipping_city; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="shippingCounty" class="form-label">County</label>
                  </div>
                  <input class="w-100 form-control shipping-input" type='text' name='delivery_county' id='shippingCounty' maxlength="50" value="<?php echo $profile->shipping_county; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="shippingCountry" class="form-label">Country</label>
                  </div>
                  <select class="w-100 form-select shipping-input" name="delivery_country" id="shippingCountry">
                    <option value="">Select a country...</option>
                    <?php echo countriesOption($profile->shipping_country); ?>
                  </select>
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="shippingZipcode" class="form-label">Zip Code</label>
                  </div>
                  <input class="w-100 form-control shipping-input" type='text' name='delivery_post_code' id='shippingZipcode' maxlength="50" value="<?php echo $profile->shipping_zipcode; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <div>
                    <label for="shippingPhone" class="form-label">Phone Number</label>
                  </div>
                  <input class="w-100 form-control shipping-input" type='text' name='delivery_phone' id='shippingPhone' maxlength="50" value="<?php echo $profile->shipping_phone; ?>" />
                </div>

                <div class="mb-4 col-md-6">
                  <div>
                    <label for="shippingCompany" class="form-label">Company</label>
                  </div>
                  <input class="w-100 form-control shipping-input" type='text' name='delivery_company' id='shippingCompany' maxlength="50" value="<?php echo $profile->shipping_company; ?>" />
                </div>

            </div>

          </form>
      </div>

    </div>

  </div>
</div>

<?php get_footer();

Session::remove("error");
Session::remove("success");?>

