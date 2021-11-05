<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
    exit;
}

function add_gallery_meta_boxes() {
  $screens = [ 'photo-archive' ];
  foreach ( $screens as $screen ) {
    add_meta_box(
        'gallery_box_id',
        'Photo Archive',
        'render_gallery_custom_box',
        $screen
    );
  }
}

add_action( 'add_meta_boxes', 'add_gallery_meta_boxes' );

function render_gallery_custom_box( $post ) {
  wp_nonce_field(basename(__FILE__), 'custom_gallery_nonce' );
  $gallery = json_decode(json_encode(get_post_meta($post->ID, 'custom_gallery', true)));
  ?>
  <div style="margin: 1rem 0;">
    <a href="#" class="upload_gallery_button button button-primary"><?php echo 'Upload Photos'; ?></a>
    <input readonly type="hidden" name="custom_gallery" id="custom_gallery" value='<?php echo $gallery; ?>' style="width: 100%; margin-top: 1rem;" />
  </div>


  <div class="wrap">
    <div class="media-frame wp-core-ui mode-grid">
      <div class="media-frame-tab-panel">
        <div class="media-frame-content" data-columns="6">
          <div class="attachments-browser">
            <div class="attachments-wrapper">
              <ul tabindex="-1" class="attachments ui-sortable ui-sortable-disabled" id="photoArchiveUl">
                <?php
                $images = json_decode($gallery);
                foreach(array_reverse($images) as $key => $image) { ?>

                  <li id="photoArchiveLi<?php echo (count($images) - $key - 1); ?>" aria-label="post-item" class="attachment">
                    <div class="buttons-wrapper" style="margin: 0.25rem;">
                      <button data-index="<?php echo (count($images) - $key - 1); ?>" onclick="deletePhotoArchive(event)" class="button button-small button-delete">x</button>
                    </div>
                    <div class="attachment-preview type-image portrait">
                      <div class="thumbnail">
                        <div class="centered">
                          <img src="<?php echo $image->mediumUrl; ?>" alt="" draggable="false">
                        </div>
                      </div>
                    </div>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
}

function save_gallery_postdata($post_id) {

  $is_autosave = wp_is_post_autosave($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $is_valid_nonce = (isset($_POST['custom_gallery_nonce']) && wp_verify_nonce($_POST['custom_gallery_nonce'], basename(__FILE__))) ? true : false;

  if($is_autosave || $is_revision || !$is_valid_nonce) {
    return;
  }

  if (array_key_exists('custom_gallery', $_POST)) {
    update_post_meta(
        $post_id,
        'custom_gallery',
        sanitize_text_field($_POST['custom_gallery'])
    );
  }
}
add_action('save_post', 'save_gallery_postdata');
