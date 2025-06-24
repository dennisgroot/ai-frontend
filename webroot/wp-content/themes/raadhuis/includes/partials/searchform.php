<?php

/**
 * Searchform
 */

?>

<form method="GET" class="search" action="<?= home_url('/'); ?>">
    <input type="search" placeholder="<?= esc_attr_x('Zoeken...', 'raadhuis'); ?>" value="<?= get_search_query() ?>" name="s" title="<?= esc_attr_x('Zoeken naar:', 'raadhuis'); ?>" />
    <input type="submit" value="<?= esc_attr_x('Zoeken', 'raadhuis'); ?>" />
</form>