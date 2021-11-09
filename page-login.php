<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

// unset($_SESSION['SESSION_USER_UUID']);
// unset($_SESSION['SESSION_USER_NAME']);

if(isAuthenticated()) {
  Redirect::to(get_home_url());
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
  <div class="row">

    <div class="col-md-6 offset-md-3">
      <div class="message error-message"><?php echo Session::get("error"); ?></div>
      <form action="<?php echo get_template_directory_uri(); ?>/inc/app/Routes/Auth.php" method="post" class="w-100">
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
        <input type="hidden" name="home_url" value="<?php echo get_home_url(); ?>">
        <div class="mb-2">
          <div>
            <label for='email' >User Email*:</label>
          </div>
          <input class="w-100" type='email' name='email' id='email'  maxlength="50" required />
        </div>

        <div class="mb-3">
          <div>
            <label for='password' >Password*:</label>
          </div>
          <input class="w-100" type='password' name='password' id='password' maxlength="50" required />
        </div>
        <p><input class="btn" type="submit" /></p>
        <p><small><a href="<?php echo get_home_url(); ?>/register">New User Registration</a></small></p>
      </form>

    </div>

  </div>

</div>

<?php get_footer();

Session::remove("error"); ?>

