<?php
get_header();
?>

    <div class="container" style="margin-top:20px;">
    
    <div class="ban1">
    <img src="<?php echo get_template_directory_uri() ?>/images/lit-auto.jpg">
	<?php get_banner("banner-1230x110"); ?>
    </div>

    <div class="left">

    <div class="content">

    <div id="gallery" class="am-gallery">

        <div class="am-image-wrapper">

        </div>

        <div class="am-nav">

            <div class="am-thumbs">

                <ul class="am-thumb-list">

                    <?php 
					$posts = get_posts(array('post_type' => 'news', 'meta_key' => 'nws_is_promo', 'meta_value' => 'on', 'posts_per_page' => 5));
                    ?>

                    <?php foreach ($posts as $post) : setup_postdata($post); ?>

                        <?php if (has_post_thumbnail()) : ?>

                            <?php
                            $cats = null;
                            $term = wp_get_post_terms(get_the_ID(), 'nlocation');
                            $cats = (count($term) > 0) ? $term[0]->name : null;
                            $term = wp_get_post_terms(get_the_ID(), 'ncategory');
                            if(count($term) > 0) {
                                if(!is_null($cats)) $cats .= ", ";
                                if(count($term) == 1) $cats .= $term[0]->name;
                                else {
                                    foreach($term as $t) {
                                        if($t->slug != 'lenta') {
                                            $cats .= $t->name;
                                            break;
                                        }
                                    }
                                }
                            }
                            ?>
                            <li>
                                <a href="<?php get_image_thumb(get_the_ID(), array(445,326), true, true); ?>">
                                    <img
                                        src="<?php get_image_thumb(get_the_ID(), array(122,82), true, true); ?>"
                                        title="<?php echo htmlspecialchars(get_the_title()); ?>"
                                        alt="<?php echo htmlspecialchars(get_the_title()); ?>"
                                        date="<?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), "slide"); ?>"
                                        comment="<?php comments_number('0', '1', '%'); ?>]|[<?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?>" link="<?php the_permalink(); ?>"
                                        longdesc="<?php echo htmlspecialchars(kama_excerpt('maxchar=200&echo')); ?>"
                                        class="grayscale">
                                    <div class="hover"></div>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </div>
    
</div>
</div>
<div class="right">
<div class="bside">

<!-- Tabs start -->
<ol class="tabs">
  <li><a href="#tab1">Последние</a></li>
  <li><a href="#tab2">Популярные</a></li>
</ol>

<div class="tab_container">
<div id="tab1" class="tab_content">

Git project

<?php 
$posts = get_posts(array('post_type' => 'news', 'posts_per_page' => 5, 'tax_query' => array(array('taxonomy' => 'ncategory', 'field' => 'slug', 'terms' => 'lenta')))); 
// var_dump($cat_posts);

?>
    <ul>
        <?php foreach ($posts as $post) : setup_postdata($post); ?>
            <li>
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <h2 class="post_title"><?php the_title(); ?></h2>
                <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>
                            <span class="post_comments"><i class="comment-ico"></i><?php comments_number('0', '1', '%');  ?></span>
                            <span class="post_views"><i class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>
                </a>
            </li>
        <?php endforeach; wp_reset_postdata(); ?>
        <?php
            $params = array(
                'post_type' => 'news',
                'posts_per_page' => $counter,
                'meta_key' => 'nws_is_main',
                'meta_compare' => 'NOT EXISTS',
            );
            $params['tax_query'] = array('relation' => 'AND');
            $params['tax_query'][] =  array('taxonomy' => 'ncategory', 'field' => 'slug', 'terms' => 'lenta');
            if(is_tax('nlocation')) {
                $params['tax_query'][] = array('taxonomy' => 'nlocation', 'field' => 'id', 'terms' => $qObj->term_id);
            }
            $posts = get_posts($params);
        ?>
        <?php
            $prepend = array_splice($posts, 0, $counter-15);
            foreach ($prepend as $post) : setup_postdata($post);
        ?>
            <li>
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <h2 class="post_title"><?php the_title(); ?></h2>
                <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>
                            <span class="post_comments"><i class="comment-ico"></i><?php comments_number('0', '1', '%');  ?></span>
                            <span class="post_views"><i
                                    class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>
                </a>
            </li>
        <?php endforeach; wp_reset_postdata(); ?>
    </ul>
