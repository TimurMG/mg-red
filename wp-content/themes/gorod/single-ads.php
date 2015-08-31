<?php
get_header();
?>
 
    <div class="main">
        <div class="left">
            <div class="page">

                <div class="orgs-block">
                    <div
                        class="breadcrumbs"><?php if (function_exists('ads_taxonomy_breadcrumb')) ads_taxonomy_breadcrumb(); ?></div>
                </div>

                <div class="abc-top">
                    <h1 class="title">Объвления</h1>

                    <div class="add-button">
                        <a href="/add-ads/">
                            <button type="button">+ Подать объвление</button>
                        </a>
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
                            <?php while (have_posts()) : the_post(); ?>
                                <div class="single-item">
                                    <?php
                                    $location = get_the_terms(get_the_ID(), 'nlocation');
                                    if ($location) {
                                        $location = array_shift($location);
                                        $location = $location->name;
                                    } else {
                                        $location = "Уральск";
                                    }
                                    ?>
                                    <div class="top">
                                        <div class="post_info">
                                            <span
                                                class="date"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), 'slide'); ?></span>
                                            <span class="location"><?php echo $location; ?></span>
                                            <span class="views"><i class="views-ico"></i>
                                                <?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?>
                                            </span>
                                        </div>
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $thumb_id = get_post_thumbnail_id(get_the_ID());
                                            $url = get_image_by_id($thumb_id, array(800, 600), true, true);
                                            echo "<a href='".$url."'>";
                                            get_image_thumb(get_the_ID(), array(165, 120));
                                            echo "</a>";
                                        }
                                        ?>
                                        <h2 class="adc-title"><?php the_title(); ?></h2>

                                        <div class="adc-content"><?php the_content(); ?></div>
                                    </div>
                                    <?php
                                    $attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image'));
                                    if (count($attachments) > 1) :
                                        ?>
                                        <div class="images">
                                            <?php
                                            $thumb_id = (isset($thumb_id)) ? $thumb_id : get_post_thumbnail_id(get_the_ID());
                                            foreach ($attachments as $attach_id => $attach) {
                                                if($thumb_id != $attach_id) {
                                                    $image = get_image_by_id($attach_id, array(55, 40));
                                                    $full_src = get_image_by_id($attach_id, array(800, 600), true, true);
                                                    echo '<a href="' . $full_src . '">' . $image . '</a>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="info">
                                        <div><span><strong>Цена: </strong> <?php $price = get_post_meta(get_the_ID(), 'ads_price', true); echo (empty($price)) ? "-" : $price; ?></span></div>
                                        <?php $aim = get_the_author_meta('aim'); if (!empty($aim)) : ?>
                                            <div><span><strong>Телефон: </strong><?php echo $aim; ?></span></div>
                                        <?php endif; ?>
                                        <div><span><strong>Автор: </strong> <?php the_author(); ?></span></div>
                                        <div><span><a href="javascript:void(0);" class="author-mail-btn" onclick="t_block('contact_form')">
                                                    <i class="author-mail-ico"></i>Написать автору</a></span></div>

                                        <div id="contact_form"><?php echo do_shortcode('[contact-form-7 id="960"]'); ?></div>
                                    </div>

                                    <div class="prev_next_post_links">
                                        <?php be_previous_post_link('<div class="prev_post_link">%link</div>', '%title', true, '', 'adscategory'); ?>
                                        <?php be_next_post_link('<div class="next_post_link">%link</div>', '%title', true, '', 'adscategory'); ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <ul class="abc-list-items" style="margin-top: 0;">
                                <?php
                                    global $post;
                                    $terms_obj = wp_get_post_terms($post->ID, 'adscategory');
                                    foreach($terms_obj as $t) $terms[] = $t->slug;
                                    $related_posts = get_posts(
                                        array(
                                            'post_type' => 'ads',
                                            'post__not_in' => array($post->ID),
                                            'posts_per_page' => 5,
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'adscategory',
                                                    'field' => 'slug',
                                                    'terms' => $terms,
                                                    'operator' => 'IN'
                                                )
                                            )
                                        ));
                                ?>
                                <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
                                    <li class="item">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            get_image_thumb(get_the_ID(), array(96, 75));
                                        } else {
                                            echo "<img src='" . get_template_directory_uri() . "/images/blank_image.png' alt='' />";
                                        }
                                        $location = get_the_terms($post->ID, 'nlocation');
                                        if ($location) {
                                            $location = array_shift($location);
                                            $location = $location->name;
                                        } else {
                                            $location = "Уральск";
                                        }
                                        ?>
                                        <div class="post_info">
                                            <span
                                                class="date"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span>
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
                                <?php endforeach; wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <?php get_template_part('right-sidebar'); ?>
        </div>
    </div>

<?php
get_footer();