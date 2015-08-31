<?php if(is_page('adspage') || is_page('add-ads') || is_page('manage-ads') || is_tax('adscategory') || is_singular('ads')) : ?>

    <div class="latest-news-block">

        <div class="title">

            <h1>Последние объявления</h1>

        </div>

        <?php

        $counter = 8;

        $posts = get_posts(

            array(

                'post_type' => 'ads',

                'posts_per_page' => 3,

                'meta_key' => 'ads_vip',

                'meta_value' => 'on'

            ));

        $counter = $counter - count($posts);

        ?>

        <ul>

            <?php foreach ($posts as $post) : setup_postdata($post); ?>

                <li>

                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">



                    <?php if(has_post_thumbnail()) get_image_thumb(get_the_ID(), array(95,70)); ?>



                    <h2 class="post_title"><?php the_title(); ?></h2>

                    <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>

                    <span class="post_views"><i class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>

                    <div class="vip"></div>

                    </a>

                </li>

            <?php endforeach; wp_reset_postdata(); ?>

            <?php

            $posts = get_posts(

                array(

                    'post_type' => 'ads',

                    'posts_per_page' => $counter,

                    'meta_key' => 'ads_vip',

                    'meta_compare' => 'NOT EXISTS'

                ));

            ?>

            <?php

            foreach ($posts as $post) : setup_postdata($post);

                ?>

                <li>

                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">



                    <?php if(has_post_thumbnail()) get_image_thumb(get_the_ID(), array(95,70)); ?>



                    <h2 class="post_title"><?php the_title(); ?></h2>

                    <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>

                    <span class="post_views"><i class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>

                    </a>

                </li>

            <?php endforeach; wp_reset_postdata(); ?>

        </ul>



        <div class="banner banner-320x375" id="banner-320x375">

            <?php get_banner("banner-320x375"); ?>

        </div>

    </div>

<?php elseif(is_home() || is_front_page() || is_singular('banners') || is_tax('nlocation') || is_post_type_archive('news') || is_page() || is_singular('news')) : ?>

<div class="latest-news-block">

    <div class="title">

        <h1>Последние новости</h1>

    </div>

        <?php

        $counter = 20;

        $qObj = get_queried_object();



        $params = array(

            'post_type' => 'news',

            'posts_per_page' => 3,

            'meta_key' => 'nws_is_main',

            'meta_value' => 'on',

            'meta_compare' => '=',

        );



        $params['tax_query'] = array('relation' => 'AND');

        $params['tax_query'][] =  array('taxonomy' => 'ncategory', 'field' => 'slug', 'terms' => 'lenta');



        if(is_tax('nlocation')) {

            $params['tax_query'][] = array('taxonomy' => 'nlocation', 'field' => 'id', 'terms' => $qObj->term_id);

        }



        $posts = get_posts($params);

        $counter = $counter - count($posts);

        ?>

    <ul>

        <?php foreach ($posts as $post) : setup_postdata($post); ?>

            <li>

                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">



                <h2 class="post_title"><?php the_title(); ?></h2>

                <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>

                            <span class="post_comments"><i

                                    class="comment-ico"></i><?php comments_number('0', '1', '%');  ?></span>

                            <span class="post_views"><i

                                    class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>

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

                            <span class="post_comments"><i

                                    class="comment-ico"></i><?php comments_number('0', '1', '%');  ?></span>

                            <span class="post_views"><i

                                    class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>

                </a>

            </li>

        <?php endforeach; wp_reset_postdata(); ?>

    </ul>



    <div class="banner banner-320x375" id="banner-320x375" style="overflow: hidden;">

        <?php get_banner("banner-320x375"); ?>

    </div>









    <ul>

        <?php

            $prepend = array_splice($posts, 0, $counter-15);

            foreach ($prepend as $post) : setup_postdata($post);

        ?>

            <li>

                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">



                <h2 class="post_title"><?php the_title(); ?></h2>

                <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>

                            <span class="post_comments"><i

                                    class="comment-ico"></i><?php comments_number('0', '1', '%');  ?></span>

                            <span class="post_views"><i

                                    class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>

                </a>

            </li>

        <?php endforeach; wp_reset_postdata(); ?>

    </ul>


