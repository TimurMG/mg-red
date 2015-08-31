<?php
/*
Template Name: Справочник главная
*/
?>
<?php
get_header();
?>

    <div class="main">
        <div class="left">
            <div class="page">

                <div class="orgs-block">
                    <?php
                        $obj = get_queried_object();
                    ?>
                    <div class="breadcrumbs"><a href="/">Главная</a><span><?php echo $obj->post_title; ?></span></div>
                </div>

                <div class="tags-top">
                    <h1 class="title">
                        <?php echo $obj->post_title; ?>
                        <?php if(is_user_logged_in()) : ?><a class="my-abc" href="<?php echo home_url('/manage-orgs/'); ?>">мои организации</a><?php endif; ?>
                    </h1>
                </div>

                <div class="org-cont">
                    <ul class="org-menu">
                        <?php
                        $list = wp_list_categories(array(
                            'taxonomy' => 'catcategory',
                            'echo' => 0,
                            'hierarchical' => true,
                            'title_li' => '',
                            'hide_empty' => false,
                            'show_count' => true,
                            'orderby' => 'menu_order',
                            'walker' => new Org_Category_Walker()
                        ));
                        echo $list;
                        ?>
 <div style="width:280px; height:294px; overflow:hidden; position:absolute; float:left; margin-top:20px;" class="banner banner-305x350" id="recipe-banner-305x350x1">
                    <?php get_banner("banerobyava2"); ?>
                </div>
                    </ul>
                    <div class="org-list">
                        <div>
                            <div class="org-list-header">
                                <div class="add-button">
                                    <a href="/add-org/"><button type="button">+ Добавить организацию</button></a>
                                </div>
                            </div>
                            <?php

                            $q = array('post_type' => 'catalog', 'posts_per_page' => 20, 'paged' => get_query_var('paged'));
                            $posts = get_posts($q);
                            foreach ($posts as $k => $v) {
                                $loc = get_the_terms($v->ID, 'nlocation');
                                if($loc) {
                                    $loc = array_shift($loc);
                                    $posts[$k]->location = $loc->name;
                                }
                                else {
                                    $posts[$k]->location = "Уральск";
                                }
                                $posts[$k]->contact = get_post_meta($v->ID, 'catalog_contacts', true);
                            }

                            uasort($posts, "sort_objects_by_location");
                            $location = "";
                            ?>
                            <ul class="org-list-items">
                                <?php foreach ($posts as $post) : setup_postdata($post); ?>
                                    <?php if ($location != $post->location) {
                                        echo "<li class='head'><div class='right'></div><div class='left'>" . $post->location . "</div></li>";
                                        $location = $post->location;
                                    } ?>
                                    <li class="item">
                                        <div class="post_contact"><?php
                                            preg_match('#d+-d+-d+|d+ d+ d+|d+#ui', $post->contact, $phone_arr);
                                            echo (count($phone_arr) > 0) ? $phone_arr[0] : ' - ';
                                            ?></div>
                                        <h2 class="post_title"><a href="<?php the_permalink() ?>"
                                                                  title="<?php the_title(); ?>"><?php echo the_title();  ?></a>
                                        </h2>
                                    </li>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="orgs-paginate">
                    <?php
                        global $wp_query;
                        $total = wp_count_posts('catalog')->publish;
                        $wp_query->max_num_pages = ceil($total/20);
                        wp_simple_pagination();
                    ?>
                </div>


            </div>
        </div>
        <div class="right">
            <?php get_template_part('right-sidebar'); ?>
        </div>
    </div>

<?php
get_footer();