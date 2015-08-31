<?php
$cat_prefix = 'catalog_';

$cat_meta_box = array(
    'id' => 'catmeta',
    'title' => 'Дополнительные поля',
    'page' => 'catalog',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Контакты',
            'desc' => '',
            'id' => $cat_prefix . 'contacts',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'name' => 'VIP',
            'desc' => '',
            'id' => $cat_prefix . 'vip',
            'type' => 'checkbox',
            'std' => ''
        ),
    ),

);

add_action('admin_menu', 'cat_add_box');

// Add meta box
function cat_add_box() {
    global $cat_meta_box;

    add_meta_box($cat_meta_box['id'], $cat_meta_box['title'], 'cat_show_box', $cat_meta_box['page'], $cat_meta_box['context'], $cat_meta_box['priority']);
}

// Callback function to show fields in meta box
function cat_show_box() {
    global $cat_meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="cat_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($cat_meta_box['fields'] as $field) {
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

add_action('save_post', 'cat_save_data');

// Save data from meta box
function cat_save_data($post_id) {
    if($_GET['post_type'] == 'catalog' || $_POST['post_type'] == 'catalog')
    {
        global $cat_meta_box;

        // verify nonce
        if (!wp_verify_nonce($_POST['cat_meta_box_nonce'], basename(__FILE__))) {
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

        foreach ($cat_meta_box['fields'] as $field) {
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