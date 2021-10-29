<?php

// Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
    exit;
}

function history_menu() {
  register_rest_route( 'menus/v1', 'menu', array(
    'methods' => WP_REST_SERVER:: READABLE,
    'callback' => 'get_menu',
  ) );

  register_rest_route( 'menus/v1', 'footer-menu', array(
    'methods' => WP_REST_SERVER:: READABLE,
    'callback' => 'get_footer_menu',
  ) );
}

function get_menu() {
  if (!wp_get_nav_menu_items('main')) {
    $answer = [];
    return $answer;
  }
  return wp_get_nav_menu_items('main');
}

function get_footer_menu() {
  if (!wp_get_nav_menu_items('footer')) {
    $answer = [];
    return $answer;
  }
  return wp_get_nav_menu_items('footer');
}