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
    static $template_map = array(
        'contributors' => 'authors'
    );

    static function modals_handler() {
        if (strtok($_SERVER["REQUEST_URI"],'?') == '/modal' && $_GET['m']) {
            $data = $_GET['m'];
            $modal_args = explode('/', $data);
            $modal = htmlspecialchars(array_shift($modal_args));
            $modal_template = $modal;

            if (self::$template_map[$modal])
                $modal_template = self::$template_map[$modal];

            ob_start();
            include "templates/$modal_template-modal.php";
            print ob_get_clean();

            exit();
        }
    }

    static function search_form() {
        get_search_form(true);
    }
}

wp_enqueue_script('the-open-standard-modals', plugins_url('js/modals.js', __FILE__), NULL, NULL, TRUE);
wp_enqueue_script('the-open-standard-authors', plugins_url('js/authors.js', __FILE__), NULL, NULL, TRUE);

?>