<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
    exit;
}

function add_pdf_meta_boxes() {
  $screens = [ 'newsletter' ];
  foreach ( $screens as $screen ) {
    add_meta_box(
        'pdf_box_id',
        'PDF Newsletter',
        'render_pdf_custom_box',
        $screen
    );
  }
}

add_action( 'add_meta_boxes', 'add_pdf_meta_boxes' );


function render_pdf_custom_box( $post ) {
  wp_nonce_field(basename(__FILE__), 'custom_pdf_nonce' );
  $pdf = get_post_meta($post->ID, 'custom_pdf', true);
  ?>
  <div style="margin: 1rem 0;">
    <a href="#" class="upload_pdf_button button button-primary"><?php echo 'Upload PDF Newsletter'; ?></a>
    <input readonly type="text" name="custom_pdf" id="custom_pdf" value="<?php echo $pdf; ?>" style="width: 100%; margin-top: 1rem;" />
  </div>

  <?php
}

function save_pdf_postdata($post_id) {

  $is_autosave = wp_is_post_autosave($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $is_valid_nonce = (isset($_POST['custom_pdf_nonce']) && wp_verify_nonce($_POST['custom_pdf_nonce'], basename(__FILE__))) ? true : false;

  if($is_autosave || $is_revision || !$is_valid_nonce) {
    return;
  }

  if (array_key_exists('custom_pdf', $_POST)) {
    update_post_meta(
        $post_id,
        'custom_pdf',
        esc_url_raw($_POST['custom_pdf'])
    );
  }
}
add_action('save_post', 'save_pdf_postdata');
