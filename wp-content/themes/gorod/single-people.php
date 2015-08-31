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
            <div class="single single-news doctor">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="dr-single-info">
                        <?php if(has_post_thumbnail()) {
                            get_image_thumb(get_the_ID(), array(200,190));
                        } ?>

                        <h1 class="title"><?php the_title(); ?></h1>
                        <div class="dr-spec"><?php echo get_post_meta(get_the_ID(), 'pl_specialization', true); ?></div>
                        <div class="dr-content"><?php the_content(); ?></div>
                    </div>

                    <div class="comment-respond">
                        <h3>Задать вопрос</h3>

                        <?php echo do_shortcode('[contact-form-7 id="32821"]'); //21171  ?>
                    </div>

                    <div class="banner banner-880x110" id="med-banner-880x110">
                        <?php get_banner("med-banner-880x110"); ?>
                    </div>

                    <div class="comment-respond dr-comments">
                        <h3>Последние вопросы и ответы</h3>
                        <?php comments_template('/comments-medical.php'); ?>
                    </div>
                    <div class="health-confirm-text">
                        <?php if ( is_active_sidebar( 'sidebar-medical-text' ) ) {
                            dynamic_sidebar( 'sidebar-medical-text' );
                        } ?>
                    </div>

                <?php endwhile; ?>
            </div>
        </div>
    </div>

<?php
get_footer();