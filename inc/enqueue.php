<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_styles_and_scripts() {
  //libs CSS
  wp_enqueue_style('overlap-lib-css', get_theme_file_uri('dist/css/libs.min.css'));

  //custom CSS
  wp_enqueue_style('overlap-app-css', get_theme_file_uri('dist/css/all.min.css'), NULL, microtime());

  //custom js
  wp_enqueue_script('overlap-app-js', get_theme_file_uri('dist/js/all.min.js'), null, microtime(), true);
}

function history_customizer_script() {
  //custom js
  wp_enqueue_script('history-customizer-js', get_theme_file_uri('dist/js/theme-customize.min.js'), array( 'jquery','customize-preview' ), microtime(), true);
}
