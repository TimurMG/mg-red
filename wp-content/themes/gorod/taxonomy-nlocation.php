<?php
get_header();
?>

    <div class="main">
    <div class="left">

    <div class="content">
    <div id="gallery" class="am-gallery">
        <div class="am-image-wrapper">
        </div>
        <div class="am-nav">
            <div class="am-thumbs">
                <ul class="am-thumb-list">
                    <?php
                    global $term;
                    $t = is_array($term) ? $term[0]->slug : $term;
                    $posts = get_posts(array('post_type' => 'news', 'meta_key' => 'nws_is_promo', 'meta_value' => 'on', 'posts_per_page' => 10, 'nlocation' => $t));
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
                                <a href="<?php get_image_thumb(get_the_ID(), array(568,328), true, true); ?>">
                                    <img
                                        src="<?php get_image_thumb(get_the_ID(), array(160,96), true, true); ?>"
                                        title="<?php echo htmlspecialchars(get_the_title()); ?>"
                                        alt="<?php echo htmlspecialchars(get_the_title()); ?>"
                                        date="<?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), "slide"); ?>"
                                        comment="<?php comments_number('0', '1', '%'); ?>]|[<?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?>"
                                        link="<?php the_permalink(); ?>"
                                        longdesc="<?php echo htmlspecialchars(kama_excerpt('maxchar=180&echo')); ?>"
                                        category="<?php echo $cats; ?>"
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

    <div class="banner banner-880x110" id="banner-880x110">
        <?php get_banner("banner-880x110"); ?>
    </div>


    <div class="news-block-col3">
        <div class="photo-block">
            <?php get_template_part('photoreport'); ?>
        </div>
        <div class="news-block tabs">
            <ul>
                <li><a href="#local">Новости Казахстана</a></li>
                <li><a href="#world">Мировые новости</a></li>
            </ul>
            <div id="local">
                <?php
                $isFirst = true;
                $cat_posts = get_posts(array('post_type' => 'news', 'ncategory' => 'in-country', 'posts_per_page' => 5));
                ?>
                <div class="local-news">
                    <?php if (count($cat_posts) > 0) {
                        $post = $cat_posts[0];
                        setup_postdata($post) ?>
                        <div class="main-news">
                            <?php if (has_post_thumbnail(get_the_ID())) : ?>
                                <div class="post-thumb"><a href="<?php the_permalink() ?>" title="<?php echo htmlspecialchars(get_the_title()); ?>">
                                        <?php get_image_thumb(get_the_ID(), array(224,160)); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <h2><?php the_title_shorten(50); ?></h2>
                            <a href="<?php the_permalink(); ?>" title=""
                               class="post-shot-content"><?php kama_excerpt("maxchar=200"); ?></a>

                            <div class="post-time-view">
                                <?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), 'v'); ?>
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
                                    <div
                                        class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), 'v'); ?></div>
                                    <h2><a href="<?php the_permalink(); ?>"
                                           title="<?php echo htmlspecialchars(get_the_title()); ?>"><?php the_title_shorten(60); ?></a>
                                    </h2>
                                </li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                        <div class="all-news"><a href="/ncategory/in-country/">Все новости Казахстана</a></div>
                    </div>
                </div>
                <div class="clearer"></div>
            </div>
            <div id="world">
                <?php
                $isFirst = true;
                $cat_posts = get_posts(array('post_type' => 'news', 'ncategory' => 'in-world', 'posts_per_page' => 5));
                ?>
                <div class="local-news">
                    <?php if (count($cat_posts) > 0) {
                        $post = $cat_posts[0];
                        setup_postdata($post) ?>
                        <div class="main-news">
                            <?php if (has_post_thumbnail(get_the_ID())) : ?>
                                <div class="post-thumb"><a href="<?php the_permalink() ?>" title="<?php echo htmlspecialchars(get_the_title()); ?>">
                                        <?php get_image_thumb(get_the_ID(), array(224,160)); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <h2><?php the_title_shorten(50); ?></h2>
                            <a href="<?php the_permalink(); ?>" title=""
                               class="post-shot-content"><?php kama_excerpt("maxchar=200"); ?></a>

                            <div class="post-time-view">
                                <?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), 'v'); ?>
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
                                    <div
                                        class="post_time"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), 'v'); ?></div>
                                    <h2><a href="<?php the_permalink(); ?>"
                                           title="<?php echo htmlspecialchars(get_the_title()); ?>"><?php the_title_shorten(60); ?></a>
                                    </h2>
                                </li>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </ul>
                        <div class="all-news"><a href="/ncategory/in-world/">Все Мировые новости</a></div>
                    </div>
                </div>
                <div class="clearer"></div>
            </div>
        </div>
    </div>

    <div class="banner banner-880x110" id="banner-880x110x2">
        <?php get_banner("banner-880x110x2"); ?>
    </div>


    <?php
    $isFirst = true;
    $cat_posts = get_posts(array('post_type' => 'news', 'ncategory' => 'avto-news', 'posts_per_page' => 6));
    ?>
    <div class="category-news-block auto">
        <h1 class="title">
            <?php $t_term = get_term_by( 'slug', 'avto-news', 'ncategory' ); echo $t_term->name;  ?> <span class="archive"><a href="/ncategory/avto-news/">все новости</a></span>
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
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
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


    <div class="banners-block-col2">
        <div class="banner banner-420x145x1" id="banner-420x145x1">
            <?php get_banner("banner-420x145x1"); ?>
        </div>
        <div class="banner banner-420x145x2" id="banner-420x145x2">
            <?php get_banner("banner-420x145x2"); ?>
        </div>
    </div>

    <?php
    $isFirst = true;
    $cat_posts = get_posts(array('post_type' => 'news', 'ncategory' => 'interviews_analyst', 'posts_per_page' => 6));
    ?>
    <div class="category-news-block interview">
        <h1 class="title">
            <?php $t_term = get_term_by( 'slug', 'interviews_analyst', 'ncategory' ); echo $t_term->name;  ?> <span class="archive"><a href="/ncategory/interviews_analyst/">все новости</a></span>
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
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
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
    </div>

    </div>
    <div class="right">
        <?php get_template_part('right-sidebar'); ?>
    </div>
    </div>


<?php
get_footer();