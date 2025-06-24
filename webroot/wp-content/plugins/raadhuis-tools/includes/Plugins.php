<?php

/**
 * Plugins class
 */
class RaadhuisToolsPlugins
{

    // Initialize functions here, mostly actions and filters.
    public function init()
    {

        // Yoast SEO - Add page number to pagination meta description
        add_filter('wp_title', array($this, 'yoastMetaDescPagination'), 100, 1);
        add_filter('wpseo_metadesc', array($this, 'yoastMetaDescPagination'), 100, 1);
    }

    // Yoast SEO - Add page number to pagination meta description
    public function yoastMetaDescPagination()
    {

        if (is_plugin_active('wordpress-seo/wp-seo.php')) {
            global $page;

            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            ! empty($page) && 1 < $page && $paged = $page;

            $paged > 1 && $s .= ' | ' . sprintf(__('Page: %s'), $paged);

            return $s;
        }
    }
}
