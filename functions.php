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

if (!function_exists("be_dps_template_part")) {
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
}

if (!function_exists('banner_text_mode_color_add_custom_box')) {

	if (!function_exists('banner_text_mode_color_inner_custom_box')) {
		function banner_text_mode_color_inner_custom_box($post)
		{
			wp_nonce_field(plugin_basename(__FILE__), 'banner_text_mode_color_noncename');

			$value = get_post_meta($post->ID, 'banner_text_mode_color_mode_field') ? get_post_meta($post->ID, 'banner_text_mode_color_mode_field') : 'New Field';

			echo '<label for="banner_text_mode_color_mode_field">';
			_e("Couleur du texte ", 'banner_text_mode_color_textdomain');
			echo '</label> ';
			echo '<select type="text" id="banner_text_mode_color_mode_field" name="banner_text_mode_color_mode_field"><option selected="' . ($value === "light" ? "selected" : null) . '" value="light">Clair</option><option selected="' . ($value === "dark" ? "selected" : null) . '" value="dark">Sombre</option></select>';
		}
	}

	function banner_text_mode_color_add_custom_box()
	{
		add_meta_box(
			'banner_text_mode_color_sectionid',
			__('', 'banner_text_mode_color_textdomain'),
			'banner_text_mode_color_inner_custom_box',
			'post'
		);
		add_meta_box(
			'banner_text_mode_color_sectionid',
			__('Mode de bannière', 'banner_text_mode_color_textdomain'),
			'banner_text_mode_color_inner_custom_box',
			'page'
		);
	}
	add_action('add_meta_boxes', 'banner_text_mode_color_add_custom_box');
}

if (!function_exists('banner_text_mode_color_save_postdata')) {
	function banner_text_mode_color_save_postdata($post_id)
	{
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return;
		if (!wp_verify_nonce($_POST['banner_text_mode_color_noncename'], plugin_basename(__FILE__)))
			return;
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return;
		} else {
			if (!current_user_can('edit_post', $post_id))
				return;
		}

		$mydata = $_POST['banner_text_mode_color_mode_field'];
		update_post_meta($post_id, 'banner_text_mode_color_mode_field', $mydata);
	}
	add_action('save_post', 'banner_text_mode_color_save_postdata');
}
