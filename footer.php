<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogasm
 */

?>

</div><!-- #content -->

<div class="footer-separator"></div>

<footer class="site-footer">

  <footer class="site-footer">

    <?php
    /**
     * Hook - blogasm_action_footer.
     *
     * @hooked blogasm_add_footer_widgets - 10
     * @hooked blogasm_add_footer_bar - 20
     */
    do_action('blogasm_action_footer');
    ?>

  </footer><!-- .site-footer -->

</footer><!-- .site-footer -->
</div><!-- #page -->


<div class="back-to-top d-none d-lg-flex align-items-center">
  <div class="bt-text">
    <?php esc_html_e('Haut de page', 'blogasm'); ?>
  </div><!-- .bt-text -->

  <span class="d-block pt-icon icon-arrow-right"></span>
</div><!-- .back-to-top -->

<?php wp_footer(); ?>

</body>

</html>