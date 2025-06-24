<?php

/**
 * team block template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'team-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "class_name" and "align" values.
$class_name = 'team wp-block alignfull pb-l';

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
$team_title = get_field('team_title');
$team_text = get_field('team_text');
$team_members = get_field('team_members');

?>

<section class="<?= esc_attr($class_name); ?>" <?php if ($id) : echo 'id="' . $id . '"';
                                                endif; ?>>
    <div class="row align-center">
        <div class="small-12 large-6 text-center column">
            <div class="mb-l">
                <?php if ($team_title) : ?>
                    <h2 class="team__title mb-s"><?= $team_title; ?></h2>
                <?php endif; ?>
                <?php if ($team_text) : ?>
                    <div class="team__intro">
                        <?= $team_text; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if ($team_members && is_array($team_members)) : ?>
        <div class="team__slider">
            <?php foreach ($team_members as $team_members_member) : ?>
                <div class="team__slide">
                    <div class="team__item grow text-center">
                        <?php if ($team_members_member['team_member_image']) : ?>
                            <img class="team__image lazyload mb-xs" data-src="<?= $team_members_member['team_member_image']['sizes']['square'] ?>" title="<?= $team_members_member['team_member_image']['title'] ?>" alt="<?= $team_members_member['team_member_image']['alt'] ?>" />
                        <?php endif; ?>
                        <div class="team__content grow pt-l">
                            <?php if ($team_members_member['team_member_name']) : ?>
                                <h3 class="team__name mb-0">
                                    <?= $team_members_member['team_member_name']; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ($team_members_member['team_member_text']) : ?>
                                <div class="team__description grow p-s mb-0">
                                    <?= $team_members_member['team_member_text']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>