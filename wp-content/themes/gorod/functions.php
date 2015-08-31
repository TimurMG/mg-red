<?php



include 'lib/post-types.php';

include 'lib/news-metabox.php';
include 'lib/page-news-metabox.php';

include 'lib/ads-metabox.php';

include 'lib/catalog-metabox.php';

include 'lib/people-metabox.php';

include 'lib/aq_resizer.php';

include 'lib/orgs_category_walker.php';



define('ATTACHMENTS_DEFAULT_INSTANCE', false);

define('WP_POST_REVISIONS', false);

define('MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS);





//if ( get_magic_quotes_gpc() ) {

    $_POST = array_map( 'stripslashes_deep', $_POST );

    $_GET = array_map( 'stripslashes_deep', $_GET );

    $_COOKIE = array_map( 'stripslashes_deep', $_COOKIE );

    $_REQUEST = array_map( 'stripslashes_deep', $_REQUEST );

//}



/***

 * @desc Init theme default parameters

 */

function theme_setup()

{

    //load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );



    // This theme styles the visual editor with editor-style.css to match the theme style.

    //add_editor_style();



    // Adds RSS feed links to <head> for posts and comments.

    //add_theme_support( 'automatic-feed-links' );



    // This theme supports a variety of post formats.

    //add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );



    register_nav_menu('region_menu', 'Меню регионов');

    register_nav_menu('primary', 'Главное меню');

    register_nav_menu('primary_sub', 'Главное меню (выпадающее)');

    register_nav_menu('category_menu', 'Меню рубрик');

    register_nav_menu('footer_menu', 'Подвал');



    register_nav_menu('cinema_menu', 'Меню для кинотеатра');



    register_nav_menu('mob_region_menu', 'Меню регионов (mobile)');

    register_nav_menu('mob_primary', 'Главное меню (mobile)');

    register_nav_menu('mob_footer_menu', 'Подвал (mobile)');

    register_nav_menu('mob_footer_menu_login', 'Подвал (mobile-login)');



    register_nav_menu('tab_region_menu', 'Меню регионов (tablet)');

    register_nav_menu('tab_primary', 'Главное меню (tablet)');

    register_nav_menu('tab_footer_menu', 'Подвал (tablet)');



    add_theme_support('post-thumbnails');



    /*add_image_size('r568x328', 568, 328, true);

    add_image_size('r160x96', 160, 96, true);

    add_image_size('r76x50', 76, 50, true);

    add_image_size('r224x160', 224, 160, true);

    add_image_size('r320x160', 320, 160, true);*/

    //set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

}



add_action('after_setup_theme', 'theme_setup');

add_filter('show_admin_bar', '__return_false');

remove_action('wp_head', 'wp_generator');



remove_filter('the_content', 'wptexturize');

remove_filter('the_title', 'wptexturize');

remove_filter('comment_text', 'wptexturize');



add_action('init', 'enqueue_my_script');

function enqueue_my_script()

{

    global $is_IE;

    if (!is_admin() && !is_login_page()) {

        wp_enqueue_style("adGallery", get_template_directory_uri() . "/js/ad_gallery/jquery.ad-gallery.css");

        wp_enqueue_style("tabs", get_template_directory_uri() . "/js/jquery.ui.tabs.css");

        wp_enqueue_style("colorbox", get_template_directory_uri() . "/js/colorbox/colorbox.css");

        wp_enqueue_style("beforeafter", get_template_directory_uri() . "/js/beforeafter/css/beforeafter.css");

        wp_enqueue_style("leaflet", get_template_directory_uri() . "/js/beforeafter/css/leaflet.css");



        wp_enqueue_script("jquery");

        if($is_IE && get_ie_version() < 9) wp_enqueue_script("html5", get_template_directory_uri() . "/js/html5shiv.js");

        wp_enqueue_script("jquery-ui", get_template_directory_uri() . "/js/jquery-ui-1.10.4.custom.min.js", array('jquery'));

        wp_enqueue_script('validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'));

        wp_enqueue_script('messages_ru', get_template_directory_uri() . '/js/messages_ru.js', array('validate'));

        wp_enqueue_script('grayscale', get_template_directory_uri() . "/js/grayscale.js", array('jquery'));

        wp_enqueue_script("adGallery", get_template_directory_uri() . "/js/ad_gallery/jquery.ad-gallery.js", array('jquery'));

        wp_enqueue_script('swfobject');

        wp_enqueue_script('colorbox', get_template_directory_uri() . "/js/colorbox/jquery.colorbox-min.js", array('jquery'));

        wp_enqueue_script('adObj', get_template_directory_uri() . "/js/ad-script.js", array('jquery'));

        wp_enqueue_script("files", get_template_directory_uri() . "/js/files.js", array('jquery'));

        wp_enqueue_script('func', get_template_directory_uri() . "/js/functions.js", array('jquery'), '1.1.2');

        wp_enqueue_script('orphus', get_template_directory_uri() . "/js/orphus.js");

        wp_enqueue_script('multifile_compressed', get_template_directory_uri() . '/js/multifile_compressed.js', array('jquery'));

        wp_enqueue_script('respond', get_template_directory_uri() . "/js/respond.js");



        wp_enqueue_script('modernizr', get_template_directory_uri() . "/js/beforeafter/modernizr-1.6.min.js");

        wp_enqueue_script('leaflet', get_template_directory_uri() . "/js/beforeafter/leaflet.js");

        wp_enqueue_script('beforeafter', get_template_directory_uri() . "/js/beforeafter/beforeafter.js");



        wp_localize_script('func', 'ajax_obj', array(

            'ajax_url' => admin_url('admin-ajax.php', (is_ssl() ? 'https' : 'http')),

            'nonce' => wp_create_nonce('ajax-nonce'),

        ));



        wp_enqueue_style("mCustomScrollbar", get_template_directory_uri() . "/js/scrollbar/jquery.mCustomScrollbar.css");

        wp_enqueue_script("mousewheel", get_template_directory_uri() . "/js/scrollbar/jquery.mousewheel.min.js", array('jquery'));

        wp_enqueue_script('mCustomScrollbar', get_template_directory_uri() . '/js/scrollbar/jquery.mCustomScrollbar.min.js', array('jquery'));

    }

}

function is_login_page() {

    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));

}



add_action('attachments_register', 'banner_attachments');



/***

 * @param $attachments

 * @desc Add banners parameters as width, heigth, link to banners post type

 */

function banner_attachments($attachments)

{

    $args = array(

        'label' => 'Баннеры',

        'post_type' => 'banners',

        'filetype' => null, // no filetype limit

        'note' => 'Панель добавления файлов',

        'button_text' => 'Добавить баннер',

        'modal_text' => 'Добавить',

        'fields' => array(

            array(

                'name' => 'width',

                'type' => 'text',

                'label' => 'Ширина',

            ),

            array(

                'name' => 'height',

                'type' => 'text',

                'label' => 'Высота',

            ),

            array(

                'name' => 'link_url',

                'type' => 'text',

                'label' => 'Ссылка',

            ),
            array(

                'name' => 'sort',

                'type' => 'text',

                'label' => 'Сортировка',

            ),

        ),

    );

    $attachments->register('banner_attachments', $args); // unique instance name

}

/*
PostVIEW by tim for SomBlog
*/

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.' ';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('просмотров');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}


