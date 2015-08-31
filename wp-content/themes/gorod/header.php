<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head<?php  if(is_singular('news') || is_singular('post')) { ?> prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#" <?php } ?>>

    <meta charset="<?php bloginfo('charset'); ?>"/>

    <?php
    global $post;
    if((is_singular('news') && has_term('other','ncategory', $post)) || is_singular('page_news')) {
        echo '<meta name="description" content="' . get_post_meta($post->ID, 'nws_description', true) . '"/>';
    }
    else {
        ?>
        <meta name="description" content="<?php wp_title('|', true, 'right'); ?>"/>
    <?php } ?>

    <?php get_post_meta_tags(); ?>
    <?php add_open_meta_tags(); ?>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <script src="<?php echo get_template_directory_uri() ?>/js/jquery.min.js"></script> <!-- подключаем последнюю версию jQuery -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/images/favicon.ico" type="image/x-icon"/>
	<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/tabs.js"></script>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
    <?php wp_head(); ?>

	<script src="<?php echo get_template_directory_uri() ?>/js/jquery-latest.js"></script> <!-- подключаем последнюю версию jQuery -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/c.js"></script>  <!-- подключаем наш скрипт -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/css/style-c.css"> <!-- подключаем стилевой файл -->

	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/tabs.css" />
</head>

<body <?php body_class(); ?>>

<header id="masthead" style="background-color:#F3F3F3 !important;" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding">
				
				<div id="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo get_template_directory_uri() ?>/images/logo-mg.png">
                    </a>
				</div>
				
				<div class="projects">
                <table border="0">
                <tr>
                <td style="padding:16px 20px; vertical-align: middle;">
                <a href="//ujob.kz" target="_blank"><img src="http://mg-red.kz/wp-content/uploads/2015/06/ujob1.png">
                </a>
                </td>
                <td>
                <a href="//umarket.kz.kz" target="_blank"><img src="http://mg-red.kz/wp-content/uploads/2015/06/umarket.png">
                </a>
                </td>
                
                </tr>
                </table>
                
                </div>
                
                <div class="app">
                <img src="http://mg-red.kz/wp-content/uploads/2015/06/android.png">
                <img src="http://mg-red.kz/wp-content/uploads/2015/06/apple.png">
                </div>
                
			</div>	
		</div>			
		
        <div id="site-navigation" class="main-navigation" role="navigation">
			<div class="container">
                     <img src="">   
            <div class="head_pod_menu">
            &nbsp;
            <div class="pod_menu">
            <?php wp_nav_menu(array('container' => '', 'menu_class' => 'primary-sub', 'theme_location' => 'primary_sub')); ?>
            </div>
            </div>
				<?php
					  //Display the Menu.							
					  wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); 
				?>
            
            
            
                
                <div style="display:inline-block; float:right; ">
                <ul>
                <li>
                <a href="">
Войти
</a>
</li>
</ul>
            </div>
            
            <div style="display: inline-block; float: right; margin: 0px; padding: 0; top: 6px; position: relative; right: 10px;">
                <? get_search_form(); ?>
            </div>
            
			</div>
		</div><!-- #site-navigation -->	  
        
        <script type="text/javascript">
$(document).ready(function() {
var start_pos=$('#site-navigation').offset().top;
 $(window).scroll(function(){
  if ($(window).scrollTop()>=start_pos) {
      if ($('#site-navigation').hasClass()==false) $('#site-navigation').addClass('to_top');
	  document.getElementById('log').style.display='block';
  }
  else {
	  $('#site-navigation').removeClass('to_top');
  	document.getElementById('log').style.display='none';
  }
  });
});
</script>
              
	</header><!-- #masthead -->