<?php

/**
 * Custom post types
 *
 * https://wordpress.org/support/article/post-types/#custom-post-types
 */

function events_post_type()
{
    register_post_type(
        'events',
        array(
            'labels' => array(
                'name' => 'Evenementen',
                'singular_name' => 'Evenement',
                'all_items' => 'Alle items',
                'add_new' => 'Nieuw item',
                'add_new_item' => 'Voeg nieuw item toe',
                'edit' => 'Wijzig',
                'edit_item' => 'Wijzig item',
                'new_item' => 'Voeg nieuw item toe',
                'view_item' => 'Toon item',
                'search_items' => 'Zoeken naar items',
                'not_found' => 'Niets gevonden in de database.',
                'not_found_in_trash' => 'Niets gevonden en de prullenbak.',
                'parent_item_colon' => '',
            ),
            'description' => 'Een post type voor evenementen',
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 8,
            'menu_icon' => 'dashicons-calendar-alt',
            'rewrite' => array(
                'slug' => 'evenementen',
                'with_front' => false,
            ),
            'has_archive' => false,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'page-attributes'),
            'show_in_rest' => true,
        )
    );

    //register_taxonomy_for_object_type('category', 'events');
    //register_taxonomy_for_object_type('post_tag', 'events');
}

add_action('init', 'events_post_type');

function vacancies_post_type()
{
    register_post_type(
        'vacancies',
        array(
            'labels' => array(
                'name' => 'Vacatures',
                'singular_name' => 'Vacature',
                'all_items' => 'Alle items',
                'add_new' => 'Nieuw item',
                'add_new_item' => 'Voeg nieuw item toe',
                'edit' => 'Wijzig',
                'edit_item' => 'Wijzig item',
                'new_item' => 'Voeg nieuw item toe',
                'view_item' => 'Toon item',
                'search_items' => 'Zoeken naar items',
                'not_found' => 'Niets gevonden in de database.',
                'not_found_in_trash' => 'Niets gevonden en de prullenbak.',
                'parent_item_colon' => '',
            ),
            'description' => 'Een post type voor vacatures',
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 8,
            'menu_icon' => 'dashicons-businessman',
            'rewrite' => array(
                'slug' => 'vacature',
                'with_front' => false,
            ),
            'has_archive' => false,
            'capability_type' => 'post',
            'hierarchical' => false,
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'page-attributes'),
        )
    );

    //register_taxonomy_for_object_type('category', 'vacancies');
    //register_taxonomy_for_object_type('post_tag', 'vacancies');
}

add_action('init', 'vacancies_post_type');

// // Custom categorieën
// register_taxonomy('agenda_categories',
// 	array('agenda'),
// 	array('hierarchical' => true,
// 		'labels' => array(
// 			'name' => 'Categorieën',
// 			'singular_name' => 'Categorie',
// 			'search_items' => 'Zoek categorieën',
// 			'all_items' => 'Alle categorieën',
// 			'parent_item' => 'Hoofd categorie',
// 			'parent_item_colon' => 'Hoofd categorie:',
// 			'edit_item' => 'Bewerk categorie',
// 			'update_item' => 'Categorie bijwerken',
// 			'add_new_item' => 'Voeg nieuwe categorie toe',
// 			'new_item_name' => 'Nieuwe categorie naam',
// 		),
// 		'show_admin_column' => true,
// 		'show_ui' => true,
// 		'query_var' => true,
// 		'rewrite' => array('slug' => 'agenda-categories'),
// 	)
// );

// // Custom tags
// register_taxonomy('agenda_tags',
// 	array('agenda'),
// 	array('hierarchical' => false,
// 		'labels' => array(
// 			'name' => 'Tags',
// 			'singular_name' => 'Tag',
// 			'search_items' => 'Zoek tags',
// 			'all_items' => 'Alle tags',
// 			'parent_item' => 'Hoofd tag',
// 			'parent_item_colon' => 'Hoofd tag:',
// 			'edit_item' => 'Bewerk tag',
// 			'update_item' => 'Tag bijwerken',
// 			'add_new_item' => 'Voeg nieuwe tag toe',
// 			'new_item_name' => 'Nieuwe tag naam',
// 		),
// 		'show_admin_column' => true,
// 		'show_ui' => true,
// 		'query_var' => true,
// 	)
// );