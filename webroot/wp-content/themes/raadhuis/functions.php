<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Theme support options
include_once(get_template_directory() . '/includes/functions/theme-support.php');

// Theme activation
include_once(get_template_directory() . '/includes/admin/install.php');

// Register scripts and stylesheets
include_once(get_template_directory() . '/includes/functions/enqueue-scripts.php');

// Shortcodes
include_once(get_template_directory() . '/includes/shortcodes/shortcodes.php');

// Register custom menus and menu walkers
include_once(get_template_directory() . '/includes/functions/menu.php');

// Register sidebars/widget areas
include_once(get_template_directory() . '/includes/functions/sidebar.php');

// Replace 'older/newer' post links with numbered navigation
include_once(get_template_directory() . '/includes/functions/pagination.php');

// Custom post type example:
include_once(get_template_directory() . '/includes/functions/custom-post-type.php');

// Makes WordPress comments suck less
// include_once(get_template_directory().'/includes/functions/comments.php');

// Adds site styles to the WordPress editor
include_once(get_template_directory() . '/includes/functions/editor-styles.php');

// Remove Emoji Support
// include_once(get_template_directory().'/includes/functions/disable-emoji.php');

// ACF actions and filter when plugin is active
require_once(get_template_directory() . '/includes/plugins/acf.php');

// Add custom functions here!
include_once(get_template_directory() . '/includes/functions/custom.php');

// Add custom blocks for Gutenberg here
require_once(get_template_directory() . '/includes/functions/blocks.php');
