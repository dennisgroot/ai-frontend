<?php

/**
 * Gallery block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'gallery-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'gallery wp-block alignfull';

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
$gallery_title = get_field('gallery_title');
$gallery_text = get_field('gallery_text');
$gallery_images = get_field('gallery_images');
$gallery_id = "gallery-" . uniqid();
?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <?php if ($gallery_title || $gallery_text) : ?>
        <div class="row">
            <div class="small-12 large-6 column">
                <div class="mb-m">
                    <?php if ($gallery_title) : ?><h2 class="gallery__title"><?= $gallery_title; ?></h2><?php endif; ?>
                    <?php if ($gallery_text) : ?><div class="gallery__intro"><?= $gallery_text; ?></div><?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($gallery_images) : ?>
        <div class="row">
            <div class="small-12 column">
                <div class="gallery__container">
                    <?php foreach ($gallery_images as $gallery_images_image) : ?>
                        <a data-fancybox="gallery-<?= $gallery_id; ?>" data-caption="<?= $gallery_images_image['gallery_image']['caption']; ?>" href="<?= $gallery_images_image['gallery_image']['sizes']['header']; ?>">
                            <img class="lazyload aspect-ratio-12-8" data-src="<?= $gallery_images_image['gallery_image']['sizes']['block-horizontal']; ?>" title="<?= $gallery_images_image['gallery_image']['title']; ?>" alt="<?= $gallery_images_image['gallery_image']['alt']; ?>" />
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>