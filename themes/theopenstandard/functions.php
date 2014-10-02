<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */

    // Options Framework (https://github.com/devinsays/options-framework-plugin)
    if (!function_exists( 'optionsframework_init')) {
        define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/_/inc/');
        require_once dirname( __FILE__ ) . '/_/inc/options-framework.php';
    }

    // Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
    function html5reset_setup() {
        load_theme_textdomain('html5reset', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('structured-post-formats', array('link', 'video'));
        add_theme_support('post-formats', array('gallery'));
        register_nav_menu('primary', __('Navigation Menu', 'html5reset'));
        add_theme_support('post-thumbnails');
    }
    add_action('after_setup_theme', 'html5reset_setup');

    // WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
    function html5reset_wp_title( $title, $sep ) {
        global $paged, $page;

        if ( is_feed() )
            return $title;

        // Add the site name.
        $title .= get_bloginfo( 'name' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page()))
            $title = "$title $sep $site_description";

        // Add a page number if necessary.
        if ($paged >= 2 || $page >= 2)
            $title = "$title $sep " . sprintf(__('Page %s', 'html5reset'), max($paged, $page));

        return $title;
    }
    add_filter('wp_title', 'html5reset_wp_title', 10, 2);

    // Load jQuery
    if (!function_exists('core_mods')) {
        function core_mods() {
            if (!is_admin()) {
                wp_deregister_script('jquery');
                wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"), false);
                wp_enqueue_script('jquery');
            }
        }
        add_action('wp_enqueue_scripts', 'core_mods');
    }

    // Custom Menu
    register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );

    // Widgets
    if ( function_exists('register_sidebar' )) {
        function html5reset_widgets_init() {
            register_sidebar( array(
                'name'          => __( 'Sidebar Widgets', 'html5reset' ),
                'id'            => 'sidebar-primary',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
        }
        add_action( 'widgets_init', 'html5reset_widgets_init' );
    }

    // Navigation - update coming from twentythirteen
    function post_navigation() {
        echo '<div class="navigation">';
        echo '    <div class="next-posts">'.get_next_posts_link('&laquo; Older Entries').'</div>';
        echo '    <div class="prev-posts">'.get_previous_posts_link('Newer Entries &raquo;').'</div>';
        echo '</div>';
    }

    // Posted On
    function posted_on() {
        printf( __( '<span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', '' ),
            esc_url( get_permalink() ),
            esc_attr( get_the_time() ),
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_author() )
        );
    }

    // Disable the automatic appending of related posts to post content
    add_filter('rp4wp_append_content', '__return_false');

    //Custom Image Sizes
    add_image_size( 'story-rss', 460 );

    add_filter( 'image_size_names_choose', 'my_custom_sizes' );

    function my_custom_sizes( $sizes ) {
        return array_merge( $sizes, array(
            'story-rss' => __( 'Story RSS' ),
        ) );
    }

    if ( has_post_thumbnail() ) {
        the_post_thumbnail( 'story-rss' );
    }


    require_once('custom-post-types.php');
    require_once('custom-shortcodes.php');
    require_once('simple-fields.php');
    require_once('content-filters.php');
    require_once('helpers.php');
?>
