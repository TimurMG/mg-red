<?php

/*

Template Name: Somicadze blog

*/

get_header('som');

?>

<div class="mainauto no-border">

<? include'right-som.php';?>

<div class="cont">
<?php 
$cat_posts = get_posts(array('post_type' => 'som', 'posts_per_page' => 6, 'tax_query' => array(array('taxonomy' => 'somcat', 'field' => 'slug', 'terms' => 'somblog')))); 
// var_dump($cat_posts);

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
                    <?php echo get_the_date('d M  H:i'); $arr = get_the_ID(); $arrr = array($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]); ?>
                    </div>

								<?php get_image_thumb(get_the_ID(), array(300,180)); ?>
</a>
<div class="txt">
								<a href="<?php the_permalink(); ?>">

								<?php the_title_shorten(36); ?>

                                </a>

                                
<div style="height: 80px; overflow: hidden;   color: #898989;
  line-height: 18px;
  font-family: Tahoma;
  font-size: 14px;
">
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
<!-------------------------------Photorep----------------------------->                        

<?php

$isFirst = true;

$cat_posts = get_posts(array('post_type' => 'som', 'posts_per_page' => 5, 'tax_query' => array(array('taxonomy' => 'somcat', 'field' => 'slug', 'terms' => 'photorep')))); 
?>

<?php 
if (count($cat_posts) > 0) {

$post = $cat_posts[0];
setup_postdata($post) 
?>

<div style="
margin-top:10px;
border-radius:20px;
position:absolute;
font-size:10px;
padding:5px 10px;
background:rgba(0,0,0,0.8);
color:#fff;
margin-left:535px;">

<img src="http://mgorod.kz/wp-content/uploads/2015/07/comm.png" style="  width: 10px;
  height: 9px;
  top:2px;
  margin-left:6px;
  position: relative;
  right: 2px;"><?php comments_number('0', '1', '%');  ?>   <img src="http://mgorod.kz/wp-content/uploads/2015/07/pro.png" style="  width: 10px;
  height: 7px;
  margin-left:6px;
  position: relative;
  right: 2px;"><?php echo getPostViews(get_the_ID()); ?>


</div>
<div class="week-news gl-news" style="width: 622px; height:320px; overflow:hidden; margin-right:0 !important; margin-bottom:0;">
<a href="<?php the_permalink(); ?>" >
<div class="com">
<?php echo get_the_date('d M  H:i'); ?>
</div>
<?php get_image_thumb(get_the_ID(), array(622,319)); ?>
</a>

<div class="txt" style="
  width: 582px;
  margin-top: -79px;
  margin-bottom: -380px;
">

<a href="<?php the_permalink(); ?>" style="
  font-size: 24px !important;
  font-weight: bold;
  display: block;
  text-shadow: 1px 1px 1px #000;
  padding: 10px 0;
  border-bottom: 0px;
  color: #FFF;
  text-decoration: none;
  height: 410px;
  overflow: hidden;
" >
<?php the_title_shorten(80); ?>
</a>                                

</div>

</div>
<?php } ?>
<?php
                        foreach ($cat_posts as $post) : setup_postdata($post);
                            if ($isFirst) {
                                $isFirst = false;
                                continue;
                            }
                            ?>
                        
                        
<!-----------------------------------end------------------------------>  




            

<div class="beez-news">
<a href="<?php the_permalink(); ?>" >

<div class="date">
<?php echo get_the_date('d M  H:i'); ?>
</div>
<h1>
<?php the_title_shorten(60); ?>
</h1>
<div class="comm">

<img src="http://mgorod.kz/wp-content/uploads/2015/07/comm.png" style="  width: 10px;
  height: 9px;
  top:2px;
  margin-left:6px;
  position: relative;
  right: 2px;"><?php comments_number('0', '1', '%');  ?>   <img src="http://mgorod.kz/wp-content/uploads/2015/07/pro.png" style="  width: 10px;
  height: 7px;
  margin-left:6px;
  position: relative;
  right: 2px;"><?php echo getPostViews(get_the_ID()); ?>


</div>
<?php get_image_thumb(get_the_ID(), array(300,150)); ?>
</a>
</div>


                        <?php endforeach; wp_reset_postdata(); ?>
                        
<div style="width:1280px;">
<span style="margin-bottom:20px; width:300px; display:block;  float: left; margin-right: 22px;">
<?php get_banner("som2"); ?>
</span>                        


<?php 
$cat_posts = get_posts(array('post_type' => 'som', 'posts_per_page' => 6, 'tax_query' => array(array('taxonomy' => 'somcat', 'field' => 'slug', 'terms' => 'somblog')))); 


$args = array( 'posts_per_page' => 6, 'post_type' => 'som','offset'=> 7, 'tax_query' => array(array('taxonomy' => 'somcat', 'field' => 'slug', 'terms' => 'somblog')));

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post );
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

								<?php get_image_thumb(get_the_ID(), array(300,180)); ?>
</a>
<div class="txt">
								<a href="<?php the_permalink(); ?>">

								<?php the_title_shorten(36); ?>

                                </a>

                                
<div style="height: 80px; overflow: hidden;   color: #898989;
  line-height: 18px;
  font-family: Tahoma;
  font-size: 14px;
">
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
                        
</div>


<div style="display:block; margin-top: 20px; margin-bottom:0px;  width: 297px; overflow: hidden;">
<?php get_banner("som4"); ?>
</div>
</div>

</div>

<?php include'foot.php';?>