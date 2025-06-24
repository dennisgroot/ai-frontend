<?php

/**
 * Video block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'video-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'video wp-block alignfull';

if (!empty($block['class_name'])) {
    $class_name .= ' ' . $block['class_name'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$algemeen_cookiebot_id = get_field('algemeen_cookiebot_id', 'options');
$video_id = get_field('video_id');
$video_title = get_field('video_title');
$video_text = get_field('video_text');
?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <?php if ($video_title || $video_text) : ?>
        <div class="row align-center">
            <div class="column small-12 large-8">
                <div class="mb-m">
                    <?php if ($video_title) : ?>
                        <h2 class="video__title"><?= $video_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($video_text) : ?>
                        <div class="video__intro">
                            <?= $video_text; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row align-center">
        <?php if ($video_id) : ?>
            <div class="column small-12 large-8">
                <?php if ($algemeen_cookiebot_id) : ?><div class="cookieconsent-optin-marketing"><?php endif; ?>
                    <?php if (onlyNumbers($video_id)) : ?>
                        <div class="player aspect-ratio-16-9" data-plyr-provider="vimeo" data-plyr-embed-id="<?= $video_id; ?>" loading="lazy"></div>
                    <?php else : ?>
                        <div class="player aspect-ratio-16-9" data-plyr-provider="youtube" data-plyr-embed-id="<?= $video_id; ?>" loading="lazy"></div>
                    <?php endif; ?>
                    <?php if ($algemeen_cookiebot_id) : ?>
                    </div><?php endif; ?>
            </div>
            <?php if ($algemeen_cookiebot_id) : ?>
                <div class="cookieconsent-optout-marketing">
                    <?= __('Accepteer marketing cookies om deze inhoud te tonen.', 'raadhuis'); ?>
                    <a href="javascript: Cookiebot.renew()"><?= __('Accepteer marketing cookies', 'raadhuis'); ?></a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>