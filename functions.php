<?php

if (!function_exists('child_theme_enqueue_scripts')) {
	function child_theme_enqueue_scripts()
	{
		wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

		wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css');

		wp_enqueue_script('child-js', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '1.0', true);
	}
	add_action('wp_enqueue_scripts', 'child_theme_enqueue_scripts');
}

/**
 * Template Parts with Display Posts Shortcode
 * @author Bill Erickson
 * @see https://www.billerickson.net/template-parts-with-display-posts-shortcode
 *
 * @param string $output, current output of post
 * @param array $original_atts, original attributes passed to shortcode
 * @return string $output
 */
function be_dps_template_part($output, $original_atts)
{
	// Return early if our "layout" attribute is not specified
	if (empty($original_atts['layout']))
		return $output;
	ob_start();
	get_template_part('partials/dps', $original_atts['layout']);
	$new_output = ob_get_clean();
	if (!empty($new_output))
		$output = $new_output;
	return $output;
}
add_action('display_posts_shortcode_output', 'be_dps_template_part', 10, 2);


function wpa_44672($wp_query)
{
	if (true) {
		set_query_var('category__not_in', ["tutoriels"]);
	}
}
add_action('pre_get_posts', 'wpa_44672');
