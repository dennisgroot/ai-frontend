<?php

/**
 * Blocks for Gutenberg made with ACF
 */
function raadhuis_block_categories($categories)
{
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'raadhuis-content',
                'title' => __('Raadhuis content', 'raadhuis'),
            ],
            [
                'slug'  => 'raadhuis-overview',
                'title' => __('Raadhuis overzichten', 'raadhuis'),
            ],
            [
                'slug'  => 'raadhuis-functional',
                'title' => __('Raadhuis functioneel', 'raadhuis'),
            ],
        ]
    );
}

add_filter('block_categories_all', 'raadhuis_block_categories', 10, 2);

function register_acf_blocks($dir_url)
{
    $dir_url = get_template_directory() . '/blocks/';

    $block_names = array('image-text', 'story', 'image-slider', 'faq', 'gallery', 'news', 'cards', 'video', 'events', 'team', 'downloads', 'vacancies', 'logo-slider');


    foreach ($block_names as $block_name) {
        register_block_type($dir_url . $block_name . '/block.json');
    }
}
add_action('init', 'register_acf_blocks', 5, 1);
