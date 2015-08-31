<?php 
/*
Template Name: Архив газеты
*/

get_header(); 

?> 

    <div class="main"> 





        <div class="left"> 



            <div class="single single-news"> 

                <?php while (have_posts()) : the_post(); ?> 

                    <div class="breadcrumbs"><?php get_news_breadcrumbs(); ?></div> 

                    <h1 class="title"><?php the_title(); ?></h1> 

                    <div class="tools"> 

                        <span class="date"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>

<? 
$res = mysql_query("SELECT comment_count FROM mt_posts WHERE post_name='arxiv-gazet'");
$myr_count = mysql_fetch_array($res);

$don = $myr_count['comment_count'] + 1;

$res2 = mysql_query("UPDATE mt_posts SET comment_count='$don' WHERE post_name='arxiv-gazet'");
?>                        

<span class="views"><i class="views-ico"></i> <?php comments_number('0', '1', '%'); ?> </span> 

                        <span class="print"><a href="/"><i class="print-ico"></i>Версия для печати</a></span> 

                    </div> 



                    <?php if(has_excerpt()) :  ?> 

                    <div class="excerpt"><?php the_excerpt(); ?></div> 

                    <?php endif; ?> 



                    <div class="single-news-content" style="margin-left: 0px !important;">
                    
                    <? 
					$res = mysql_query("SELECT * FROM arhpdf ORDER by id DESC");
					$myrow = mysql_fetch_array($res);
					
					if ($myrow > 0){
						
						do 
	{

	printf ("<div class='arhpdf'><div style='font-size:14px;'><div class='knopki'><a href='%s' target='_blank'>Скачать</a> | <a href='%s' target='_blank'>Читать</a></div>
<div style='height:208px; overflow:hidden;  margin-bottom: 5px !important; border:1px solid #CCC;'>
<img src='%s' style='width:150px;'>
</div>
%s
</div></div>",$myrow['rard'],$myrow['fail'],$myrow['img'],$myrow['title']);
	}

	while ($myrow = mysql_fetch_array($res));
						
						}else{
							echo'<div style="background-color:#EEE; color:#000; padding:10px; display:block;">Упс! А газет то нету!</div>';
							}
					?>
                    
                    </div> 
                <?php endwhile; ?> 
<p>&nbsp;</p>
                <div class="banner banner-880x110" id="banner-880x110"> 

                    <?php get_banner("banner-880x110"); ?> 

                </div> 

            </div> 

        </div> 

        <div class="right"> 

            <?php get_template_part('right-sidebar'); ?> 

        </div> 

    </div> 



<?php 

get_footer();