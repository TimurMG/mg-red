<?php
get_header();
?>

    <div class="main">
        <div class="left">
            <div class="page">

                <div class="tags-block">
                    <?php
                    global $wp_query;
                    $term = $wp_query->get_queried_object();
                    ?>
                    <div class="breadcrumbs"><a href="/">Главная</a></div>

                    <div class="tags-top">
                        <h1 class="title search">ВЫ ИСКАЛИ: "<?php echo get_search_query(); ?>"</h1>
                    </div>

                    <?php if(have_posts()) : ?>
                    <ul class="tags-list">
                        <?php while(have_posts()) : the_post(); ?>
                            <li class="tags_teaser_item">
                                <div>
                                    <?php if(has_post_thumbnail( get_the_ID() )) : ?>
                                        <div class="post_thumb"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php get_image_thumb(get_the_ID(), array(95, 70)); ?></a></div>
                                    <?php endif; ?>
                                    <div class="post_time">
                                        <?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?>
                                        <span class="views"><i class="views-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>
                                    </div>
                                    <h2 class="post_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title();  ?></a></h2>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php else : ?>
                        <div class="tags-top">
                            <h1 class="title search">По вашему запросу ничего не найдено, попробуйте искать по другим ключевым словам...</h1>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="tags-bottom">
                    <?php wp_simple_pagination(); ?>
                </div>

            </div>
        </div>
        <div class="right">
            <?php get_template_part('right-sidebar'); ?>
        </div>
    </div>

<?php
get_footer();