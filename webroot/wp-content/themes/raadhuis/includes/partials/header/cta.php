<?php
$page_for_posts = get_option('page_for_posts');

$pageID = get_the_ID();

if ($page_for_posts == $pageID) {
    $pageID = $page_for_posts;
}
$header_call_to_action = get_field('header_call_to_action', $pageID);
?>
<?php if ($header_call_to_action && $header_call_to_action['header_call_to_action_show_cta']) : ?>
    <div class="small-12 large-4 large-offset-3 column">
        <?php if ($header_call_to_action['header_call_to_action_link']) : ?>
            <a href="<?= $header_call_to_action['header_call_to_action_link']['url']; ?>" <?php if ($header_call_to_action['header_call_to_action_link']['target']) : echo 'target="' . $header_call_to_action['header_call_to_action_link']['target'] . '"';
                                                                                            endif; ?> class="header__cta r-p-m r-mb-xl border-white round-medium text-white">
            <?php else : ?>
                <span class="header__cta r-p-m r-mb-xl border-white round-medium text-white">
                <?php endif; ?>
                <?php if ($header_call_to_action['header_call_to_action_title']) : ?>
                    <h4><?= $header_call_to_action['header_call_to_action_title']; ?></h4>
                <?php endif; ?>
                <?php if ($header_call_to_action['header_call_to_action_text']) : ?>
                    <p class="m-0"><?= $header_call_to_action['header_call_to_action_text']; ?> </p>
                <?php endif; ?>
                </span>
            </a>
    </div>
<?php endif; ?>