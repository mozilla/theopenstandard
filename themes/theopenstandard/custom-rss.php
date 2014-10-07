<?php

remove_all_actions('do_feed_rss');
remove_all_actions('do_feed_rss2');

add_action('do_feed_rss', 'custom_product_feed_rss', 10, 1);
add_action('do_feed_rss2', 'custom_product_feed_rss2', 10, 1);

function custom_product_feed_rss($for_comments) {
    $rss_template = get_template_directory() . '/templates/rss/feed-rss.php';
    load_template($rss_template);
}

function custom_product_feed_rss2($for_comments) {
    $rss_template = get_template_directory() . '/templates/rss/feed-rss2.php';
    load_template($rss_template);
}