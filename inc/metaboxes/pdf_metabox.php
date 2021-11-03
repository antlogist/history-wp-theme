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
  $pdf = get_post_meta($post->ID, 'custom_pdf', true);
  ?>
<div style="margin: 1rem 0;">
  <a href="#" class="upload_pdf_button button button-primary"><?php echo 'Upload PDF Newsletter'; ?></a>
  <input disabled type="text" name="custom_pdf" id="custom_pdf" value="<?php echo $pdf; ?>" style="width: 100%; margin-top: 1rem;" />
</div>

  <?php
}

function save_pdf_postdata($post_id) {
    if (array_key_exists('custom_pdf', $_POST)) {
        update_post_meta(
            $post_id,
            'custom_pdf',
            esc_url_raw($_POST['custom_pdf'])
        );
    }
}
add_action('save_post', 'save_pdf_postdata');
