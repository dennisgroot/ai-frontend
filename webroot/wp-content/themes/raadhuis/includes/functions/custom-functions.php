<?php

// Debug var_dump
function vd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

// Debug print
function pr($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

// Add extra body classes to the body_class function
function get_body_classes($classes)
{
    global $set_body_classes;

    // Default classes
    $classes[] = 'preload';

    if (!empty($set_body_classes)) {
        $classes[] = $set_body_classes;
    }

    return $classes;
}

// Get custom excerpt (updated to be awesome)
function get_custom_excerpt($content_or_id, $length = 200)
{
    if (is_numeric($content_or_id)) {

        $custom_excerpt = get_field('header_inleiding', $content_or_id);
        $post = get_post($content_or_id);

        if ($post->post_excerpt) {
            $excerpt = $post->post_excerpt;
        } elseif ($custom_excerpt && strlen($custom_excerpt) > 1) {
            $excerpt = strip_tags($custom_excerpt);
        } else {
            $excerpt = strip_tags($post->post_content);
        }
    } else {
        $excerpt = strip_tags($content_or_id);
    }

    $length = intval($length);

    if (strlen($excerpt) > $length) {
        $excerpt = substr($excerpt, 0, $length);
        $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
        $excerpt .= '...';
    }

    return $excerpt;
}

// Get the link for ACF link field
function get_the_link($link, $classes = 'button primary')
{
    if (empty($link)) {
        return false;
    }

    $html = "<a href='{$link['url']}' target='{$link['target']}' class='{$classes}' title='{$link['title']}'>{$link['title']}</a>";

    return $html;
}

// Get the content by ID, properly...
function get_the_content_by_id($id)
{
    if (empty($id)) {
        return false;
    }

    $id = intval($id);

    $post = get_post($id);
    $the_content = apply_filters('the_content', $post->post_content);

    return $the_content;
}

// Get the post categories slugs
function get_the_post_categories_slugs($post_id, $taxonomy = '', $echo = false, $implode = true)
{
    if (empty($post_id)) {
        return false;
    }

    if (empty($taxonomy)) {
        return false;
    }

    $terms = get_the_terms($post_id, $taxonomy);

    $categories = array();

    if (!empty($terms)) {
        foreach ($terms as $key => $term) {
            $categories[$key] = $term->slug;
        }
    }

    if ($echo == true) {
        echo implode(' ', $categories);
    }

    if ($implode == true) {
        return implode(' ', $categories);
    }

    return $categories;
}

// Get the post categories names
function get_the_post_categories_names($post_id, $taxonomy = '', $echo = false, $implode = true)
{
    if (empty($post_id)) {
        return false;
    }

    if (empty($taxonomy)) {
        return false;
    }

    $terms = get_the_terms($post_id, $taxonomy);

    $categories = array();

    if (!empty($terms)) {
        foreach ($terms as $key => $term) {
            $categories[$key] = $term->name;
        }
    }

    if ($echo == true) {
        echo implode(' ', $categories);
    }

    if ($implode == true) {
        return implode(' ', $categories);
    }

    return $categories;
}

//replace emailadress specials char
function remove_plaintext_email($emailAddress)
{
    $emailRegEx = '/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4})/i';

    return preg_replace_callback($emailRegEx, "encodeEmail", $emailAddress);
}

//encode emailadress with antispambot
function encodeEmail($result)
{
    return antispambot($result[1]);
}

// Move Yoast Meta Box to bottom
function yoast_metabox_priority()
{
    return 'low';
}

// Function to change "posts" to "news" in the admin side menu
function change_post_menu_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Nieuws';
    $submenu['edit.php'][5][0] = 'Nieuws';
    $submenu['edit.php'][10][0] = 'Voeg nieuws toe';
    $submenu['edit.php'][16][0] = 'Tags';
    echo '';
}
// Function to change post object labels to "news"
function change_post_object_label()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Nieuws';
    $labels->singular_name = 'Nieuws';
    $labels->add_new = 'Voeg item toe';
    $labels->add_new_item = 'Voeg item toe';
    $labels->edit_item = 'Bewerk item';
    $labels->new_item = 'Nieuw item';
    $labels->view_item = 'Bekijk item';
    $labels->search_items = 'Zoek item';
    $labels->not_found = 'Geen item gevonden';
    $labels->not_found_in_trash = 'Geen nieuws in prullenbak';
}