/***

 * @param $postName - post slug

 * @param string $type - post type

 * @return bool|int

 * @desc Get post ID by post slug or false if not found

 */

function get_post_id_by_slug($postName, $type = "post")

{

    global $wpdb;

    $post_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_status = 'publish' AND post_type='" . $type . "'", $postName));

    if ($post_id) {

        return $post_id;

    }

    return false;

}



/***

 * @param $banner_slug - post slug (only banners type)

 * @desc Get banner content (swf|image) with resizable parameters

 */

function get_banner($banner_slug, $echo = true, $url_and_link = false)

{

    $banner_id = get_post_id_by_slug($banner_slug, 'banners');



    $banners = new Attachments('banner_attachments', $banner_id);

    $output = "";

    if ($banners->exist()) {

 $i = 0;
     //пишем всю эту муть.. там в Attachments::()->OneSort();
    $o =$banners->OneSort();
    if(empty($o))
    {
       $o = 0;     
    }
        //ты втираешь мне какуюто Дичь!?
        if($banners->total() > 1) {

            if(!session_id()) session_start();
            if (!isset($_SESSION[$banner_slug])){
                $_SESSION[$banner_slug] = $o;
                 $_SESSION[start] = true;
            }else{
                 $_SESSION[start] = false;           
            }
            $i = intval($_SESSION[$banner_slug]);
            //извольте?!?
            if($_SESSION[start])
             {
                 $i = $i;
             }else{
                if ($i < $banners->total() - 1) {
                    $_SESSION[$banner_slug] = ++$i;
                } else {
                    $_SESSION[$banner_slug] = $i = 0;
                }
             }

        }

        if ($banners->get_single($i)) {

            if($url_and_link) return array('url' => $banners->url($i), 'link' => $banners->field('link_url', $i));

            if ($banners->type($i) == 'image') {

                $b_url = $banners->field('link_url', $i);

                if (!empty($b_url)) $output .= '<noindex><a rel="nofollow" href="' . $b_url . '" target="_blank">';

                $output .= '<img src="' . $banners->url($i) . '" width="100%" />';

                if (!empty($b_url)) $output .= '</a></noindex>';

            }

            if ($banners->type($i) == 'application') {

                $hb = explode("x", $banner_slug);

                $parent_id = $banner_slug . '_' . $banners->id($i);

                $output .= '<div id="' . $parent_id . '"><script type="text/javascript">';

                $output .= 'swfobject.embedSWF("' . $banners->url($i) . '", "' . $parent_id . '", "100%", "' . $hb[1] . '", "10.0.0", "install flash player", null, {menu: "false", wmode: "transparent", scale:"default"}, null);';

                $output .= '</script></div>';

            }

        }

    }

    else {

        if($echo)

            echo $output;

        else

            return false;

    }

    if($echo)

        echo $output;

    else

        return $output;

}



/***

 * @desk Get content for meta tag keywords depending from post type

 */

function get_post_meta_tags()

{

    global $post, $wp_query;

    $tax = '';

    $meta = 'мой город';

    switch ($wp_query->queried_object->post_type) {

        case 'ads':

            $tax = 'adscategory';

            break;

        case 'news':

            $tax = 'ntag';

            break;

        case 'catalog':

            $tax = 'catcategory';

            break;

    }

    if(has_term('other','ncategory', $post) || is_singular('page_news'))
    {
        $meta = get_post_meta($post->ID, 'nws_keywords', true);
    }
    else {
        if (!empty($tax)) {

            $tags = wp_get_post_terms($post->ID, $tax, array("fields" => "names"));

            foreach ($tags as $tag) {

                $meta .= ', ' . $tag;

            }

        }
    }

    echo '<meta name="keywords" content="' . $meta . '">' . PHP_EOL;
}



/***

 * @desc Get open meta tags. Only for (news|post) post type.

 */

function add_open_meta_tags()

{

    global $post;



    if (is_singular('news') || is_singular('post')) {

        echo '<meta property="og:title" content="' . htmlspecialchars($post->post_title) . '"/>' . PHP_EOL;

        echo '<meta property="og:type" content="article"/>' . PHP_EOL;

        echo '<meta property="og:url" content="' . get_permalink($post->ID) . '"/>' . PHP_EOL;

        if (has_post_thumbnail($post->ID)) {

            echo '<meta property="og:image" content="' . wp_get_attachment_url(get_post_thumbnail_id($post->ID)) . '"/>' . PHP_EOL;

        }

        echo '<meta property="og:site_name" content="' . get_bloginfo("name") . '"/>' . PHP_EOL;

        echo '<meta property="og:description" content="' . htmlspecialchars(strip_tags(kama_excerpt("maxchar=100&echo=false&save_format=false"))) . '"/>' . PHP_EOL;

        echo '<meta property="article:published_time" content="' . str_replace('0000', '0500', get_the_date(DateTime::ISO8601)) . '"/>' . PHP_EOL;

        echo '<meta property="article:author:username" content="' . get_the_author_meta('display_name', $post->post_author) . '" />' . PHP_EOL;



        if (is_singular('news')) {

            $cats = wp_get_post_terms($post->ID, 'ncategory');

            foreach ($cats as $cat) {

                echo '<meta property="article:section" content="' . $cat->name . '" />' . PHP_EOL;

                break;

            }

            $tags = wp_get_post_terms($post->ID, 'ntag');

            foreach ($tags as $tag) {

                echo '<meta property="article:tag" content="' . $tag->name . '" />' . PHP_EOL;

            }

        }

        if (is_singular('post')) {

            $cats = wp_get_post_terms($post->ID, 'category');

            foreach ($cats as $cat) {

                echo '<meta property="article:section" content="' . $cat->name . '" />' . PHP_EOL;

                break;

            }

            $tags = wp_get_post_tags($post->ID);

            foreach ($tags as $tag) {

                echo '<meta property="article:tag" content="' . $tag->name . '" />' . PHP_EOL;

            }

        }

    }

}





add_action('pre_get_posts', 'custom_page_size', 1);

function custom_page_size($query)

{

    if (is_admin() || !$query->is_main_query())

        return;



    if (is_home()) {

        return;

    }



    if (is_author()) {

        $query->set('posts_per_page', 15);

        return;

    }



    if(is_feed()) {

        $query->set('post_type', 'news');

        return;

    }



  /*  if (is_tax('megogocat') && $query->is_main_query()) {

        $query->set('posts_per_page', 30);

        $query->set('meta_key', 'mgo_year');

        $query->set('orderby', 'meta_value_num');

        $query->set('order', 'DESC');

        return;

    }*/



    if (!session_id()) session_start();

    if (is_tax('adscategory') || is_tax('catcategory')) {



        $loc = -1;

        if(!empty($_POST['location'])) {

            $loc = $_POST['location'];

        }

        elseif(isset($_SESSION['location'])) {

            $loc = $_SESSION['location'];

        }

        if($loc != -1)$query->set('tax_query', array(array('taxonomy' => 'nlocation', 'field' => 'id', 'terms' => $loc)));



        if(is_tax('adscategory')) $query->set('posts_per_page', 10);

        if(is_tax('catcategory')) $query->set('posts_per_page', 20);



        return;

    }



    if (is_tax()) {

        $query->set('posts_per_page', 12);

        return;

    }



    if (is_search()) {

        $query->set('posts_per_page', 20);

        return;

    }



    if (is_archive()) {

        $query->set('posts_per_page', 30);

        if($query->is_main_query() && $query->is_post_type_archive('page_news'))
        {
            $query->set('post_parent', 0 );
            $query->set('depth', 1 );
        }

        if($query->is_main_query() && $query->is_post_type_archive('news'))
        {
            $query->set('tax_query', array(array('taxonomy' => 'ncategory', 'field' => 'slug', 'terms' => 'other', 'operator' => 'NOT IN')));
        }

        return;

    }

}



