<?php

// Get Google reviews
$placesApi = new Raadhuis_Google_Places_Api_Public();
// $reviews = $placesApi->get_reviews_query();
$google_total_count = get_option('rh_google_reviews_total_count', 0);
$google_total_score = get_option('rh_google_reviews_total_score', 0);

get_header(); ?>

<div class="logo-wrapper">
    <div class="stars">
        <?= $placesApi->renderStarRating($google_total_score, 5); ?>
    </div>
    <div class="rating"><strong><?= $google_total_score ?>/5.0</strong> - <?= $google_total_count ?> <?= __('reviews', 'raadhuis'); ?></div>
</div>

<?= the_content(); ?>
<?php get_footer(); ?>