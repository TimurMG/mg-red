<?php
global $post;
$terms_obj = wp_get_post_terms($post->ID, 'ntag');
foreach($terms_obj as $t) $terms[] = $t->slug;
$related_posts = get_posts(
    array(
        'post_type' => 'news',
        'post__not_in' => array($post->ID),
        'posts_per_page' => 3,
        'tax_query' => array(
            array(
                'taxonomy' => 'ntag',
                'field' => 'slug',
                'terms' => $terms,
                'operator' => 'IN'
            )
        )
    ));
?>
<?php if(count($related_posts) > 0) : ?>
<div class="related-news">
    <h3>Новости по теме:</h3>
    <ul>
        <?php foreach( $related_posts as $post ) : setup_postdata($post); ?>
        <li>
            <?php if(has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>"><?php get_image_thumb(get_the_ID(), array(64,64), true); ?></a>
            <?php endif; ?>
            <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title_shorten(50); ?></a></h2>
            <span class="comments"><i class="comments-ico"></i><?php comments_number('0', '1', '%'); ?></span>
            <span class="views"><i class="views-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span>
        </li>
        <?php endforeach; wp_reset_postdata(); ?>
    </ul>
</div>
<?php endif; ?>