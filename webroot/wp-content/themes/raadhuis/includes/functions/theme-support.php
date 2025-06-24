<?php

// Adding WP Functions & Theme Support
function raadhuis_theme_support()
{
    if (!defined('DISALLOW_FILE_EDIT')) {
        define('DISALLOW_FILE_EDIT', true);
    }

    $image_sizes = array(
        'custom-image-size' => array(
            'width' => 600,
            'height' => 400,
            'crop' => array('center', 'top'),
            'retina' => true,
        ),
    );

    foreach ($image_sizes as $key => $value) {
        $name = $key;
        $width = $value['width'];
        $height = $value['height'];
        $crop = $value['crop'];
        $retina = $value['retina'];

        // Add size
        add_image_size($name, $width, $height, $crop);

        if (isset($retina) && $retina == true) {
            $retina_name = $name . '-retina';
            $retina_height = $height * 2;
            $retina_width = $width * 2;

            // Add retina size
            add_image_size($retina_name, $retina_width, $retina_height, $crop);
        }
    }

    // Add WP Thumbnail Support
    add_theme_support('post-thumbnails');


    // Adding support for core block visual styles.
    add_theme_support('wp-block-styles');

    // Adding support for responsive embedded content.
    add_theme_support('responsive-embeds');

    // Adding support for full navigation menu functionality.
    add_theme_support('block-nav-menus');

    // Add RSS Support
    add_theme_support('automatic-feed-links');

    // Add Support for WP Controlled Title Tag
    add_theme_support('title-tag');

    // Add HTML5 Support
    add_theme_support(
        'html5',
        array(
            'comment-list',
            'comment-form',
            'search-form',
        )
    );

    // Editor styles
    add_theme_support('editor-styles');

    add_editor_style();

    // Disable admin notification after password change
    if (! function_exists('wp_password_change_notification')) {
        function wp_password_change_notification($user)
        {
            return;
        }
    }

    // Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
    $GLOBALS['content_width'] = apply_filters('raadhuis_theme_support', 1200);
} /* end theme support */

// Add Gutenberg JS
function gutenberg_script()
{
    wp_enqueue_script('gutenberg-script', get_template_directory_uri() . '/gutenberg.js', array('wp-blocks', 'wp-dom'), filemtime(get_stylesheet_directory() . '/gutenberg.js'), true);
}

add_action('after_setup_theme', 'raadhuis_theme_support');
add_action('enqueue_block_editor_assets', 'gutenberg_script');
