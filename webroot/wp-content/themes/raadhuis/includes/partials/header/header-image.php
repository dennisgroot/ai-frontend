<?php
$page_for_posts = get_option('page_for_posts');
$pageID = get_the_ID();

if ($page_for_posts == $pageID) {
    $pageID = $page_for_posts;
}
$header_background_mobile = get_field('header_background_mobile', $pageID);
?>
<?php if ($header_background_mobile || get_the_post_thumbnail_url()) : ?>
    <picture>
        <?php if ($header_background_mobile) : ?>
            <source media="(max-width: 768px)" srcset="<?= $header_background_mobile['sizes']['block-vertical']; ?>">
        <?php endif; ?>
        <?php if (get_the_post_thumbnail()) : ?>
            <source media="(min-width: 769px)" srcset="<?= get_the_post_thumbnail_url(get_the_ID(), 'header'); ?>">
            <img loading="lazy" class="header__image" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'header'); ?>" alt="<?= get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true); ?>">
        <?php endif; ?>
    </picture>
<?php endif; ?>