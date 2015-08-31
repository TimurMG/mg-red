<?php
/*
Template Name: Врачи
*/
?>
<?php
get_header('medical');
?>

    <div class="main no-border">
        <div class="right">
            <div class="right-banners-top">
                <div class="banner banner-305x150" id="med-banner-305x150x1">
                    <?php get_banner("med-banner-305x150x1"); ?>
                </div>
                <div class="banner banner-305x150" id="med-banner-305x150x2">
                    <?php get_banner("med-banner-305x150x2"); ?>
                </div>
                <div class="banner banner-305x150" id="med-banner-305x150x3">
                    <?php get_banner("med-banner-305x150x3"); ?>
                </div>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/link-me101/link.php');
$o['charset'] = 'utf-8';
$o[ 'force_show_code' ] = true;
$o[ 'host' ] = 'mgorod.kz';
$clientlink = new linkClient($o);
unset($o);
echo $clientlink->start_links();
?>

            </div>
        </div>
        <div class="left">
            <?php
            $posts = get_posts(array('post_type' => 'medicalnews', 'posts_per_page' => 21, 'tax_query' => array(array('taxonomy' => 'medcat', 'field' => 'slug', 'terms' => 'events'))));
            $mainID = 0;
            ?>

            <?php if (count($posts) > 0) : ?>

                <div class="medical-events-block">
                    <?php foreach ($posts as $post) : setup_postdata($post); ?>

                        <?php if (has_post_thumbnail()) : ?>

                            <div class="first">
                                <a href="<?php the_permalink(); ?>" class="thumb-link">
                                    <img src="<?php get_image_thumb(get_the_ID(), array(515, 315), true, true); ?>"
                                         width="100%" alt="<?php echo htmlspecialchars(get_the_title()); ?>">
                                </a>
                                <?php
                                $date = get_date_formatted(get_the_date('d.m.Y.H.i'), "slide");
                                $views = get_post_meta(get_the_ID(), 'views', true);
                                $views = (empty($views)) ? '0' : $views;
                                ?>
                                <div class="info">
                                    <h2><?php the_title(); ?></h2>

                                    <div class="desc"><a
                                            href="<?php the_permalink(); ?>"><?php echo htmlspecialchars(kama_excerpt('maxchar=120&echo')); ?></a>
                                    </div>
                                    <div class="i-line">
                                        <span class="comments"><i
                                                class="comment-ico"></i><?php comments_number('0', '1', '%'); ?></span>
                                        <span class="views"><i class="view-ico"></i><?php echo $views; ?></span>
                                        <span class="date"><?php echo $date; ?></span>
                                    </div>
                                </div>
                            </div>

                            <?php $mainID = get_the_ID();
                            break; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <div class="list">
                        <div class="title">
                            <h1>Последние события</h1>
                        </div>
                        <ul>
                            <?php foreach ($posts as $post) : setup_postdata($post); ?>
                                <li>
                                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                                        <h2 class="post_title"><?php the_title(); ?></h2>
                                        <span
                                            class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>
                                        <span class="post_comments"><i
                                                class="comment-ico"></i><?php comments_number('0', '1', '%'); ?></span>
                                        <span class="post_views"><i
                                                class="view-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true);
                                            echo (empty($views)) ? '0' : $views; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>

            <?php endif; ?>
        </div>
    </div>

    <ul class="two-banners-block">
        <li>
            <div class="banner banner-605x150" id="med-banner-605x150x1">
                <?php get_banner("med-banner-605x150x1"); ?>
            </div>
        </li>
        <li>
            <div class="banner banner-605x150" id="med-banner-605x150x2">
                <?php get_banner("med-banner-605x150x2"); ?>
            </div>
        </li>
    </ul>

    <div class="main no-border">
        <div class="right">
            <div class="right-banners-bot">
                <div class="banner banner-305x350" id="med-banner-305x350x1">
                    <?php get_banner("med-banner-305x350x1"); ?>
                </div>
                <div class="banner banner-305x350" id="med-banner-305x350x2">
                    <?php get_banner("med-banner-305x350x2"); ?>
                </div>
                <div class="banner banner-305x350" id="med-banner-305x350x3">
                    <?php get_banner("med-banner-305x350x3"); ?>
                </div>
                <div class="banner banner-305x350" id="med-banner-305x350x4">
                    <?php get_banner("med-banner-305x350x4"); ?>
                </div>
            </div>
        </div>
        <div class="left">
            <div class="dr-block">
