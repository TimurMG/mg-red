<?php

header("Content-Type: application/xml");

$rss = '<?xml version="1.0" encoding="utf-8"?>';
$rss .= '<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">';

$rss .= '<channel>';


$header = '<image><url>' . get_template_directory_uri() . '/images/logo.png</url>';
$header .= '<title>' . get_bloginfo('blogname') . '</title>';
$header .= '<link>' . home_url() . '</link></image>';

$rss .= $header;


$posts = get_posts(array('post_type' => array( 'news', 'page_news'), 'meta_key' => 'nws_is_export', 'meta_value' => 'on', 'posts_per_page' => 70));

$items = '';

foreach( $posts as $post ) : setup_postdata($post);
    $item = '<item>';

    $title = the_title('','',false);
    preg_match_all('/\(.*?\)/', $title, $res, PREG_SET_ORDER);
    foreach($res as $i) {
        $title = str_replace($i[0], '', $title);
    }

    $title = '<title>' . htmlspecialchars($title) . '</title>';
    $link = '<link>' . get_permalink() . '</link>';
    $author = '<author>' . get_the_author_meta('display_name') . '</author>';

    $category = '<category>';
    $cats = wp_get_post_terms( get_the_ID(), 'ncategory');
    foreach($cats as $cat) {
        $category .= $cat->name;
        break;
    }
    $category .= '</category>';

    $date = '<pubDate>' . str_replace('0000','0500',get_the_date('r')) . '</pubDate>';
    $genre = '<yandex:genre>article</yandex:genre>';

    $enclosure = '';
    $content = get_the_content();

    preg_match_all('/<a.*? href=\"(.*?)\".*?>(.*?(<img.*?src=\"(.*?)\.(.{3,4})\".*?>).*?)<\/a>/', $content, $res, PREG_SET_ORDER);
    foreach($res as $i) {
        $enclosure .= '<enclosure url="' . $i[1] . '" type="image/' . $i[5] . '"/>';
        $content = str_replace($i[0], '', $content);
    }
    preg_match_all('/\[.*?\]/', $content, $res, PREG_SET_ORDER);
    foreach($res as $i) {
        $content = str_replace($i[0], '', $content);
    }

    $content = '<yandex:full-text>' . htmlspecialchars($content) . '</yandex:full-text>';


    $item .= $title . $link . $author . $category . $enclosure . $date . $genre . $content;
    $item .= '</item>';
    $items .= $item;
endforeach;

$rss .= $items;

$rss .= '</channel></rss>';

echo $rss;