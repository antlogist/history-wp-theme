<section id="pdfSection" class="pdf-section py-5" style="background-image: url(<?php echo get_template_directory_uri() . '/images/fabric-plaid-b.png'?>); ">
  <div class="container mb-2 text-center">
    <h1 id="newsletterTitle">
      <?php if (!get_theme_mod('newsletter_title')) {
        echo "Newsletters";
      } else { echo get_theme_mod('newsletter_title'); }; ?>
    </h1>
    <div class="pdf-pagination mb-2">
      <button class="prev-pdf"><<</button>
      <button class="next-pdf">>></button>
    </div>
    <div>
      <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
    </div>

    <canvas id="pdf-canvas"></canvas>

    <div class="pdf-pagination mt-4">
      <button class="prev-pdf"><<</button>
      <button class="next-pdf">>></button>
    </div>

    <div class="buttons-wrapper mt-4">
      <a href="<?php if (!get_theme_mod('newsletter_id')) { echo "./"; } else { echo esc_url( get_permalink(get_theme_mod('newsletter_id')) ); } ?>" class="btn">More letters</a>
    </div>

  </div>
</section>