/***

 * @param null $p_date

 * @param string $format

 * @return string

 * @desc Get date by custom format

 */

function get_date_formatted($p_date = null, $format = "std")

{

    $d = ($p_date == null) ? date("d.m.Y.H.i") : date("d.m.Y.H.i", strtotime($p_date));

    $d = explode(".", $d);



    $months = array(

        "01" => "Январь",

        "02" => "Февраль",

        "03" => "Март",

        "04" => "Апрель",

        "05" => "Май",

        "06" => "Июнь",

        "07" => "Июль",

        "08" => "Август",

        "09" => "Сентябрь",

        "10" => "Октябрь",

        "11" => "Ноябрь",

        "12" => "Декабрь",

    );

    $m = $months[$d[1]];



    switch ($format) {

        case "v":

            return $m . " " . $d[0] . ", " . $d[2] . " в " . $d[3] . ":" . $d[4];

        case "slide":

            return $m . " " . $d[0] . ", " . $d[2];

        case "std":

            return $m . " " . $d[0] . ", " . $d[2] . ", " . $d[3] . ":" . $d[4];

        default:

            return $m . " " . $d[0] . ", " . $d[2] . ", " . $d[3] . ":" . $d[4];

    }

}



/***

 * @param $len - string length

 * @param string $rep - string end

 * @desc reduction post title

 */

function the_title_shorten($len, $rep = '...')

{

    $title = the_title('', '', false);



    if (iconv_strlen($title, 'utf-8') > $len) {

        $shortened_title = iconv_substr($title, 0, $len, 'utf-8');

        $shortened_title = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $shortened_title); //убираем последнее слово, ибо оно в 99% случаев неполное

    } else

        $shortened_title = $title;



    print $shortened_title;

}



/***

 * @param string $args

 * @return int|mixed|string

 * @desc Get post subtitle

 */

function kama_excerpt($args = '')

{

    global $post;

    parse_str($args, $i);

    $maxchar = isset($i['maxchar']) ? (int)trim($i['maxchar']) : 200;

    $text = isset($i['text']) ? trim($i['text']) : '';

    $save_format = isset($i['save_format']) ? trim($i['save_format']) : false;

    $echo = isset($i['echo']) ? false : true;



    if (!$text) {

        $out = $post->post_excerpt ? $post->post_excerpt : $post->post_content;

        $out = preg_replace("!\[/?.*\]|\[/?.*\].*\[/?.*\]!ui", '', $out); //убираем шоткоды, например:[singlepic id=3]

        // для тега <!--more-->

        if (!$post->post_excerpt && strpos($post->post_content, '<!--more-->')) {

            preg_match('/(.*)<!--more-->/s', $out, $match);

            $out = str_replace("\r", '', trim($match[1], "\n"));

            $out = preg_replace("!\n\n+!s", "</p><p>", $out);

            $out = "<p>" . str_replace("\n", "<br />", $out) . "</p>";

            if ($echo)

                return print $out;

            return $out;

        }

    }



    $out = $text . $out;

    if (!$post->post_excerpt)

        $out = strip_tags($out, $save_format);



    if (iconv_strlen($out, 'utf-8') > $maxchar) {

        $out = iconv_substr($out, 0, $maxchar, 'utf-8');

        $out = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $out); //убираем последнее слово, ибо оно в 99% случаев неполное

    }



    if ($save_format) {

        $out = str_replace("\r", '', $out);

        $out = preg_replace("!\n\n+!", "</p><p>", $out);

        $out = "<p>" . str_replace("\n", "<br />", trim($out)) . "</p>";

    }



    if ($echo) return print trim($out);

    return trim($out);

}



/***

 * @param null $post_id

 * @param array $sizes

 * @param bool $crop

 * @param bool $url

 * @desc Generate image thumbnail on fly

 */

function get_image_thumb($post_id = null, $sizes = array(224, 160), $crop = true, $url = false, $cl = "")

{

    $post_id = (null === $post_id) ? get_the_ID() : $post_id;

    $post_thumbnail_id = get_post_thumbnail_id($post_id);



    echo get_image_by_id($post_thumbnail_id, $sizes, $crop, $url, $cl);

}



function get_image_by_id($post_thumbnail_id = null, $sizes = array(224, 160), $crop = true, $url = false, $cl = "")

{

    $img_url = wp_get_attachment_url($post_thumbnail_id, 'full'); //get img URL



    $image_th_url = aq_resize($img_url, $sizes[0], $sizes[1], $crop); //resize & crop img



    $class = "attachment-{$sizes[0]}x$sizes[1] wp-post-image " . $cl;

    $alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);



    if (empty($image_th_url)) {

        if($url) {

            return $img_url;

        }

        else {

            return "<img src='{$img_url}' class='{$class}' alt='{$alt}' >";

        }

    }



    if ($url) {

        return $image_th_url;

    }



    return "<img src='{$image_th_url}' class='{$class}' alt='{$alt}' >";

}





add_filter('wp_title', 'my_wp_title', 10, 2);



/***

 * @param $title

 * @param $sep

 * @return string

 * @desc Get page title

 */

function my_wp_title($title, $sep)

{

    global $paged, $page, $post;



    if (is_feed())

        return $title;



    if (is_single() && (get_post_type() == 'news' || get_post_type() == 'page_news')) {

        if(has_term('other','ncategory', $post) || get_post_type() == 'page_news') {
            $t = get_post_meta($post->ID, 'nws_title', true);
            return (empty($t)) ? $post->post_title : $t;
        }

        $loc = get_the_terms($post->ID, 'nlocation');

        if ($loc) {

            $loc = array_shift($loc);

            return "Новости " . $loc->name . " - " . str_replace("|", "", $title);

        } else {

            return "Новости  - " . str_replace("|", "", $title);

        }

    }



    // Add the site name.

    $title .= get_bloginfo('name');



    // Add the site description for the home/front page.

    $site_description = get_bloginfo('description', 'display');

    if ($site_description && (is_home() || is_front_page()))

        $title = "$title $sep $site_description";



    // Add a page number if necessary.

    if ($paged >= 2 || $page >= 2)

        $title = "$title";

    // $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );



    return $title;

}





add_filter('the_content', 'filter_new_content');

function filter_new_content($content)