<div  style="overflow: hidden;">

        <?php get_banner("ultrabban-305x356"); ?>

    </div>









    <ul>

        <?php

            $prepend = array_splice($posts, 0, $counter-15);

            foreach ($prepend as $post) : setup_postdata($post);

        ?>

            <li>

                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">



                <h2 class="post_title"><?php the_title(); ?></h2>

                <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>

                            <span class="post_comments"><i

                                    class="comment-ico"></i><?php comments_number('0', '1', '%');  ?></span>

                            <span class="post_views"><i

                                    class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>

                </a>

            </li>

        <?php endforeach; wp_reset_postdata(); ?>

    </ul>    

   
    
    
    <!------vtoroi----->
    <div class="banner banner-320x375" id="banner-320x375" style="overflow: hidden;">

        <?php get_banner("banner-305x356"); ?>

    </div>
    <ul>

        <?php foreach ($posts as $post) : setup_postdata($post); ?>
            <li>
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <h2 class="post_title"><?php the_title(); ?></h2>
                <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>
                            <span class="post_comments"><i
                                    class="comment-ico"></i><?php comments_number('0', '1', '%');  ?></span>
                            <span class="post_views"><i
                                    class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>
                </a>
            </li>
        <?php endforeach; wp_reset_postdata(); ?>
    </ul>
    
    

    <div class="news-archive-link"><a href="<?php echo get_post_type_archive_link('news'); ?>">Архив новостей</a></div>




<!----------right-side-bar-in-categorii--------->


<?php elseif (is_tax('ncategory') || is_tax('ntag') || is_search() || is_tax('catcategory') || is_singular('catalog') || is_singular('competition')) : ?>

    <div class="latest-news-block">

        <div class="title">

            <h1>Последние новости</h1>

        </div>

        <?php

        $counter = 5;

        $posts = get_posts(

            array(

                'post_type' => 'news',

                'posts_per_page' => 3,

                'meta_key' => 'nws_is_main',

                'meta_value' => 'on',

                'meta_compare' => '=',

                'tax_query' => array(

                    'relation' => 'AND',

                    array('taxonomy' => 'ncategory', 'field' => 'slug', 'terms' => 'lenta')

                )

            ));

        $counter = $counter - count($posts);

        ?>

        <ul>

            <?php foreach ($posts as $post) : setup_postdata($post); ?>

                <li>

                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">



                    <h2 class="post_title"><?php the_title(); ?></h2>

                    <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>

                            <span class="post_comments"><i

                                    class="comment-ico"></i><?php comments_number('0', '1', '%');  ?></span>

                            <span class="post_views"><i

                                    class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>

                    </a>

                </li>

            <?php endforeach; wp_reset_postdata(); ?>

            <?php

            $posts = get_posts(

                array(

                    'post_type' => 'news',

                    'posts_per_page' => $counter,

                    'meta_key' => 'nws_is_main',

                    'meta_compare' => 'NOT EXISTS',

                    'tax_query' => array(

                        'relation' => 'AND',

                        array('taxonomy' => 'ncategory', 'field' => 'slug', 'terms' => 'lenta')

                    )

                ));

            ?>

            <?php

            foreach ($posts as $post) : setup_postdata($post);

                ?>

                <li>

                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">



                    <h2 class="post_title"><?php the_title(); ?></h2>

                    <span class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>

                            <span class="post_comments"><i

                                    class="comment-ico"></i><?php comments_number('0', '1', '%');  ?></span>

                            <span class="post_views"><i

                                    class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>

                    </a>

                </li>

            <?php endforeach; wp_reset_postdata(); ?>

        </ul>

        <div class="news-archive-link"><a href="<?php echo get_post_type_archive_link('news'); ?>">Архив новостей</a></div>



        

<div class="banner banner-320x375" id="banner-320x375">

            <?php get_banner("banner-320x375"); ?>

        </div>

    </div>

<?php endif; ?>





<?php $ban305x384 = get_banner("banner-305x384", false); ?>



<?php if($ban305x248) : ?>

<div class="banner banner-305x248" id="banner-305x248">

    <?php echo $ban305x248; ?>

</div>

<?php endif; ?>



<?php if($ban305x384) : ?>

<div class="banner banner-305x384" id="banner-305x384">

    <?php echo $ban305x384; ?>

</div>

<?php endif; ?>

</div>





<a rel='nofollow' href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="<?php echo get_template_directory_uri() ?>/images/error-text.jpg" border="0" width="320" height="100" /></a>
