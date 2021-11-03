<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

/*===INCLUDES===*/
//Theme features
include( get_template_directory() . '/inc/setup.php' );

//Styles and scrpts
include( get_template_directory() . '/inc/enqueue.php' );

//Theme customizer
include( get_template_directory() . '/inc/customizer.php');
include( get_template_directory() . '/inc/customizer/header.php');
include( get_template_directory() . '/inc/customizer/about.php');
include( get_template_directory() . '/inc/customizer/newsletter.php');
include( get_template_directory() . '/inc/customizer/historypages.php');

//REST menu
include( get_template_directory() . '/inc/REST/rest_menu.php');

//History pages CPT
include( get_template_directory() . '/inc/CPT/history_pages.php');

/*===HOOKS===*/
//Theme features
add_action('after_setup_theme', 'history_theme_support');

//Menu depth
add_action( 'admin_enqueue_scripts', 'menu_depth' );

//Add viewport
add_action( 'wp_head', 'add_viewport_meta_tag' , '1' );

//Styles and scrpts
add_action( 'wp_enqueue_scripts', 'history_styles_and_scripts' );

//Theme customizer
add_action( 'customize_register', 'history_customize_register' );

//Theme customizer script
add_action( 'customize_preview_init', 'history_customizer_script' );

//REST menu
add_action( 'rest_api_init', 'history_menu' );

//History Pages post type
add_action('init', 'historypages_cpt');

/*===FILTERS===*/
add_filter( 'script_loader_tag', 'add_async_attribute', 10, 2 );