{

    global $post;



    if ($post->post_type == "news" && is_single()) {

        $loc = get_the_terms($post,'nlocation');

        if($loc) {

            $loc = array_shift($loc);

            $title = "Новости " . $loc->name . " - " . $post->post_title;

        }

        else {

            $title = "Новости - " . $post->post_title;

        }



        preg_match_all('/<img.*?(alt="(.*?)").*?\/>/', $content, $res, PREG_SET_ORDER);



        foreach($res as $item)

        {

            //$noTitle = preg_replace('/title=".*?"/', '', $item[0]);

            $in = "alt='" . $title . " " . $item[2] . "'";// . " title='" . $item[2] . "'";

            $out = str_replace($item[1], $in, $item[0]);

            $content = str_replace($item[0], $out, $content);

        }



        if(!has_term('other','ncategory', $post)) $content .= "<p class='author'>" . get_the_author_meta('display_name', $post->post_author) . "</p>";



        if (!has_term('photoreport', 'ncategory', $post)) {

            $images_arr = get_posts(array('post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID));

            if ($images_arr) {

                $post_thumbnail_id = get_post_thumbnail_id($post->ID);



                $content .= "<div class='gray-images'>";

                foreach ($images_arr as $im) {

                    $type = get_post_mime_type($im->ID);

                    if(strpos($type, 'image') === false) continue;



                    $guid = substr ($im->guid, 0, strrpos($im->guid, '.'));

                    $post_names = array($guid.'.', $guid.'-');

                    if (strpos($content, $post_names[0]) === false && strpos($content, $post_names[1]) === false) {

                        if ($im->ID == $post_thumbnail_id && strpos($content, '[slideshow') !== false) {

                            $img_url = wp_get_attachment_url($post_thumbnail_id, 'full'); //get img URL

                            $image_th_url = aq_resize($img_url, 300, 225, true); //resize & crop img*/

                            $replace_str = "<a href='" . $img_url . "'><img src='" . $image_th_url . "' alt='" . htmlspecialchars($im->post_title) . "'></a>";

                            $content = preg_replace('#\[slideshow .*\]#ui', $replace_str, $content);

                        } else {

                            $img_url = wp_get_attachment_url($im->ID, 'full'); //get img URL

                            $image_th_url = aq_resize($img_url, 140, 105, true); //resize & crop img

                            $content .= "<a href='" . $img_url . "'><img class='grayscale' src='" . $image_th_url . "' alt='" . htmlspecialchars($im->post_title) . "'></a>";

                        }

                    }

                }

                $content .= "</div>";

            }

        }

        $content = preg_replace('#\[slideshow .*\]#ui', '', $content);



        $postUrl = urlencode(get_post_permalink($post->ID));



        $content .= '<div class="share-buttons">';

        $content .= '<div id="mailru_like"><a target="_blank" "nofollow" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share" data-mrc-config="{\'cm\' : \'1\', \'sz\' : \'20\', \'st\' : \'2\', \'tp\' : \'mm\'}">Нравится</a></div>';

        $content .= '<script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>';

        $content .= '<div id="vk_like"></div><script type="text/javascript">VK.Widgets.Like("vk_like", {type: "button", height: 20});</script>';

        $content .= '<iframe src="https://www.facebook.com/plugins/like.php?href='.$postUrl.'&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; float: right; width: 220px;" allowTransparency="true"></iframe>';

        $content .= '<a rel="nofollow" href="https://twitter.com/share" class="twitter-share-button" data-lang="ru">Твитнуть</a>';

        $content .= "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";

        $content .= '</div>';







    }

    return $content;

}





function get_news_breadcrumbs()

{

    if (!is_singular('news')) return;

    $breadcrumbs = "";



    $breadcrumbs .= "<a href='" . home_url() . "'>Главная</a>";



    $term = wp_get_post_terms(get_the_ID(), 'nlocation');

    if (count($term) > 0) $breadcrumbs .= "<a href='" . get_term_link($term[0], 'nlocation') . "'>" . $term[0]->name . "</a>";



    $term = wp_get_post_terms(get_the_ID(), 'ncategory');

    if(count($term) > 0) {

        if(count($term) == 1) $breadcrumbs .= "<a href='" . get_term_link($term[0], 'ncategory') . "'>" . $term[0]->name . "</a>";

        else {

            foreach($term as $t) {

                if($t->slug != 'lenta') {

                    $breadcrumbs .= "<a href='" . get_term_link($t, 'ncategory') . "'>" . $t->name . "</a>";

                    break;

                }

            }

        }

    }



    echo $breadcrumbs;

}





function gorod_comment($comment, $args, $depth)

{

    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

        <div id="comment-<?php comment_ID(); ?>">

            <div class="comment-author-conteiner vcard">

                <span class="comment-author"><?php echo get_comment_author(); ?></span>

                <span

                    class="comment-date"><?php echo get_date_formatted(get_comment_date('d.m.Y') . "." . get_comment_time('H.i'), 'v'); ?></span>

                <span class="reply">

                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'reply_text' => 'Ответить', 'max_depth' => $args['max_depth']))) ?>

                </span>

                <span class="karma"><?php if (function_exists(ckrating_display_karma)) {

                        ckrating_display_karma();

                    } ?></span>

            </div>

            <?php if ($comment->comment_approved == '0') : ?>

                <em><?php _e('Your comment is awaiting moderation.') ?></em>

            <?php endif; ?>



            <div class="comment-content"><?php comment_text() ?></div>

        </div>

    </li>

<?php

}

function get_ulogin_buttons($i = '')

{

    $url = current_page_url();

    $url .= ($i == '') ? '#commentform' : '';

    $receiver = get_template_directory_uri() . "/lib/xd_custom.html";

    $ulogin = '<div id="uLogin'.$i.'" x-ulogin-params="display=buttons;providers=twitter,facebook,vkontakte,mailru;hidden=;fields=first_name,last_name,email;optional=phone;label=;redirect_uri='.$url.';receiver='.$receiver.'">';

    $ulogin .= '<a href = "#twitter" data-uloginbutton = "twitter" class="twitter-ico" ></a>';

    $ulogin .= '<a href = "#facebook" data-uloginbutton = "facebook" class="facebook-ico" ></a>';

    $ulogin .= '<a href = "#vkontakte" data-uloginbutton = "vkontakte" class="vkontakte-ico" ></a>';

    $ulogin .= '<a href = "#mailru" data-uloginbutton = "mailru" class="mailru-ico" ></a>';

    $ulogin .= '<a href = "#odnoklassniki" data-uloginbutton = "odnoklassniki" class="odnoklassniki-ico" ></a>';

    $ulogin .= '</div>';

    return $ulogin;

}



function add_ads_post($data, $future = false)

