<?php

/**
 * News block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'news-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'news wp-block alignfull';

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

// Get fields
$news_title = get_field('news_title');
$news_text = get_field('news_text');
$news_button_text = get_field('news_button_text');

// Load values and assign defaults.
$sticky = get_option('sticky_posts');
$post_type = 'post';
$postsLargeID = array();
$postsLarge = '';

if ($sticky) :
    $argsSticky = array(
        'post_type' => $post_type,
        'numberposts' => 1,
        'post__in' => $sticky,
        'orderby' => 'date',
        'order'   => 'DESC'
    );

    $postsSticky = get_posts($argsSticky);
endif;

if (!$sticky) :
    $argsLarge = array(
        'post_type' => $post_type,
        'numberposts' => 1,
        'ignore_sticky_posts' => 1,
        'post__not_in' => $sticky,
        'orderby' => 'date',
        'order'   => 'DESC'
    );
    $postsLarge = get_posts($argsLarge);


    if ($postsLarge) {
        foreach ($postsLarge as $postsLargeItem) {
            $postsLargeID[] = $postsLargeItem->ID;
        }
    }

endif;
$post_not_in = array_merge($sticky, $postsLargeID);


$args = array(
    'post_type' => 'post',
    'numberposts' => 3,
    'post__not_in' => $post_not_in,
    'orderby' => 'date',
    'order'   => 'DESC'
);
$news_list_posts = get_posts($args);
$news_list_posts_post_data_sticky = array();
$news_list_posts_post_data_large = array();
$news_list_posts_post_data = array();

if ($sticky && $postsSticky) {
    foreach ($postsSticky as $postsSticky_post) {
        $news_list_posts_post_data_sticky[] = array(
            'url' => get_the_permalink($postsSticky_post->ID),
            'title' => get_the_title($postsSticky_post->ID),
            'post_thumbnail_url' => get_the_post_thumbnail_url($postsSticky_post->ID, 'cards'),
            'post_thumbnail_alt' => get_the_post_thumbnail_alt($postsSticky_post->ID),
            'date' => get_the_date('d F Y', $postsSticky_post->ID),
        );
    }
}

if ($postsLarge) {
    foreach ($postsLarge as $postsLarge_post) {
        $news_list_posts_post_data_large[] = array(
            'url' => get_the_permalink($postsLarge_post->ID),
            'title' => get_the_title($postsLarge_post->ID),
            'post_thumbnail_url' => get_the_post_thumbnail_url($postsLarge_post->ID, 'cards'),
            'post_thumbnail_alt' => get_the_post_thumbnail_alt($postsLarge_post->ID),
            'date' => get_the_date('d F Y', $postsLarge_post->ID),
        );
    }
}

if ($news_list_posts) {
    foreach ($news_list_posts as $news_list_posts_item) {
        $news_list_posts_post_data[] = array(
            'url' => get_the_permalink($news_list_posts_item),
            'title' => get_the_title($news_list_posts_item),
            'post_thumbnail_url' => get_the_post_thumbnail_url($news_list_posts_item, 'cards'),
            'post_thumbnail_alt' => get_the_post_thumbnail_alt($news_list_posts_item),
            'date' => get_the_date('d F Y', $news_list_posts_item->ID),
        );
    }
}
?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <div class="row">
        <div class="small-12 large-6 column">
            <div class="mb-m">
                <?php if ($news_title) : ?><h2 class="news__title"><?= $news_title; ?></h2><?php endif; ?>
                <?php if ($news_text) : ?><div class="news__intro"><?= $news_text; ?></div><?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row news-list small-up-1 large-up-2">
        <div class="column relative">
            <?php if ($sticky && $postsSticky) : ?>
                <?php foreach ($news_list_posts_post_data_sticky as $news_list_posts_item) : ?>
                    <a href="<?= $news_list_posts_item['url']; ?>" title="<?= $news_list_posts_item['title']; ?>" class="news__item-big">
                        <div class="news__container lazyload  aspect-ratio-12-8" data-src="<?= $news_list_posts_item['post_thumbnail_url']; ?>" style="background: url(<?= $news_list_posts_item['post_thumbnail_url']; ?>)">
                            <div class="news__content p-m text-white">
                                <div class="news__date text-white mb-xs"><?= $news_list_posts_item['date']; ?></div>
                                <h3 class="text-white m-0"><?= $news_list_posts_item['title']; ?></h3>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ($news_list_posts_post_data_large as $news_list_posts_post_data_large) : ?>
                    <a href="<?= $news_list_posts_post_data_large['url']; ?>" title="<?= $news_list_posts_post_data_large['title']; ?>" class="news__item-big">
                        <div class="news__container lazyload  aspect-ratio-12-8" data-src="<?= $news_list_posts_post_data_large['post_thumbnail_url']; ?>" style="background: url(<?= $news_list_posts_post_data_large['post_thumbnail_url']; ?>)">
                            <div class="news__content p-m text-white">
                                <div class="news__date text-white mb-xs"><?= $news_list_posts_post_data_large['date']; ?></div>
                                <h3 class="text-white m-0"><?= $news_list_posts_post_data_large['title']; ?></h3>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if ($news_list_posts_post_data) : ?>
            <div class="column">
                <?php foreach ($news_list_posts_post_data as $news_list_posts_post_data_item) : ?>
                    <a href="<?= $news_list_posts_post_data_item['url']; ?>" title="<?= $news_list_posts_post_data_item['title']; ?>" class="news__item-small no-decoration">
                        <div class="row collapse">
                            <div class="column small-8 medium-8">
                                <div class="news__content p-m">
                                    <div class="news__date mb-xs"><?= $news_list_posts_post_data_item['date']; ?></div>
                                    <h3 class="h4 m-0"><?= $news_list_posts_post_data_item['title']; ?></h3>
                                </div>
                            </div>
                            <div class="column small-4 medium-4 text-center pr-0">
                                <div class="news__image-container">
                                    <div class="news__image lazyload aspect-ratio-6-4" data-src="<?= $news_list_posts_post_data_item['post_thumbnail_url']; ?>" alt="<?= $news_list_posts_post_data_item['post_thumbnail_alt']; ?>" />
                                </div>
                            </div>
                        </div>
            </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</div>
<?php if (get_option('page_for_posts')) : ?>
    <div class="row">
        <div class="column py-m text-right">
            <a href="<?= get_the_permalink(get_option('page_for_posts')); ?>" class="button" role="button"><?php if ($news_button_text) : echo $news_button_text;
                                                                                                                else : echo __('Bekijk al het nieuws', 'raadhuis');
                                                                                                                endif; ?></a>
        </div>
    </div>
<?php endif; ?>
</section>