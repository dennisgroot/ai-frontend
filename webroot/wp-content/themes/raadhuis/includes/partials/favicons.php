<?php $color = '#ffffff'; // Aanpassen naar kleur/logo favicon 
?>

<link rel="apple-touch-icon" sizes="180x180" href="<?= esc_url(get_template_directory_uri()) . '/dist/assets/img/favicons/apple-touch-icon.png'; ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= esc_url(get_template_directory_uri()) . '/dist/assets/img/favicons/favicon-32x32.png'; ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= esc_url(get_template_directory_uri()) . '/dist/assets/img/favicons/favicon-16x16.png'; ?>">
<link rel="mask-icon" href="<?= esc_url(get_template_directory_uri()) . '/dist/assets/img/favicons/safari-pinned-tab.svg'; ?>" color="<?= $color; ?>">
<meta name="msapplication-TileColor" content="<?= $color; ?>">
<meta name="theme-color" content="<?= $color; ?>">