<?php
/*
Template Name: Добавить рецепт
*/
?>
<?php
get_header('recipe');
?>

    <div class="main no-border">
        <div class="right no-last">
            <div class="right-banners-top">
                <div class="banner banner-305x150" id="recipe-banner-305x150x1">
                    <?php get_banner("recipe-banner-305x150x1"); ?>
                </div>
                <div class="banner banner-305x150" id="recipe-banner-305x150x2">
                    <?php get_banner("recipe-banner-305x150x2"); ?>
                </div>
                <div class="banner banner-305x150" id="recipe-banner-305x150x3">
                    <?php get_banner("recipe-banner-305x150x3"); ?>
                </div>
            </div>
            <div class="right-banners-bot">
                <div class="banner banner-305x350" id="recipe-banner-305x350x1">
                    <?php get_banner("recipe-banner-305x350x1"); ?>
                </div>
                <div class="banner banner-305x350" id="recipe-banner-305x350x2">
                    <?php get_banner("recipe-banner-305x350x2"); ?>
                </div>
            </div>
        </div>
        <div class="left">
            <div class="single single-news">
                <?php while (have_posts()) : the_post(); ?>
                    <h1 class="title"><?php the_title(); ?></h1>
                    <div class="comment-respond">
                        <?php echo do_shortcode('[contact-form-7 id="35151"]'); //21223  ?>
                    </div>
                <?php endwhile; ?>
                <div class="banner banner-880x110" id="recipe-banner-880x110">
                    <?php get_banner("recipe-banner-880x110"); ?>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();