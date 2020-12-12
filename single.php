<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blogasm
 */

get_header();

$row_class          = array('row');
$primary_class      = array('content-area');

if (blogasm_has_secondary_content_class() != 'full-width') {
  $row_class[]    = 'have-sidebar';
}

if (blogasm_has_primary_content_class()) {
  $primary_class[] = blogasm_has_primary_content_class();
}

while (have_posts()) : the_post(); ?>
  <?php
  $banner_text_mode = "banner-is-light";
  $banner_text_mode_color_mode = get_post_meta(get_the_ID(), 'banner_text_mode_color_mode', true);
  if ($banner_text_mode_color_mode === "dark") {
    $banner_text_mode = "banner-is-dark";
  }
  ?>
  <div class="outer-container have-mt <?php echo esc_attr($banner_text_mode) ?>">
    <div class="container-fluid">
      <div class="<?php echo esc_attr(implode(' ', $row_class)); ?>">

        <?php
        $featured_img_meta_value    = get_post_meta(get_the_ID(), 'blogasm_featured_img_type', true);
        $featured_img_type          = !empty($featured_img_meta_value) ? $featured_img_meta_value : 'portrait-img';
        if ($featured_img_type == 'full-width-img') : ?>

          <figure class="post-featured-image full-width w-100">

            <?php the_post_thumbnail('blogasm-1800-540', array(
              'alt' => the_title_attribute(array(
                'echo' => false,
              )),
            )); ?>

          </figure><!-- .post-featured-image -->

        <?php endif; ?>

        <div class="col-12 d-flex flex-wrap">
          <div id="primary" class="<?php echo esc_attr(implode(' ', $primary_class)); ?>">
            <main id="main" class="site-main">

              <?php

              /*
                             * Include the Post-Type-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                             */
              get_template_part('template-parts/post/content', get_post_format()); ?>

            </main><!-- #main -->
          </div><!-- #primary -->

          <?php
          /**
           * Hook - blogasm_action_sidebar.
           *
           * @hooked: blogasm_add_sidebar - 10
           */
          do_action('blogasm_action_sidebar'); ?>

        </div><!-- .col -->
      </div><!-- .row -->
    </div><!-- .container-fluid -->
  </div><!-- .outer-container -->

<?php

endwhile; // End of the loop.

get_footer();
