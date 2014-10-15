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
    static function curl_request($url) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    private static function get_plus_one_count($shared_url) {
        $html = file_get_contents("https://plusone.google.com/_/+1/fastbutton?url=" . urlencode($shared_url));
        $doc = new DOMDocument();
        set_error_handler(function() { /* ignore errors */ });
        $doc->loadHTML($html);
        restore_error_handler();
        $counter = $doc->getElementById('aggregateCount');
        $count = $counter->nodeValue;

        // The count can be returned as a string like 1.5k
        if (strstr($count, 'k'))
            $count = floatval($count) * 1000;
        
        return json_encode(array('count' => intval($count)));
    }

    static function share_handler() {
        if (strtok($_SERVER["REQUEST_URI"],'?') == '/share-counts') {
            $shared_url = $_GET['shared_url'];
            if ($_GET['service'] == 'twitter')
                $response = self::curl_request('http://urls.api.twitter.com/1/urls/count.json?url=' . urlencode($shared_url));
            if ($_GET['service'] == 'googleplus')
                $response = self::get_plus_one_count($shared_url);

            header('Content-Type: application/json');
            print $response;
            exit();
        }
    }

    static function share_links() {
        wp_enqueue_script('the-open-standard-sharing', plugins_url('js/sharing.js', __FILE__), NULL, NULL, TRUE);
        include 'share-links.php';
    }
}

?>