function remove_editor()
{
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);

        switch ($template) {
            case '':
                remove_post_type_support('page', 'editor');
                break;
            default:
                // Don't remove any other template.
                break;
        }

        switch ($id) {
            case 1:
                remove_post_type_support('page', 'editor');
                break;
            default:
                // Don't remove any other template.
                break;
        }
    }
}

add_filter('gform_confirmation_anchor', function () {
    return 20;
});

//check voor video block
function onlyNumbers($input)
{
    // Controleer of de string alleen cijfers bevat
    return ctype_digit($input);
}

// Voeg een filter toe om de standaard Yoast SEO-beschrijving in te stellen
function default_yoast_seo_description($metadesc)
{
    // Controleer of de huidige pagina een bericht is en of Yoast SEO actief is
    if (class_exists('WPSEO_Frontend')) {
        global $post;

        // Controleer of de huidige post geen meta-beschrijving heeft
        if (! $metadesc) {
            // Stel hier je standaard beschrijving in
            $default_description = rtrim(get_custom_excerpt(get_the_ID(), 150));

            // Gebruik de standaard beschrijving als er geen is ingesteld
            return $default_description;
        }
    }

    return $metadesc;
}

// Voeg filter toe voor og:description
function default_yoast_og_description($og_desc)
{
    // Controleer of het een bericht is zonder beschrijving

    $default_description = rtrim(get_custom_excerpt(get_the_ID(), 150));
    return $default_description;

    return $og_desc;
}

function get_the_post_thumbnail_alt($post_id)
{
    return get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
}

function get_the_post_thumbnail_title($post_id)
{
    return get_post(get_post_thumbnail_id($post_id))->post_title;
}

function custom_post_rewrite_rules()
{
    $page_for_posts_id = get_option('page_for_posts');
    if ($page_for_posts_id) {
        $page_for_posts_slug = get_post_field('post_name', $page_for_posts_id);
        add_rewrite_rule(
            '^' . $page_for_posts_slug . '/([^/]+)/?$',
            'index.php?name=$matches[1]',
            'top'
        );
    }
}

function custom_post_permalink($permalink, $post)
{
    if ($post->post_type == 'post') {
        $page_for_posts_id = get_option('page_for_posts');
        if ($page_for_posts_id) {
            $page_for_posts_slug = get_post_field('post_name', $page_for_posts_id);
            $permalink = home_url('/' . $page_for_posts_slug . '/' . $post->post_name . '/');
        }
    }
    return $permalink;
}

function flush_rewrite_rules_on_init()
{
    flush_rewrite_rules();
}

if (function_exists('relevanssi_orderby')) {
    add_filter('relevanssi_orderby', function ($orderby) {
        return array('relevance' => 'desc');
    });
}


// Actions
add_action('admin_menu', 'change_post_menu_label');
// add_action('init', 'remove_editor');
add_action('init', 'custom_post_rewrite_rules');
add_action('init', 'flush_rewrite_rules_on_init');

// Filters
add_filter('body_class', 'get_body_classes');
add_filter('the_content', 'remove_plaintext_email', 20);
add_filter('widget_text', 'remove_plaintext_email', 20);
add_filter('the_excerpt', 'remove_plaintext_email', 20);
add_filter('wpseo_metabox_prio', 'yoast_metabox_priority');
add_filter('wpseo_metadesc', 'default_yoast_seo_description', 10, 1);
add_filter('wpseo_twitter_description', 'default_yoast_seo_description', 10, 1);
add_filter('wpseo_opengraph_desc', 'default_yoast_og_description', 10, 1);
add_filter('post_link', 'custom_post_permalink', 10, 2);