{

    global $wpdb;

    if (is_user_logged_in()) {

        if (!isset($data['conf_rule']) || empty($data['conf_rule'])) {

            echo '<div class="error">Для размещения объявления необходимо согласиться с условиями сайта!</div>';

            return;

        }

        if (isset($data['author_email']) && filter_var($data['author_email'], FILTER_VALIDATE_EMAIL)) {

            $author_email = $data['author_email'];

        } else {

            echo '<div class="error">Не (корректно) заполнено поле "Ваш email"</div>';

            return;

        }

        if (isset($data['title']) && !empty($data['title'])) {

            $title = $data['title'];

        } else {

            echo '<div class="error">Не заполнено поле "Заголовок"</div>';

            return;

        }

        if (isset($data['description']) && !empty($data['description'])) {

            $content = $data['description'];

        } else {

            echo '<div class="error">Не заполнено поле "Объявление"</div>';

            return;

        }

        if (!check_attachment_files() && !$future) {

            echo '<div class="error">Загружаемый вами тип файла не поддерживается</div>';

            return;

        }

        $author_phone = isset($data['author_phone']) ? strip_tags($wpdb->escape($data['author_phone'])) : '';

        $price = isset($data['price']) ? strip_tags($wpdb->escape($data['price'])) : '';

        $type = strip_tags($wpdb->escape($data['p_type']));



        $post_name = sanitize_title_with_translit($title);

        $post_date = current_time('mysql'); //date('Y-m-d H:i:s');

        $expired_date = gmdate('Y-m-d H:i:s', (time() + (get_option('gmt_offset') * HOUR_IN_SECONDS) + MONTH_IN_SECONDS * 2));



        /* создаем массив и собираем все данные вместе */

        $the_post = array();

        $the_post['post_author'] = get_current_user_id();

        $the_post['post_date'] = $post_date;

        $the_post['post_date_gmt'] = $post_date;

        $the_post['post_content'] = str_replace(array("\r\n", "\n", "\r"), "<br>", strip_tags($wpdb->escape(str_replace('"', '&quot;',$content)), '<p><br><br/>'));

        $the_post['post_title'] = htmlspecialchars(strip_tags($wpdb->escape($title)));

        $the_post['post_excerpt'] = '';

        $the_post['post_status'] = 'pending';

        $the_post['comments_status'] = 'open';

        $the_post['ping_status'] = 'closed';

        $the_post['post_password'] = '';

        $the_post['post_name'] = $wpdb->escape($post_name);

        $the_post['to_ping'] = '';

        $the_post['pinged'] = '';

        $the_post['post_content_filtered'] = '';

        $the_post['guid'] = '';

        $the_post['post_type'] = $type;

        $the_post['post_mime_type'] = '';

        $the_post['comment_count'] = 0;

        $the_post['filter'] = true; // говорим вордпресс "все ок, не надо что-то проверять и удалять из моего поста"



        $post_ID = 0;

        if (!empty($data['ad_id'])) {

            $ads = get_post($data['ad_id']);

            $the_post["ID"] = $ads->ID;

            if ($ads->post_author == $the_post['post_author']) $post_ID = wp_update_post($the_post);

        } else {

            $post_ID = wp_insert_post($the_post);

        }



        if ($post_ID > 0) {

            require_once(ABSPATH . WPINC . '/registration.php');



            wp_update_user(array('ID' => $the_post['post_author'], 'user_email' => $author_email, 'aim' => $author_phone));



            wp_set_post_terms($post_ID, strip_tags($wpdb->escape($data['location'])), 'nlocation');

            wp_set_post_terms($post_ID, strip_tags($wpdb->escape($data['category'])), 'adscategory');



            if (!empty($data['ad_id'])) update_post_meta($post_ID, 'ads_price', $price);

            else {

                add_post_meta($post_ID, 'ads_price', $price, true);

                add_post_meta($post_ID, 'scadenza-enable', '1', true);

                add_post_meta($post_ID, 'scadenza-date', $expired_date, true);

            }



            if (!$future) {

                $featuredImage = true;

                foreach ($_FILES as $file_id => $array) {

                    if ($featuredImage) {

                        $attachment_id = insert_attachment($file_id, $post_ID, $featuredImage);

                        $featuredImage = false;

                    } else {

                        $attachment_id = insert_attachment($file_id, $post_ID, $featuredImage);

                    }

                }

            }



            if(isset($_POST['images']) && is_array($_POST['images'])) {

                $images = $_POST['images'];

                $first = true;

                foreach($images as $imgID) {

                    wp_update_post(array('ID' => $imgID, 'post_parent' => $post_ID));

                    if($first) {

                        set_post_thumbnail($post_ID, $imgID);

                        $first = false;

                    }

                }

            }



            echo '<div class="succes">Ваше объявление поставлено в очередь на модерацию.</div>';

        } else {

            echo '<div class="error">произошла ошибка</div>';

        }

    }

}



function add_org_post($data, $future = false)

{

    global $wpdb;

    if (is_user_logged_in()) {

        if (isset($data['author_email']) && filter_var($data['author_email'], FILTER_VALIDATE_EMAIL)) {

            $author_email = $data['author_email'];

        } else {

            echo '<div class="error">Не (корректно) заполнено поле "Ваш email"</div>';

            return;

        }

        if (isset($data['title']) && !empty($data['title'])) {

            $title = $data['title'];

        } else {

            echo '<div class="error">Не заполнено поле "Название организации"</div>';

            return;

        }

        if (isset($data['description']) && !empty($data['description'])) {

            $content = $data['description'];

        } else {

            echo '<div class="error">Не заполнено поле "Описание"</div>';

            return;

        }

        if(!check_attachment_files() && !$future) {

            echo '<div class="error">Загружаемый вами тип файла не поддерживается</div>';

            return;

        }

        $contacts = isset($data['contacts']) ? strip_tags($wpdb->escape((nl2br($data['contacts'])),'<p><br><br/>')) : '';

        $type = strip_tags($wpdb->escape($data['p_type']));



        $post_name = sanitize_title_with_translit($wpdb->escape($title));

        $post_date = current_time('mysql'); //date('Y-m-d H:i:s');



        /* создаем массив и собираем все данные вместе */

        $the_post = array();

        $the_post['post_author'] = get_current_user_id();

        $the_post['post_date'] = $post_date;

        $the_post['post_date_gmt'] = $post_date;

        $the_post['post_content'] = str_replace(array("\r\n", "\n", "\r"), "<br>", strip_tags($wpdb->escape(str_replace('"', '&quot;',$content)),'<p><br><br/>'));

        $the_post['post_title'] = htmlspecialchars(strip_tags($wpdb->escape($title)));

        $the_post['post_excerpt'] = '';

        $the_post['post_status'] = 'pending';

        $the_post['comments_status'] = 'open';

        $the_post['ping_status'] = 'closed';

        $the_post['post_password'] = '';

        $the_post['post_name'] = $post_name;

        $the_post['to_ping'] = '';

        $the_post['pinged'] = '';

        $the_post['post_content_filtered'] = '';

        $the_post['guid'] = '';

        $the_post['post_type'] = $type;

        $the_post['post_mime_type'] = '';

        $the_post['comment_count'] = 0;

        $the_post['filter'] = true; // говорим вордпресс "все ок, не надо что-то проверять и удалять из моего поста"



        $post_ID = 0;

        if (!empty($data['org_id'])) {

            $org = get_post($data['org_id']);

            $the_post["ID"] = $org->ID;

            if ($org->post_author == $the_post['post_author']) $post_ID = wp_update_post($the_post);

        } else {

            $post_ID = wp_insert_post($the_post);

        }



        if ($post_ID > 0) {

            require_once(ABSPATH . WPINC . '/registration.php');



            wp_update_user(array('ID' => $the_post['post_author'], 'user_email' => $author_email));



            wp_set_post_terms($post_ID, $data['location'], 'nlocation');

            wp_set_post_terms($post_ID, $data['category'], 'catcategory');



            if (!empty($data['org_id'])) update_post_meta($post_ID, 'catalog_contacts', $contacts);

            else add_post_meta($post_ID, 'catalog_contacts', $contacts, true);



            if (!$future) {

                $featuredImage = true;

                foreach ($_FILES as $file_id => $array) {

                    if ($featuredImage) {

                        $attachment_id = insert_attachment($file_id, $post_ID, $featuredImage);

                        $featuredImage = false;

                    } else {

                        $attachment_id = insert_attachment($file_id, $post_ID, $featuredImage);

                    }

                }

            }



            if(isset($_POST['images']) && is_array($_POST['images'])) {

                $images = $_POST['images'];

                $first = true;

                foreach($images as $imgID) {

                    wp_update_post(array('ID' => $imgID, 'post_parent' => $post_ID));

                    if($first) {

                        set_post_thumbnail($post_ID, $imgID);

                        $first = false;

                    }

                }

            }



            echo '<div class="succes">Ваша запись поставлена в очередь на модерацию.</div>';

        } else {

            echo '<div class="error">произошла ошибка</div>';

        }

    }

}







