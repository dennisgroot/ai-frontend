<?php

/**
 * logo Slider block template.
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
$class_name = 'logo-slider wp-block alignfull';

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
$logo_slider_title = get_field('logo_slider_title');
$logo_slider_text = get_field('logo_slider_text');
$logo_slider_slider = get_field('logo_slider_slider');
?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <?php if ($logo_slider_title || $logo_slider_text) : ?>
        <div class="row">
            <div class="small-12 large-6 column">
                <div class="mb-m">
                    <?php if ($logo_slider_title) : ?>
                        <h2 class="logo-slider__title"><?= $logo_slider_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($logo_slider_text) : ?>
                        <div class="logo-slider__intro">
                            <?= $logo_slider_text; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($logo_slider_slider) : ?>
        <div class="row small-up-1 medium-up-4 large-up-6 align-center logo-slider__wrapper">
            <?php foreach ($logo_slider_slider as $logo_slider_slider_slide) : ?>
                <div class="column">
                    <?php if ($logo_slider_slider_slide['logo_slider_slider_link']) : ?>
                        <?php
                        $logo_slider_slider_slide_link_url = $logo_slider_slider_slide['logo_slider_slider_link']['url'] ?? null;
                        $logo_slider_slider_slide_link_title = $logo_slider_slider_slide['logo_slider_slider_link']['title'] ?? null;
                        $logo_slider_slider_slide_link_target = $logo_slider_slider_slide['logo_slider_slider_link']['target'] ?? '_self';
                        ?>
                        <a
                            href="<?= $logo_slider_slide_link_url; ?>"
                            title="<?= $logo_slider_slider_slide_link_title; ?>"
                            <?php if ($logo_slider_slider_slide['logo_slider_slider_link']['target']) : ?>
                            <?= 'target="' . $logo_slider_slider_slide['logo_slider_slider_link']['target'] . '"'; ?>
                            <?php endif; ?>>
                        <?php endif; ?>
                        <?php if ($logo_slider_slider_slide['logo_slider_slider_image']) : ?>
                            <img src="<?= $logo_slider_slider_slide['logo_slider_slider_image']['sizes']['square']; ?>" alt="<?= $logo_slider_slider_slide['logo_slider_slider_image']['alt']; ?>">
                        <?php endif; ?>
                        <?php if ($logo_slider_slider_slide['logo_slider_slider_link']) : ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>