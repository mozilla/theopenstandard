<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head id="<?php echo of_get_option('meta_headid'); ?>" data-template-set="html5-reset-wordpress-theme">
    <meta charset="<?php bloginfo('charset'); ?>">

    <?php
        if (is_search())
            echo '<meta name="robots" content="noindex, nofollow" />';
    ?>

    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <!-- concatenate and minify for production -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/reset.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />
    <link href='http://fonts.googleapis.com/css?family=Karma:400,300,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Fira+Sans:300,400,400italic,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/foundation/css/foundation.min.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_/css/zurb.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_/css/blog.css" />

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <div class="off-canvas-wrap" data-offcanvas>
        <div class="inner-wrap">
            <div class="nav-icon-and-logo">
                <div>
                    <a class="left-off-canvas-toggle" href="#"><img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/0992d7f691b654e889e30d9bed9196d2a9ec5891/menu-icon.svg"></a>
                </div>
                <div class="logo-container">
                    <a title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home" href="<?php echo esc_url(home_url('/')); ?>"><img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/30d897fbdac61ee6a0ea567077e5d5eb323ec341/tos_logo.svg"></a>
                </div>
            </div>

            <!-- OFF CANVAS MENU -->
            <?php include('templates/off-canvas.php'); ?>

            <?php if (is_front_page()) { ?>
                <!-- DATE -->
                <div class="date-home">
                    <p><?php echo date("F j, Y"); ?></p>
                </div>
            <?php } ?>