function check_attachment_files()

{

    $checked = true;

    if (count($_FILES) > 0) {

        array_shift($_FILES);

        foreach ($_FILES as $file_id => $array) {

            $type = explode('/', $array['type']);



            if ($type[1] != 'jpeg' && $type[1] != 'png' && $type[1] != 'jpg' && $type[1] != 'gif') {

                $checked = false;

                return $checked;

            }

        }

    }

    return $checked;

}



function insert_attachment($file_id, $post_id, $featuredImage)

{

    require_once(ABSPATH . "wp-admin" . '/includes/image.php');

    require_once(ABSPATH . "wp-admin" . '/includes/file.php');

    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

    $_FILES[$file_id]['name'] = sanitize_title_with_translit($_FILES[$file_id]['name']);

    $attach_id = media_handle_upload($file_id, $post_id);

    if (is_int($attach_id) && ($featuredImage)) update_post_meta($post_id, '_thumbnail_id', $attach_id);

    return $attach_id;

}



add_action('wp_ajax_insert_attach', 'insert_post_attach');

function insert_post_attach()

{

    if (is_user_logged_in()) {

        $nonce = $_POST['nonce'];

        if (!wp_verify_nonce($nonce, 'ajax-nonce')) wp_die();



        if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );



        $arr = array();



        $file = $_FILES['image'];



        $file['name'] = sanitize_title_with_translit(sanitize_file_name(basename($file['name'])));



        $upload_overrides = array( 'test_form' => false );

        $movefile = wp_handle_upload( $file, $upload_overrides );



        if ( $movefile ) {

            $wp_filetype = wp_check_filetype(basename($movefile['file']), null );

            $wp_upload_dir = wp_upload_dir();

            $filePath = $wp_upload_dir['url'] . '/' . basename( $movefile['file'] );

            $attachment = array(

                'guid' => $filePath,

                'post_mime_type' => $wp_filetype['type'],

                'post_title' => sanitize_file_name( basename( $movefile['file'])),

                'post_content' => '',

                'post_status' => 'inherit'

            );



            $attach_id = wp_insert_attachment( $attachment, $filePath );



            $attach_data = wp_generate_attachment_metadata( $attach_id, $filePath );

            wp_update_attachment_metadata( $attach_id, $attach_data );



            $img_url = wp_get_attachment_url($attach_id, 'full'); //get img URL

            $image_th_url = aq_resize($img_url, 100, 100, true);



            $arr = array('id' => $attach_id, 'url' => $image_th_url);

            exit("_@_".json_encode($arr));



        } else {

            exit(json_encode($arr['error'] = 0));

        }

    } else wp_die();

}



function get_post_attachments($parent_id = 0, $future = false, $max = 5)

{

    $args = array(

        'order' => 'ASC',

        'orderby' => 'menu_order',

        'post_type' => 'attachment',

        'post_parent' => $parent_id,

        'post_mime_type' => 'image',

        'post_status' => null,

        'post_per_page' => $max,

    );

    $items = "";

    $counter = 0;

    $attachments = ($parent_id == 0) ? false : get_posts($args);

    if ($attachments) {



        foreach ($attachments as $attachment) {

            $img_url = wp_get_attachment_url($attachment->ID, 'full'); //get img URL

            $image_th_url = aq_resize($img_url, 100, 100, true);

            if($future) {

                $counter++;



                $items .= '<div class="attach-item">';

                $items .= '<input type="file" name="file'.$counter.'" class="attaches" disabled="disabled">';

                $items .= '<img id="img_' . $attachment->ID . '" src="' . $image_th_url .'">';

                $items .= '<div class="delete-btn" id="' . $attachment->ID . '"></div>';

                $items .= '</div>';

            }

            else {

                $items .= "<div><img src='" . $image_th_url . "'><input type='button' value='удалить' onclick='remove_attachment(this, " . $attachment->ID . ")'></div>";

            }

        }

    }



    if($future) {

        while($counter < $max) {

            $counter++;



            $items .= '<div class="attach-item">';

            $items .= '<input type="file" name="file'.$counter.'" class="attaches">';

            $items .= '</div>';

        }

    }



    echo $items;

}



add_action('wp_ajax_competition_like', 'competition_like_handler');

add_action('wp_ajax_nopriv_competition_like', 'competition_like_handler');

function competition_like_handler()

{

    $id = intval($_POST['id']);

    $nonce = $_POST['nonce'];

    if (!wp_verify_nonce($nonce, 'ajax-nonce') || !$id) wp_die();



    $ips = get_post_meta($id, 'competition_ips', true);

    $ips = ($ips) ? json_decode($ips) : array();

    if(in_array(get_user_ip(), $ips)) {

        exit(json_encode(array('error' => 'Ваш голос уже принят.')));

    }

    $ips[] = get_user_ip();



    $likes = get_post_meta($id, 'competition_like', true);

    $likes = ($likes) ? intval($likes)+1 : 1;



    if(update_post_meta($id, 'competition_like', $likes) && update_post_meta($id, 'competition_ips', json_encode($ips)))

        exit(json_encode(array('likes' => $likes)));



    exit(json_encode(array('error' => 'Что то пошло не так. Попробуйте позже.')));

}



add_action('wp_ajax_delete_attach', 'remove_post_attachment');

function remove_post_attachment()

{

    if (is_user_logged_in()) {

        $id = intval($_POST['ad_id']);

        $nonce = $_POST['nonce'];

        if (!wp_verify_nonce($nonce, 'ajax-nonce')) wp_die();

        $p = get_post($id);

        if (get_current_user_id() == $p->post_author) wp_delete_attachment($id, true);

        exit;

    } else wp_die();

}



add_action('wp_ajax_get_sub_cats', 'get_sub_cats');

function get_sub_cats()

{

    if (is_user_logged_in()) {

        $id = intval($_POST['id']);

        $nonce = $_POST['nonce'];

        if (!wp_verify_nonce($nonce, 'ajax-nonce')) wp_die();

        exit(json_encode(get_ads_sub_terms($id)));

    } else wp_die();

}





add_filter('add_menu_classes', 'show_pending_number', 8);

function show_pending_number($menu)

