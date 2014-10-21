<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php
        if (is_search())
            echo '<meta name="robots" content="noindex, nofollow" />';
    ?>

    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <!-- concatenate and minify for production -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/reset.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/foundation/css/foundation.min.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_/zurb_src/dist/assets/css/app.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_/css/blog.css" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

    <?php wp_head(); ?>
    <script src='<?php echo get_template_directory_uri(); ?>/_/zurb_src/dist/assets/js/modernizr.js'></script>
</head>

<body <?php body_class(); ?>>

    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WS25KC"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WS25KC');</script>
    <!-- End Google Tag Manager -->

    <div class="off-canvas-wrap" data-offcanvas>
        <div class="inner-wrap">
            <div class="nav-icon-and-logo">
                <div>
                    <a class="left-off-canvas-toggle" href="#"><img src="<?php theme_image_src('icons/menu-icon.svg'); ?>"></a>
                </div>
                <div class="logo-container">
                    <a title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php theme_image_src('tOS_logo.svg'); ?>"></a>
                </div>
            </div>

            <!-- OFF CANVAS MENU -->
            <?php include('templates/off-canvas.php'); ?>

            <?php if (is_front_page()) { ?>
                <!-- DATE -->
                <div class="date-home">
                    <p></p>
                    <script>
                        $(function() {
                            $('.date-home p').text(moment().format('MMMM D, YYYY'));
                        });
                    </script>
                </div>
            <?php } ?>
