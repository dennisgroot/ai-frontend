<?php
// SIDEBARS AND WIDGETIZED AREAS
function raadhuis_register_sidebars()
{

    register_sidebar(array(
        'id' => 'sidebar-primary',
        'name' => __('Sidebar primary', 'raadhuis-wp'),
        'description' => __('The first (primary) sidebar.', 'raadhuis-wp'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'offcanvas',
        'name' => __('Offcanvas', 'raadhuis-wp'),
        'description' => __('The offcanvas sidebar.', 'raadhuis-wp'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    /*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar-secondary',
		'name' => __('Sidebar 2', 'raadhuis-wp'),
		'description' => __('The second (secondary) sidebar.', 'raadhuis-wp'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar-secondary.php

	*/
} /* end register sidebars */

add_action('widgets_init', 'raadhuis_register_sidebars');
