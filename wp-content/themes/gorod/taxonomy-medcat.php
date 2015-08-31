<?php
get_header('medical');
?>

    <div class="main no-border">
        <div class="right no-last">
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
            <div class="right-banners-bot">
                <div class="banner banner-305x350" id="med-banner-305x350x1">
                    <?php get_banner("med-banner-305x350x1"); ?>
                </div>
                <div class="banner banner-305x350" id="med-banner-305x350x2">
                    <?php get_banner("med-banner-305x350x2"); ?>
                </div>
            </div>
        </div>
        <div class="left">
            <div class="page">

                <div class="tags-block">
                    <?php
                    global $wp_query;
                    $term = $wp_query->get_queried_object();
                    ?>
                    <div class="tags-top">
                        <h1 class="title"><?php echo $term->name; ?></h1>
                        <?php wp_simple_pagination(); ?>
                    </div>

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
                </div>

                <div class="tags-bottom">
                    <?php wp_simple_pagination(); ?>
                </div>

            </div>
        </div>
    </div>

<?php
get_footer();