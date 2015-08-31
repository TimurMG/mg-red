<?php
get_header();
?>

    <div class="main">
        <div class="left">
            <div class="single single-news">
                <div class="error">404</div><span>страница не найдена</span><br>
                <em><a href="/">на главную</a></em>
            </div>
        </div>
        <div class="right">
            <?php get_template_part('right-sidebar'); ?>
        </div>
    </div>

<?php
get_footer();