</div>


<div id="tab2" class="tab_content">
<?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 10");
foreach ($result as $topten) {
$postid = $topten->ID;
$title = $topten->post_title;
$commentcount = $topten->comment_count;
if ($commentcount != 0) { ?>
<li><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>"><?php echo $title ?></a></li>
<?php } } ?>

</div>
							
</div>
<!-- Tabs end -->                        

</div>
</div>

</div>
<div class="biz-news">
<div class="shir">
<div class="b-carousel"> <!-- контейнер, в котором будет карусель -->
	
		<div class="b-carousel-button-left"></div> <!-- левая кнопка -->
		<div class="b-carousel-button-right"></div> <!-- правая кнопка -->
		
		<div class="h-carousel-wrapper"> <!-- видимая область карусели -->
			<div class="h-carousel-items"> <!-- весь набор элементов карусели -->
			
				<div class="b-carousel-block"> <!-- первый элемент карусели -->
					<a href="#" class="a-carousel-image-link">
						<img src="<?php echo get_template_directory_uri() ?>/images/test.jpg" alt="" />
					</a>
				</div>
				
				<div class="b-carousel-block">
					<a href="#" class="a-carousel-image-link">
						<img src="<?php echo get_template_directory_uri() ?>/images/test.jpg" alt="" />
                        <h2>djfhjh</h2>
					</a>
				</div>
				
				<div class="b-carousel-block">
					<a href="#" class="a-carousel-image-link">
						<img src="<?php echo get_template_directory_uri() ?>/images/test.jpg" alt="" />
					</a>
				</div>
				
				<div class="b-carousel-block">
					<a href="#" class="a-carousel-image-link">
						<img src="<?php echo get_template_directory_uri() ?>/images/test.jpg" alt="" />
					</a>
				</div>
				
				<div class="b-carousel-block"> <!-- последний элемент карусели -->
					<a href="#" class="a-carousel-image-link">
						<img src="<?php echo get_template_directory_uri() ?>/images/test.jpg" alt="" />
					</a>
				</div>
                <div class="b-carousel-block"> <!-- последний элемент карусели -->
					<a href="#" class="a-carousel-image-link">
						<img src="<?php echo get_template_directory_uri() ?>/images/test.jpg" alt="" />
					</a>
				</div>
                <div class="b-carousel-block"> <!-- последний элемент карусели -->
					<a href="#" class="a-carousel-image-link">
						<img src="<?php echo get_template_directory_uri() ?>/images/test.jpg" alt="" />
					</a>
				</div>
				
			</div>
		</div>
		
	</div>
</div>
</div>

<div class="shir">
<div class="other-news">
<div class="bside">

<!-- Tabs start -->
<ol class="tabs">
  <li><a href="#tab1">Новости Казахстана</a></li>
  <li><a href="#tab2">Мировые новости</a></li>
  <li><a href="#tab2">Новости спорта</a></li>
</ol>

<div class="tab_container">
<div id="tab1" class="tab_content">
<?php 
$cat_posts = get_posts(array('post_type' => 'som', 'posts_per_page' => 6, 'tax_query' => array(array('taxonomy' => 'somcat', 'field' => 'slug', 'terms' => 'somblog')))); 
// var_dump($cat_posts);

?>



<?php 
foreach ($cat_posts as $post) : setup_postdata($post); 
?>

<div class="week-news" style="  width: 220px;
  display: inline-block;
  float: left;
  margin: 0 20px 20px 0;">
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

								<?php get_image_thumb(get_the_ID(), array(220,100)); ?>
</a>
<div class="txt">
								<a href="<?php the_permalink(); ?>">

								<?php the_title_shorten(50); ?>

                                </a>

                                
<div style="height: 80px; overflow: hidden;   color: #898989;
  line-height: 18px;
  font-family: Tahoma;
  font-size: 14px;
">
                    
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
    <a href="#">Показать все новости</a>
</div>


<div id="tab2" class="tab_content">

</div>
							
</div>
<!-- Tabs end --> 
</div>
<div class="ban">
<img src="img/test.jpg">
</div>
</div>
<?php get_footer();