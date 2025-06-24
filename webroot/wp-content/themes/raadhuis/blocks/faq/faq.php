<?php

/**
 * FAQ block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'faq-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'faq wp-block alignfull';

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
$faq_title = get_field('faq_title');
$faq_text = get_field('faq_text');
$faq_items = get_field('faq_items');
?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <div class="row align-center">
        <div class="column large-8 small-12">
            <div class="mb-m">
                <?php if ($faq_title) : ?><h2 class="faq__title"><?= $faq_title; ?></h2><?php endif; ?>
                <?php if ($faq_text) : ?>
                    <div class="faq__intro">
                        <?= $faq_text; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($faq_items) : ?>
            <div class="column small-12 large-8 faq-items">
                <?php foreach ($faq_items as $faq_items_item) : ?>
                    <?php if ($faq_items_item['faq_items_faq_category']) : ?>
                        <div class="mt-m">
                            <div class="faq__category_title">
                                <h3 class="h4"><?= $faq_items_item['faq_items_faq_category']; ?></h3>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($faq_items_item['faq_items_faq_items']) : ?>
                        <?php foreach ($faq_items_item['faq_items_faq_items'] as $faq_items_item) : ?>
                            <div class="faq__item">
                                <?php if ($faq_items_item['faq_items_faq_question']) : ?>
                                    <div class="faq__question" aria-expanded="false">
                                        <h3 class="h5"><?= $faq_items_item['faq_items_faq_question']; ?></h3>
                                    </div>
                                <?php endif; ?>
                                <?php if ($faq_items_item['faq_items_faq_answer']) : ?>
                                    <div class="faq__answer mb-0"><?= $faq_items_item['faq_items_faq_answer']; ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>