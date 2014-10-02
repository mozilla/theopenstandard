<?php
    // Helper function for getting post categories.
    function get_post_categories($post, $without = NULL, $limit = NULL) {
        $categories = get_the_category($post);
        if ($without || $limit)
            $categories = reduce_categories($categories, $without, $limit);

        return $categories;
    }

    // Helper function for reducing an array of categories to a certain length and/or a certain slug.
    function reduce_categories($categories, $without = NULL, $limit = NULL) {
        if ($without) {
            foreach ($categories as $index => $category) {
                if (in_array($category->slug, $without))
                    unset($categories[$index]);
            }
        }

        if ($limit)
            $categories = array_slice($categories, 0, $limit);

        if (!$categories)
            return NULL;

        if (count($categories) == 1 and $limit === 1)
            return $categories[0];

        return $categories;
    }

    // Use Related Posts for Wordpress to get a list of related posts, but generate our own template.
    function get_related_posts($id = NULL) {
        // Get the current ID if ID not set
        if (!$id)
            $id = get_the_ID();

        // Post Link Manager
        $pl_manager = new RP4WP_Post_Link_Manager();

        // Get list of related posts
        $related_posts = $pl_manager->get_children($id);

        ob_start();
        include 'templates/related-posts.php';
        return ob_get_clean();
    }

    function get_category_posts($query_options = array()) {
        $query_options = array_merge(array(
            'orderby' => 'date'
        ), $query_options);

        $category_posts = new WP_Query($query_options);
        return $category_posts;
    }

    function get_post_thumbnail_url($size = 'thumbnail') {
        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
        return $image_url[0];
    }
?>