<?php

if (!function_exists('child_theme_enqueue_scripts')) {
	function child_theme_enqueue_scripts()
	{
		wp_enqueue_style('child-theme-css', get_stylesheet_uri());

		wp_enqueue_script('child-theme-js', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '1.0', true);
	}
	add_action('wp_enqueue_scripts', 'child_theme_enqueue_scripts');
}
