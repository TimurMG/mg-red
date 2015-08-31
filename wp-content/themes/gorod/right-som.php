<div style="float:left; margin-right:20px;">
<div class="latest-news-block ppost" style="border: 1px solid #E5E5E5; width: 300px; margin-bottom:20px; height:1096px; overflow:hidden;">

<h1 style="  border: 0;
  
    padding: 20px 10px 0px 30px !important;
  font-size: 20px;
  font-family: 'bandera_proregular';">
  <img src="http://mgorod.kz/wp-content/uploads/2015/07/lenta1.png" style="position:absolute;   margin-top: 3px;
  margin-left: -36px;">
  Новости от <b>SOMICADZE</b></h1>

<?php 
$posts = get_posts(array('post_type' => 'som', 'posts_per_page' => 13, 'tax_query' => array(array('taxonomy' => 'somcat', 'field' => 'slug', 'terms' => 'newsweek')))); 
?>
<a href="/weekend/newsweek/" class="view-all">
        Показать все новости
        </a>
        <ul style="margin:15px 30px !important;">
            <?php foreach ($posts as $post) : setup_postdata($post); ?>
                
                <li>
                    <a href="<?php the_permalink() ?>">
                    
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                    <td style="width: 80px;">
                    <div style="color: #999; font-size: 12px;">
                    <?php echo get_the_date('d M  H:i'); ?>
                    </div>
                    </td>
                    <td>
                    <div style="font-size: 12px;
  color: #999;">
                    <img src="http://mgorod.kz/wp-content/uploads/2015/07/09chat2.png" style="  width: 10px;
  height: 9px;
  opacity: 0.4; float:none !important; margin:auto !important;
  top: -3px;"> <?php comments_number('0', '1', '%');  ?>   <img src="http://mgorod.kz/wp-content/uploads/2015/07/12eye.png" style="  width: 10px;
  height: 7px;
  opacity: 0.4; float:none !important; margin:auto !important;
  top: -4px;"> <?php echo getPostViews(get_the_ID()); ?>
                    </div>
                    </td>
                    </tr>
                    </table>
                    <h2 class="post_title" style="text-decoration:none !important;  font-size:16px !important;  margin: 7px 0;"><?php the_title(); ?></h2>
                    
                    </a>
                </li>
            <?php endforeach; wp_reset_postdata(); ?>
        </ul>
        
</div>
</div>