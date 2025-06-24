<?php

/**
 * Vacancies block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'vacancies-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'vacancies wp-block alignfull';

if (!empty($block['class_name'])) {
    $class_name .= ' ' . $block['class_name'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$vacancies_title = get_field('vacancies_title');
$vacancies_text = get_field('vacancies_text');
$vacancies_button_text = get_field('vacancies_button_text');
$vacancies_number = get_field('vacancies_number');

$args_vacatures = array(
    'post_type' => 'vacancies',
    'orderby' => 'date',
    'order' => 'ASC'
);

if ($vacancies_number == 'latest') {
    $args_vacatures['posts_per_page'] = 3;
} else {
    $args_vacatures['posts_per_page'] = -1;
}

$posts_vacatures = get_posts($args_vacatures);

if ($vacancies_button_text) {
    $button = $vacancies_button_text;
} else {
    $button = __('Bekijk de vacature', 'raadhuis');
}

$results = array(); // Lege array om de resultaten op te slaan

foreach ($posts_vacatures as $post) {
    $cpt_vacancies_label = get_field('cpt_vacancies_label', $post->ID);

    if ($cpt_vacancies_label) {
        $label = $cpt_vacancies_label;
    } else {
        $label = '';
    }

    // Voeg het bericht toe aan de resultaten array
    $results[] = array(
        'link' => get_the_permalink($post->ID),
        'title' => $post->post_title,
        'excerpt' => get_custom_excerpt($post->ID, 100),
        'button_text' => $button,
        'label' => $label,
    );
}

?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <?php if ($vacancies_title || $vacancies_text) : ?>
        <div class="row">
            <div class="large-6 column">
                <div class="mb-m">
                    <?php if ($vacancies_title) : ?>
                        <h2 class="vacancies__title"><?= $vacancies_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($vacancies_text) : ?>
                        <div class="vacancies__intro">
                            <?= $vacancies_text; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row small-up-1 medium-up-2 large-up-3 flex-grow">
        <?php if ($results) : foreach ($results as $result) : ?>
                <?php
                $link = $result['link'];
                $title = $result['title'];
                $excerpt = $result['excerpt'];
                $buttonText = $result['button_text'];
                $label = $result['label'];
                ?>

                <div class="column">
                    <a href="<?= $link; ?>" class="card card--event card--white grow">

                        <div class="card__content grow">
                            <div class="card__vacancy-info">
                                <?= $label; ?>
                            </div>
                            <h3 class="card__title"><?= $title; ?></h3>
                            <div class="card__text text-grow">
                                <p><?= $excerpt; ?></p>
                            </div>
                            <div class="card__link"><?= $buttonText; ?></div>
                        </div>
                    </a>
                </div>
        <?php endforeach;
        endif; ?>
    </div>


</section>