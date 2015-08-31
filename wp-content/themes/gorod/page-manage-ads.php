<?php
/*
Template Name: Управление объявлениями
*/
?>
<?php if (is_user_logged_in()) : ?>
    <?php
    if ('POST' == $_SERVER['REQUEST_METHOD'] && $_POST['p_type'] == 'ads' && $_POST['ad_act'] == 'del' && !empty($_POST['ad_id'])) {
        $p = get_post($_POST['ad_id']);
        if ($p->post_author == get_current_user_id()) wp_update_post(array('ID' => intval($_POST['ad_id']), 'post_status' => 'trash'));
        unset($_POST);
    }
    ?>
    <?php
    get_header();
    ?>

    <div class="main">
        <div class="left">
            <div class="page">

                <div class="tags-block">

                    <div class="breadcrumbs"><a href="/">Главная</a><a href="/adspage/">Объявление</a><span>Мои объявления</span>
                    </div>

                    <div class="tags-top">
                        <h1 class="title">Мои объявления</h1>
                    </div>

                    <ul class="tags-list">
                        <?php
                        $user_posts = get_posts(
                            array(
                                'post_type' => 'ads',
                                'author' => get_current_user_id(),
                                'posts_per_page' => -1
                            ));
                        ?>
                        <?php if (count($user_posts) > 0) : ?>
                            <?php foreach ($user_posts as $post) : setup_postdata($post); ?>
                                <li class="tags_teaser_item">
                                    <div>
                                        <?php if (has_post_thumbnail(get_the_ID())) : ?>
                                            <div class="post_thumb"><a href="<?php the_permalink() ?>"
                                                                       title="<?php the_title(); ?>"><?php get_image_thumb(get_the_ID(), array(95, 70)); ?></a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="post_time">
                                            <?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?>
                                            <span class="views"><i
                                                    class="views-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>
                                        </div>
                                        <h2 class="post_title"><a href="<?php the_permalink(); ?>"
                                                                  title="<?php the_title(); ?>"><?php echo the_title();  ?></a>
                                        </h2>

                                        <div class="tools-btns">
                                            <form action="/add-ads/" method="post">
                                                <input type="hidden" name="ad_id" value="<?php the_ID() ?>">
                                                <input type="hidden" name="ad_act" value="edit">
                                                <input type="submit" value="редактировать" class="as-link">
                                            </form>
                                            <form action="" method="post"
                                                  onsubmit="javascript: return confirm_del_action()">
                                                <input type="hidden" name="ad_act" value="del">
                                                <input type="hidden" name="p_type" value="ads">
                                                <input type="hidden" name="ad_id" value="<?php the_ID() ?>">
                                                <input type="submit" value="удалить" class="as-link">
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;
                            wp_reset_postdata(); ?>
                        <?php else : ?>
                            <li class="tags_teaser_item">
                                <div>
                                    <h2 class="post_title">У вас нет записей</h2>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="right">
            <?php get_template_part('right-sidebar'); ?>
        </div>
    </div>

    <?php
    get_footer(); ?>
<?php else : ?>
    <?php wp_redirect(home_url());
    exit; ?>
<?php endif;