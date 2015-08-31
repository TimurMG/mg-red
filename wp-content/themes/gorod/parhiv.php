<?php
/*
Template Name: Архив чета там новостей
*/
get_header('som');
?>




    <div class="mainauto no-border">

      <? include'right-som.php';?>

        <div class="left">
<div>




<div class="category-news-block auto rek" style="background-image:none !important; display:inline-block; margin: 0px 0 20px !important; border:0; width: 735px;">

               

                  <div class="main-news" style="width:415px;">

                        

                            

                        

                        

                   </div>


                <div class="second" style="margin-left:0px !important;">

                   

                      <?php



            $cat_posts = get_posts(array('post_type' => 'som', 'posts_per_page' => 999, 'tax_query' => array(array('taxonomy' => 'somcat', 'field' => 'slug', 'terms' => 'somblog'))));



            ?>
            <?php if (count($cat_posts) > 0) { ?>
             <?php foreach ($cat_posts as $post) : setup_postdata($post); ?>

                          <div style="margin-bottom:10px !important; display:block;">
                          <table border="0" cellpadding="0" cellspacing="0" width="100%">

<tr>
<td width="230">
								<?php get_image_thumb(get_the_ID(), array(238,160)); ?>
</td>
<td valign="top" style="padding: 0 20px !important; background-color:#FFF5E1;   vertical-align: -webkit-baseline-middle;">
								<a href="<?php the_permalink(); ?>" style="font-size:24px !important; display:block; margin-bottom:10px; padding:10px 0; border-bottom:1px #CCC dashed; color:#333; text-decoration:none;" >
								<?php the_title_shorten(50); ?>
                                </a>
                                
                                <?php echo htmlspecialchars(kama_excerpt('maxchar=200&echo')); ?>
</td>
</tr>
</table>
                            </div>

                        <?php endforeach; wp_reset_postdata(); ?>

                   

                </div>

                
<?php } ?>

                




        </div>

</div>

</div>
<?php include'foot.php';?>