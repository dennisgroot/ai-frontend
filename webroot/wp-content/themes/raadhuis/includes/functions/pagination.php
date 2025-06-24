<?php

function raadhuis_pagination($q = '', $show_total = false)
{
    global $wp_query;

    if (!empty($q)) {
        $query = $q;
    } else {
        $query = $wp_query;
    }

    $showed = 0;
    $total = 0;
    $showed = $query->post_count;
    $total = $query->found_posts;

    $big = 999999999; // This needs to be an unlikely integer
    $paginate_links = paginate_links(array(
        'base' => str_replace($big, '%#%', html_entity_decode(get_pagenum_link($big))),
        'current' => max(1, get_query_var('paged')),
        'total' => $query->max_num_pages,
        'mid_size' => 5,
        'prev_next' => true,
        'prev_text' => __('&larr;', 'raadhuis'),
        'next_text' => __('&rarr;', 'raadhuis'),
        'type' => 'list',
    ));

    $paginate_links = str_replace("<ul class='page-numbers'>", "<ul>", $paginate_links);
    $paginate_links = str_replace('<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links);
    $paginate_links = str_replace("<li><span class='page-numbers current'>", "<li class='current'>", $paginate_links);
    $paginate_links = str_replace('</span>', '</a>', $paginate_links);
    $paginate_links = str_replace("<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links);
    $paginate_links = preg_replace('/\s*page-numbers/', '', $paginate_links);

    // Display the pagination if more than one page is found.
    if ($paginate_links) {
        echo '<div class="pagination">';
        echo $paginate_links;
        if ($show_total == true) {
            echo '<p>' . $showed . ' van ' . $total . ' ' . __('resultaten getoond', 'raadhuis') . '</p>';
        }
        echo '</div><!--// end .pagination -->';
    }
}
