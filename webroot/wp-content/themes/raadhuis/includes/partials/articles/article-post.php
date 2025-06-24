<?php
$class = 'flex flex-col bg-white px-4 py-8 sm:px-6 lg:p-10 rounded';
$class .= !empty($args['class']) ? ' ' . $args['class'] : '';
?>

<article data-partial="<?= basename(__FILE__, '.php'); ?>" id="post-<?php the_id(); ?>" class="<?= $class; ?>" role="article">
    <div class="inner">
        <?php the_title(); ?>
        <?php the_content(); ?>
    </div>
</article>