<?php if ( have_comments() ) : ?>
    <ul class="commentlist">
        <?php global $wp_query; $wp_query->set('comments_per_page', 30); ?>
        <?php wp_list_comments( array( 'callback' => 'medical_comment', 'style' => 'ul' ) ); ?>
    </ul>

    <?php wp_simple_comments_pagination(); ?>

<?php endif; // have_comments() ?>