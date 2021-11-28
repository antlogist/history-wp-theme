<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

if(!isAuthenticated()) {
  Redirect::to(get_home_url());
  exit;
}

include_once(get_template_directory() . '/inc/app/Controllers/ProfileController.php');

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

<?php
  if(Session::get("error")) {
    echo '<div class="message error-message">' . Session::get("error") . '</div>';
  }

  if(Session::get("success")) {
    echo '<div class="message error-message">' . Session::get("success") . '</div>';
  }
?>

<div class="buttons-wrapper mb-5">
  <a href="<?php echo get_home_url(); ?>/view-order/" class="btn">Orders</a>
</div>
<form action="<?php echo get_template_directory_uri(); ?>/inc/app/Routes/Profile.php" method="post" class="w-100" id="profileInfo">

  <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
  <input type="hidden" name="homeUrl" value="<?php echo get_home_url(); ?>">

  <div class="row mb-5">
    <div class="col-md-6">
      <div class="mb-3">
        <div>
          <label for='email' class="form-label">User Email*:</label>
        </div>
        <input class="w-100 form-control" type='email' name='email' id='email' maxlength="50" value="<?php echo $profile->email; ?>" disabled />
      </div>

    </div>
  </div>

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
            <input class="w-100 form-control billing-input" type='text' name='billingFirstname' id='billingFirstname' maxlength="50" value="<?php echo $profile->billing_firstname; ?>" />
          </div>

          <div class="mb-3 col-md-6">
            <div>
              <label for="billingLastname" class="form-label">Last Name</label>
            </div>
            <input class="w-100 form-control billing-input" type='text' name='billingLastname' id='billingLastname' maxlength="50" value="<?php echo $profile->billing_lastname; ?>" />
          </div>
      </div>

      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="billingAddress" class="form-label">Address</label>
        </div>
        <input class="w-100 form-control billing-input" type='text' name='billingAddress' id='billingAddress' maxlength="50" value="<?php echo $profile->billing_address; ?>" />
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="billingCity" class="form-label">City</label>
        </div>
        <input class="w-100 form-control billing-input" type='text' name='billingCity' id='billingCity' maxlength="50" value="<?php echo $profile->billing_city; ?>" />
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="billingCounty" class="form-label">County</label>
        </div>
        <input class="w-100 form-control billing-input" type='text' name='billingCounty' id='billingCounty' maxlength="50" value="<?php echo $profile->billing_county; ?>" />
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="billingCountry" class="form-label">Country</label>
        </div>
        <select class="w-100 form-select billing-input" name="billingCountry" id="billingCountry">
          <option value="">Select a country...</option>
          <?php echo countriesOption($profile->billing_country); ?>
        </select>
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="billingZipcode" class="form-label">Zip Code</label>
        </div>
        <input class="w-100 form-control billing-input" type='text' name='billingZipcode' id='billingZipcode' maxlength="50" value="<?php echo $profile->billing_zipcode; ?>" />
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="billingPhone" class="form-label">Phone Number</label>
        </div>
        <input class="w-100 form-control billing-input" type='text' name='billingPhone' id='billingPhone' maxlength="50" value="<?php echo $profile->billing_phone; ?>" />
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="billingCompany" class="form-label">Company</label>
        </div>
        <input class="w-100 form-control billing-input" type='text' name='billingCompany' id='billingCompany' maxlength="50" value="<?php echo $profile->billing_company; ?>" />
      </div>

  </div>

  <div class="buttons-wrapper mb-5 d-flex align-items-center">
    <button class="btn copy-billing" id="copyBilling">Copy</button>
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
            <input class="w-100 form-control shipping-input" type='text' name='shippingFirstname' id='shippingFirstname' maxlength="50" value="<?php echo $profile->shipping_firstname; ?>" />
          </div>

          <div class="mb-3 col-md-6">
            <div>
              <label for="shippingLastname" class="form-label">Last Name</label>
            </div>
            <input class="w-100 form-control shipping-input" type='text' name='shippingLastname' id='shippingLastname' maxlength="50" value="<?php echo $profile->shipping_lastname; ?>" />
          </div>
      </div>

      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="shippingAddress" class="form-label">Address</label>
        </div>
        <input class="w-100 form-control shipping-input" type='text' name='shippingAddress' id='shippingAddress' maxlength="50" value="<?php echo $profile->shipping_address; ?>" />
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="shippingCity" class="form-label">City</label>
        </div>
        <input class="w-100 form-control shipping-input" type='text' name='shippingCity' id='shippingCity' maxlength="50" value="<?php echo $profile->shipping_city; ?>" />
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="shippingCounty" class="form-label">County</label>
        </div>
        <input class="w-100 form-control shipping-input" type='text' name='shippingCounty' id='shippingCounty' maxlength="50" value="<?php echo $profile->shipping_county; ?>" />
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="shippingCountry" class="form-label">Country</label>
        </div>
        <select class="w-100 form-select shipping-input" name="shippingCountry" id="shippingCountry">
          <option value="">Select a country...</option>
          <?php echo countriesOption($profile->shipping_country); ?>
        </select>
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="shippingZipcode" class="form-label">Zip Code</label>
        </div>
        <input class="w-100 form-control shipping-input" type='text' name='shippingZipcode' id='shippingZipcode' maxlength="50" value="<?php echo $profile->shipping_zipcode; ?>" />
      </div>

      <div class="mb-3 col-md-6">
        <div>
          <label for="shippingPhone" class="form-label">Phone Number</label>
        </div>
        <input class="w-100 form-control shipping-input" type='text' name='shippingPhone' id='shippingPhone' maxlength="50" value="<?php echo $profile->shipping_phone; ?>" />
      </div>

      <div class="mb-4 col-md-6">
        <div>
          <label for="shippingCompany" class="form-label">Company</label>
        </div>
        <input class="w-100 form-control shipping-input" type='text' name='shippingCompany' id='shippingCompany' maxlength="50" value="<?php echo $profile->shipping_company; ?>" />
      </div>

  </div>

  <p><input class="btn" type="submit" value="Update" /></p>

</form>

</div>

<?php get_footer();

Session::remove("error");
Session::remove("success"); ?>
