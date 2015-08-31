<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment! ?>
    <?php if ( have_comments() ) : ?>
    <h2 class="comments-title">Комментарии</h2>


    <ul class="commentlist">
        <?php wp_list_comments( array( 'callback' => 'gorod_comment', 'style' => 'ul' ) ); ?>
    </ul>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through */?>
        <nav id="comment-nav-below" class="navigation" role="navigation">
            <?php paginate_comments_links(); ?>
        </nav>
    <?php endif; // check for comment navigation ?>

    <?php endif; // have_comments() ?>

    <?php

    $loginBtns = (is_user_logged_in()) ? "" : get_ulogin_buttons();

    $fields =  array(
        'login' => $loginBtns,
        'author' => '<p class="comment-form-author"><input id="author" class="default-val" name="author" type="text" placeholder="Имя *" value="" ' . $aria_req . ' /></p>',
        'email' => '<p class="comment-form-email"><input id="email" class="default-val" name="email" type="text" placeholder="Эл. почта *" value="" ' . $aria_req . ' /></p>',
        'url' => ''
    );

    $args = array(
        'id_form' => 'commentform',
        'id_submit' => 'submit',
        'title_reply' => __( 'Leave a Reply' ),
        'title_reply_to' => __( 'Leave a Reply to %s' ),
        'cancel_reply_link' => __( 'Cancel reply' ),
        'label_submit' => 'Отправить',
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" rows="6" name="comment" aria-required="true"></textarea></p><p class="comment-form-rule"><input type="checkbox" checked="checked" name="comment_rule" id="comment_rule"><label for="comment_rule">Согласен с <a href="/pravila-polzovaniya-sajta/" target="_blank">условиями сайта</a></label></p>',
        //'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
        'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), '#' ) . '</p>',
        'logged_in_as' => '',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'fields' => apply_filters( 'comment_form_default_fields', $fields)
        );

        comment_form($args);
    ?>

</div><!-- #comments .comments-area -->