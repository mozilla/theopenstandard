<?php
    // Helper function for getting post categories.
    function get_post_categories($post, $without = array('featured', 'hp_lead', 'sponsored'), $limit = NULL) {
        $categories = get_the_category($post);
        if ($without || $limit)
            $categories = reduce_categories($categories, $without, $limit);

        return $categories;
    }

    function get_primary_category($post, $without = array('featured', 'hp_lead', 'sponsored')) {
        $primary_category_data = simple_fields_value('primary_category', $post);
        if ($primary_category_data && $primary_category_data['selected_value']) {
            $primary_category = get_term_by('name', $primary_category_data['selected_value'], 'category');
        } else {
            $primary_category = get_post_categories($post, $without, 1);
        }

        return $primary_category;
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

    function get_post_thumbnail_url($size = 'thumbnail') {
        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
        return $image_url[0];
    }

    // Provide concise fall-through logic
    function one_of() {
        $args = func_get_args();
        foreach ($args as $arg) {
            if ($arg)
                return $arg;
        }
    }

    function theme_image_src($path) {
        echo get_theme_image_src($path);
    }

    function get_theme_image_src($path) {
        return get_template_directory_uri() . '/_/images/' . $path;
    }

    // We use this as an argument in get_next_post and get_previous_post.
    function get_non_primary_category_ids($post) {
        $primary_category = get_primary_category($post);
        $categories = get_post_categories($post, NULL);
        $category_ids = array();
        foreach ($categories as $category) {
            if ($primary_category->term_id != $category->term_id) {
                $category_ids = $category->term_id;
            }
        }
        return $category_ids;
    }
?>