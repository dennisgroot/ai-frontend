<div class="menu-mobile hide-for-large">
    <div class="menu-mobile-wrapper">
        <span class="menu-mobile-close" id="menu-mobile-close">&times;</span>

        <?php if (has_nav_menu('main_menu')) : ?>
            <nav class="navigation main_menu">
                <ul>
                    <li class="menu-item">
                        <a href="<?= home_url(); ?>"><img src="<?= esc_url(get_template_directory_uri()) . '/dist/img/home.svg'; ?>" alt="home" title="Terug naar de homepage" /></a>
                    </li>
                    <?php wp_nav_menu(array('theme_location' => 'main_menu', 'items_wrap' => '%3$s', 'container' => false, 'show_home' => true)); ?>
                </ul>
            </nav>
        <?php endif; ?>

        <?php if (has_nav_menu('top_menu')) : ?>
            <nav class="navigation top_menu">
                <?php wp_nav_menu(array('theme_location' => 'top_menu', 'items_wrap' => '<ul>%3$s</ul>', 'container' => false, 'show_home' => true)); ?>
            </nav>
        <?php endif; ?>

    </div>
</div>