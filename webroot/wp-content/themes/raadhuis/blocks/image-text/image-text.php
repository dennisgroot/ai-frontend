<?php

/**
 * Text met image template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-image-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'image-text wp-block alignfull';

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
$image_text_position_image = get_field('image_text_position_image');
$image_text_title = get_field('image_text_title');
$image_text_text = get_field('image_text_text');
$image_text_image = get_field('image_text_image');
$image_text_button = get_field('image_text_button');

if ($image_text_position_image) {
    if ($image_text_position_image == 'left') {
        $class_name .= ' image-text--image-left';
    }
    if ($image_text_position_image == 'right') {
        $class_name .= ' image-text--image-right';
    }
} else {
    $class_name .= ' image-text--image-left';
}

?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <div class="row align-middle">
        <?php if ($image_text_title || $image_text_text) : ?>
            <div class="column small-12 large-6 image-text__text-col">
                <div class="px-l">
                    <?php if ($image_text_title) : ?>
                        <h2 class="image-text__title"><?= $image_text_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($image_text_text) : ?>
                        <div class="image-text__text fs-large">
                            <?= $image_text_text; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($image_text_button)) : ?>
                        <?php
                        $button_url = $image_text_button['url'] ?? null;
                        $button_title = $image_text_button['title'] ?? null;
                        $button_target = $image_text_button['target'] ?? '_self';
                        ?>
                        <a href="<?= $button_url; ?>" class="button is-style-primary" role="button" target="<?= $button_target; ?>"><?= $button_title; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($image_text_image) : ?>
            <div class="column small-12 large-6 image-text__image-col">
                <img class="image-text__image lazyload aspect-ratio-12-8" data-src="<?= $image_text_image['sizes']['block-horizontal']; ?>" title="<?= $image_text_image['title']; ?>" alt="<?= $image_text_image['alt']; ?>" />
            </div>
        <?php endif; ?>
    </div>
</section>