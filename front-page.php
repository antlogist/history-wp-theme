
<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}
get_header();

?>

<script>
  const currentPdf = "<?php if(!get_theme_mod("newsletter_pdf")) { echo "https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf"; } else { echo get_theme_mod("newsletter_pdf"); } ?>";
</script>

<header id="header" style="background-image: url(<?php if (!get_theme_mod('header_img')) {echo get_template_directory_uri() . "/images/header.jpg";} else { echo esc_url(get_theme_mod('header_img'));} ?>)">
  <div class="container header-container">
    <div class="row">
      <div class="col-12">
        <div class="header-title-outer-wrapper">
          <img class="header-logo" id="headerLogo" src="<?php if (!get_theme_mod('header_logo')) { echo get_template_directory_uri() . "/images/logo.png"; } else { echo esc_url(get_theme_mod('header_logo')); }; ?>" alt="">
          <div>
            <h1 class="header-title" id="headerTitle"><?php if (!get_theme_mod("header_title")) {echo "Website title";} else {echo get_theme_mod("header_title");} ?></h1>
            <div class="header-buttons-wrapper">
              <a href="<?php if (!get_theme_mod('shop_id')) { echo "./"; } else { echo esc_url( get_permalink(get_theme_mod('shop_id')) ); } ?>" class="btn">Shop</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</header>

<section id="frontAbout" class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6 order-md-2">
        <div class="mt-4 mb-2">
          <img id="aboutImg" class="w-100" src="<?php if (!get_theme_mod('about_img')) { echo get_template_directory_uri() . "/images/logo.png"; } else { echo esc_url(get_theme_mod('about_img')); }; ?>" alt="">
        </div>
      </div>
      <div class="col-md-6 order-md-1 d-flex align-items-center">
        <div class="mt-2 mb-4">
          <h1 id="aboutTitle">
            <?php if (!get_theme_mod('about_title')) {
              echo "About Us";
            } else { echo get_theme_mod('about_title'); }; ?>
          </h1>
          <div id="aboutText" class="text-wrapper">
            <?php if (!get_theme_mod('about_text')) {
              echo "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et sapiente praesentium in molestias laborum tempore eius eos reprehenderit tempora quis corporis, est repellat, saepe numquam nulla sequi amet repellendus voluptatem?";
            } else { echo get_theme_mod('about_text'); }; ?>
          </div>
          <div class="buttons-wrapper mt-4">
            <a href="<?php if (!get_theme_mod('about_id')) { echo "./"; } else { echo esc_url( get_permalink(get_theme_mod('about_id')) ); } ?>" class="btn">Learn more</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="pdfSection" class="pdf-section py-5" style="background-image: url(<?php echo get_template_directory_uri() . '/images/fabric-plaid-b.png'?>); ">
  <div class="container mb-2 text-center">
    <h1 id="historyPagesTitle">
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

<section id="historyPages" class="py-5">

  <div class="container mb-2 text-center">

    <h1 id="historypagesTitle">
        <?php if (!get_theme_mod('historypages_title')) {
          echo "History Pages";
        } else { echo get_theme_mod('historypages_title'); }; ?>
    </h1>

    <div class="row" data-masonry='{"percentPosition": true }'>

      <?php
        $historyPages = new WP_Query(array(
          'posts_per_page' => get_theme_mod('historypages_posts_per_page'),
          'post_type' => 'history-page'
        ));

        while($historyPages->have_posts()) {
          $historyPages->the_post(); ?>

          <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card p-3">
              <a href="<?php the_permalink(); ?>">
                <img class="card-img-top w-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
              </a>
              <div class="card-body">
                <h5 class="mt-2"><?php the_title(); ?></h5>
                <p><?php echo wp_trim_words(get_the_content(), 18); ?></p>
                <div class="buttons-wrapper">
                  <a href="<?php the_permalink(); ?>" class="btn">Learn more</a>
                </div>
              </div>
            </div>
          </div>

        <?php }

      ?>

    </div>
  </div>
</section>

<?php

get_footer();

?>
