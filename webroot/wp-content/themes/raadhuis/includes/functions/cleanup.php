<?php

function raadhuis_start() {
	add_action('init', 'raadhuis_head_cleanup');
	add_action('wp_head', 'raadhuis_remove_wp_widget_recent_comments_style', 1);
	add_action('wp_head', 'raadhuis_remove_recent_comments_style', 1);
	add_action('gallery_style', 'raadhuis_gallery_style');
	add_action('excerpt_more', 'raadhuis_excerpt_more');
}

function raadhuis_head_cleanup() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'wp_generator');
}

function raadhuis_remove_wp_widget_recent_comments_style() {
	if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style');
	}
}

function raadhuis_remove_recent_comments_style() {
	global $wp_widget_factory;

	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}
}

function raadhuis_gallery_style($css) {
	return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

function raadhuis_excerpt_more($more) {
	global $post;

	return '<a class="excerpt-read-more" href="' . get_permalink($post->ID) . '" title="' . __('Lees meer', 'raadhuis') . get_the_title($post->ID) . '">' . __('... Lees meer &raquo;', 'raadhuis') . '</a>';
}

function remove_sticky_class($classes) {
	if (in_array('sticky', $classes)) {
		$classes = array_diff($classes, array("sticky"));
		$classes[] = 'wp-sticky';
	}

	return $classes;
}

function raadhuis_get_the_author_posts_link() {
	global $authordata;

	if (!is_object($authordata)) {
		return false;
	}

	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url($authordata->ID, $authordata->user_nicename),
		esc_attr(sprintf(__('Berichten van %s', 'raadhuis'), get_the_author())),
		get_the_author()
	);

	return $link;
}

function raadhuis_disable_gutenberg_patterns() {
	remove_theme_support( 'core-block-patterns' );
}


// Actions
add_action('after_setup_theme', 'raadhuis_start', 16);
add_action('post_class', 'remove_sticky_class');
add_action( 'after_setup_theme', 'raadhuis_disable_gutenberg_patterns' );