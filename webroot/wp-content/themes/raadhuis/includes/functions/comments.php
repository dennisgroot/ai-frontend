<?php

/**
 * Comments
 */

function raadhuis_comments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class('panel'); ?>>
        <div class="media-object">
            <div class="media-object-section">
                <?= get_avatar($comment, 75); ?>
            </div>
            <div class="media-object-section">
                <article id="comment-<?php comment_ID(); ?>">
                    <header class="comment-author">
                        <?php printf(__('%s', 'raadhuis'), get_comment_author_link()); ?> on
                        <time datetime="<?= comment_time('Y-m-j'); ?>"><a href="<?= htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php comment_time(__('F jS, Y - g:ia', 'raadhuis')); ?> </a></time>
                        <?php edit_comment_link(__('(Bewerken)', 'raadhuis'), '  ', ''); ?>
                    </header>

                    <?php if ($comment->comment_approved == '0'): ?>
                        <div class="alert alert-info">
                            <p><?php _e('Je reactie wacht op moderatie', 'raadhuis') ?></p>
                        </div>
                    <?php endif; ?>

                    <section class="comment-content clearfix">
                        <?php comment_text(); ?>
                    </section>

                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </article>
            </div>
        </div>
    <?php // </li> wordt door WordPress automatisch toegevoegd
}
