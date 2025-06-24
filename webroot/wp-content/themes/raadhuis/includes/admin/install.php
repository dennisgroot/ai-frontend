<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly

function theme_setup()
{
    // update_option( 'theme_setup_status', '0' ); // Enable for debugging

    // First we check to see if our default theme settings have been applied.
    $theme_status = get_option('theme_setup_status');

    // On theme activation
    if ($theme_status !== '1') {

        function create_homepage()
        {
            $homepage_page_title        = __('Homepage', 'raadhuis');
            // $homepage_page_content      = __('', 'raadhuis');
            $homepage_page = array(
                'post_type'         => 'page',
                'post_title'        => $homepage_page_title,
                // 'post_content'      => $homepage_page_content,
                'post_status'       => 'publish',
                'post_name'         => 'home',
                'comment_status'    => 'closed',
                'post_author'       => 1,
            );

            $query = new WP_Query(array(
                'post_type' => 'page',
                'title' => $homepage_page_title,
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'fields' => 'ids'
            ));

            if (!$query->have_posts()) {
                wp_insert_post($homepage_page);
            }
        }

        function create_blogpage()
        {
            $blogpage_page_title            = __('Nieuws', 'raadhuis');
            // $blogpage_page_content          = __('', 'raadhuis');
            $blogpage_page = array(
                'post_type'         => 'page',
                'post_title'        => $blogpage_page_title,
                // 'post_content'      => $blogpage_page_content,
                'post_status'       => 'publish',
                'post_name'         => 'home',
                'comment_status'    => 'closed',
                'post_author'       => 1,
            );

            $query = new WP_Query(array(
                'post_type' => 'page',
                'title' => $blogpage_page_title,
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'fields' => 'ids'
            ));

            if (!$query->have_posts()) {
                wp_insert_post($blogpage_page);
            }
        }

        // Delete the default WordPress default posts, pages and comments.
        wp_delete_post(1, true);
        wp_delete_post(2, true);
        wp_delete_comment(1);

        // Create homepage/blog page
        create_homepage();
        create_blogpage();

        $home = get_page_by_title('Homepage');
        $blog = get_page_by_title('Nieuws');

        $core_settings = array(
            'blogdescription'        => '',                    // meta description
            'date_format'            => 'd-m-Y',                // post date
            'default_comment_status' => 'closed',            // comments on/off
            'permalink_structure'    => '/%postname%/',        // permalink structure
            'timezone_string'        => 'Europe/Amsterdam',    // default timezone
            'show_avatars'            => 0,                    // avatars on/off
            'use_smilies'            => 0,                   // disable smilies
            'show_on_front'            => 'page',              // set to static pages
            'page_on_front'            => $home->ID,           // set homepage
            'page_for_posts'        => $blog->ID,           // set blog page
        );

        foreach ($core_settings as $k => $v) {
            update_option($k, $v);
        }

        // Flush
        global $wp_rewrite;
        $wp_rewrite->flush_rules();

        update_option('theme_setup_status', '1');
    }
}

add_action('after_setup_theme', 'theme_setup');
