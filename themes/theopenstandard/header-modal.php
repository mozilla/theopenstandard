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

    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WS25KC"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WS25KC');</script>
    <!-- End Google Tag Manager --> 