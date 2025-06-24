<?php if ( ! defined( 'ABSPATH' ) ) exit;

//===============================================//
//=========== Add shortcodes button =============//
//===============================================//


add_action('admin_head', 'add_shortcodes_button');

function add_shortcodes_button() {
    global $typenow;

    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
	    return;
    }

    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "add_tinymce_plugin");
        add_filter('mce_buttons', 'register_shortcodes_button');
    }
}

function add_tinymce_plugin($plugin_array) {
    $plugin_array['shortcodes_button'] = esc_url( get_template_directory_uri() ) . '/includes/shortcodes/js/shortcodes.js';
    return $plugin_array;
}

function register_shortcodes_button($buttons) {
   array_push($buttons, "shortcodes_button");
   return $buttons;
}


//===============================================//
//================= Elements ====================//
//===============================================//


/* -- Row
========================================== */

function row( $atts, $content = null ) {
	return '<div class="row">'.do_shortcode($content).'</div>';
}

add_shortcode('row', 'row');

/* -- Columns
========================================== */

function column( $atts, $content = null ) {
	extract( shortcode_atts(
		array(
			'width' => '',
		), $atts )
	);
	return '<div class="column '.$width.'">'.do_shortcode($content).'</div>';
}

add_shortcode('column', 'column');

function company_name( $atts, $content = null ) {
    
    $current_user_id = get_current_user_id();
    $user_group = get_user_group($current_user_id);

    if (!empty($_GET['company_name'])) {
        return esc_html($_GET['company_name']);
    } elseif (!empty($user_group)) {
        return esc_html($user_group->name);
    }
	
    return false;
}

add_shortcode('company_name', 'company_name');

function order_id( $atts, $content = null ) {

    if (!empty($_GET['order_id'])) {
        return esc_html($_GET['order_id']);
    }
	
    return false;
}

add_shortcode('order_id', 'order_id');

function firstname( $atts, $content = null ) {

    if (!empty($_GET['firstname'])) {
        return esc_html($_GET['firstname']);
    }
	
    return false;
}

add_shortcode('firstname', 'firstname');

function lastname( $atts, $content = null ) {

    if (!empty($_GET['lastname'])) {
        return esc_html($_GET['lastname']);
    }
	
    return false;
}

add_shortcode('lastname', 'lastname');

function display_name( $atts, $content = null ) {

    if (!empty($_GET['display_name'])) {
        return esc_html($_GET['display_name']);
    }
	
    return false;
}

add_shortcode('display_name', 'display_name');


function post_id( $atts, $content = null ) {

    if (!empty($_GET['post_id'])) {
        return esc_html($_GET['post_id']);
    } else {
        return get_the_ID();
    }
	
    return false;
}

add_shortcode('post_id', 'post_id');

/* -- Button
========================================== */

function button( $atts, $content = null ) {
	extract( shortcode_atts(
		array(
			'size' => '',
			'link' => '',
			'target' => '',
			'class' => '',
		), $atts )
	);

	if($target) { $target = 'target="'.$target.'"'; }

	return '<a class="button '.$size.' '.$class.'" href="'.$link.'" '. $target.'>'. $content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content) .'</a>';

}

add_shortcode('button', 'button');