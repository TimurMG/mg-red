<div class="cont">
<?php
global $post;
$terms_obj = wp_get_post_terms($post->ID, 'somcat');
foreach($terms_obj as $t) $terms[] = $t->slug;
$related_posts = get_posts(
    array(
        'post_type' => 'som',
        'post__not_in' => array($post->ID),
        'posts_per_page' => 6,
        'tax_query' => array(
            array(
                'taxonomy' => 'somcat',
                'field' => 'slug',
                'terms' => $terms,
                'operator' => 'IN'
            )
        )
    ));
?>
<?php if(count($related_posts) > 0) : ?>

        <?php foreach( $related_posts as $post ) : setup_postdata($post); ?>

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
<img src="http://mgorod.kz/wp-content/uploads/2015/07/09chat2.png" class="schet" style="  width: 10px;
  height: 9px;
  opacity: 0.4;
  top: -3px;
  margin-left:6px;
  position: relative;
  right: 2px;"><?php comments_number('0', '1', '%');  ?>   <img class="schet" src="http://mgorod.kz/wp-content/uploads/2015/07/12eye.png" style="  width: 10px;
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
<?php endif; ?>