<?php
/*
Template Name: Добавить объявление
*/
?>

<?php
global $is_IE;
get_header();
?>

    <div class="main">
        <div class="left">
            <div class="page abc-page">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php if(is_user_logged_in()) : ?><a class="my-abc" href="<?php echo home_url('/manage-orgs/'); ?>">мои организации</a><?php endif; ?>
                    <h1 class="page-title">
                        <?php
                        if(!empty($_POST['org_act']) && $_POST['org_act'] == 'edit') {
                            echo "Редактировать организацию";
                        }
                        else {
                            the_title();
                        }
                        ?>
                    </h1>
                <?php endwhile; ?>

                <?php if(is_user_logged_in()) : ?>
                    <?php
                    $cur_user = get_userdata(get_current_user_id());

                    $item = array(
                        'ID' => '',
                        'author_email' => $cur_user->user_email,
                        'title' => '',
                        'description' => '',
                        'location' => 0,
                        'category' => 0,
                        'contacts' => ''
                    );

                    if(!empty($_POST['org_act']) && $_POST['org_act'] == 'edit' && !empty($_POST['org_id'])) {
                        $org = get_post($_POST['org_id']);

                        if($org->post_author == $cur_user->ID) {
                            $loc_list = wp_get_post_terms($org->ID, 'nlocation', array("fields" => "ids"));
                            $cat_list = wp_get_post_terms($org->ID, 'catcategory', array("fields" => "ids"));

                            $item["ID"] = $_POST['org_id'];
                            $item["title"] = $org->post_title;
                            $item["description"] = $org->post_content;
                            $item["location"] = $loc_list[0];
                            $item["category"] = $cat_list[0];
                            $item["contacts"] = get_post_meta($item["ID"], 'catalog_contacts', true);
                        }
                    }
                    if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['p_type'] == 'catalog' && $_POST['org_act'] == 'add' ) {
                        $future = ($is_IE && get_ie_version() < 10) ? false : true;
                        add_org_post($_POST, $future);
                    }
                    ?>

                    <!-- Put this in your theme template file -->
                    <div class="postbox">

                        <form id="new_post" name="new_post" method="post" action="" enctype="multipart/form-data">

                            <div class="field">
                                <input type="text" id="author_email" placeholder="Ваш email *" name="author_email" class="required email" value="<?php echo $item["author_email"]; ?>" ></div>

                            <div class="field">
                                <input type="text" id="title" name="title" placeholder="Название организации *" value="<?php echo $item["title"]; ?>" class="required " ></div>

                            <div class="field">
                                <textarea id="description" name="description" placeholder="Описание *" class="required " rows="10"><?php echo $item["description"]; ?></textarea></div>

                            <div class="field">
                                <textarea id="contacts" name="contacts" placeholder="Контакты организации" class="" rows="10"><?php echo $item["contacts"] ?></textarea></div>

                            <div class="field">
                                <label>Регион</label>
                                <?php wp_dropdown_categories(array('taxonomy' => 'nlocation', 'hide_empty' => 0, 'hierarchical' => 0, 'name' => 'location', 'selected' => $item["location"])); ?></div>

                            <div class="field">
                                <label>Раздел</label>
                                <?php wp_dropdown_categories(array('taxonomy' => 'catcategory', 'hide_empty' => 0, 'hierarchical' => 1, 'name' => 'category', 'selected' => $item["category"])); ?></div>

                            <?php  if($is_IE && get_ie_version() < 10) : ?>

                                <div class="attach"><span class="attachment-text">Прикрепить изображения (типы файлов: jpg, png, gif. макс. 5):</span><br>
                                    <input type="file" name="file" id="attachment" accept="image/jpg, image/gif, image/png, image/jpeg">
                                    <div id="attachment_list">
                                        <?php if(!empty($item["ID"])) { get_post_attachments($item["ID"]); } ?>
                                    </div>
                                </div>

                                <script>
                                     var list = document.getElementById( 'attachment_list' );
                                     var multi_selector = new MultiSelector(list , 4 );
                                     multi_selector.addElement( document.getElementById( 'attachment' ) );
                                     multi_selector.count = list.children.length;
                                     if(multi_selector.count >= multi_selector.max) multi_selector.current_element.disabled = true;
                                </script>

                            <?php else : ?>

                                <div class="attachment-text">Прикрепить изображения (типы файлов: jpg, png, gif.):</div>
                                <div class="attachment-aria">
                                    <?php
                                        $itemID = (!empty($item["ID"])) ? $item["ID"] : 0;
                                        get_post_attachments($item["ID"], true);
                                    ?>
                                </div>

                            <?php endif; ?>

                            <input type="submit" value="Отправить" id="submit" name="submit" />

                            <input type="hidden" name="p_type" id="p_type" value="catalog" />
                            <input type="hidden" name="org_act" value="add" />
                            <input type="hidden" name="org_id" value="<?php echo $item["ID"] ?>" />
                            <input type="hidden" name="action" value="post" />
                            <?php wp_nonce_field( 'new-post' ); ?>

                        </form>

                    </div>
                    <!--// New Post Form -->
                <?php else : ?>
                    <div>Для добавления организаций необходимо <a class="login-link" href="#"><?php _e('Log In'); ?></a>.</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="right">
            <?php get_template_part('right-sidebar'); ?>
        </div>
    </div>

<?php
get_footer();