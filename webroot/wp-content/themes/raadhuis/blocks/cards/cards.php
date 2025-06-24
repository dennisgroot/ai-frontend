<?php

/**
 * Item List block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'item-list-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'item-list wp-block alignfull';

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
$item_list_title = get_field('item_list_title');
$item_list_text = get_field('item_list_text');
$item_list_type = get_field('item_list_type');
$item_list_featured_image = get_field('item_list_featured_image');
$item_list_background_items = get_field('item_list_background_items');
$algemeen_read_more_button = get_field('algemeen_read_more_button', 'options');
$text_button = '';
$display_in_preview = null;

if ($algemeen_read_more_button) {
    $text_button = $algemeen_read_more_button;
} else {
    $text_button = __('Lees meer', 'raadhuis');
}

$item_list_category = '';

$args_posts = array(
    'numberposts' => 3,
    'post_type' => 'post',
    'orderby' => 'date',
    'order'   => 'DESC',
);

if ($item_list_type == 'category') {
    $item_list_category_array = get_field('item_list_category');
    if ($item_list_category_array == false) {
    } else {
        $item_list_category = implode(',', $item_list_category_array);
        $args_posts['category__in'] = $item_list_category;
    }
}

$item_list_posts = get_posts($args_posts);
$item_list_posts_post_data = array();

if ($item_list_posts) {
    foreach ($item_list_posts as $item_list_posts_post) {
        $item_list_posts_post_data[] = array(
            'url' => get_the_permalink($item_list_posts_post),
            'title' => get_the_title($item_list_posts_post),
            'post_thumbnail_url' => get_the_post_thumbnail_url($item_list_posts_post, 'cards'),
            'post_thumbnail_alt' => get_the_post_thumbnail_alt($item_list_posts_post),
            'excerpt' => get_custom_excerpt($item_list_posts_post->ID, 200),
            'read_more_text' => $text_button,
            'post_date' => get_the_date(get_option('date_format'), $item_list_posts_post->ID),
        );
    }
}
?>

<?php if ($item_list_posts_post_data) : ?>
    <section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                    endif; ?>>
        <div class="row">
            <div class="column small-12 large-6">
                <div class="mb-m">
                    <?php if ($item_list_title) : ?><h2 class="item-list__title"><?= $item_list_title; ?></h2><?php endif; ?>
                    <?php if ($item_list_text) : ?><div class="list__intro"><?= $item_list_text; ?></div><?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row small-up-1 medium-up-2 large-up-3 flex-grow">
            <?php foreach ($item_list_posts_post_data as $item_list_posts_post_data_item) : ?>
                <div class="column">
                    <a href="<?= $item_list_posts_post_data_item['url']; ?>" class="card grow <?php if ($item_list_background_items) : echo $item_list_background_items;
                                                                                                else : echo ' card--white';
                                                                                                endif; ?>">
                        <?php if ($item_list_featured_image) : ?>
                            <img class="card__image lazyload aspect-ratio-6-4" data-src="<?= $item_list_posts_post_data_item['post_thumbnail_url']; ?>" alt="<?= $item_list_posts_post_data_item['post_thumbnail_alt']; ?>" />
                        <?php endif; ?>
                        <div class="card__content grow">
                            <div class="card__date"><?= $item_list_posts_post_data_item['post_date']; ?></div>
                            <h3 class="h4 card__title"><?= $item_list_posts_post_data_item['title']; ?></h3>
                            <div class="card__text text-grow">
                                <p><?= $item_list_posts_post_data_item['excerpt']; ?></p>
                            </div>
                            <button class="button card__button"><?= $item_list_posts_post_data_item['read_more_text']; ?></button>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>