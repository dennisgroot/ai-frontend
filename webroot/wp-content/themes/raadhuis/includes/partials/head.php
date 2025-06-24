<?php
$algemeen_cookiebot_id = get_field('algemeen_cookiebot_id', 'options');
?>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($algemeen_cookiebot_id) : ?>
        <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="<?= $algemeen_cookiebot_id; ?>" data-blockingmode="auto"></script>
    <?php endif; ?>

    <!-- Favicons -->
    <?= get_template_part('includes/partials/favicons'); ?>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>

    <?php get_template_part('includes/partials/gtm-head'); ?>
</head>