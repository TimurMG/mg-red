<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

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



    

    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/slider/css/screen.css" type="text/css" media="all"/>

    

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

	<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/slider/js/easySlider1.7.js"></script>

	<script type="text/javascript">

		$(document).ready(function(){	

			$("#slider").easySlider({

				auto: true, 
				continuous: true,
				nextId: "slider1next",
				prevId: "slider1prev",
				numeric: true

			});

		});	

	</script>	

    

    <?php wp_head(); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" ></script>
<?
wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', 'jquery', false);
wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', 'jquery', false);
?>


</head>

<body style=" background-color:#E4E4E4; padding-top:0px">





<?php $slide_posts = get_posts(array('post_type' => 'som', 'posts_per_page' => 5, 'tax_query' => array(array('taxonomy' => 'somcat', 'field' => 'slug', 'terms' => 'slide')))); ?>

            

			<?php if (count($slide_posts) > 0) { ?>

             

<div id="container" style="margin-bottom:-20px;">







	<div id="content" style="margin: auto; width: 1340px !important;   overflow: hidden; background-color:#fff;">

		<div id="slider" style="height:200px !important; width:1340px !important;">

			<ul>

            <?php foreach ($slide_posts as $post) : setup_postdata($post); ?>

				<li>

                <a style="text-decoration:none;" href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars(get_the_title()); ?>">

				<div class="txt-slide">

                <?php the_title_shorten(150); ?>

                </div>

				<?php get_image_thumb(get_the_ID(), array(1340,200)); ?>

                </a>

                </li>

			<?php endforeach; wp_reset_postdata(); ?>

            </ul>

		</div>

	</div>



</div>

<?php } ?>

<div class="wrapper" style="max-width:1260px !important; padding: 20px 40px 10px 40px !important; margin: 0 auto !important; overflow: hidden !important; position: relative !important; z-index: 2 !important; background: #ffffff !important;">


    <div class="header-min" style="  border-bottom: 3px #E7E7E9 solid; height: inherit !important; margin-bottom:15px;">



<div class="menus-auto" style="height: auto !important;

  width: auto !important;

  position: relative;

  background: none;

  top: 72px;
  
  margin-left:-500px;">

            <div class="top enter">

                <?php do_shortcode("[add_wp_sliding_login_register_links]"); ?>

            </div>

            

        </div>        

        <div class="a-left">

            <div class="logo" style="float: none; width: inherit;  text-align: -webkit-center; margin: 10px;">

                <figure style="margin-bottom:20px;">

                    <a href="http://mgorod.kz/weekend/"><img src="<?php echo get_template_directory_uri() ?>/images/weekend.png" alt="Новости Уральска" ></a>

                    

                </figure>

            </div>

            

        </div>

    </div>



<div id="menuweek" style="text-align: -webkit-center; margin-bottom: 30px;">
<?php wp_nav_menu('menu=weekend'); ?>
</div>
<script type="text/javascript">
try{
var el=document.getElementById('menuweek').getElementsByTagName('a');
var url=document.location.href;
for(var i=0;i<el.length; i++){
if (url==el[i].href){
el[i].className += ' act';
};
};
}catch(e){}
</script>
