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

                <div class="abc-top">
                    <h1 class="title">
                        Объвления
                        <?php if(is_user_logged_in()) : ?><a class="my-abc" href="<?php echo home_url('/manage-ads/'); ?>">мои объявления</a><?php endif; ?>
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
                    <div class="add-button">
                        <a href="/add-ads/"><button type="button">+ Подать объвление</button></a>
                    </div>
                </div>

                <div class="org-cont">
                    <ul class="org-menu">
                        <?php
                        $list = wp_list_categories(array(
                            'taxonomy' => 'adscategory',
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
 <div style="width:280px; position:absolute; float:left; margin-top:20px;" class="banner banner-305x350" id="recipe-banner-305x350x1">
                    <?php get_banner("banerobyava2"); ?>
                </div>
                    </ul>
                    <div class="org-list">
                        <div>
                            <ul class="abc-list-items">
                                <?php foreach ($posts as $post) : setup_postdata($post); ?>
                                    <li class="item">
                                        <?php
                                            if(has_post_thumbnail()) {
                                                 get_image_thumb(get_the_ID(), array(96,75));
                                            }
                                            else {
                                                echo "<img src='".get_template_directory_uri()."/images/blank_image.png' alt='' />";
                                            }
                                            $location = get_the_terms($post->ID, 'nlocation');
                                            if($location) {
                                                $location = array_shift($location);
                                                $location = $location->name;
                                            }
                                            else {
                                                $location = "Уральск";
                                            }
                                        ?>
                                        <div class="post_info">
                                            <span class="date"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>
                                            <span class="location"><?php echo $location; ?></span>
                                            <span class="views"><i class="views-ico"></i>
                                                <?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?>
                                            </span>
                                        </div>
                                        <h2 class="post_title"><?php echo the_title();  ?></h2>
                                        <a href="<?php the_permalink(); ?>" title="" class="post-shot-content">
                                            <?php kama_excerpt("maxchar=80"); ?>
                                        </a>
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