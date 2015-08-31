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
            <div class="single single-news">
                <?php while (have_posts()) : the_post(); ?>
                    <h1 class="title"><?php the_title(); ?></h1>
                    <div class="tools">
                        <span class="date"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>
                        <span class="comments"><i class="comments-ico"></i><?php comments_number('0', '1', '%'); ?></span>
                        <span class="views"><i class="views-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>
                        <span class="print"><a href="/"><i class="print-ico"></i>Версия для печати</a></span>
                    </div>

                    <?php if(has_excerpt()) :  ?>
                    <div class="excerpt"><?php the_excerpt(); ?></div>
                    <?php endif; ?>

                    <div class="single-news-content"><?php the_content(); ?></div>

                <?php endwhile; ?>
                <div class="banner banner-880x110" id="med-banner-880x110">
                    <?php get_banner("med-banner-880x110"); ?>
                </div>
            </div>
            <?php comments_template(); ?>
            <div class="health-confirm-text">
                <?php if ( is_active_sidebar( 'sidebar-medical-text' ) ) {
                    dynamic_sidebar( 'sidebar-medical-text' );
                } ?>
            </div>
        </div>
    </div>

<?php
get_footer();