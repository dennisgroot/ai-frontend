<?php

/* ACF
---------------------------------------------------------------------------------- */
function acf_plugin_init()
{
    if (class_exists('ACF')) :

        function acf_fields_flexible_content_label($title, $field, $layout, $i)
        {
            foreach ($field['value'] as $key => $value) {
                if ($layout['name'] == $value['acf_fc_layout']) {
                    $group = !empty(get_sub_field($value['acf_fc_layout'])) ? get_sub_field($value['acf_fc_layout']) : false;
                    $block_title = !empty($group['title']) ? '(' . esc_html($group['title']) . ')' : '';
                    $title = '<b style="color: #5D2CFF;">' . $title . '</b> ' . $block_title;
                    return $title;
                }
            }
        }
        function relationship_options_filter($options, $field, $the_post)
        {
            $options['post_status'] = array('publish');
            return $options;
        }

        // Actions
        // add_action('acf/input/admin_head', 'acf_flexible_content_collapse_on_load');

        // Filters
        add_filter('acf/fields/relationship/query/', 'relationship_options_filter', 10, 3); // releation field only show published posts
        add_filter('acf/fields/flexible_content/layout_title/name=pagebuilder', 'acf_fields_flexible_content_label', 10, 4); // acf pagebuilder show labels
        add_filter('acf/format_value/type=textarea', 'do_shortcode'); // allow shortcodes in textarea fields
        add_filter('acf/format_value/type=text', 'do_shortcode'); // allow shortcodes in text fields

        // ACF options page(s)
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title'     => 'Algemeen',
                'menu_title'    => 'Algemeen',
                'menu_slug'     => 'options',
                'redirect'        => false,
                'position'        => '4',
                'icon_url'        => 'dashicons-admin-tools',
                'update_button' => 'Wijzigingen opslaan'
            ));

            acf_add_options_sub_page(array(
                'page_title'     => 'Theme Header Settings',
                'menu_title'    => 'Header',
                'parent_slug'    => 'options',
            ));

            acf_add_options_sub_page(array(
                'page_title'     => 'Theme Footer Settings',
                'menu_title'    => 'Footer',
                'parent_slug'    => 'options',
            ));
        }

    endif;
}
add_action('wp', 'acf_plugin_init');
