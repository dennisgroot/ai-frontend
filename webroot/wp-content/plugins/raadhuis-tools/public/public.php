<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://raadhuis.com
 * @since      1.0.0
 *
 * @package    Raadhuis_Tools
 * @subpackage Raadhuis_Tools/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Raadhuis_Tools
 * @subpackage Raadhuis_Tools/public
 * @author     Raadhuis <online@raadhuis.com>
 */
class Raadhuis_Tools_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'dist/css/public.css', [], $this->version, 'all');

        $show_toolbar = get_option('raadhuis-tools_show_toolbar');
        $user = wp_get_current_user();
        $allowed_roles = array('editor', 'administrator');

        if (is_user_logged_in() && array_intersect($allowed_roles, $user->roles) && $show_toolbar) {
            wp_enqueue_style($this->plugin_name . '-public-tools', plugin_dir_url(__FILE__) . 'dist/css/public-tools.css', [], $this->version, 'all');
        }
    }


    /**
     * Add custom CSS to the login page
     *
     * @since    1.0.0
     */
    public function loginCss()
    {
        wp_enqueue_style($this->plugin_name . '-login', plugin_dir_url(__FILE__) . 'dist/css/login.css', [], $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        $show_toolbar = get_option('raadhuis-tools_show_toolbar');
        $user = wp_get_current_user();
        $allowed_roles = array('editor', 'administrator');

        // All scripts for front-end.
        wp_enqueue_script($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'dist/js/public.js', array('jquery'), $this->version, false);

        // only include the public-tools.js file if show_toolbar is true and the user is logged in with one of the specified roles.
        if (is_user_logged_in() && array_intersect($allowed_roles, $user->roles) && $show_toolbar) {
            wp_enqueue_script($this->plugin_name . '-public-tools', plugin_dir_url(__FILE__) . 'dist/js/public-tools.js', array('jquery'), $this->version, false);
        }
    }

    // Insert head_scripts from the options table into wp_head
    public function loadHeadScripts()
    {
        $head_scripts = get_option('raadhuis-tools_head_scripts');

        if ($head_scripts) {
            echo $head_scripts;
        }
    }

    /**
     * Changing the logo link from wordpress.org to your site
     *
     * @return string Home url
     */
    public function loginUrl()
    {
        return home_url();
    }

    /**
     * Changing the alt text on the logo to show your site name
     *
     * @return string Blogname
     */
    public function loginTitle()
    {
        return get_option('blogname');
    }

    // Insert body_scripts from the options table into wp_head
    public function loadBodyScripts()
    {
        $body_scripts = get_option('raadhuis-tools_body_scripts');

        if ($body_scripts) {
            echo $body_scripts;
        }
    }

    // Insert footer_scripts from the options table into wp_head
    public function loadFooterScripts()
    {
        $footer_scripts = get_option('raadhuis-tools_footer_scripts');

        if ($footer_scripts) {
            echo $footer_scripts;
        }
    }

    public function toolsToolbar()
    {
        $show_toolbar = get_option('raadhuis-tools_show_toolbar');
        $user = wp_get_current_user();
        $allowed_roles = array('editor', 'administrator');

        if (is_user_logged_in() && array_intersect($allowed_roles, $user->roles) && $show_toolbar) :

            echo '<div class="raadhuis-tools-toolbar-container rt-hidden md:!rt-block rt-fixed rt-top-[50%] -rt-translate-y-2/4 rt-right-0 rt-w-14 rt-z-9999 rt-text-center rt-rounded">
				<button aria-label="Open tools" type="button" class="open-toolbar toggle-toolbar rt-absolute rt-w-full rt-top-1/2 rt-right-0 rt-bg-primary rt-text-white rt-p-0 !rt-pt-5 -rt-translate-y-2/4">
					<i class="dashicons dashicons-admin-tools !rt-text-white rt-text-[24px]"></i>
					<div class="rt-w-full rt-mt-5 rt-bg-[#000000] rt-flex rt-items-center rt-justify-center rt-py-3"><img loading="lazy" class="rt-w-7 rt-h-auto" src="' . RAADHUISTOOLS_PLUGIN_URL . 'public/dist/img/logo-raadhuis-white.svg' . '" alt="Raadhuis"></div>
				</button>
		
				<div class="raadhuis-tools-toolbar rt-flex rt-flex-col rt-translate-x-full">';

            if (current_user_can('manage_options')) :
                do_action('raadhuis_tools_toolbar_admin');
            endif;

            do_action('raadhuis_tools_toolbar');

            echo '<button aria-label="Sluit tools" type="button" class="close-toolbar toggle-toolbar rt-bg-[#000000] rt-text-white rt-p-3">
					<i class="dashicons dashicons-no-alt"></i>
					</button>
				</div>
			</div>';

            if (current_user_can('manage_options')) : do_action('raadhuis_tools_toolbar_functions_admin');
            endif;
            do_action('raadhuis_tools_toolbar_functions');

        endif;
    }

    public function toolsSmoothingButton()
    {
        echo '<a aria-label="Font-smoothing" class="raadhuis-tools-smoothing go" href="#" data-tooltip="Font-smoothing inschakelen">
			<i class="dashicons dashicons-editor-bold"></i>
		</a>';
    }


    public function toolsBreakpointsButton()
    {
        echo '<a aria-label="Breakpoints" class="raadhuis-tools-breakpoints go" href="#" data-tooltip="Breakpoints tonen">
			<i class="dashicons dashicons-image-flip-horizontal"></i>
		</a>';
    }

    public function toolsBreakpoints()
    {
        echo '<div id="raadhuis-tools-breakpoints" class="rt-flex rt-w-14 rt-text-center rt-hidden rt-items-center rt-fixed rt-bottom-0 rt-right-0 rt-justify-center rt-py-2 rt-bg-primary rt-text-white rt-text-sm rt-z-9999">
			<span class="sm:!rt-hidden md:!rt-hidden lg:!rt-hidden xl:!rt-hidden rt-font-extrabold">xs</span>
			<span class="!rt-hidden sm:!rt-inline md:!rt-hidden rt-font-extrabold">sm</span>
			<span class="!rt-hidden md:!rt-inline lg:!rt-hidden rt-font-extrabold">md</span>
			<span class="!rt-hidden lg:!rt-inline xl:!rt-hidden rt-font-extrabold">lg</span>
			<span class="!rt-hidden xl:!rt-inline 2xl:!rt-hidden 3xl:!rt-hidden 4xl:!rt-hidden 5xl:!rt-hidden 6xl:!rt-hidden rt-font-extrabold">xl</span>
			<span class="!rt-hidden 2xl:!rt-inline 3xl:!rt-hidden 4xl:!rt-hidden 5xl:!rt-hidden 6xl:!rt-hidden rt-font-extrabold">2xl</span>
			<span class="!rt-hidden 3xl:!rt-inline 4xl:!rt-hidden 5xl:!rt-hidden 6xl:!rt-hidden rt-font-extrabold">3xl</span>
			<span class="!rt-hidden 4xl:!rt-inline 5xl:!rt-hidden 6xl:!rt-hidden rt-font-extrabold">4xl</span>
			<span class="!rt-hidden 5xl:!rt-inline 6xl:!rt-hidden rt-font-extrabold">5xl</span>
			<span class="!rt-hidden 6xl:!rt-inline rt-font-extrabold">6xl</span>
		</div>';
    }

    public function toolsGridButton()
    {
        echo '<a aria-label="Grid" class="raadhuis-tools-grid go" href="#" data-tooltip="Grid tonen">
			<i class="dashicons dashicons-columns"></i>
		</a>';
    }

    public function toolsGrid()
    {
        echo '<div id="raadhuis-tools-grid" class="rt-fixed rt-left-0 rt-hidden rt-top-0 rt-w-screen rt-h-screen rt-z-90 rt-flex rt-flex-row rt-flex-nowrap rt-items-start rt-justify-center rt-select-none rt-pointer-events-none">
			<div class="container rt-h-full rt-w-full">
				<div class="rt-h-full rt-w-full rt-grid rt-grid-cols-12 rt-grid-rows-1 rt-gap-x-4 sm:rt-gap-x-6 2xl:rt-gap-x-10">
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
					<div class="rt-w-full rt-h-full rt-bg-primary rt-bg-opacity-10"></div>
				</div>
			</div>
		</div>';
    }
}
