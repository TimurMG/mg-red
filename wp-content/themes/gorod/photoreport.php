<?php

$isFirst = true;



$q = array('post_type' => 'news', 'ncategory' => 'photoreport', 'posts_per_page' => 13);



if(is_tax('nlocation')) {

    $q['tax_query'] = array(

        array(

            'taxonomy' => 'nlocation',

            'field' => 'id',

            'terms' => get_queried_object_id()

        )

    );

}



$photoreports = get_posts($q);

if (count($photoreports) > 0) :

    ?>



    <div class="photoreport">

        <h3>Фоторепортаж <a href="/ncategory/photoreport/">архив</a></h3>



        <?php $post = $photoreports[0]; setup_postdata($post) ?>

        <div class="main-photo">

            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

            <?php get_image_thumb(get_the_ID(), array(320, 160)); ?>

            </a>

            <h1><?php the_title(); ?></h1>



            <div class="date"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i'), 'v'); ?></div>

        </div>

        <?php wp_reset_postdata(); ?>



        <div class="second-photo">

        <?php

        foreach ($photoreports as $post) : setup_postdata($post);

            if ($isFirst) {

                $isFirst = false;

                continue;

            }

                ?>

                <?php if(has_post_thumbnail()) : ?>

                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

                    <?php get_image_thumb(get_the_ID(), array(70, 50), true, false, "grayscale"); ?>

                </a>

                <?php endif; ?>

        <?php endforeach; wp_reset_postdata(); ?>

        </div>

    </div>



<?php

endif;