{

    global $wpdb;



    $comment_count = $user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments AS c INNER JOIN $wpdb->posts AS p ON c.comment_post_ID = p.ID WHERE c.comment_approved = '0' AND p.post_type <> 'people'" );



    $menu[25][0] = sprintf(__('Комментарии %s'), "<span class='awaiting-mod count-$comment_count'><span class='pending-count'>" . number_format_i18n($comment_count) . "</span></span>");



    $num_posts = wp_count_posts('ads');

    $status = "pending";

    $pending_count = 0;

    if (!empty($num_posts->$status))

        $pending_count = $num_posts->$status;



    $menu[8][0] = sprintf(__('Объявления %s'), "<span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . "</span></span>");





    $num_posts = wp_count_posts('catalog');

    $status = "pending";

    $pending_count = 0;

    if (!empty($num_posts->$status))

        $pending_count = $num_posts->$status;



    $menu[9][0] = sprintf(__('Справочник %s'), "<span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . "</span></span>");



    return $menu;

}



add_filter('body_class', 'class_names');

function class_names($classes)

{



    if (($key = array_search("single-ads", $classes)) !== false) {

        $classes[$key] = "single-abc";

    }

    return $classes;

}



function ads_taxonomy_breadcrumb() {

// Get the current term

    if(is_tax() || is_singular('ads') || is_singular('catalog')) {

        global $wp_query, $post;



        if(is_single()) {

            $term_name = (is_singular('ads')) ? 'adscategory' : 'catcategory';

            $terms = wp_get_post_terms( $post->ID, $term_name );

            if(count($terms) == 0) return;

            $term = $terms[0];

        }

        else {

            $term = $wp_query->queried_object;

        }



        $tax = $term->taxonomy;



        $delimeter = '';

        $currentBefore = '<span class="current">';

        $currentAfter = '</span>';



        echo '<a href="'.home_url().'">'.__("Home").'</a>';



        $p = (is_tax('adscategory') || is_singular('ads')) ? get_post(get_post_id_by_slug('adspage', 'page')) : get_post(get_post_id_by_slug('orgspage', 'page'));

        echo $delimeter . '<a href="'.get_permalink($p->ID).'">'.$p->post_title.'</a>';



        // Create a list of all the term's parents

        $parent = $term->parent;

        if(is_single()) $parents[] = $term->term_id;

        while ($parent):

            $parents[] = $parent;

            $new_parent = get_term_by( 'id', $parent, $tax );

            $parent = $new_parent->parent;

        endwhile;

        if(!empty($parents)):

            $parents = array_reverse($parents);



            // For each parent, create a breadcrumb item

            foreach ($parents as $parent):

                $item = get_term_by( 'id', $parent, $tax );

                $url = get_bloginfo('url').'/'.$item->taxonomy.'/'.$item->slug;

                echo $delimeter . '<a href="'.$url.'">'.$item->name.'</a>';

            endforeach;

        endif;



        $current = (is_single()) ? $post->post_title : $term->name;

        // Display the current term in the breadcrumb

        echo $delimeter . $currentBefore . $current . $currentAfter;

    }

}



function sort_objects_by_location($f1, $f2)

{

    if ($f1->location < $f2->location) return -1;

    elseif ($f1->location > $f2->location) return 1;

    else {

        if ($f1->post_date == $f2->post_date) return 0;

        return ($f1->post_date > $f2->post_date) ? -1 : 1;

    }

}



function sort_objects_by_likes($f1, $f2)

{

    if ($f1->likes < $f2->likes) return 1;

    elseif ($f1->likes > $f2->likes) return -1;

    else return 0;

}





function get_ads_root_terms()

{

    $arr = array();

    $terms = get_categories(array('taxonomy' => 'adscategory', 'type' => 'ads', 'parent' => 0)); // get all the terms on that post

    $images = get_option('taxonomy_image_plugin'); // get the taxonomy images array

    foreach ($terms as $term) { // iterate through each term

        $term_id = $term->term_taxonomy_id; // get the ID of the term

        if (array_key_exists($term_id, $images)) { // check if term has an image

            $img = wp_get_attachment_image_src($images[$term_id], 'full');

            if (!$img) $img = array(0 => "");

            $arr[] = array(

                'id' => $term->term_id,

                'img' => $img[0],

                'name' => $term->name

            );

        }

    }

    return $arr;

}



function get_ads_sub_terms($parent)

{

    $arr = array();

    $terms = get_categories(array(

        'type' => 'ads',

        'parent' => $parent,

        'hide_empty' => 0,

        'taxonomy' => 'adscategory'

    )); // get all the terms on that post



    foreach ($terms as $term) {

        $arr[] = array(

            'id' => $term->term_id,

            'name' => $term->name

        );

    }



    return $arr;

}



function get_ie_version() {

    $ver = 11;



    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6')) $ver = 6;

    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7')) $ver = 7;

    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8')) $ver = 8;

    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9')) $ver = 9;

    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10')) $ver = 10;



    return $ver;

}



add_filter ('pre_comment_user_ip', 'get_user_ip');

function get_user_ip()

{

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) {

        $ip = $_SERVER['HTTP_X_FORWARDED'];

    } elseif (!empty($_SERVER['HTTP_FORWARDED'])) {

        $ip = $_SERVER['HTTP_FORWARDED'];

    } else {

        $ip = $_SERVER['REMOTE_ADDR'];

    }

    return $ip;

}



function add_category_to_rss(){

    global $post;

    $terms = wp_get_post_terms($post->ID, 'ncategory', array("fields" => "names"));

    echo '<category>'.$terms[0].'</category>' . PHP_EOL;

}

add_action( 'rss2_item', 'add_category_to_rss', 10, 1);



add_action('wp_head', 'kama_postviews');

function kama_postviews() {

    /* ------------ Настройки -------------- */

    $meta_key       = 'views';  // Ключ мета поля, куда будет записываться количество просмотров.

    $who_count      = 0;            // Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированых пользователей.

    $exclude_bots   = 1;            // Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.

    /* СТОП настройкам */



    global $user_ID, $post;



    if(is_singular('ads') || is_singular('news') || is_singular('page_news') || is_singular('medicalnews') /*|| is_singular('megogo')*/ ||

        is_singular('educationnews') || is_singular('lessons') || is_singular('recipenews') || is_singular('recipe') || is_singular('avtomabilkanews') || is_singular('avtomabilka')) {

        $id = (int)$post->ID;

        static $post_views = false;

        if($post_views) return true; // чтобы 1 раз за поток

        $post_views = (int)get_post_meta($id,$meta_key, true);

        $should_count = false;

        switch( $who_count ) {

            case 0: $should_count = true;

                break;

            case 1:

                if( (int)$user_ID == 0 )

                    $should_count = true;

                break;

            case 2:

                if( (int)$user_ID > 0 )

                    $should_count = true;

                break;

        }

        if( (int)$exclude_bots==1 && $should_count ){

            $useragent = $_SERVER['HTTP_USER_AGENT'];

            $notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla

            $bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется

            if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )

                $should_count = false;

        }



        if($should_count)

            if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);

    }

    return true;

}



add_action( 'update_views_event', 'do_this_in_an_hour', 10, 3 );

function do_this_in_an_hour( $post_id ) {

    $post_views = (int)get_post_meta($post_id, 'views', true);

    $post_views = $post_views + rand(100,200);

    update_post_meta($post_id, 'views', $post_views);

}



add_action( 'save_post', 'run_when_post_published_first_time',10,2 );

function run_when_post_published_first_time ( $post_id )

{

    $post = get_post($post_id);

    if ($post->post_date == $post->post_modified && $post->post_type == 'news' && $post->post_status == 'publish') {

        wp_schedule_single_event( time() + 3600, 'update_views_event', array( $post_id ) );

    }

}



