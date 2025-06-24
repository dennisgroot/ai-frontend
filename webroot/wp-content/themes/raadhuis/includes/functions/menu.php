<?php

// Register menus
register_nav_menus(
    array(
        'nav-topbar'            => __('Topbar', 'raadhuis-wp'),
        'nav-main'                => __('Hoofdmenu', 'raadhuis-wp'),
        'nav-footer-1'            => __('Footer menu (kolom 1)', 'raadhuis-wp'),
        'nav-footer-2'            => __('Footer menu (kolom 2)', 'raadhuis-wp'),
        'nav-footer-links'        => __('Footer menu (links)', 'raadhuis-wp'),
    )
);

function raadhuis_main_nav($depth = 1, $class = 'menu')
{
    wp_nav_menu(array(
        'container'                => false,
        'menu_id'                => 'nav-main',
        'menu_class'            => $class,
        'items_wrap'            => '<ul class="%2$s">%3$s</ul>',
        'theme_location'        => 'nav-main',
        'depth'                    => $depth,
        'fallback_cb'            => false,
    ));
}

function raadhuis_top_nav($depth = 1, $class = 'menu')
{
    wp_nav_menu(array(
        'container'                => false,
        'menu_id'                => 'nav-topbar',
        'menu_class'            => $class,
        'items_wrap'            => '<ul class="%2$s">%3$s</ul>',
        'theme_location'        => 'nav-topbar',
        'depth'                    => $depth,
        'fallback_cb'            => false,
    ));
}

function raadhuis_footer_nav_1($depth = 1, $class = 'menu')
{
    wp_nav_menu(array(
        'container'                => false,
        'menu_id'                => 'nav-footer',
        'menu_class'            => $class,
        'items_wrap'            => '<ul class="%2$s">%3$s</ul>',
        'theme_location'        => 'nav-footer-1',
        'depth'                    => $depth,
        'fallback_cb'            => false,
    ));
}

function raadhuis_footer_nav_2($depth = 1, $class = 'menu')
{
    wp_nav_menu(array(
        'container'                => false,
        'menu_id'                => 'nav-footer',
        'menu_class'            => $class,
        'items_wrap'            => '<ul class="%2$s">%3$s</ul>',
        'theme_location'        => 'nav-footer-2',
        'depth'                    => $depth,
        'fallback_cb'            => false,
    ));
}

function raadhuis_footer_nav_links($depth = 1, $class = 'menu')
{
    wp_nav_menu(array(
        'container'                => false,
        'menu_id'                => 'nav-footer',
        'menu_class'            => $class,
        'items_wrap'            => '<ul class="%2$s">%3$s</ul>',
        'theme_location'        => 'nav-footer-links',
        'depth'                    => $depth,
        'fallback_cb'            => false,
    ));
}
