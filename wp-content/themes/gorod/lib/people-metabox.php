<?php
$prefix = 'pl_';

$pl_meta_box = array(
    'id' => 'peoplemeta',
    'title' => 'Дополнительная информация',
    'page' => 'people',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Специализация',
            'desc' => '',
            'id' => $prefix . 'specialization',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => 'Почтовый адрес',
            'desc' => '',
            'id' => $prefix . 'email',
            'type' => 'text',
            'std' => ''
        )
    ),

);



add_action('admin_menu', 'pl_add_box');

// Add meta box
function pl_add_box() {
    global $pl_meta_box;

    add_meta_box($pl_meta_box['id'], $pl_meta_box['title'], 'pl_show_box', $pl_meta_box['page'], $pl_meta_box['context'], $pl_meta_box['priority']);
}

// Callback function to show fields in meta box
function pl_show_box() {
    global $pl_meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="pl_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($pl_meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
        '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
        '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:50%" />',
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

add_action('save_post', 'pl_save_data');

// Save data from meta box
function pl_save_data($post_id) {
    if($_GET['post_type'] == 'people' || $_POST['post_type'] == 'people')
    {
        global $pl_meta_box;

        // verify nonce
        if (!wp_verify_nonce($_POST['pl_meta_box_nonce'], basename(__FILE__))) {
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

        foreach ($pl_meta_box['fields'] as $field) {
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



