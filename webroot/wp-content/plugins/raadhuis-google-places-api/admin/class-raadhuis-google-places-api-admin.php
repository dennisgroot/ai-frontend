<?php

class Raadhuis_Google_Places_Api_Admin
{
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'dist/css/admin.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'dist/js/admin.js', array('jquery'), $this->version, false);
    }

    public function register_rh_google_reviews()
    {
        register_post_type(
            'rh-google-reviews',
            array(
                'labels' => array(
                    'name' => __('Google Reviews', TRANSLATION_GROUP),
                    'singular_name' => __('Google Review', TRANSLATION_GROUP),
                    'all_items' => __('Alle reviews', TRANSLATION_GROUP),
                    'add_new' => __('Nieuwe review', TRANSLATION_GROUP),
                    'add_new_item' => __('Voeg nieuwe review toe', TRANSLATION_GROUP),
                    'edit' => __('Wijzig review', TRANSLATION_GROUP),
                    'edit_item' => __('Wijzig review', TRANSLATION_GROUP),
                    'new_item' => __('Voeg nieuwe review toe', TRANSLATION_GROUP),
                    'view_item' => __('Toon review', TRANSLATION_GROUP),
                    'search_items' => __('Zoeken naar reviews', TRANSLATION_GROUP),
                    'not_found' => __('Niets gevonden in de database.', TRANSLATION_GROUP),
                    'not_found_in_trash' => __('Niets gevonden en de prullenbak.', TRANSLATION_GROUP),
                    'parent_item_colon' => '',
                ),
                'description' => 'Een post type voor Google Reviews vanuit de Raadhuis Google Places API plugin.',
                'public' => false,
                'publicly_queryable' => true,
                'exclude_from_search' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_position' => 100,
                'menu_icon' => 'dashicons-google',
                'rewrite' => array(
                    'slug' => 'google-review',
                    'with_front' => false,
                ),
                'has_archive' => false,
                'capability_type' => 'post',
                'capabilities' => array(
                    'create_posts' => 'do_not_allow'
                ),
                'map_meta_cap' => true,
                'hierarchical' => false,
                'show_in_rest' => true,
                'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'page-attributes'),
            )
        );
    }

    public function redirect_rh_google_reviews_to_404()
    {
        if (is_singular('rh-google-reviews')) {
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
            include(get_query_template('404'));
            exit;
        }
    }

    public function add_plugin_admin_menu()
    {
        add_submenu_page(
            'edit.php?post_type=rh-google-reviews',
            __('Instellingen', TRANSLATION_GROUP),
            __('Instellingen', TRANSLATION_GROUP),
            'manage_options',
            'raadhuis-google-places-api-settings',
            array($this, 'display_plugin_admin_settings')
        );

        add_submenu_page(
            'edit.php?post_type=rh-google-reviews',
            __('Gebruik', TRANSLATION_GROUP),
            __('Gebruik', TRANSLATION_GROUP),
            'manage_options',
            'raadhuis-google-places-api-examples',
            array($this, 'display_plugin_examples_page')
        );

        add_submenu_page(
            'edit.php?post_type=rh-google-reviews',
            __('Log', TRANSLATION_GROUP),
            __('Log', TRANSLATION_GROUP),
            'manage_options',
            'raadhuis-google-places-api-log',
            array($this, 'display_plugin_log')
        );
    }

    public function add_fetch_reviews_button_and_data($which)
    {
        if ($which == 'top' && get_current_screen()->post_type == 'rh-google-reviews') {
            $rh_google_reviews_total_count = get_option('rh_google_reviews_total_count', 0);
            $rh_google_reviews_total_score = get_option('rh_google_reviews_total_score', 0);

            echo '<div class="alignleft actions">';
            echo '<div class="flex-row-wrap gap-x-4 items-center justify-start">';
            echo '<button type="button" class="button button-primary" id="fetch-google-places-reviews">Google reviews ophalen</button>';

            // Check if meta: rh_google_reviews_total_count exist and has value:
            if ($rh_google_reviews_total_count) {
                echo "<span>Totaal aantal reviews: $rh_google_reviews_total_count</span>";
            }

            // Check if meta: rh_google_reviews_total_score exist and has value:
            if ($rh_google_reviews_total_score) {
                echo "<span>Gemiddelde scrore: $rh_google_reviews_total_score</span>";
            }
            echo '</div>';
            echo '</div>';
        }
    }

    public function add_reviews_limit_notice($which)
    {
        if ($which == 'bottom' && get_current_screen()->post_type == 'rh-google-reviews') {
            echo '<div class="alignleft actions">';
            echo '<p class="max-review-notice">Let op: Er worden maximaal 5 reviews geladen omdat de Google Places API op dit moment niet meer reviews teruggeeft.</p>';
            echo '</div>';
        }
    }

    public function display_plugin_admin_settings()
    {
?>
        <div class="wrap">
            <h1><?php _e('Raadhuis Google Places API Instellingen', TRANSLATION_GROUP); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('raadhuis_google_places_api_settings_group');
                do_settings_sections('raadhuis-google-places-api-settings');
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }

    public function register_settings()
    {
        register_setting(
            'raadhuis_google_places_api_settings_group',
            'raadhuis_google_places_api_code',
            // array($this, 'sanitize_api_key') // Beveilig deze string
        );

        register_setting(
            'raadhuis_google_places_api_settings_group',
            'raadhuis_google_places_key',
            // array($this, 'sanitize_api_key') // Beveilig deze string
        );

        add_settings_section(
            'raadhuis_google_places_api_settings_section',
            __('API Instellingen', TRANSLATION_GROUP),
            null,
            'raadhuis-google-places-api-settings'
        );

        add_settings_field(
            'raadhuis_google_places_key',
            __('Google Places ID', TRANSLATION_GROUP),
            array($this, 'display_places_key_field'),
            'raadhuis-google-places-api-settings',
            'raadhuis_google_places_api_settings_section'
        );

        add_settings_field(
            'raadhuis_google_places_api_code',
            __('Google API console key', TRANSLATION_GROUP),
            array($this, 'display_api_key_field'),
            'raadhuis-google-places-api-settings',
            'raadhuis_google_places_api_settings_section'
        );
    }

    public function display_places_key_field()
    {
        $places_key = get_option('raadhuis_google_places_key');
        echo '<input type="text" id="raadhuis_google_places_key" name="raadhuis_google_places_key" class="regular-text" value="' . $places_key . '" /><br>';
        echo '<p><small>Zoek de places key van jouw locatie hier: <a target="_blank" href="https://developers.google.com/maps/documentation/places/web-service/place-id#find-id">https://developers.google.com/maps/documentation/places/web-service/place-id#find-id</a></small></p>';
    }

    public function display_api_key_field()
    {
        $api_key = get_option('raadhuis_google_places_api_code');
        echo '<input type="password" id="raadhuis_google_places_api_code" name="raadhuis_google_places_api_code" class="regular-text" value="' . $api_key . '" /><br>';
        echo '<p><small>Maak een API-code aan voor de Google Places API en voeg deze hier toe. Ga hiervoor naar: <a target="_blank" href="https://console.cloud.google.com/">https://console.cloud.google.com/</a></small></p>';
        echo '<p><small><strong>LET OP:</strong> Zorg ervoor dat je jouw API-key IP-adres restricties meegeeft die deze API-key mogen bereiken. Anders werkt deze API niet. Ook is dit is handig om misbruik en een eventuele hoge rekening te voorkomen.</small></p>';
        echo '<p><small>Voor meer info, zie: <a target="_blank" href="https://developers.google.com/maps/documentation/places/web-service/get-api-key">https://developers.google.com/maps/documentation/places/web-service/get-api-key</a> of bel Raadhuis voor advies.</small></p>';
    }

    public function pr($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }

    private function update_log($message)
    {
        // Haal de huidige log op
        $log = get_option('rh_google_reviews_log', array());

        // Voeg de datum toe aan het bericht
        $date = date_i18n('Y-m-d H:i:s');
        $log_entry = "$date - $message";

        // Voeg de nieuwe log entry toe aan de log
        $log[] = $log_entry;

        // Sla de bijgewerkte log op
        update_option('rh_google_reviews_log', $log);
    }

    public function clear_debug_log()
    {
        update_option('rh_google_reviews_log', []);
        echo json_encode(['status' => 'success', 'message' => 'Log geleegd.']);
        exit;
    }

    public function fetch_google_places_reviews()
    {
        $places_key = get_option('raadhuis_google_places_key');
        $api_key = get_option('raadhuis_google_places_api_code');
        $fields = 'reviews,rating,user_ratings_total';

        if (empty($api_key)) {
            $message = 'Fout: Google places key ontbreekt binnen instellingen.';
            $this->update_log($message);
            echo json_encode(['error' => $message]);
            wp_die();
        }

        if (empty($places_key)) {
            $message = 'Google API key ontbreekt binnen instellingen.';
            $this->update_log($message);
            echo json_encode(['error' => $message]);
            wp_die();
        }

        // Controleer of WPML of Polylang actief is en haal de actieve talen op
        if (defined('ICL_SITEPRESS_VERSION')) {
            $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
        } elseif (function_exists('pll_languages_list')) {
            $languages = pll_languages_list(['fields' => 'slug']);
        } else {
            $languages = ['nl' => ''];
        }

        $all_reviews = [];
        $total_user_ratings = 0;
        $total_rating = 0;
        $language_count = count($languages);

        foreach ($languages as $lang_code) {
            $lang_query = '&language=' . $lang_code;
            $url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $places_key . '&key=' . $api_key . '&fields=' . $fields . '&reviews_no_translations=true&translated=false' . $lang_query;

            $response = wp_remote_get($url);

            if (is_wp_error($response)) {
                $this->update_log('Fout: ' . $response->get_error_message());
                echo json_encode(['error' => $response->get_error_message()]);
                wp_die();
            }

            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            if (isset($data['error_message'])) {
                $this->update_log('Fout: ' . $data['error_message']);
                echo json_encode(['error' => $data['error_message']]);
                wp_die();
            }

            if (isset($data['result']['user_ratings_total'])) {
                $total_user_ratings += $data['result']['user_ratings_total'];
            }

            if (isset($data['result']['rating'])) {
                $total_rating += $data['result']['rating'];
            }

            if (isset($data['result']['reviews'])) {
                $all_reviews = array_merge($all_reviews, $data['result']['reviews']);
            }
        }

        // Update total review count
        if ($total_user_ratings) {
            update_option('rh_google_reviews_total_count', $total_user_ratings);
            $this->update_log('Succes: Totaal review aantal bijgewerkt.');
        }

        // Update total review score
        if ($total_rating) {
            $average_rating = $total_rating / $language_count;
            update_option('rh_google_reviews_total_score', $average_rating);
            $this->update_log('Succes: Totale review score bijgewerkt.');
        }

        if (!empty($all_reviews)) {
            // Create WordPress posts from reviews
            $this->save_reviews_as_posts($all_reviews);

            $this->update_log('Succes: Google Places data succesvol opgehaald.');

            echo json_encode($all_reviews);
            wp_die();
        }

        $this->update_log('Fout: Geen reviews gevonden in de response.');
        echo json_encode(['error' => 'Geen reviews gevonden in de response.']);
        wp_die();
    }

    // Add the custom columns to the book post type:
    public function set_custom_edit_rh_google_reviews_columns($columns)
    {
        // unset($columns['author']);
        $columns['language'] = __('Taal', TRANSLATION_GROUP);
        $columns['rating'] = __('Beoordeling', TRANSLATION_GROUP);
        $columns['type'] = __('Bron', TRANSLATION_GROUP);

        return $columns;
    }

    public function renderStarRating($rating, $maxRating = 5)
    {
        $rating = $rating <= $maxRating ? $rating : $maxRating;

        $fullStar = '<svg class="review-star review-star-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>';
        $halfStar = '<svg class="review-star review-star-half" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 376.4l.1-.1 26.4 14.1 85.2 45.5-16.5-97.6-4.8-28.7 20.7-20.5 70.1-69.3-96.1-14.2-29.3-4.3-12.9-26.6L288.1 86.9l-.1 .3 0 289.2zm175.1 98.3c2 12-3 24.2-12.9 31.3s-23 8-33.8 2.3L288.1 439.8 159.8 508.3C149 514 135.9 513.1 126 506s-14.9-19.3-12.9-31.3L137.8 329 33.6 225.9c-8.6-8.5-11.7-21.2-7.9-32.7s13.7-19.9 25.7-21.7L195 150.3 259.4 18c5.4-11 16.5-18 28.8-18s23.4 7 28.8 18l64.3 132.3 143.6 21.2c12 1.8 22 10.2 25.7 21.7s.7 24.2-7.9 32.7L438.5 329l24.6 145.7z"/></svg>';
        $emptyStar = '<svg class="review-star review-star-empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>';

        $fullStarCount = (int) $rating;
        $halfStarCount = ceil($rating) - $fullStarCount;
        $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

        $stars = str_repeat($fullStar, $fullStarCount);
        $stars .= str_repeat($halfStar, $halfStarCount);
        $stars .= str_repeat($emptyStar, $emptyStarCount);

        return $stars;
    }

    // Add the data to the custom columns for the book post type:
    public function custom_rh_google_reviews_column($column, $post_id)
    {
        switch ($column) {

            case 'language':
                $value = get_post_meta($post_id, 'review_language', true) ?? false;
                if ($value) {
                    $flag = $value == 'en' ? 'gb' : $value;
                    echo "<img style='display:inline-block;width:20px;height:12px;margin-right:4px;vertical-align:baseline;object-fit:cover;object-possition:center;' src='https://flagcdn.com/$flag.svg' width='30' alt=''>";
                    echo strtoupper($value);
                } else {
                    echo "<img style='display:inline-block;width:20px;height:12px;margin-right:4px;vertical-align:baseline;object-fit:cover;object-possition:center;' src='https://flagcdn.com/nl.svg' width='30' alt=''>";
                    echo 'NL';
                }
                break;

            case 'rating':
                $value = get_post_meta($post_id, 'review_rating', true) ?? false;

                if (!$value) {
                    echo 'Geen beoordeling';
                    break;
                }

                $stars = $this->renderStarRating($value);
                echo "<span class='star_rating'>$stars ($value)</span>";
                break;

            case 'type':
                $value = get_post_meta($post_id, 'review_type', true) ?? false;

                if ($value) {
                    $review_author_url = get_post_meta($post_id, 'review_author_url', true);
                    $value = ucfirst($value);
                    echo "<a href='$review_author_url'>$value</a>";
                } else {
                    echo 'Custom';
                }
                break;
        }
    }

    private function save_reviews_as_posts($reviews)
    {

        foreach ($reviews as $key => $review) {
            $author_name = wp_strip_all_tags($review['author_name']);
            $post_data = array(
                'post_type' => 'rh-google-reviews',
                'post_title' => $author_name,
                'post_content' => $review['text'],
                'post_status' => 'draft',
            );

            $post_found = get_posts(
                array(
                    'post_type'   => 'rh-google-reviews',
                    'title'       => $author_name,
                    'post_status' => 'any',
                    'numberposts' => 1,
                )
            );

            // Check if review already exists
            if (!$post_found) {
                $post_id = wp_insert_post($post_data);

                if ($post_id) {
                    add_post_meta($post_id, 'review_id', $review['review_id'], true);
                    add_post_meta($post_id, 'review_type', 'google', true);

                    // Add all review data to post_meta with prefix "review_"
                    foreach ($review as $meta_key => $meta_value) {
                        add_post_meta($post_id, 'review_' . $meta_key, $meta_value, true);
                    }
                }
            }
        }
    }

    public function display_plugin_log()
    {
        $log = get_option('rh_google_reviews_log', [])
    ?>
        <div class="wrap">
            <h1><?php _e('Debug log', TRANSLATION_GROUP); ?></h1>
            <p><?php _e('Hier vind je een log van de laatst uitgevoerde plugin acties.', TRANSLATION_GROUP); ?></p>
            <p><button type="button" class="button button-danger" id="clear-log">Log legen</button></p>
            <code style="white-space: pre-line; padding: 0; margin: 0;"><?php foreach ($log as $key => $item) : ?><span><?= $item . '<br>'; ?></span><?php endforeach; ?></code>
        </div>
    <?php }

    public function display_plugin_examples_page()
    {
    ?>
        <div class="wrap">
            <h1><?php _e('Gebruik', TRANSLATION_GROUP); ?></h1>
            <h2><?php _e('Optie 1 - Shortcode gebruiken:', TRANSLATION_GROUP); ?></h2>
            <p><?php _e('Gebruik onderstaande shortcode op een pagina om de reviews als slider te tonen. Op desktop 3 naast elkaar, op mobiel 1 review zichtbaar.', TRANSLATION_GROUP); ?></p>
            <code>[rh-google-reviews]</code><br><br>
            <hr>
            <h2><?php _e('Optie 2 - Front-end zelf opbouwen:', TRANSLATION_GROUP); ?></h2>
            <h4><?php _e('WP_Query voor het post type', TRANSLATION_GROUP); ?></h4>
            <code>$placesApi = new Raadhuis_Google_Places_Api_Public();</code><br>
            <code>$googleReviewQuery = $placesApi->get_reviews_query(); // $language en $limit zijn optioneel.</code>

            <h4><?php _e('Sterren weergeven', TRANSLATION_GROUP); ?></h4>
            <p><?php _e('Met onderstaande functie kun de score omzetten in SVG sterren binnen de WP_Query loop. Deze dienen nog wel CSS styling mee te krijgen.', TRANSLATION_GROUP); ?></p>
            <code>$placesApi = new Raadhuis_Google_Places_Api_Public();</code><br>
            <code>$rating = get_field('review_rating');</code><br>
            <code>$stars = $placesApi->renderStarRating($rating);</code>

            <h4><?php _e('Totalen ophalen', TRANSLATION_GROUP); ?></h4>
            <p><?php _e('Met onderstaande code kun je de totale hoeveelheid reviews en totale score ophalen.', TRANSLATION_GROUP); ?></p>
            <code>$total_count = get_option('rh_google_reviews_total_count', 0);</code><br>
            <code>$total_score = get_option('rh_google_reviews_total_score', 0);</code>

        </div>
<?php
    }
}
