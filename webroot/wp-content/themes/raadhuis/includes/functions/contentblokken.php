<?php 


/**
 * Get's the partials based on the ACF layout name.
 *
 * You can find the layout name in the ACF group Contentblokken.
 * Keep your partial name the same as the ACF layout name and it'll work.
 */
function raadhuis_get_contentblokken_partials($contentblokken) {
	if (!empty($contentblokken)) {
		foreach ($contentblokken as $key => $contentblok) {
			echo get_template_part('includes/partials/content', str_replace('_', '-', $contentblok['acf_fc_layout']), $contentblok);
		}
	}
}

function raadhuis_remove_texteditor() {
	remove_post_type_support( 'page', 'editor' );
	remove_post_type_support( 'post', 'editor' );
}
add_action('admin_init', 'raadhuis_remove_texteditor');


?>