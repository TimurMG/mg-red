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
                    <?php if(is_user_logged_in()) : ?><a class="my-abc" href="<?php echo home_url('/manage-ads/'); ?>">мои объявления</a><?php endif; ?>
                    <h1 class="page-title">
                        <?php
                        if(!empty($_POST['ad_act']) && $_POST['ad_act'] == 'edit') {
                            echo "Редактировать объявление";
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
                        'author_phone' => get_user_meta($cur_user->ID, 'aim', true),
                        'title' => '',
                        'description' => '',
                        'location' => 0,
                        'category' => 0,
                        'category_name' => '',
                        'price' => ''
                    );
                    if(!empty($_POST['ad_act']) && $_POST['ad_act'] == 'edit' && !empty($_POST['ad_id'])) {
                        $ad = get_post($_POST['ad_id']);

                        if($ad->post_author == $cur_user->ID) {
                            $loc_list = wp_get_post_terms($ad->ID, 'nlocation', array("fields" => "ids"));
                            $cat_list = wp_get_post_terms($ad->ID, 'adscategory', array("fields" => "all"));

                            $item["ID"] = $_POST['ad_id'];
                            $item["title"] = $ad->post_title;
                            $item["description"] = $ad->post_content;
                            $item["location"] = $loc_list[0];
                            $item["category"] = $cat_list[0]->term_id;
                            $item["category_name"] = $cat_list[0]->name;
                            $item["price"] = get_post_meta($item["ID"], 'ads_price', true);
                        }
                    }
                    if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['p_type'] == 'ads' && $_POST['ad_act'] == 'add' ) {
                        $future = ($is_IE && get_ie_version() < 10) ? false : true;
                        add_ads_post($_POST, $future);
                    }
                    ?>

                    <!-- Put this in your theme template file -->
                    <div class="postbox">

                        <form id="new_post" class="abc" name="new_post" method="post" action="" enctype="multipart/form-data">

                            <div class="field">
                                <input type="text" id="author_email" placeholder="Ваш email *" name="author_email" class="required email" value="<?php echo (!empty($item["author_email"])) ? $item["author_email"] : ""; ?>" ></div>

                            <div class="field adc-cats">
                                <span id="cat-name"><?php echo (!empty($item["category_name"])) ? $item["category_name"] : "Категория"; ?></span>
                                <input type="hidden" name="category" id="category" value="<?php echo $item["category"]; ?>">
                                <div class="cats">
                                    <div class="wait"></div>
                                    <?php $cats = get_ads_root_terms(); ?>
                                    <ul>
                                        <?php foreach($cats as $cat) : ?>
                                            <li style="background: #ffffff url(<?php echo $cat['img']; ?>) no-repeat center 10px">
                                                <a href="#" id="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="field">
                                <input type="text" id="author_phone" placeholder="Ваш телефон" name="author_phone" class="" value="<?php echo $item["author_phone"]; ?>" ></div>

                            <div class="field">
                                <input type="text" id="title" name="title" placeholder="Заголовок *" value="<?php echo $item["title"]; ?>" class="required" ></div>

                            <div class="field">
                                <textarea  id="description" name="description" placeholder="Текст объявления *" class="required " rows="10"><?php echo $item["description"]; ?></textarea></div>

                            <div class="field">
                                <label>Регион</label>
                                <?php wp_dropdown_categories(array('taxonomy' => 'nlocation', 'hide_empty' => 0, 'hierarchical' => 0, 'name' => 'location', 'selected' => $item["location"])); ?></div>

                            <div class="field">
                                <input type="text" id="price" placeholder="Цена" class="" name="price" value="<?php echo $item["price"]; ?>" ></div>


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
                            <div class="rules">
                                <input type="checkbox" checked="checked" name="conf_rule" id="conf_rule" /> Согласен с <a href="<?php echo home_url('/pravila-dobavleniya-obyavlenij/'); ?>" target="_blank">условиями размещения объявлений</a>
                            </div>

                            <input type="hidden" name="p_type" id="p_type" value="ads" />
                            <input type="hidden" name="ad_act" value="add" />
                            <input type="hidden" name="ad_id" value="<?php echo $item["ID"] ?>" />
                            <input type="hidden" name="action" value="post" />
                            <?php wp_nonce_field( 'new-post' ); ?>

                        </form>

                    </div>
                    <!--// New Post Form -->
                <?php else : ?>
                    <div>Для добавления объявлений необходимо <a class="login-link" href="#"><?php _e('Log In'); ?></a>.</div>
                <?php endif; ?>
            </div>
        </div>
        <div class="right">
            <?php get_template_part('right-sidebar'); ?>
        </div>
    </div>

<?php
get_footer();