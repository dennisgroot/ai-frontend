<?php

/**
 * Download block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'events-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'events wp-block alignfull';

if (!empty($block['class_name'])) {
    $class_name .= ' ' . $block['class_name'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
if (!empty($block['className'])) {
    $strip_class_name = str_replace('is-style-', '', $block['className']);
    $class_name .= ' ' . $strip_class_name;
}

// Load values and assign defaults.
$events_title = get_field('events_title');
$events_text = get_field('events_text');
$events_read_more_text = get_field('events_read_more_text');

if ($events_read_more_text) {
    $events_read_more_text = $events_read_more_text;
} else {
    $events_read_more_text = __('Bekijk het evenement', 'raadhuis');
}

$now = date_i18n('Y-m-d H:i:s');
$args_events = array(
    'post_type' => 'events',
    'showposts' => -1,
    'suppress_filters' => false,
    'meta_key' => 'cpt_events_date',
    'orderby' => 'meta_value',
    'order'    => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'cpt_events_date'
        ),
        array(
            'key' => 'cpt_events_date',
            'value' => $now,
            'compare' => '>='
        )
    )
);

$events_posts = get_posts($args_events);
$events_posts_post_data = array();
if ($events_posts) {
    foreach ($events_posts as $events_posts_post) {
        $events_posts_post_data[] = array(
            'url' => get_the_permalink($events_posts_post),
            'title' => get_the_title($events_posts_post),
            'post_thumbnail_url' => get_the_post_thumbnail_url($events_posts_post, 'cards'),
            'post_thumbnail_alt' => get_the_post_thumbnail_alt($events_posts_post),
            'excerpt' => get_custom_excerpt($events_posts_post->ID, 200),
            'event_date' => get_field('cpt_events_date', $events_posts_post->ID),
            'read_more_text' => $events_read_more_text,
        );
    }
}

?>

<?php if ($events_posts_post_data) : ?>
    <section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                    endif; ?>>
        <div class="row">
            <div class="large-6 column">
                <div class="mb-m">
                    <?php if ($events_title) : ?>
                        <h2 class="events__title"><?= $events_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($events_text) : ?>
                        <div class="events__intro">
                            <?= $events_text; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row small-up-1 medium-up-2 large-up-3 flex-grow">
            <?php foreach ($events_posts_post_data as $events_posts_post_data_item): ?>
                <div class="column">
                    <a href="<?= $events_posts_post_data_item['url']; ?>" class="card card--event card--white grow">
                        <div class="card__image-wrapper">
                            <img class="card__image lazyload aspect-ratio-6-4" data-src="<?= $events_posts_post_data_item['post_thumbnail_url']; ?>" title="#" alt="<?= $events_posts_post_data_item['post_thumbnail_alt']; ?>" />
                            <div class="card__event-date">
                                <?= $events_posts_post_data_item['event_date']; ?>
                            </div>
                        </div>
                        <div class="card__content grow">
                            <h4 class="card__title"><?= $events_posts_post_data_item['title']; ?></h4>
                            <div class="card__text text-grow">
                                <p><?= $events_posts_post_data_item['excerpt']; ?></p>
                            </div>
                            <div class="card__link">
                                <?= $events_posts_post_data_item['read_more_text']; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>