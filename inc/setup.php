<?php

//Exit if accessed directly
if ( ! defined ("ABSPATH") ) {
  exit;
}

function register_my_session(){
  if( ! session_id() ) {
      session_start();
  }
}

function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
}

function menu_depth( $hook ) {
  if ( $hook != 'nav-menus.php' ) return;
  wp_add_inline_script( 'nav-menu', 'wpNavMenu.options.globalMaxDepth = 1;', 'after' );
}

function history_theme_support() {
  //Thumbnails support
  add_theme_support("post-thumbnails");

  //Image size
  add_image_size("pageBanner", 1500, 350, true);
  add_image_size("standardImage", 1024, 683, true);
  add_image_size("squareImage", 683, 683, true);

  //Document title tag support
  add_theme_support( "title-tag" );

  //Menus
  add_theme_support("menus");
}

// Dynamic body id
function body_id() {
  if (is_front_page()) {
    return ' id="frontPage"';
  } elseif (is_home()) {
    return ' id="homePage"';
  } elseif (is_single()) {
    switch(get_post_type()) {
      case 'newsletter':
        return ' id="newsletterPage"';
        break;
      case 'photo-archive':
        return ' id="photoarchivePage"';
        break;
      default:
      return ' id="singlePage"';
    }
  } elseif (is_search()) {
    return ' id="searchPage"';
  } elseif (is_archive()) {
    return ' id="archivePage"';
  } elseif (is_page('profile')) {
    return ' id="profilePage"';
  } elseif (is_page('shop')) {
    return ' id="shopPage"';
  }
}

function add_async_attribute($tag, $handle) {
  $handles = array(
    'masonry-js',
  );

  foreach( $handles as $defer_script) {
    if ( $defer_script === $handle ) {
       return str_replace( ' src', ' async src', $tag );
    }
  }

  return $tag;
}
