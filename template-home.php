<?php

/**
 * Template Name: Full Width No Title
 * Template Post Type: post, page, product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogasm-child
 */

get_header();

$row_class          = array('row');
$primary_class      = array('content-area');

if (blogasm_has_secondary_content_class() != 'full-width') {
  $row_class[]    = 'have-sidebar';
}

if (blogasm_has_primary_content_class()) {
  $primary_class[] = blogasm_has_primary_content_class();
} ?>

<div class="outer-container have-mt">
  <div class="container-fluid">
    <div class="<?php echo esc_attr(implode(' ', $row_class)); ?>">
      <div class="col-12 d-flex flex-wrap">
        <div id="primary" class="<?php echo esc_attr(implode(' ', $primary_class)); ?>">
          <main id="main" class="site-main">
            <div class="blog-posts archived-posts">
              <?php the_content() ?>
            </div><!-- .blog-posts -->
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

get_footer();
