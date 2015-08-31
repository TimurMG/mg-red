<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="description" content="<?php wp_title('|', true, 'right'); ?>"/>
    <?php get_post_meta_tags(); ?>
    <?php add_open_meta_tags(); ?>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/print.css" type="text/css" media="print"/>
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/ie.css" type="text/css" media="all"/>
    <![endif]-->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?96"></script>
    <script type="text/javascript">
        VK.init({apiId: 3673383, onlyWidgets: true});
    </script>
    <?php wp_head(); ?>
    <script>
        (function($){
            $(window).load(function(){
                if($(".medical-events-block").length > 0) {
                    $(".medical-events-block .list ul").mCustomScrollbar({
                        scrollButtons:{
                            enable:false
                        },
                        advanced:{
                            updateOnContentResize: true,
                            updateOnBrowserResize: true
                        },
                        scrollInertia:500
                    });
                }
            });
        })(jQuery);
    </script>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
    <div class="banner banner-1160x110" id="med-banner-1160x110">
        <?php get_banner("med-banner-1160x110"); ?>
    </div>
    <div class="header-min">
        <div class="menus">
            <div class="top">
                <?php do_shortcode("[add_wp_sliding_login_register_links]"); ?>
            </div>
            <div class="bottom">
                <ul class="primary-sub-menu">
                    <li>
                        <i class="menu-ico"></i>
                        <?php wp_nav_menu(array('container' => '', 'menu_class' => 'primary-sub', 'theme_location' => 'primary_sub')); ?>
                    </li>
                </ul>
                <div class="clearer"></div>
            </div>
        </div>
        <div class="h-left">
            
            <div class="header-min-health"><a href="/medicina/"></a></div>
        </div>
    </div>