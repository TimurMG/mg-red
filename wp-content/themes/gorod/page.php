<?php
get_header();
?>

    <div class="main">
        <div class="left">
            <div class="page">
                <?php while (have_posts()) : the_post(); ?>
                    <h1 class="title"><?php the_title(); ?></h1>

                    <div class="page-content"><?php the_content(); ?></div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="right">
            <?php get_template_part('right-sidebar'); ?>
        </div>
    </div>

<?php
get_footer();