<div style="position:absolute; color:#FFF; width:890px; text-align:center; height:390px; background-color:rgba(0,0,0,0.7);">
<p style="margin-top:170px; font-size:30px; position:relative;">
Извините, закрыто на ремонт!
</p>
</div>
                <h2>Задать вопрос</h2>
                <?php
                    $drs = get_posts(array('post_type' => 'people', 'posts_per_page' => -1));
                ?>
                <ul class="dr-list">
                    <?php foreach ($drs as $post) : setup_postdata($post); ?>
                        <?php if(has_post_thumbnail()) : ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <?php get_image_thumb(get_the_ID(), array(149, 185), true); ?>
                                </a>
                                <div class="dr-name"><?php the_title(); ?></div>
                                <div class="dr-spec">
                                    <a href="<?php the_permalink(); ?>"><?php echo get_post_meta(get_the_ID(), 'pl_specialization', true); ?></a>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <ul class="two-banners-block two-banners-min">
                <li>
                    <div class="banner banner-434x150" id="med-banner-434x150xl1x1">
                        <?php get_banner("med-banner-434x150xl1x1"); ?>
                    </div>
                </li>
                <li>
                    <div class="banner banner-434x150" id="med-banner-434x150xl1x2">
                        <?php get_banner("med-banner-434x150xl1x2"); ?>
                    </div>
                </li>
            </ul>

            <?php
            $isFirst = true;
            $cat_posts = get_posts(array('post_type' => 'medicalnews', 'posts_per_page' => 6, 'tax_query' => array(array('taxonomy' => 'medcat', 'field' => 'slug', 'terms' => 'news'))));
            ?>
            <div class="category-news-block shadow">
                <h1 class="title">
                    <?php $t_term = get_term_by( 'slug', 'news', 'medcat' ); echo $t_term->name;  ?> <span class="archive"><a href="/medcat/news/">архив</a></span>
                </h1>
                <?php if (count($cat_posts) > 0) {
                    $post = $cat_posts[0];
                    setup_postdata($post) ?>
                    <div class="main-news">
                        <?php if (has_post_thumbnail(get_the_ID())) : ?>
                            <div class="post-thumb">
                                <a href="<?php the_permalink() ?>" title="<?php echo htmlspecialchars(get_the_title()); ?>">
                                    <?php get_image_thumb(get_the_ID(), array(320,160)); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <h2><?php the_title_shorten(50); ?></h2>
                        <a href="<?php the_permalink(); ?>" title=""
                           class="post-shot-content"><?php kama_excerpt("maxchar=200"); ?></a>

                        <div class="post-time-view">
                            <?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), 'v'); ?>
                            <span class="comments"><i class="comment-ico"></i>
                                <?php comments_number('0', '1', '%'); ?>
                                            </span>
                    <span class="view"><i class="view-ico"></i>
                        <?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?>
                                            </span>
                        </div>
                    </div>
                <?php } ?>
                <div class="second">
                    <ul>
                        <?php
                        foreach ($cat_posts as $post) : setup_postdata($post);
                            if ($isFirst) {
                                $isFirst = false;
                                continue;
                            }
                            ?>
                            <li>
                                <a href="<?php the_permalink() ?>" title="<?php echo htmlspecialchars(get_the_title()); ?>">
                                    <?php get_image_thumb(get_the_ID(), array(76,50)); ?>
                                </a>
                                <div class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), 'v'); ?></div>
                                <h2><a href="<?php the_permalink(); ?>"
                                       title="<?php echo htmlspecialchars(get_the_title()); ?>"><?php the_title_shorten(50); ?></a>
                                </h2>
                            </li>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>

            <ul class="two-banners-block two-banners-min">
                <li>
                    <div class="banner banner-434x150" id="med-banner-434x150xl2x1">
                        <?php get_banner("med-banner-434x150xl2x1"); ?>
                    </div>
                </li>
                <li>
                    <div class="banner banner-434x150" id="med-banner-434x150xl2x2">
                        <?php get_banner("med-banner-434x150xl2x2"); ?>
                    </div>
                </li>
            </ul>

            <?php
                $cat_posts = get_posts(array('post_type' => 'medicalnews', 'posts_per_page' => 10, 'tax_query' => array(array('taxonomy' => 'medcat', 'field' => 'slug', 'terms' => 'usefulness'))));
            ?>
            <div class="category-news-block list2cols">
                <h1 class="title">
                    <?php $t_term = get_term_by( 'slug', 'usefulness', 'medcat' ); echo $t_term->name;  ?> <span class="archive"><a href="/medcat/usefulness/">архив</a></span>
                </h1>
                <?php if (count($cat_posts) > 0) { ?>
                    <div class="list">
                        <ul>
                            <?php
                            foreach ($cat_posts as $post) : setup_postdata($post); ?>
                                <li>
                                    <div>
                                        <a href="<?php the_permalink() ?>" title="<?php echo htmlspecialchars(get_the_title()); ?>">
                                            <?php get_image_thumb(get_the_ID(), array(76,50)); ?>
                                        </a>
                                        <div class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), 'v'); ?></div>
                                        <h2><a href="<?php the_permalink(); ?>"
                                               title="<?php echo htmlspecialchars(get_the_title()); ?>"><?php the_title_shorten(50); ?></a>
                                        </h2>
                                    </div>
                                </li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="health-confirm-text">
                <?php if ( is_active_sidebar( 'sidebar-medical-text' ) ) {
                    dynamic_sidebar( 'sidebar-medical-text' );
                } ?>
            </div>

        </div>
    </div>

<?php
get_footer();