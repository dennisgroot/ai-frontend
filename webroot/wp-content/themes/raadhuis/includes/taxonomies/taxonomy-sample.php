<?php

$register_taxonomy_example = function () {

    $taxonomy_name = 'taxonomy_example';

    register_taxonomy(
        $taxonomy_name,
        [
            'sample', // Aan welke post types moet hij gekoppeld worden? Array (meerdere) of string.
        ],
        [
            'hierarchical' => true,
            'labels' => [
                'name' => __('Example', 'raadhuis-wp'),
                'singular_name' => __('Example', 'raadhuis-wp'),
                'search_items' => __('example', 'raadhuis-wp'),
                'all_items' => __('Alle exampleen', 'raadhuis-wp'),
                'parent_item' => __('Vorig item', 'raadhuis-wp'),
                'parent_item_colon' => __('Vorig item', 'raadhuis-wp'),
                'edit_item' => __('Wijzig example', 'raadhuis-wp'),
                'update_item' => __('Update example', 'raadhuis-wp'),
                'add_new_item' => __('example toevoegen', 'raadhuis-wp'),
                'new_item_name' => __('Nieuw example', 'raadhuis-wp'),
            ],
            'rewrite' => ['slug' => $taxonomy_name],
            'query_var' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'show_in_quick_edit' => true,
            'show_in_rest' => true, // Show as Gutenberg block witin editor.
        ]
    );
};

add_action('wp_loaded', $register_taxonomy_example);
