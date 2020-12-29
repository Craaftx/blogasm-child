<?php

if (!function_exists('child_theme_enqueue_scripts')) {
	function child_theme_enqueue_scripts()
	{
		/**
		 * Remove custom Bootstrap and non minified CSS code to use last version of Bootstrap instead
		 */
		wp_dequeue_style('lib-style');
		wp_enqueue_style('bootstrap-cdn', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');

		wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

		wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css');

		wp_enqueue_script('child-js', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '1.0', true);
	}
	add_action('wp_enqueue_scripts', 'child_theme_enqueue_scripts', 11);
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

/**
 * Function to show the copyright information
 */
function blogasm_footer_copyright_information()
{
	printf(
		'<div class="site-info">%1$s <a href="%2$s">%3$s</a> | %4$s <!-- .site-info -->',
		sprintf(
			'%1$s %2$s',
			esc_html__('Copyright &copy;', 'blogasm'),
			esc_html(date('Y'))
		),
		esc_url(home_url('/')),
		esc_html(get_bloginfo('name', 'display')),
		esc_html__('All rights reserved', 'blogasm')
	);
}

/** Add new default gravatar */
if (!function_exists('default_new_gravatar')) {
	function default_new_gravatar($avatar_defaults)
	{
		$myavatar = 'https://blog.guilmaindorian.com/wp-content/uploads/2020/12/default_gravatar.jpg';
		$avatar_defaults[$myavatar] = "Default Gravatar";
		return $avatar_defaults;
	}
	add_filter('avatar_defaults', 'default_new_gravatar');
}

/**
 * Remove kirki font enqueue
 */
add_filter('kirki/enqueue_google_fonts', '__return_empty_array');

/**
 * Override blogasm load of google fonts
 */
function blogasm_google_fonts_url()
{

	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	$fonts = ['Inter:wght@500;700;800', 'Arimo:wght@400;700'];

	if ($fonts) {
		$fonts_url = add_query_arg(array(
			'family' => implode('&family=', $fonts),
			'subset' => rawurlencode($subsets),
			'display' => rawurlencode("swap"),
		), 'https://fonts.googleapis.com/css2');
	}

	return $fonts_url;
}

/**
 * Remove website field from comment form
 */
if (!function_exists('unset_url_field')) {
	function unset_url_field($fields)
	{
		$commenter = wp_get_current_commenter();
		$consent = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
		$text = "Gagner du temps et enregistrer mon nom et mon e-mail dans le navigateur pour mon prochain commentaire.";
		$fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . $text . '</label></p>';

		if (isset($fields['url']))
			unset($fields['url']);
		return $fields;
	}
	add_filter('comment_form_default_fields', 'unset_url_field');
}
