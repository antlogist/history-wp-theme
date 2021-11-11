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
<form action="">

  <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
  <input type="hidden" name="homeUrl" value="<?php echo get_home_url(); ?>">

  <div class="row mb-5">
    <div class="col-md-6">

      <div class="mb-2">
        <div>
          <label for='email' >User Email*:</label>
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
        <div class="mb-2 col-md-6">
            <div>
              <label for="billingFirstName">First Name</label>
            </div>
            <input class="w-100 form-control" type='text' name='billingFirstname' id='billingFirstname' maxlength="50" value="<?php echo $profile->billing_firstname; ?>" />
          </div>

          <div class="mb-2 col-md-6">
            <div>
              <label for="billingLastname">Last Name</label>
            </div>
            <input class="w-100 form-control" type='text' name='billingLastname' id='billinLastname' maxlength="50" value="<?php echo $profile->billing_lastname; ?>" />
          </div>
      </div>

      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingAddress">Address</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingAddress' id='billinLAddress' maxlength="50" value="<?php echo $profile->billing_address; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingCity">City</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingCity' id='billinLCity' maxlength="50" value="<?php echo $profile->billing_city; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingCounty">County</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingCounty' id='billinLCounty' maxlength="50" value="<?php echo $profile->billing_county; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingCountry">Country</label>
        </div>
        <select class="w-100 form-select" name="billingCountry" id="billingCountry">
          <option value="">Select a country...</option>
          <?php echo countriesOption($profile->billing_country); ?>
        </select>
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingZipcode">Zip Code</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingZipcode' id='billinLZipcode' maxlength="50" value="<?php echo $profile->billing_zipcode; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingPhone">Phone Number</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingPhone' id='billinLPhone' maxlength="50" value="<?php echo $profile->billing_phone; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingCompany">Company</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingCompany' id='billingCompany' maxlength="50" value="<?php echo $profile->billing_company; ?>" />
      </div>

  </div>



  <div class="row">
    <div class="col-md-12 mb-2">
      <h2>Shipping Details</h2>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="mb-2 col-md-6">
            <div>
              <label for="billingFirstName">First Name</label>
            </div>
            <input class="w-100 form-control" type='text' name='billingFirstname' id='billingFirstname' maxlength="50" value="<?php echo $profile->shipping_firstname; ?>" />
          </div>

          <div class="mb-2 col-md-6">
            <div>
              <label for="billingLastname">Last Name</label>
            </div>
            <input class="w-100 form-control" type='text' name='billingLastname' id='billinLastname' maxlength="50" value="<?php echo $profile->shipping_lastname; ?>" />
          </div>
      </div>

      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingAddress">Address</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingAddress' id='billinLAddress' maxlength="50" value="<?php echo $profile->shipping_address; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingCity">City</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingCity' id='billinLCity' maxlength="50" value="<?php echo $profile->shipping_city; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingCounty">County</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingCounty' id='billinLCounty' maxlength="50" value="<?php echo $profile->shipping_county; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingCountry">Country</label>
        </div>
        <select class="w-100 form-select" name="billingCountry" id="billingCountry">
          <option value="">Select a country...</option>
          <?php echo countriesOption($profile->shipping_country); ?>
        </select>
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingZipcode">Zip Code</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingZipcode' id='billinLZipcode' maxlength="50" value="<?php echo $profile->shipping_zipcode; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingPhone">Phone Number</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingPhone' id='billinLPhone' maxlength="50" value="<?php echo $profile->shipping_phone; ?>" />
      </div>

      <div class="mb-2 col-md-6">
        <div>
          <label for="billingCompany">Company</label>
        </div>
        <input class="w-100 form-control" type='text' name='billingCompany' id='billingCompany' maxlength="50" value="<?php echo $profile->shipping_company; ?>" />
      </div>

  </div>


</form>

</div>

<?php get_footer(); ?>

