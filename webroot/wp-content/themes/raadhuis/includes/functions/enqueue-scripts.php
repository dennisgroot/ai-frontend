<?php

function site_scripts()
{
    $app_js = get_template_directory() . '/dist/assets/js/app.js';
    $app_css = get_template_directory() . '/dist/assets/css/app.css';

    // Adding scripts file in the footer
    if (file_exists($app_js)) {
        wp_enqueue_script('script', get_template_directory_uri() . '/dist/assets/js/app.js', ['jquery'], filemtime($app_js), array(
            'strategy' => 'defer'
        ));
    } else {
        echo '<strong>Geen Javascript file in dist folder!</strong><br>';
    }

    // Register main stylesheet
    if (file_exists($app_css)) {
        wp_enqueue_style('style', get_template_directory_uri() . '/dist/assets/css/app.css', [], filemtime($app_css), 'all');
    } else {
        echo '<strong>Geen CSS file in dist folder!</strong>';
    }
}

add_action('wp_enqueue_scripts', 'site_scripts', 999);
