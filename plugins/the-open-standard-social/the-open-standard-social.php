<?php
/**
 * Plugin Name: The Open Standard Social
 * Description: Provides social media functionality for The Open Standard
 * Author: Internet Simplicity
 * Author URI: http://internetsimplicity.net
 */

defined('ABSPATH') or die("No script kiddies please!");

add_action('parse_request', 'TheOpenStandardSocial::share_handler');

Class TheOpenStandardSocial {
    static function share_handler() {
        if (strtok($_SERVER["REQUEST_URI"],'?') == '/track_sharing') {
			switch ($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					$post_id = $_GET['post_id'];
					header('Content-Type: application/json');
					print get_post_meta($post_id, 'sharing_info', TRUE);
					exit();
				case 'POST':
					$post_id = $_POST['post_id'];
					$service = $_POST['service'];
					$sharing_info = get_post_meta($post_id, 'sharing_info', TRUE);
					if ($sharing_info) {
						$sharing_info = json_decode($sharing_info, TRUE);
						if (!$sharing_info[$service])
							$sharing_info[$service] = 0;
						$sharing_info[$service] += 1;
						update_post_meta($post_id, 'sharing_info', json_encode($sharing_info));
					} else {
						$sharing_info = array();
						$sharing_info[$service] = 1;
						add_post_meta($post_id, 'sharing_info', json_encode($sharing_info), TRUE);
					}
					exit();
			}
            exit();
        }
    }

    static function share_links() {
		wp_enqueue_script('the-open-standard-sharing-js', plugins_url('js/sharing.js', __FILE__), NULL, NULL, TRUE);
        include 'share-links.php';
    }
}

?>