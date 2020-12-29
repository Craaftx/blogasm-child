<?php

/**
 * Template part for displaying post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogasm
 */
global $post;
$header_elements            = get_theme_mod('blogasm_post_content_header_elements_order', array('posted-date', 'post-author', 'post-cats', 'post-title', 'post-subtitle'));
$header_class               = array('entry-header d-flex flex-wrap');
$header_element_class       = array('header-elements entry-header d-flex flex-wrap align-items-center');
$header_element_class[]     = 'text-left';

$header_element_class[] = 'w-100';

$content_class          = array('entry-content');
$content_class[]        = 'text-left';
$footer_class           = array('entry-footer d-flex flex-wrap align-items-center');
$footer_class[]         = 'text-left'; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('have-' . "landscape-img"); ?>>
  <header class="<?php echo esc_attr(implode(' ', $header_class)); ?>">

    <?php if (has_post_thumbnail()) : ?>

      <figure class="post-featured-image">

        <?php the_post_thumbnail('blogasm-1370-850', array(
          'alt' => the_title_attribute(array(
            'echo' => false,
          )),
        )); ?>

      </figure><!-- .post-featured-image -->

    <?php endif; ?>

    <div class="<?php echo esc_attr(implode(' ', $header_element_class)); ?>">

      <?php

      the_title('<h1 class="entry-title w-100">', '</h1>'); ?>

    </div><!-- .header-elements -->
  </header><!-- .entry-header -->

  <div class="<?php echo esc_attr(implode(' ', $content_class)); ?>">

    <?php the_content();

    wp_link_pages(array(
      'before'      => '<div class="page-links d-flex flex-wrap align-items-center">' . esc_html__('Pages:', 'blogasm'),
      'after'       => '</div>',
      'link_before' => '<span class="page-number">',
      'link_after'  => '</span>',
    ));

    if (get_edit_post_link()) :

      edit_post_link(
        sprintf(
          wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
            __('Edit <span class="screen-reader-text">%s</span>', 'blogasm'),
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          get_the_title()
        ),
        '<span class="edit-link">',
        '</span>'
      );

    endif; ?>

  </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->

<div class="after-footer-content">
  <?php
  // If comments are open or we have at least one comment, load up the comment template.
  if (comments_open() || get_comments_number()) :
    comments_template();
  endif;
  ?>

</div><!-- .after-footer-content -->