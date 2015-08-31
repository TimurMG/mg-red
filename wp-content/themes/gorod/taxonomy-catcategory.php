<?php
if (!session_id()) session_start();

global $wp_query;
$posts = $wp_query->posts;

$cur_page = $wp_query->query_vars['paged'];

get_header();
?>

    <div class="main">
        <div class="left">
            <div class="page">

                <div class="orgs-block">
                    <div class="breadcrumbs"><?php if (function_exists('ads_taxonomy_breadcrumb')) ads_taxonomy_breadcrumb(); ?></div>
                </div>

                <div class="tags-top">
                    <h1 class="title">
                        Справочная
                        <?php if(is_user_logged_in()) : ?><a class="my-abc" href="<?php echo home_url('/manage-orgs/'); ?>">мои организации</a><?php endif; ?>
                    </h1>

                    <?php if($cur_page < 2) : ?>
                    <div class="location-filter">
                        <form action="" method="post">
                            <?php
                            $cur_location = -1;
                            if(!empty($_POST['location'])) {
                                $cur_location = $_POST['location'];
                                $_SESSION['location'] = $_POST['location'];
                            }
                            elseif(isset($_SESSION['location'])) $cur_location = $_SESSION['location'];
                            ?>
                            <?php wp_dropdown_categories(
                                array(
                                    'show_option_none' => 'Показать все',
                                    'taxonomy' => 'nlocation',
                                    'hide_empty' => true,
                                    'hierarchical' => 0,
                                    'name' => 'location',
                                    'class' => 'location-ddl',
                                    'selected' => $cur_location)); ?>
                            <input type="submit" value="Фильтр" class="Buttons">
                        </form>
                    </div>
                    <?php endif; ?>
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
                    </ul>
                    <div class="org-list">
                        <div>
                            <div class="org-list-header">
                                <div class="org-cat-title">
                                    <?php
                                        $qObj = get_queried_object();
                                        echo $qObj->name;
                                    ?>
                                </div>
                                <div class="add-button">
                                    <a href="/add-org/"><button type="button">+ Добавить организацию</button></a>
                                </div>
                            </div>
                            <?php

                            global $wp_query;
                            $posts = $wp_query->posts;

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
                                        <div class="post_contact"><?php echo $post->contact; ?></div>
                                        <h2 class="post_title"><a href="<?php the_permalink() ?>"
                                                                  title="<?php the_title(); ?>"><?php echo the_title();  ?></a>
                                        </h2>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="orgs-paginate">
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