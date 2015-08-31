<?php
get_header();
?>

    <div class="main">
        <div class="left">
            <div class="single single-news">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="breadcrumbs"><?php //get_news_breadcrumbs(); ?></div>
                    <h1 class="title"><?php the_title(); ?></h1>

                    <ul class="single-competition-content">
                        <?php
                            $list = "";
                            $attaches = get_posts(array('post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => get_the_ID()));

                            foreach ($attaches as $k => $v) {
                                $likes = get_post_meta($v->ID, 'competition_like', true);
                                $likes = ($likes) ? $likes : 0;
                                $attaches[$k]->likes = $likes;
                            }

                            uasort($attaches, "sort_objects_by_likes");

                            foreach($attaches as $attach) {
                                $type = get_post_mime_type($attach->ID);
                                if (strpos($type, 'image') !== false) {
                                    $url = get_image_by_id($attach->ID, array(194,194), true, true);
                                    $full_path = get_image_by_id($attach->ID, array(800,600), true, true);

                                    $ips = get_post_meta($attach->ID, 'competition_ips', true);
                                    $ips = ($ips) ? json_decode($ips) : array();
                                    $disabled = in_array(get_user_ip(), $ips);

                                    $list .= '<li>';
                                    $list .= '<a href="'.$full_path.'">';
                                    $list .= '<img src="'.$url.'" alt="'.$attach->post_title.'" width="194" height="194" /></a>';
                                    if($disabled)
                                        $list .= '<div class="likes disabled"><i class="like-ico"></i><span class="count">'.$attach->likes.'</span></div>';
                                    else
                                        $list .= '<div class="likes"><a href="#like-'.$attach->ID.'"><i class="like-ico"></i></a><span class="count">'.$attach->likes.'</span></div>';
                                    $list .= '</li>';
                                }
                            }
                            echo $list;
                        ?>
                    </ul>

                <?php endwhile; ?>
            </div>
        </div>
        <div class="right">
            <?php get_template_part('right-sidebar'); ?>
        </div>
    </div>

<?php
get_footer();