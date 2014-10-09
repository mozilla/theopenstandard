<?php
/**
 * Plugin Name: The Open Standard Modals
 * Description: Provides modal functionality for The Open Standard
 * Author: Internet Simplicity
 * Author URI: http://internetsimplicity.net
 */

defined('ABSPATH') or die("No script kiddies please!");

add_action('parse_request', 'TheOpenStandardModals::modals_handler');

Class TheOpenStandardModals {

    static function modals_handler() {
        if (strtok($_SERVER["REQUEST_URI"],'?') == '/modal' && $_GET['m']) {
            $data = $_GET['m'];
            $modal_args = explode('/', $data);
            $modal = array_shift($modal_args);

            ob_start();
            include "templates/$modal-modal.php";
            print ob_get_clean();

            exit();
        }
    }

    static function search_form() {
        get_search_form(true);
    }
}

wp_enqueue_script('the-open-standard-modals', plugins_url('js/modals.js', __FILE__), NULL, NULL, TRUE);

?>