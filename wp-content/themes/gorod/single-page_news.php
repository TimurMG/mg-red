<?php
global $post;
get_header(); 
?>
    <div class="main"> 

        <div class="left"> 

            <?php if($post->post_parent == 0) : ?>
                <div class="page">

                    <div class="tags-block">

                        <div class="tags-top">
                            <h1 class="title"><?php echo $post->post_title; ?></h1>
                            <?php wp_simple_pagination(); ?>
                        </div>

                        <ul class="tags-list">
                            <style>
                                .post_thumb img { margin: 0 20px 15px 0 !important; }
                            </style>
                            <?php $pages = get_pages(array('child_of' => $post->ID, 'post_type' => 'page_news', 'sort_column' => 'post_date', 'sort_order' => 'desc')); ?>
                            <?php foreach($pages as $post) : setup_postdata($post); ?>
                                <li class="tags_teaser_item" style="width: 100%;">
                                    <div style="overflow: visible;">
                                        <?php if(has_post_thumbnail( get_the_ID() )) : ?>
                                            <div class="post_thumb"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php get_image_thumb(get_the_ID(), array(95, 70)); ?></a></div>
                                        <?php endif; ?>
                                        <div class="post_time">
                                            <?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?>
                                            <span class="views"><i class="views-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>
                                        </div>
                                        <h2 class="post_title" style="height: auto; overflow: visible; margin: 0 0 15px;">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title();  ?></a></h2>
                                        <div style="clear: both;"><?php the_excerpt(); ?></div>
                                    </div>
                                </li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                    </div>

                    <div class="tags-bottom">
                        <?php wp_simple_pagination(); ?>
                    </div>

                </div>
            <?php else : ?>
            <div class="single single-news"> 
                <?php while (have_posts()) : the_post(); ?> 
                    <h1 class="title"><?php the_title(); ?></h1>
                    <div class="tools"> 
                        <span class="date"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span> 
                        <span class="views"><i class="views-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>
                        <span class="print"><a href="/"><i class="print-ico"></i>Версия для печати</a></span> 
                    </div>
                    <div class="single-news-content"><?php the_content(); ?></div>
                    <div style="margin-left: -5000px;"><?php echo get_post_meta(get_the_ID(), 'nws_links', true) ?></div>
                <?php endwhile; ?> 
                <div class="banner banner-880x110" id="banner-880x110"> 
                    <?php get_banner("banner-880x110"); ?> 
                </div> 
            </div>
            <?php endif; ?>
        </div>
        <div class="right"> 
            <?php get_template_part('right-sidebar'); ?> 
        </div> 
    </div> 

<?php 
get_footer();