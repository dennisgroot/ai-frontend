<?php get_header(); ?>

<main id="content" class="main main-<?= get_post_type() ?>">
    <div class="container">

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('includes/partials/articles/article', 'post'); ?>

            <?php endwhile; ?>

        <?php else : ?>

            <p><?= __('Geen posts gevonden.', 'raadhuis-wp') ?></p>

        <?php endif; ?>

    </div>
</main>

<?php //get_sidebar(); 
?>

<?php get_footer(); ?>