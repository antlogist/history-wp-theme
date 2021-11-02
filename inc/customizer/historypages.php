<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_historypages_customize_register( $wp_customize ) {
  //History pages section
  $wp_customize->add_section('historypages_section',array(
    'title'=>'History Pages',
    'priority'=>10,
    'panel'=>'history_customize_panel',
  ));

  //History pages title setting
  $wp_customize->add_setting('historypages_title',array(
    'default'=>'History Pages',
    'sanitize_callback' => 'wp_kses_post',
    'transport' => 'postMessage'
  ));

  //History pages title control
  $wp_customize->add_control('historypages_title_control',array(
    'label'=>'Title',
    'type'=>'text',
    'section'=>'historypages_section',
    'settings'=>'historypages_title',
  ));

  //History pages posts per page setting
  $wp_customize ->add_setting('historypages_posts_per_page', array(
    'default' => 4,
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  //History pages posts per page control
  $wp_customize ->add_control(new WP_Customize_Control($wp_customize,'historypages_posts_per_page_control', array(
      'label' => 'Posts per page',
      'section' => 'historypages_section',
      'settings' => 'historypages_posts_per_page',
      'description' => 'Numbers' ,
      'type' => 'select',
      'choices' => array(
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
      )
  ) ));
}
