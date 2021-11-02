<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_newsletter_customize_register( $wp_customize ) {
  //Newsletter section
  $wp_customize->add_section('newsletter_section',array(
    'title'=>'Newsletter',
    'priority'=>10,
    'panel'=>'history_customize_panel',
  ));

  //Newsletter pdf setting
  $wp_customize ->add_setting('newsletter_pdf', array(
    'default' => '',
    'transport' => 'refresh'
  ));

  //Newsletter pdf control
  $wp_customize ->add_control(new WP_Customize_Upload_Control($wp_customize,'newsletter_pdf_control', array(
    'label'=>'Newsletter',
    'section'=>'newsletter_section',
    'settings' => 'newsletter_pdf',
  ) ));

  //Newsletter title setting
  $wp_customize->add_setting('newsletter_title',array(
    'default'=>'Newsletter',
    'sanitize_callback' => 'wp_kses_post',
    'transport' => 'postMessage'
  ));

  //Newsletter title control
  $wp_customize->add_control('newsletter_title_control',array(
    'label'=>'Title',
    'type'=>'text',
    'section'=>'newsletter_section',
    'settings'=>'newsletter_title',
  ));

  //Newsletter link setting
  $wp_customize->add_setting('newsletter_id',array(
    'default'=>'',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh'
  ));

  //Newsletter link control
  $wp_customize->add_control('newsletter_id_control',array(
    'label'=>'Newsletters Page',
    'type'=>'dropdown-pages',
    'section'=>'newsletter_section',
    'settings'=>'newsletter_id',
  ));

}