function additional_mime_types($mimes) {

    $mimes['swf'] = 'application/x-shockwave-flash';

    return $mimes;

}

add_filter('upload_mimes', 'additional_mime_types');



add_action('wp_ajax_get_more_posts', 'get_more_posts');

add_action('wp_ajax_nopriv_get_more_posts', 'get_more_posts');

function get_more_posts()

{

    $nonce = $_POST['nonce'];

    $qObjId = $_POST['term'];

    $tax = $_POST['tax'];

    $pType = $_POST['pType'];

    $offset = intval($_POST['offset']);

    $limit = intval($_POST['limit']);

    if (!wp_verify_nonce($nonce, 'ajax-nonce') || $offset == 0 || ($limit == 0 || $limit > 50) || is_array($offset)) wp_die();



    $types = get_post_types(array('public' => true), 'names');

    if(!in_array($pType, $types)) wp_die();



    $params = array('post_type' => $pType, 'posts_per_page' => $limit, 'offset' => $offset);



    $taxes = array('ncategory', 'ntag', 'adscategory', 'catcategory');

    if(!empty($tax) && in_array($tax, $taxes)) {

        if($qObjId == 0 || is_array($qObjId)) wp_die();

        $params['tax_query'][] = array('taxonomy' => $tax, 'field' => 'id', 'terms' => $qObjId);

    }



    $posts = get_posts($params);

    $output = array();



    foreach($posts as $post)

    {

        $row = array();

        $row['title'] = htmlspecialchars($post->post_title);

        $row['date'] = get_date_formatted(date_format(new DateTime($post->post_date), 'd.m.Y.H.i'));

        $row['link'] = get_permalink($post->ID);



        if($post->post_type == 'news' || $post->post_type == 'ads') {

            $views = get_post_meta($post->ID, 'views', true);

            $row['views'] = (empty($views)) ? '0' : $views;



            if(has_post_thumbnail($post->ID)) {

                $img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'full');

                $sizes = ($post->post_type == 'news') ? array(60, 60) : array(96, 75);

                $row['src'] = aq_resize($img_url, $sizes[0], $sizes[1], true);

            }

            else {

                $row['src'] = ($post->post_type == 'news') ? null : get_template_directory_uri() . '/images/blank_image.png';

            }



            if($post->post_type == 'news') {

                $row['comments'] = get_comments_number($post->ID);

            }



            if($post->post_type == 'ads') {

                $row['short'] = htmlspecialchars(kama_excerpt("maxchar=80&echo", $post));

            }

        }



        if($post->post_type == 'catalog' || $post->post_type == 'ads') {

            $location = get_the_terms($post->ID, 'nlocation');

            if ($location) {

                $location = array_shift($location);

                $row['location'] = $location->name;

            } else {

                $row['location'] = "Уральск";

            }



            if($post->post_type == 'catalog') {

                $contact = get_post_meta($post->ID, 'catalog_contacts', true);

                preg_match('#\d+-\d+-\d+|\d+ \d+ \d+|\d+#ui', $contact, $phone_arr);

                $row['contact'] = (count($phone_arr) > 0) ? $phone_arr[0] : ' - ';

            }

        }



        $output[] = $row;

    }



    exit(json_encode($output));

}



add_action( 'profile_update', 'my_profile_update', 10, 2 );

function my_profile_update( $user_id, $old_user_data ) {

    global $wpdb;



    $all_meta_for_user = array_map( function( $a ){ return $a[0]; }, get_user_meta( $user_id ) );



    $wpdb->query( $wpdb->prepare("INSERT INTO user_phone_log ( user_id, author_id, author_phone ) VALUES ( %d, %d, %s )",

        get_current_user_id(), $user_id, $all_meta_for_user['aim']) );

}



/*wpcf7_add_shortcode('__post_id','get_current_post_id', true);*/

function get_current_post_id($tag) {

    if(!is_array($tag)) return '';

    global $post;

    return '<input type="hidden" name="cform_current_post_id" value="'.$post->ID.'" />';

}



add_action( 'wpcf7_before_send_mail', 'save_cform_data' );

function save_cform_data( $cf7 ) {

    global $wpdb;

    $data = $cf7->posted_data;

    $post_id = $data['cform_current_post_id'];



    if(isset($post_id) && intval($post_id) > 0) {

        $time = current_time('mysql');



        $comments_count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM $wpdb->comments AS c WHERE c.comment_post_ID = %d AND c.comment_parent = 0", $post_id) );

        $args = array(

            'comment_post_ID' => $post_id,

            'comment_author' => 'Вопрос ' . ++$comments_count . ', ' . $wpdb->escape($data['name']),

            'comment_author_email' => (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) ? $data['email'] :'',

            'comment_author_url' => '',

            'comment_content' => $wpdb->escape($data['message']),

            'comment_type' => '',

            'comment_parent' => 0,

            'user_id' => 0,

            'comment_author_IP' => get_user_ip(),

            'comment_agent' => $_SERVER['HTTP_USER_AGENT'],

            'comment_date' => $time,

            'comment_approved' => 0,

        );



        wp_insert_comment($args);

    }

}



add_action('wp_set_comment_status', 'notify_approval_to_contributor');

add_action('edit_comment', 'notify_approval_to_contributor');

function notify_approval_to_contributor ($comment_id){

    $comment = get_comment($comment_id);

    $post = get_post($comment->comment_post_ID);

    $email = get_post_meta($post->ID, 'pl_email', true);

    if ($comment->comment_approved == 1 && $post->post_type == 'people' && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $from = get_option('admin_email');

        $headers = 'From: Мой город <'.$from.'>' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

        wp_mail( $email, $comment->comment_author, $comment->comment_content, $headers );

    }

}



add_action('comment_post', 'notify_to_question_comment_author');

function notify_to_question_comment_author ($comment_id, $status){

    $comment = get_comment($comment_id);

    $post = get_post($comment->comment_post_ID);

    if ($comment->comment_parent != 0 && $comment->comment_approved == '1' && $post->post_type == 'people') {

        $question = get_comment($comment->comment_parent);

        $link = get_comment_link($question);

        $headers = 'From: Мой город <noreplay@mgorod.kz>' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

        if(filter_var($question->comment_author_email, FILTER_VALIDATE_EMAIL)) {

            wp_mail( $question->comment_author_email, 'Ответ с сайта mgorod.kz', 'На ваш вопрос пришел ответ, можете ознакомиться по ссылке ' . $link, $headers );

        }

    }

}



add_filter('comments_clauses', 'wps_get_comment_list_by_type');

function wps_get_comment_list_by_type($clauses) {

    global $pagenow;

    if (is_admin() && $pagenow == 'edit-comments.php') {

        $clauses['join'] = ", mt_posts";

        $clauses['where'] .= " AND mt_posts.post_type <> 'people' AND mt_comments.comment_post_ID = mt_posts.ID";

    };

    return $clauses;

};



function remove_comments_from_abar(){

    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('comments');

}

add_action( 'wp_before_admin_bar_render', 'remove_comments_from_abar' );





add_filter ('comments_array', 'iweb_reverse_comments');



function iweb_reverse_comments($comments) {

    return (is_singular('people')) ? array_reverse($comments) : $comments;

}