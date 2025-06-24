<?php

/**
 * Story block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'story-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'story wp-block alignfull';

if (!empty($block['class_name'])) {
    $class_name .= ' ' . $block['class_name'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// Load values and assign defaults.
$story_text = get_field('story_text');
$story_button = get_field('story_button');
$story_image = get_field('story_image');
?>
<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <div class="row align-center">
        <div class="small-12 large-10 column">
            <?php if ($story_text) : ?>
                <blockquote class="story__text">“<?= $story_text; ?>”
                    <?php if ($story_button) : ?>
                        <?php
                        $button_url = $story_button['url'] ?? null;
                        $button_title = $story_button['title'] ?? null;
                        $button_target = $story_button['target'] ?? '_self';
                        ?>
                        <a href="<?= $button_url; ?>" class="button story__button" role="button" target="<?= $button_target ?>"><?= $button_title; ?> </a>
                    <?php endif; ?>
                </blockquote>
            <?php endif; ?>

        </div>
    </div>
    <?php if ($story_image) : ?>
        <div class="story__image lazyload aspect-ratio-16-9" data-src="<?= $story_image['sizes']['header']; ?>"></div>
    <?php endif; ?>
</section>