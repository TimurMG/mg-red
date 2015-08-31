<?php
/*
Template Name: Смотри
*/
get_header('som');
?>

<div class="mainauto no-border" style="padding-right:10px !important;">
<? include'right-som.php';?>

<div class="cont" style="width:1280px;">
<?php
global $post;
$post_slug=$post->post_name;

$cat_posts = get_posts(array('post_type' => 'som', 'posts_per_page' => 99, 'tax_query' => array(array('taxonomy' => 'somcat', 'field' => 'slug', 'terms' => $post_slug)))); 
?>




<?php 
foreach ($cat_posts as $post) : setup_postdata($post); 
?>

<div class="week-news">
<a href="<?php the_permalink(); ?>" >

<div style="  background-color: #EFBA00;
  font-size: 10px;
  position: relative;
  margin-bottom: -31px;
  padding: 3px;
  float: right;
  color: #333;
  font-family: Arial;
  margin-top: 13px;">
                    <?php echo get_the_date('d M  H:i'); ?>
                    </div>

								<?php get_image_thumb(get_the_ID(), array(300,185)); ?>
</a>
<div class="txt">
								<a href="<?php the_permalink(); ?>" style="font-size:20px !important; display:block; margin-bottom:10px; padding:10px 0; border-bottom:1px #CCC dashed; color:#333; text-decoration:none; height: 42px; overflow: hidden;" >

								<?php the_title_shorten(36); ?>

                                </a>

                                
<div style="height: 80px; overflow: hidden;">
                                <?php echo htmlspecialchars(kama_excerpt('maxchar=120&echo')); ?>
</div>
</div>

<div style="  color: #B8B8B8;
  font-size: 12px;
  margin-top: -17px;
  float: right;
  margin-right: 10px;">
<img src="http://mgorod.kz/wp-content/uploads/2015/07/09chat2.png" style="  width: 10px;
  height: 9px;
  opacity: 0.4;
  top: -3px;
  margin-left:6px;
  position: relative;
  right: 2px;"><?php comments_number('0', '1', '%');  ?>   <img src="http://mgorod.kz/wp-content/uploads/2015/07/12eye.png" style="  width: 10px;
  height: 7px;
  opacity: 0.4;
  top: -4px;
  margin-left:6px;
  position: relative;
  right: 2px;"><?php echo getPostViews(get_the_ID()); ?>
</div>
</div>
                        <?php endforeach; wp_reset_postdata(); ?>
                        


<? include'left-som.php';?>
</div>
</div>

<?php include'foot.php';?>