<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

// unset($_SESSION['SESSION_USER_UUID']);
// unset($_SESSION['SESSION_USER_NAME']);

if(isAuthenticated()) {
  Redirect::to(get_home_url());
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

<?php
  if(Session::get("error")) {
    echo '<div class="message error-message">' . Session::get("error") . '</div>';
  }

  if(Session::get("success")) {
    echo '<div class="message error-message">' . Session::get("success") . '</div>';
  }
?>

  <div class="row">

    <div class="col-md-6 offset-md-3">
      <form action="<?php echo get_template_directory_uri(); ?>/inc/app/Routes/Register.php" method="post" class="w-100">
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
        <input type="hidden" name="homeUrl" value="<?php echo get_home_url(); ?>">

        <div class="mb-3">
          <div>
            <label for='firstName' class="form-label">First Name*:</label>
          </div>
          <input class="w-100 form-control" type='text' name='firstName' id='firstName'  maxlength="50" required />
        </div>

        <div class="mb-3">
          <div>
            <label for='lastName' class="form-label">Last Name*:</label>
          </div>
          <input class="w-100 form-control" type='text' name='lastName' id='lastName'  maxlength="50" required />
        </div>

        <div class="mb-3">
          <div>
            <label for='email' class="form-label">User Email*:</label>
          </div>
          <input class="w-100 form-control" type='email' name='email' id='email'  maxlength="50" required />
        </div>

        <div class="mb-3">
          <div>
            <label for='password' class="form-label">Password*:</label>
          </div>
          <input class="w-100 form-control" type='password' name='password' id='password' maxlength="50" required />
        </div>

        <div class="mb-4">
          <div>
            <label for='confirmPassword' class="form-label">Confirm Password*:</label>
          </div>
          <input class="w-100 form-control" type='password' name='confirmPassword' id='confirmPassword' maxlength="50" required />
        </div>

        <p><input class="btn" type="submit" /></p>
      </form>

    </div>

  </div>

</div>

<?php get_footer();

Session::remove("error");
Session::remove("success"); ?>

