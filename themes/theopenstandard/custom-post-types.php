<?php
    add_action('init', 'create_post_type');
    function create_post_type() {
        register_post_type('gallery',
            array(
                'labels' => array(
                    'name' => __('Galleries'),
                    'singular_name' => __('Gallery')
                ),
                'public' => true,
                'has_archive' => true,
            )
        );
    }
?>