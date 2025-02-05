<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogasm
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if (post_password_required()) {
    return;
} ?>

<div id="comments" class="comments-area w-100">

    <h2 class="comments-title section-title custom-title">
        <?php
        printf(
            esc_html__('Commentaires ', 'blogasm')
        );
        ?>
    </h2><!-- .comments-title -->
    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) : ?>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list p-0">
            <?php
            wp_list_comments(array(
                'avatar_size'   => 100,
                'style'         => 'ol',
                'short_ping'    => true,
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'blogasm'); ?></p>
    <?php
        endif;

    endif; // Check for have_comments().

    comment_form();
    ?>

</div><!-- #comments -->