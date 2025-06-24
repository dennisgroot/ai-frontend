<?php

// Get custom excerpt with highlighted search phrase
function get_custom_excerpt_with_highlight($content_or_id, $search_phrase, $length = 200) {
    if (is_numeric($content_or_id)) {
        $post = get_post($content_or_id);
        $post_content = $post->post_content;
        $excerpt = $post_content;
    } else {
        $excerpt = strip_tags($content_or_id);
    }

    $length = intval($length);

    // Highlight search phrase
    $excerpt = preg_replace('/(' . preg_quote($search_phrase, '/') . ')/i', '<strong>$1</strong>', $excerpt);

    if (strlen($excerpt) > $length) {
        // Remove all HTML tags except highlight tags (now <strong>) are in the $excerpt variable above and below
        $excerpt = strip_tags($excerpt, '<strong>');

        // Find the position of the search phrase in the excerpt
        $phrase_position = stripos($excerpt, $search_phrase);

        // Determine the length of text before and after the phrase
        $half_length = floor($length / 2);

        // Find the start position of the part before the phrase
        $start_position = max(0, $phrase_position - $half_length);

        // If the phrase is the first word, adjust start position
        if ($start_position > 0) {
            $space_position = strrpos(substr($excerpt, 0, $start_position), ' ');
            if ($space_position !== false) {
                $start_position = $space_position + 1;
            }
        }

        // Find the end position of the part after the phrase
        $end_position = min(strlen($excerpt), $phrase_position + strlen($search_phrase) + $half_length);

        // Get the part of the excerpt and add "..." if necessary
        $excerpt = substr($excerpt, $start_position, $end_position - $start_position);
        if ($start_position > 0) {
            $excerpt = '...' . ltrim($excerpt);
        }
        if ($end_position < strlen($excerpt)) {
            $excerpt .= '...';
        }
        if ($end_position >= strlen($excerpt)) {
            $excerpt .= '...';
        }
    }

    return $excerpt;
}

?>