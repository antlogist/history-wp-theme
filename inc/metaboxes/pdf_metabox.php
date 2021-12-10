<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
    exit;
}

function add_pdf_meta_boxes() {
  $screens = [ 'newsletter', 'will', 'history-page' ];
  foreach ( $screens as $screen ) {
    add_meta_box(
        'pdf_box_id',
        'PDF',
        'render_pdf_custom_box',
        $screen
    );
  }
}

add_action( 'add_meta_boxes', 'add_pdf_meta_boxes' );


function render_pdf_custom_box( $post ) {
  wp_nonce_field(basename(__FILE__), 'custom_pdf_nonce' );
  $pdf = get_post_meta($post->ID, 'custom_pdf', true);
  $will_ref= get_post_meta($post->ID, 'will_ref', true);
  $will_year= get_post_meta($post->ID, 'will_year', true);
  $will_heldby= get_post_meta($post->ID, 'will_heldby', true);
  if ( 'will' == get_post_type() ) {
  ?>
    <div style="margin: 1rem 0 1rem 0;">
      <label for="will_year" style="display: block;">Will Year</label>
      <input type="text" name="will_year" id="will_year" value="<?php echo $will_year; ?>" style="width: 150px;" />
    </div>

    <div style="margin: 1rem 0 1rem 0;">
      <label for="will_ref" style="display: block;">Will Reference</label>
      <input type="text" name="will_ref" id="will_ref" value="<?php echo $will_ref; ?>" style="width: 150px;" />
    </div>

    <div style="margin: 1rem 0 2rem 0;">
      <label for="will_heldby" style="display: block;">Held By</label>
      <input type="text" name="will_heldby" id="will_heldby" value="<?php echo $will_heldby; ?>" style="width: 100%;" />
    </div>

  <?php } ?>
  <div style="margin: 1rem 0;">
    <a href="#" class="upload_pdf_button button button-primary"><?php echo 'Upload PDF'; ?></a>
    <input readonly type="text" name="custom_pdf" id="custom_pdf" value="<?php echo $pdf; ?>" style="width: 100%; margin-top: 1rem;" />
    <object id="pdfViewer" style="width: 100%; height: 512px; margin-top: 1rem;" data="<?php echo $pdf; ?>" type="application/pdf"></object>
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

  if (array_key_exists('will_ref', $_POST)) {
    update_post_meta(
        $post_id,
        'will_ref',
        sanitize_text_field($_POST['will_ref'])
    );
  }

  if (array_key_exists('will_year', $_POST)) {
    update_post_meta(
        $post_id,
        'will_year',
        sanitize_text_field($_POST['will_year'])
    );
  }

  if (array_key_exists('will_heldby', $_POST)) {
    update_post_meta(
        $post_id,
        'will_heldby',
        sanitize_text_field($_POST['will_heldby'])
    );
  }

}
add_action('save_post', 'save_pdf_postdata');
