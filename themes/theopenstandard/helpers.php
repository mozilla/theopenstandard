<?php
    $admin_categories = array('hp_lead', 'hp_featured', 'hp_recent', 'sponsored');
    $meta_categories = array('featured', 'hp_lead', 'hp_featured', 'hp_recent', 'sponsored');

    // Helper function for getting post categories.
    function get_post_categories($post, $without = NULL, $limit = NULL) {
        if ($without === NULL)
            $without = $meta_categories;
        $categories = get_the_category($post);
        if ($without || $limit)
            $categories = reduce_categories($categories, $without, $limit);

        return $categories;
    }

    function get_primary_category($post, $without = NULL) {
        if ($without === NULL)
            $without = $meta_categories;
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

    function get_adjacent_posts_from_category($post, $category) {
        if (!$category)
            return null;

        $related_posts = get_posts(array(
            'posts_per_page' => -1,
            'cat' => $category->term_id
        ));

        $index = 0;
        foreach ($related_posts as $i => $related_post) {
            if ($related_post->ID == $post->ID) {
                $index = $i;
                break;
            }
        }

        $prev = null;
        $next = null;

        for ($i = $index-1; $i>=0; $i--) {
            $related_post = $related_posts[$i];
            $primary_category = get_primary_category($related_post);
            if ($primary_category->term_id == $category->term_id) {
                $prev = $related_post;
                break;
            }
        }

        for ($i = $index+1; $i<count($related_posts); $i++) {
            $related_post = $related_posts[$i];
            $primary_category = get_primary_category($related_post);
            if ($primary_category->term_id == $category->term_id) {
                $next = $related_post;
                break;
            }
        }

        return array('prev' => $prev, 'next' => $next);
    }

    function the_around_the_web_menu($menu) {
        $items = wp_get_nav_menu_items($menu);
        include 'templates/around-the-web.php';
    }

    function get_author_data($author = NULL) {
        if (!$author)
            $author = array_shift(get_coauthors());

        $data = new StdClass();

        if ($author && $author->type == 'guest-author') {
            $data->description = $author->description;
            $data->nicename = $author->user_nicename;
            $data->avatar = coauthors_get_avatar($author, 150);
            $data->name = $author->display_name;
            $data->facebook = $author->facebook;
            $data->twitter = $author->twitter;
            $data->googleplus = $author->googleplus;
        } else {
            if ($author) {
                $author_id = $author->ID;
            } else {
                $author_id = get_the_author_meta('ID');
            }
            $data->description = get_the_author_meta('description', $author_id);
            $data->nicename = get_the_author_meta('user_nicename', $author_id);
            $data->avatar = get_wp_user_avatar($author_id, 150);
            $data->name = $author ? $author->data->display_name : get_the_author();
            $data->facebook = get_the_author_meta('facebook', $author_id);
            $data->twitter = get_the_author_meta('facebook', $author_id);
            $data->googleplus = get_the_author_meta('facebook', $author_id);
        }

        return $data;
    }

    // Uses my get_post_categories function and doesn't include tags or some meta categories, but is otherwise idential to the wordpress implementation.
    function get_the_category_rss_custom($type = null) {
        if ( empty($type) )
            $type = get_default_feed();
        $categories = get_post_categories($post, array('featured', 'hp_lead', 'hp_featured', 'hp_recent'));
        $the_list = '';
        $cat_names = array();

        $filter = 'rss';
        if ( 'atom' == $type )
            $filter = 'raw';

        if ( !empty($categories) ) foreach ( (array) $categories as $category ) {
            $cat_names[] = sanitize_term_field('name', $category->name, $category->term_id, 'category', $filter);
        }

        $cat_names = array_unique($cat_names);

        foreach ( $cat_names as $cat_name ) {
            if ( 'rdf' == $type )
                $the_list .= "\t\t<dc:subject><![CDATA[$cat_name]]></dc:subject>\n";
            elseif ( 'atom' == $type )
                $the_list .= sprintf( '<category scheme="%1$s" term="%2$s" />', esc_attr( get_bloginfo_rss( 'url' ) ), esc_attr( $cat_name ) );
            else
                $the_list .= "\t\t<category><![CDATA[" . @html_entity_decode( $cat_name, ENT_COMPAT, get_option('blog_charset') ) . "]]></category>\n";
        }

        return apply_filters( 'the_category_rss', $the_list, $type );
    }

    function get_posts_assigned_to_author($nicename) {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'author_name' => $nicename,
        );
        return new WP_Query($args);
    }

    function get_featured_post_for_category($category_term_id, $featured_term_id, $lead_term_id) {
        $fallback_featured_post = get_posts(array(
            'cat' => $featured_term_id,
            'category__not_in' => array($lead_term_id),
            // Simple Fields field group slug and field slug. This is replaced by simple fields with the internal field name.
            'sf_meta_key' => 'categories/primary_category',
            // Simple Fields stores its drop down values in the form 'dropdown_num_somevalue' so we need to query for that.
            'meta_value' => 'dropdown_num_' . $category_term_id,
            'posts_per_page' => 1,
            'orderby' => 'date',
        ));

        // Couldn't find a primary category with featured, so we'll grab a non primary category with featured
        if (!$fallback_featured_post) {
            $fallback_featured_post = get_posts(array(
                'category__and' => array($featured_term_id, $category_term_id),
                'category__not_in' => array($lead_term_id),
                'posts_per_page' => 1,
                'orderby' => 'date',
            ));
        }

        if ($fallback_featured_post)
            return array_shift($fallback_featured_post);

        return NULL;
    }
?>