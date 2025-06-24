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
$id = 'download-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'download wp-block alignfull';

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
$download_title = get_field('download_title');
$download_text = get_field('download_text');
$download_files = get_field('download_files');
?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <?php if ($download_title || $download_text) : ?>
        <div class="row">
            <div class="large-6 column">
                <div class="mb-m">
                    <?php if ($download_title) : ?>
                        <h2><?= $download_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($download_text) : ?>
                        <?= $download_text; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($download_files) : ?>
        <div class="row small-up-1 medium-up-2 large-up-3 flex-grow">
            <?php foreach ($download_files as $download_files_file) : ?>
                <div class="column">
                    <div class="buttons">
                        <?php if ($download_files_file['download_files_description']) : ?>
                            <div class="mb-xs">
                                <p><?= $download_files_file['download_files_description']; ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($download_files_file['download_files_file']['url']) : ?>
                            <a href="<?= $download_files_file['download_files_file']['url']; ?>" class="button is-style-download" role="button"><?= $download_files_file['download_files_file']['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>