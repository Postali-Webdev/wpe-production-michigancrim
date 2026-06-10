<?php
/**
 * Results Queries
 * Two queries: one for the most recent result, and one for the rest excluding that one.
 */

// First query: Get the most recent post from 'results' post type
$recent_args = array(
    'post_type'      => 'results',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'order'          => 'DESC',
    'orderby'        => 'date',
);
$recent_query = new WP_Query($recent_args);

// Get the post ID to exclude from the second query
$exclude_id = null;
if ($recent_query->have_posts()) {
    $recent_query->the_post();
    $exclude_id = get_the_ID();
    // You can display the recent post here if needed
    // the_title(); the_content(); etc.
    wp_reset_postdata();
}

// Second query: Get the rest of the 'results' posts, excluding the recent one
$rest_args = array(
    'post_type'      => 'results',
    'posts_per_page' => -1, // Get all remaining posts
    'post_status'    => 'publish',
    'order'          => 'DESC',
    'orderby'        => 'date',
);

// Exclude the recent post if it exists
if ($exclude_id) {
    $rest_args['post__not_in'] = array($exclude_id);
}

$rest_query = new WP_Query($rest_args);

// Now you can loop through $rest_query
if ($rest_query->have_posts()) {
    while ($rest_query->have_posts()) {
        $rest_query->the_post();
        // Display each post
        // the_title(); the_content(); etc.
    }
    wp_reset_postdata();
}
?>