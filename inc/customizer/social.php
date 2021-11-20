<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_social_customize_register( $wp_customize ) {
  //History pages section
  $wp_customize->add_section('social_section',array(
    'title'=>'Social Links',
    'priority'=>10,
    'panel'=>'history_customize_panel',
  ));

  //Facebook setting
  $wp_customize->add_setting('facebook_link',array(
    'default'=>'https://www.facebook.com/',
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
  ));

  //Facebook control
  $wp_customize->add_control('facebook_link_control',array(
    'label'=>'Facebook',
    'type'=>'text',
    'section'=>'social_section',
    'settings'=>'facebook_link',
  ));

  //Instagram setting
  $wp_customize->add_setting('instagram_link',array(
    'default'=>'https://www.instagram.com/',
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
  ));

  //Instagram control
  $wp_customize->add_control('instagram_link_control',array(
    'label'=>'Instagram',
    'type'=>'text',
    'section'=>'social_section',
    'settings'=>'instagram_link',
  ));

  //Youtube setting
  $wp_customize->add_setting('youtube_link',array(
    'default'=>'https://www.youtube.com/',
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
  ));

  //Youtube control
  $wp_customize->add_control('youtube_link_control',array(
    'label'=>'Youtube',
    'type'=>'text',
    'section'=>'social_section',
    'settings'=>'youtube_link',
  ));

}