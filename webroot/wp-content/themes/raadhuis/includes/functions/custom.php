<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly

//===============================================//
//============== Custom functions ===============//
//===============================================//

// Prefetch DNS
function dns_prefetch()
{
    echo '
        <meta http-equiv="x-dns-prefetch-control" content="on">
        <link rel="dns-prefetch" href="//fonts.googleapis.com" />
        <link rel="dns-prefetch" href="//fonts.gstatic.com" />
        <link rel="dns-prefetch" href="//ajax.googleapis.com" />
        <link rel="dns-prefetch" href="//www.google-analytics.com" />
    ';
}

// Excerpt & read more functions
function custom_read_more($id = null)
{
    return '... <a class="button primary button-read-more" href="' . get_permalink($id) . '">Lees verder &raquo;</a>';
}

function excerpt($limit, $post = null)
{
    return wp_trim_words(get_the_excerpt($post), $limit, custom_read_more());
}

function excerpt_only($limit, $post = null)
{
    return wp_trim_words(get_the_excerpt($post), $limit);
}

// Developer dump functions
function pr($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

function vd($value)
{
    var_dump($value);
}

function tinymce_text_formats($in)
{
    $in['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6;Preformatted=pre";
    return $in;
}

// Get Google API key from field - Globally accessible
function get_google_console_api($key = '')
{
    $key = get_field('google_api', 'option');
    return $key;
}

function acf_init_google_maps_api()
{
    $key = get_google_console_api();
    acf_update_setting('google_api_key', $key);
}

// function wp_get_attachment_image_filter($html, $attachment_id, $size, $icon, $attr)
// {
//     if (is_admin() or $icon == true) return $html; // return

//     if (wp_get_environment_type() === 'development') {
//         global $_wp_additional_image_sizes;

//         if (!empty($size)) {
//             $width = $_wp_additional_image_sizes[$size]['width'];
//             $height = $_wp_additional_image_sizes[$size]['height'];
//             $size = $width . 'x' . $height;
//         } else {
//             $size = '1000x1000';
//         }

//         $html = '<img src="https://dummyimage.com/' . $size . '" alt="' . $size . '" class="w-full h-full object-center object-cover">';
//     }

//     return $html;
// }

function add_custom_post_state($post_states, $post)
{
    if (!empty(get_page_template_slug($post->ID))) {
        $template_path = get_post_meta(get_the_ID(), '_wp_page_template', true);
        $templates = wp_get_theme()->get_page_templates();
        $post_states[] = $templates[$template_path];
    }
    return $post_states;
}

// function admin_enqueue_script($hook)
// {
//     if ('post.php' !== $hook) {
//         return;
//     }
//     wp_enqueue_script('admin-js', get_template_directory() . '/includes/admin/admin.js');
// }

// add_action('admin_enqueue_scripts', 'admin_enqueue_script');

function prepairAlpineJsData($data)
{

    if (!$data) {
        return;
    }

    return $data;
}

function getAlpineJsData($data = [])
{
    return json_encode($data, JSON_PRETTY_PRINT);
}

//Remove Gutenberg Block Library CSS from loading on the frontend
// function smartwp_remove_wp_block_library_css()
// {
//     wp_dequeue_style('wp-block-library');
//     wp_dequeue_style('wp-block-library-theme');
//     wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
// }
// add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

//===================================================================//
//============== Include support, filters and actions ===============//
//===================================================================//

// Support
add_post_type_support('page', 'excerpt');

// Actions
add_action('wp_head', 'dns_prefetch', 0);

// Filter
add_filter('tiny_mce_before_init', 'tinymce_text_formats');
// add_filter('wp_get_attachment_image', 'wp_get_attachment_image_filter', 10, 5);
add_filter('display_post_states', 'add_custom_post_state', 10, 2);
