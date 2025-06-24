<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly

get_header(); ?>

<main id="content" class="main main-archive">

    <div class="container">
        <h1 class="archive-title">
            <?php single_cat_title(); ?>
        </h1>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="container">
                <?php get_template_part('includes/partials/articles/article', 'post'); ?>
            </div>

        <?php endwhile;
    else : ?>

        <div class="container">
            <p><?= __('Geen posts gevonden.', 'raadhuis-wp'); ?></p>
        </div>

    <?php endif; ?>

</main>

<?php //get_sidebar(); 
?>

<?php get_footer(); ?>