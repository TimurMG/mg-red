<?php

$prefix = 'nws_';



$meta_box = array(

    'id' => 'newsmeta',

    'title' => 'Дополнительные поля',

    'page' => 'news',

    'context' => 'normal',

    'priority' => 'high',

    'fields' => array(

        array(

            'name' => 'Главная',

            'desc' => 'Отметить если новость главная',

            'id' => $prefix . 'is_main',

            'type' => 'checkbox',

            'std' => ''

        ),

        array(

            'name' => 'Отображать в промо модуле',

            'desc' => 'Отображать в промо модуле',

            'id' => $prefix . 'is_promo',

            'type' => 'checkbox',

            'std' => ''

        ),

        array(

            'name' => 'Экспорт в Яндекс',

            'desc' => 'Экспорт в Яндекс',

            'id' => $prefix . 'is_export',

            'type' => 'checkbox',

            'std' => ''

        ),

        array(

            'name' => 'Линки',

            'desc' => 'Линки',

            'id' => $prefix . 'links',

            'type' => 'textarea',

            'std' => ''

        ),

        array(

            'name' => 'Title',

            'desc' => '',

            'id' => $prefix . 'title',

            'type' => 'text',

            'std' => ''

        ),

        array(

            'name' => 'Keywords',

            'desc' => '',

            'id' => $prefix . 'keywords',

            'type' => 'text',

            'std' => ''

        ),

        array(

            'name' => 'Description',

            'desc' => '',

            'id' => $prefix . 'description',

            'type' => 'textarea',

            'std' => ''

        ),

    ),



);



add_action('admin_menu', 'news_add_box');



// Add meta box

function news_add_box() {

    global $meta_box;



    add_meta_box($meta_box['id'], $meta_box['title'], 'news_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);

}



// Callback function to show fields in meta box

function news_show_box() {

    global $meta_box, $post;



    // Use nonce for verification

    echo '<input type="hidden" name="news_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';



    echo '<table class="form-table">';



    foreach ($meta_box['fields'] as $field) {

        // get current post meta data

        $meta = get_post_meta($post->ID, $field['id'], true);



        echo '<tr>',

        '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',

        '<td>';

        switch ($field['type']) {

            case 'text':

                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',

                '<br />', $field['desc'];

                break;

            case 'textarea':

                echo '<textarea  name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',

                '<br />', $field['desc'];



                break;

            case 'select':

                echo '<select name="', $field['id'], '" id="', $field['id'], '">';

                foreach ($field['options'] as $option) {

                    echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';

                }

                echo '</select>',

                '<br />', $field['desc'];

                break;

            case 'radio':

                foreach ($field['options'] as $option) {

                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];

                }

                break;

            case 'checkbox':

                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';

                break;

        }

        echo 	'<td>',

        '</tr>';

    }



    echo '</table>';

}



add_action('save_post', 'news_save_data');



// Save data from meta box

function news_save_data($post_id) {

    if($_GET['post_type'] == 'news' || $_POST['post_type'] == 'news')

    {

        global $meta_box;



        // verify nonce

        if (!wp_verify_nonce($_POST['news_meta_box_nonce'], basename(__FILE__))) {

            return $post_id;

        }



        // check autosave

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

            return $post_id;

        }



        // check permissions

        if ('page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id)) {

                return $post_id;

            }

        } elseif (!current_user_can('edit_post', $post_id)) {

            return $post_id;

        }



        foreach ($meta_box['fields'] as $field) {

            $old = get_post_meta($post_id, $field['id'], true);

            $new = $_POST[$field['id']];



            if ($new && $new != $old) {

                update_post_meta($post_id, $field['id'], $new);

            } elseif ('' == $new && $old) {

                delete_post_meta($post_id, $field['id'], $old);

            }

        }

    }

}


