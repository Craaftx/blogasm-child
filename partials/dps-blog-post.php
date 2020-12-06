<?php

/**
 * Template part for displaying posts for Display Posts Shortcode
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogasm-child
 */

global $post;
$url_link                       = blogasm_get_permalink();
$featured_img_meta_value        = get_post_meta($post->ID, 'blogasm_featured_img_type', true);
$featured_img_type              = !empty($featured_img_meta_value) ? $featured_img_meta_value : 'portrait-img';

$excerpt_length                 = 45;

$post_class = array('post-col');
$post_class[] = 'text-left';
$post_class[] = $featured_img_type;


if ($featured_img_type == 'landscape-img') {
  $thumbnail_size = 'blogasm-960-landscape';
  $excerpt_length = 45;
} elseif ($featured_img_type == 'full-width-img') {
  $thumbnail_size = 'blogasm-1800-540';
  $excerpt_length = 45;
} else {
  $thumbnail_size = 'blogasm-576-portrait';
}

$figure_class    = array('post-thumbnail d-block position-absolute tp-0 lp-0 w-100 h-100');
$figure_class[]  = 'zoom-in';

if (!has_post_thumbnail()) {
  $figure_class[]  = 'no-featured-img';
}



?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
  <div class="post-content-wrap">
    <div class="post-thumbnail-wrap d-flex flex-wrap justify-content-between align-items-center position-relative">
      <figure class="<?php echo esc_attr(implode(' ', $figure_class)); ?>">
        <a class="post-thumbnail-link d-block h-100" href="<?php echo esc_url($url_link); ?>">

          <?php if (has_post_thumbnail()) { // Featured Image

            the_post_thumbnail($thumbnail_size, array(
              'class' => 'primary-thumbnail object-fit-cover',
              'alt' => the_title_attribute(array(
                'echo' => false,
              )),
            ));
          } ?>

        </a><!-- .post-thumbnail-link -->

      </figure><!-- .post-thumbnail -->

      <?php if (is_sticky()) {
        echo '<span class="sticky-icon position-absolute d-flex justify-content-center align-items-center"><i class="fas fa-thumbtack"></i></span>';
      } ?>

    </div><!-- .post-thumbnail-wrap -->

    <div class="post-content d-flex flex-wrap justify-content-start align-items-center">

      <?php blogasm_cat_links();

      the_title('<h2 class="entry-title w-100 td-none"><a class="d-block transition-35s" href="' . esc_url($url_link) . '" rel="bookmark">', '</a></h2>'); ?>

      <div class="entry-content">
        <p class="mb-0"><?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), $excerpt_length, '')); ?></p>
      </div><!-- .entry-content -->
    </div><!-- .post-content -->
  </div><!-- .post-content-wrap -->
</article><!-- #post-<?php the_ID(); ?> -->