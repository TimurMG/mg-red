<?php
/*
Template Name: Управление организациями
*/
?>
<?php if (is_user_logged_in()) : ?>
    <?php
    if ('POST' == $_SERVER['REQUEST_METHOD'] && $_POST['p_type'] == 'catalog' && $_POST['org_act'] == 'del' && !empty($_POST['org_id'])) {
        $p = get_post($_POST['org_id']);
        if($p->post_author == get_current_user_id()) wp_update_post(array('ID' => $_POST['org_id'], 'post_status' => 'trash'));
        unset($_POST);
    }
    ?>
    <?php
    get_header();
    ?>
<table border="0" style="margin-bottom:10px; margin-top:-10px;">
<tr>
<td width="25%" style="padding-right:5px;">
<div>
<?php get_banner("bobyava1"); ?>
</div>
</td>
<td width="25%" style="padding-right:5px;">
<div>
<?php get_banner("bobyava2"); ?>
</div>
</td>
<td width="25%" style="padding-right:5px;">
<div>
<?php get_banner("bobyava3"); ?>
</div>
</td>
<td width="25%">
<div>
<?php get_banner("bobyava4"); ?>
</div>
</td>
</tr>
</table>
    <div class="main">
        <div class="left">
            <div class="page">

                <div class="tags-block">

                    <div class="breadcrumbs"><a href="/">Главная</a><a href="/orgspage/">Справочник</a><span>Мои организации</span>
                    </div>

                    <div class="tags-top">
                        <h1 class="title">Мои организации</h1>
                    </div>

                    <ul class="tags-list">
                        <?php
                        $user_posts = get_posts(
                            array(
                                'post_type' => 'catalog',
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
                                        </div>
                                        <h2 class="post_title"><a href="<?php the_permalink(); ?>"
                                                                  title="<?php the_title(); ?>"><?php echo the_title();  ?></a>
                                        </h2>

                                        <div class="tools-btns">
                                            <form action="/add-org/" method="post">
                                                <input type="hidden" name="org_id" value="<?php the_ID() ?>">
                                                <input type="hidden" name="org_act" value="edit">
                                                <input type="submit" value="редактировать" class="as-link">
                                            </form>
                                            <form action="" method="post"
                                                  onsubmit="javascript: return confirm_del_action()">
                                                <input type="hidden" name="org_act" value="del">
                                                <input type="hidden" name="p_type" value="catalog">
                                                <input type="hidden" name="org_id" value="<?php the_ID() ?>">
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