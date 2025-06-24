<?php

/**
 * Image Slider block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'slider-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'image-slider wp-block alignfull';

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
$image_slider_title = get_field('image_slider_title');
$image_slider_text = get_field('image_slider_text');
$image_slider_slider = get_field('image_slider_slider');
?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <?php if ($image_slider_title || $block_image_slider_text) : ?>
        <div class="row">
            <div class="small-12 large-6 column">
                <div class="mb-m">
                    <?php if ($image_slider_title) : ?>
                        <h2 class="image-slider__title"><?= $image_slider_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($image_slider_text) : ?>
                        <div class="image-slider__intro"><?= $image_slider_text; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($image_slider_slider) : ?>
        <div class="image-slider__wrapper">
            <?php foreach ($image_slider_slider as $image_slider_slider_slide) : ?>
                <div>
                    <img class="lazyload aspect-ratio-16-9" data-src="<?= $image_slider_slider_slide['image_slider_slider_image']['sizes']['header']; ?>" title="<?= $image_slider_slider_slide['image_slider_slider_image']['title']; ?>" alt="<?= $image_slider_slider_slide['image_slider_slider_image']['alt']; ?>" />
                    <div class="image-slider__caption">
                        <div class="image-slider__content">
                            <?php if ($image_slider_slider_slide['image_slider_slider_title']) : ?>
                                <h3><?= $image_slider_slider_slide['image_slider_slider_title']; ?></h3>
                            <?php endif; ?>
                            <?php if ($image_slider_slider_slide['image_slider_slider_text']) : ?>
                                <?= $image_slider_slider_slide['image_slider_slider_text']; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>