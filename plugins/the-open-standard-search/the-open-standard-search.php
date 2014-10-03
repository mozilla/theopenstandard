<?php
/**
 * Plugin Name: The Open Standard Search
 * Description: Provides search functionality for The Open Standard
 * Author: Internet Simplicity
 * Author URI: http://internetsimplicity.net
 */

defined('ABSPATH') or die("No script kiddies please!");

add_action('parse_request', 'TheOpenStandardSearch::search_handler');

Class TheOpenStandardSearch {
    static function curl_request($url) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    static function search_handler() {
        if (strtok($_SERVER["REQUEST_URI"],'?') == '/search' && $_GET['s']) {
            $search_options = array(
                's' => $_GET['s'],
                'post_type' => 'post',
            );

            if ($_GET['cat'])
                $search_options['cat'] = get_category_by_slug($_GET['cat'])->term_id;

            query_posts($search_options);

            include 'search.php';

            exit();
        }
    }

    static function search_form() {
        wp_enqueue_script('the-open-standard-search', plugins_url('js/search.js', __FILE__), NULL, NULL, TRUE);
        get_search_form(true);
    }
}

?>