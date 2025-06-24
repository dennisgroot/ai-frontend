<?php

$algemeen_header_cta_button = get_field('algemeen_header_cta_button', 'options');
$algemeen_logo = get_field('algemeen_logo', 'options');
$algemeen_search = get_field('algemeen_search', 'options');
$toon_taalswitcher = get_field('toon_taalswitcher', 'options');

?>

<a class="skip-link" href="#content"><?= __('Spring naar de inhoud', 'raadhuis'); ?></a>

<nav class="nav nav--center" aria-label="header menu">
    <a href="<?= get_home_url(); ?>" class="nav__logo" title="<?= __('Terug naar homepagina', 'raadhuis'); ?>" rel="home">
        <?php if ($algemeen_logo && $algemeen_logo['algemeen_logo_header_logo']) : ?>
            <img src="<?= $algemeen_logo['algemeen_logo_header_logo']['url']; ?>" alt="Logo <?= get_option('blogname'); ?>">
        <?php else : ?>
            <img src="<?= get_stylesheet_directory_uri(); ?>/dist/assets/img/logo-white.svg" alt="Logo <?= get_option('blogname'); ?>">
        <?php endif; ?>
    </a>

    <div class="nav__menu" id="mainmenu" aria-labelledby="menutrigger">
        <?php raadhuis_nav_main(); ?>
    </div>

    <div class="nav__right">
        <?php if ($algemeen_search) : ?>
            <button href="#" class="nav__search-button" aria-expanded="false" aria-controls="nav__search"></button>
        <?php endif; ?>
        <?php
        if (is_plugin_active('sitepress-multilingual-cms/sitepress.php') && $toon_taalswitcher) :
            raadhuis_lang_switcher();
        endif; ?>
        <?php if ($algemeen_header_cta_button) : ?>
            <a href="<?= $algemeen_header_cta_button['url']; ?>" class="btn btn-primary m-0" role="menuitem">
                <?= $algemeen_header_cta_button['title']; ?>
            </a>
        <?php endif; ?>
    </div>

    <?php if ($algemeen_search) : ?>
        <div class="nav__search">
            <?php get_template_part('includes/partials/searchform'); ?>
        </div>
    <?php endif; ?>

    <button id="menutrigger" class="nav__button hide-for-large" role="button" aria-expanded="false" aria-haspopup="true" aria-controls="mainmenu"><?= __('Menu', 'raadhuis'); ?></button>
</nav>