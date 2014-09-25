<?php
    // [post_gallery id=gallery_id_here]
    function post_gallery_shortcode($atts) {
        $a = shortcode_atts(array(
            'id' => '',
        ), $atts);

        $gallery_id = $atts['id'];

        ob_start();
        include('templates/gallery.php');
        return ob_get_clean();
    }
    add_shortcode('post_gallery', 'post_gallery_shortcode');
?>