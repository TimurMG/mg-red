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
                    <h1 class="title">Справочная</h1>

                    <div class="add-button">
                        <a href="/add-org/">
                            <button type="button">+ Добавить организацию</button>
                        </a>
                    </div>
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
                            <?php while (have_posts()) : the_post(); ?>
                                <div class="single-item catalog">
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

                                    <div class="info full">
                                        <div><span><strong>Контакты: </strong><br><br><?php echo get_post_meta(get_the_ID(), 'catalog_contacts', true); ?></span></div>
                                    </div>

                                    <div class="prev_next_post_links">
                                        <?php be_previous_post_link('<div class="prev_post_link">%link</div>', '%title', true, '', 'catcategory'); ?>
                                        <?php be_next_post_link('<div class="next_post_link">%link</div>', '%title', true, '', 'catcategory'); ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
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