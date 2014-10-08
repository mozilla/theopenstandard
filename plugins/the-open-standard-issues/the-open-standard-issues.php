<?php
/**
 * Plugin Name: The Open Standard Issues
 * Description: Provides issues functionality for The Open Standard
 * Author: Internet Simplicity
 * Author URI: http://internetsimplicity.net
 */

defined('ABSPATH') or die("No script kiddies please!");

add_action('parse_request', 'TheOpenStandardIssues::issues_handler');

Class TheOpenStandardIssues {
    static function issues_handler() {
        if (strtok($_SERVER["REQUEST_URI"],'?') == '/issues') {
            load_template(plugin_dir_path(__FILE__) . 'page-issues.php');
            exit();
        }
    }

    static function the_issues_link($tag) {
        print '/issues?issues=' . $tag;
    }
}

?>