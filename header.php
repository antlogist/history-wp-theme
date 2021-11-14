<?php

//Exit if accessed directly
if ( ! defined ("ABSPATH") ) {
  exit;
}

$token = CSRFToken::_token();

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<?php

wp_head();

?>

<script>
  const baseUrl = "<?php echo get_site_url(); ?>";
  const themeUrl = "<?php echo get_template_directory_uri(); ?>"

</script>

<body <?php echo body_id() . ' '; body_class(); ?> >
  <div class="top-bar py-1" id="topbarMain">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <ul class="login-ul-main">
            <?php if (isAuthenticated()) { ?>
              <li><a href="<?php echo get_home_url(); ?>/profile"><span class="dashicons dashicons-admin-users" style="padding-top: 2px;"></span><?php echo substr(Session::get("SESSION_USER_NAME"), 0, 20); ?></a> </li>
              <li>
                <form action="<?php echo get_template_directory_uri(); ?>/inc/app/Routes/Logout.php" method="post">
                  <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
                  <input type="hidden" name="home_url" value="<?php echo get_home_url(); ?>">
                  <button class="button-link" type="submit">
                    <svg style="width: 19px;padding-bottom: 1px; padding-right: 1px;"
                      aria-hidden="true"
                      focusable="false"
                      data-prefix="fas"
                      data-icon="sign-out-alt"
                      role="img" xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512">
                      <path fill="currentColor"
                        d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path>
                    </svg>
                  </button>
                </form>
              </li>
              <li><a href="<?php echo get_home_url(); ?>/cart"><span class="dashicons dashicons-cart" style="padding-top: 2px;"></span></a> </li>
            <?php } else { ?>
              <li><a href="<?php echo get_home_url(); ?>/login">
              <svg style="width: 19px;padding-bottom: 1px; padding-right: 1px;"
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="sign-in-alt"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <path fill="currentColor" d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"></path>
              </svg></a> </li>
              <li>
                <a href="<?php echo get_home_url(); ?>/cart"><span class="dashicons dashicons-cart" style="padding-top: 2px;"></span>
                <span class="cart-count-outer-wrapper">
                  <span class="cart-count">1</span>
                </span>

                </a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>

  </div>
  <!--Nav-->
  <nav id="navMain">
    <!--Nav toggle button-->
    <a href="#" id="navToggleButton">
      <span class="toggle-line toggle-line-1"></span>
      <span class="toggle-line toggle-line-2"></span>
      <span class="toggle-line toggle-line-3"></span>
    </a>
    <div id="navMainWrapper" class="nav-wrapper opacity-0 container"></div>
  </nav>

