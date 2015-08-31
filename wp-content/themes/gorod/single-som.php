<?php
get_header('soms');
?>

<div class="category-news-block auto rek" style="  background-image: none !important; float:right !important; width:670px; margin-top:0px !important;">

<?php 
while ( have_posts() ) : the_post(); //стандартная итерация по массиву 
?>

<div style="background-color:#EEE; padding:20px;">
<h1 style="font-family:bandera_proregular; font-size:50px; border-bottom:0 !important; margin-bottom:0 !important;">
<?php the_title(); ?> 
</h1>

<h1 style="font-family:Verdana, Geneva, sans-serif; border-bottom: 0 !important; font-size:25px; margin:0; padding:0;">
<span style="font-size:10px; color:#333;"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span> <span style="font-size:10px; color:#333;">&nbsp;&nbsp;&nbsp; Коментариев: <?php comments_number('0', '1', '%'); ?> &nbsp;&nbsp;&nbsp; Просмотров: <?php setPostViews(get_the_ID()); ?><?php echo getPostViews(get_the_ID()); ?></span>
</h1>

</div>


<div style="overflow:hidden;" class="single-som">
<?php the_content(); ?>
</div>

<br>
<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="transparent" data-options="medium,round,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir"></div>

<?
endwhile;
?>
<br>

<br>
<?php comments_template('/comments-auto.php'); ?> 
</div>

<div style="float:left; width:214px;">
<? include'right-som.php';?>
<div style="display:block; margin-top: 20px; margin-bottom:0px;  width: 297px; overflow: hidden;">
<?php get_banner("som4"); ?>
</div>
</div>

<div style="width:1000px; float:left; margin:20px 0;">
<h4>Читайте также:</h4>
<?php
global $post;
//64110
print_r($post->ID);
var_dump(the_category());
// get_posts('category' => 64110);
// echo $cat->cat_name;
?>
</div>
<?php include'foots.php';?>