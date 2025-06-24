<?php

function add_custom_data_to_breadcrumb( $links ) {
    // Loop through each breadcrumb link
	$i_num = 1;

    foreach ( $links as &$link ) {
        // Add your custom data to the link array
        $link['item_number'] = $i_num; // Example custom data

		$i_num++;
    }
    return $links;
}
add_filter( 'wpseo_breadcrumb_links', 'add_custom_data_to_breadcrumb' );

/**
 * Filter the output of Yoast breadcrumbs so each item is an <li> with schema markup
 * @param $link_output
 * @param $link
 *
 * @return string
 */
function custom_yoast_breadcrumb_items($link_output, $link) {
    // Controleer of het huidige item het laatste item is
    $is_last_item = preg_match('/<\/li>\z/', $link_output);

    // Verwijder de link van het laatste item
    if ($is_last_item) {
        $new_link_output = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        $new_link_output .= '<span itemprop="item">  <span itemprop="name">' . $link['text'] . '</span></span>';
        $new_link_output .= '<meta itemprop="position" content="'.$link['item_number'].'" />';
        $new_link_output .= '</li>';
    } else {
        $new_link_output = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        $new_link_output .= '<a href="' . $link['url'] . '" itemprop="item">  <span itemprop="name">' . $link['text'] . '</span></a>';
        $new_link_output .= '<meta itemprop="position" content="'.$link['item_number'].'" />';
        $new_link_output .= '</li>';
    }

    return $new_link_output;
}
add_filter('wpseo_breadcrumb_single_link', 'custom_yoast_breadcrumb_items', 10, 2);

/**
 * Remove <span> tags from Yoast breadcrumb output
 *
 * @param string $output
 * @return string
 */
function remove_yoast_breadcrumb_span($output) {
    $output = str_replace(array('<span>', '</span>'), '', $output);
    return $output;
}
add_filter('wpseo_breadcrumb_output', 'remove_yoast_breadcrumb_span');

/**
 * Shortcut function to output Yoast breadcrumbs
 * wrapped in the appropriate markup
 */
function custom_breadcrumbs() {
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<ul class="nav__breadcrumb">', '</ul>');
    }
}

function unbox_yoast_seo_breadcrumb_append_link( $links ) {
	global $post;

    $algemeen_breadcrumbs = get_field('algemeen_breadcrumbs','options');

    if( is_singular('vacancies')){

		$breadcrumb_vacancies = array();
        $i_vacancies = 0;

        if ($algemeen_breadcrumbs && $algemeen_breadcrumbs['algemeen_breadcrumbs_vacancies']) {

            $breadcrumb_vacature_array = array();

            foreach ($algemeen_breadcrumbs['algemeen_breadcrumbs_vacancies'] as $breadcrumb_vacature_item) {

                $breadcrumb_vacature_array[$i_vacancies]['url'] = $breadcrumb_vacature_item['algemeen_breadcrumbs_vacancies_link']['url'];
                $breadcrumb_vacature_array[$i_vacancies]['text'] = $breadcrumb_vacature_item['algemeen_breadcrumbs_vacancies_link']['title'];

                $i_vacancies++;
            }

            $breadcrumb_vacancies = $breadcrumb_vacature_array;
        }

        
		array_splice($links, 1, 0, $breadcrumb_vacancies); 
	}

    if( is_singular('events')){

		$breadcrumb_events = array();
        $i_events = 0;

        if ($algemeen_breadcrumbs && $algemeen_breadcrumbs['algemeen_breadcrumbs_events']) {

            $breadcrumb_events_array = array();

            foreach ($algemeen_breadcrumbs['algemeen_breadcrumbs_events'] as $breadcrumb_events_item) {

                $breadcrumb_events_array[$i_events]['url'] = $breadcrumb_events_item['algemeen_breadcrumbs_events_link']['url'];
                $breadcrumb_events_array[$i_events]['text'] = $breadcrumb_events_item['algemeen_breadcrumbs_events_link']['title'];

                $i_events++;
            }

            $breadcrumb_events = $breadcrumb_events_array;
        }

        
		array_splice($links, 1, 0, $breadcrumb_events); 
	}

    return $links;

}
add_filter( 'wpseo_breadcrumb_links', 'unbox_yoast_seo_breadcrumb_append_link' );

?>