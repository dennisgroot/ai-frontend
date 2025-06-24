<?php get_header(); ?>

<main id="content" class="content search">

    <div class="container">

        <h1 class="h1"><?= __('Zoekresultaten voor: ', 'raadhuis-wp') . the_search_query(); ?></h1>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_id(); ?>" <?php post_class('entry'); ?>>

                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h2>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                </article>

            <?php endwhile;
        else : ?>

            <p>Je zoekterm "<?php the_search_query(); ?>" heeft geen resultaten opgeleverd. Probeer het nogmaals.</p>

        <?php get_search_form();
        endif; ?>

    </div>

</main>

<?php //get_sidebar(); 
?>

<?php get_footer(); ?>