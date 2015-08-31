<?php



function register_custom_post_types() {



    /* Register custom post types

    *****************************/



    register_post_type(

        'news',

        array( 'public' => true,

            'publicly_queryable' => true,

            'has_archive' => true,

            'hierarchical' => false,

            'menu_icon' => get_stylesheet_directory_uri() . '/images/news-icon.png',

            'labels'=>array(

                'name' => _x('Новости', 'post type general name'),

                'singular_name' => _x('Новость', 'post type singular name'),

                'add_new' => _x('Добавить новую', 'Новость'),

                'add_new_item' => __('Добавить новую новость'),

                'edit_item' => __('Редактировать новость'),

                'new_item' => __('Новая новость'),

                'view_item' => __('Посмотреть новость'),

                'search_items' => __('Поиск новостей'),

                'not_found' =>  __('Новостей не найдено'),

                'not_found_in_trash' => __('Новостей не найдено в корзине'),

                'parent_item_colon' => ''

            ),

            'show_ui' => true,

            'menu_position'=>5,

            'show_in_nav_menus' => false,

            'query_var' => true,

            'rewrite' => true,

            'rewrite' => array( 'slug' => 'nitem', 'with_front' => FALSE,),

            'register_meta_box_cb' => 'news_add_box',

            'supports' => array(

                'title',

                'thumbnail',

                'excerpt',

                'editor',

                'author',

                'comments'

            )

        )

    );




    register_post_type(

        'banners',

        array( 'public' => true,

            'publicly_queryable' => true,

            'has_archive' => false,

            'hierarchical' => false,

            'menu_icon' => get_stylesheet_directory_uri() . '/images/banners-icon.png',

            'labels'=>array(

                'name' => _x('Баннеры', 'post type general name'),

                'singular_name' => _x('Баннер', 'post type singular name'),

                'add_new' => _x('Добавить новый', 'Баннер'),

                'add_new_item' => __('Добавить новый баннер'),

                'edit_item' => __('Редактировать баннер'),

                'new_item' => __('Новый баннер'),

                'view_item' => __('Посмотреть баннер'),

                'search_items' => __('Поиск баннеров'),

                'not_found' =>  __('Баннеры не найдены'),

                'not_found_in_trash' => __('Корзина пуста'),

                'parent_item_colon' => ''

            ),

            'show_ui' => true,

            'menu_position'=>5,

            'show_in_nav_menus' => false,

            'query_var' => true,

            'rewrite' => true,

            'rewrite' => array( 'slug' => 'banners', 'with_front' => FALSE,),

            'supports' => array(

                'title',

            )

        )

    );



    register_post_type(

        'ads',

        array( 'public' => true,

            'publicly_queryable' => true,

            'has_archive' => true,

            'hierarchical' => false,

            'menu_icon' => get_stylesheet_directory_uri() . '/images/adsa_icon.png',

            'labels'=>array(

                'name' => _x('Объявления', 'post type general name'),

                'singular_name' => _x('Объявление', 'post type singular name'),

                'add_new' => _x('Добавить новое', 'Объявление'),

                'add_new_item' => __('Добавить новое объявление'),

                'edit_item' => __('Редактировать объявление'),

                'new_item' => __('Новое объявление'),

                'view_item' => __('Посмотреть объявление'),

                'search_items' => __('Поиск объявлений'),

                'not_found' =>  __('Объявления не найдены'),

                'not_found_in_trash' => __('Корзина пуста'),

                'parent_item_colon' => ''

            ),

            'show_ui' => true,

            'menu_position'=>5,

            'show_in_nav_menus' => false,

            'query_var' => true,

            'rewrite' => true,

            'rewrite' => array( 'slug' => 'ads', 'with_front' => FALSE,),

            'register_meta_box_cb' => 'ads_add_box',

            'supports' => array(

                'title',

                'thumbnail',

                'editor',

                'author',

                'comments'

            )

        )

    );



    register_post_type(

        'catalog',

        array( 'public' => true,

            'publicly_queryable' => true,

            'has_archive' => true,

            'hierarchical' => false,

            'menu_icon' => get_stylesheet_directory_uri() . '/images/catalog_icon.png',

            'labels'=>array(

                'name' => _x('Справочник', 'post type general name'),

                'singular_name' => _x('Организация', 'post type singular name'),

                'add_new' => _x('Добавить организацию', 'Организация'),

                'add_new_item' => __('Добавить новую организацию'),

                'edit_item' => __('Редактировать организацию'),

                'new_item' => __('Новая организация'),

                'view_item' => __('Посмотреть организацию'),

                'search_items' => __('Поиск организаций'),

                'not_found' =>  __('Организации не найдены'),

                'not_found_in_trash' => __('Корзина пуста'),

                'parent_item_colon' => ''

            ),

            'show_ui' => true,

            'menu_position'=>5,

            'show_in_nav_menus' => false,

            'query_var' => true,

            'rewrite' => true,

            'rewrite' => array( 'slug' => 'catalog', 'with_front' => FALSE,),

            'register_meta_box_cb' => 'cat_add_box',

            'supports' => array(

                'title',

                'thumbnail',

                'editor',

                'author',

                'comments'

            )

        )

    );





    register_post_type(

        'people',

        array( 'public' => true,

            'publicly_queryable' => true,

            'has_archive' => true,

            'hierarchical' => false,

            'menu_icon' => get_stylesheet_directory_uri() . '/images/drs-icon.png',

            'labels'=>array(

                'name' => _x('Врачи', 'post type general name'),

                'singular_name' => _x('Врач', 'post type singular name'),

                'add_new' => _x('Добавить врача', 'врач'),

                'add_new_item' => __('Добавить нового врача'),

                'edit_item' => __('Редактировать запись'),

                'new_item' => __('Новый врач'),

                'view_item' => __('Посмотреть запись'),

                'search_items' => __('Поиск врача'),

                'not_found' =>  __('Записи не найдены'),

                'not_found_in_trash' => __('Корзина пуста'),

                'parent_item_colon' => ''

            ),

            'show_ui' => true,

            'menu_position'=>5,

            'show_in_nav_menus' => false,

            'query_var' => true,

            'rewrite' => true,

            'register_meta_box_cb' => 'pl_add_box',

            'rewrite' => array( 'slug' => 'people', 'with_front' => FALSE),

            'supports' => array(

                'title',

                'editor',

                'thumbnail',

                'comments'

            )

        )

    );



/*Новости АВТОМАБИЛКИ начало*/		
register_post_type(        
'som',        
array( 'public' => true,            
'publicly_queryable' => true,            
'has_archive' => true,            
'hierarchical' => false,            
'menu_icon' => get_stylesheet_directory_uri() . '/images/car-icon.png',            
'labels'=>array(                
'name' => _x('Somicadze', 'post type general name'),                
'singular_name' => _x('Som', 'post type singular name'),                
'add_new' => _x('Добавить запись', 'новость'),                
'add_new_item' => __('Добавить новую запись'),                
'edit_item' => __('Редактировать запись'),                
'new_item' => __('Новая запись'),                
'view_item' => __('Посмотреть запись'),                
'search_items' => __('Поиск записей'),                
'not_found' =>  __('Запись не найдена'),                
'not_found_in_trash' => __('Корзина пуста'),                
'parent_item_colon' => ''            
),            
'show_ui' => true,            
'menu_position'=>6,            
'show_in_nav_menus' => false,            
'query_var' => true,            
'rewrite' => true,            
'rewrite' => array( 'slug' => 'somnews', 'with_front' => FALSE),            
'supports' => array(                
'title',                
'thumbnail',                
'excerpt',                
'editor',                
'author',                
'comments'            
)        
)    
);





    /* Register custom taxonomies

    *****************************/



    $labelsTags = array(

        'name' => _x( 'Метки', 'taxonomy general name' ),

        'singular_name' => _x( 'Метки', 'taxonomy singular name' ),

        'search_items' =>  __( 'Поиск меток' ),

        'all_items' => __( 'Все метки' ),

        'edit_item' => __( 'Редактировать метку' ),

        'update_item' => __( 'Обновить метку' ),

        'add_new_item' => __( 'Добавить новую метку' ),

        'new_item_name' => __( 'Новая метка' ),

    );

    register_taxonomy('ntag',array('news'), array(

        'hierarchical' => false,

        'labels' => $labelsTags,

        'show_ui' => 'radio',

        'show_in_nav_menus' => false,

        'query_var' => true,

        'rewrite' => array( 'slug' => 'ntag' ),

    ));



    $labelsCat = array(

        'name' => _x( 'Рубрики новостей', 'taxonomy general name' ),

        'singular_name' => _x( 'Рубрика', 'taxonomy singular name' ),

        'search_items' =>  __( 'Поиск рубрик' ),

        'all_items' => __( 'Все рубрики' ),

        'parent_item' => __( 'Родительская рубрика' ),

        'parent_item_colon' => __( 'Родительская рубрика:' ),

        'edit_item' => __( 'Редактировать рубрику' ),

        'update_item' => __( 'Обновить рубрику' ),

        'add_new_item' => __( 'Добавить новую рубрику' ),

        'new_item_name' => __( 'Новая рубрика' ),

    );

    register_taxonomy('ncategory',array('news'), array(

        'hierarchical' => true,

        'labels' => $labelsCat,

        'show_ui' => 'radio',

        'query_var' => true,

        'rewrite' => array( 'slug' => 'ncategory' ),

    ));



    $labelsLoc = array(

        'name' => _x( 'Регионы', 'taxonomy general name' ),

        'singular_name' => _x( 'Регион', 'taxonomy singular name' ),

        'search_items' =>  __( 'Поиск региона' ),

        'all_items' => __( 'Все регионы' ),

        'parent_item' => __( 'Родительский регион' ),

        'parent_item_colon' => __( 'Родительский регион:' ),

        'edit_item' => __( 'Редактировать регион' ),

        'update_item' => __( 'Обновить регион' ),

        'add_new_item' => __( 'Добавить новый регион' ),

        'new_item_name' => __( 'Новый регион' ),

    );

    register_taxonomy('nlocation', array('news','ads','catalog'), array(

        'public' => true,

        'hierarchical' => true,

        'labels' => $labelsLoc,

        'query_var' => 'nlocation',

        'show_ui' => true,

        'rewrite' => array( 'slug' => 'nlocation', 'with_front' => false )

    ));



    $labelsAdsCat = array(

        'name' => _x( 'Категории объявлений', 'taxonomy general name' ),

        'singular_name' => _x( 'Категория', 'taxonomy singular name' ),

        'search_items' =>  __( 'Поиск категории' ),

        'all_items' => __( 'Все категории' ),

        'parent_item' => __( 'Родительская категория' ),

        'parent_item_colon' => __( 'Родительская категория:' ),

        'edit_item' => __( 'Редактировать категорию' ),

        'update_item' => __( 'Обновить категорию' ),

        'add_new_item' => __( 'Добавить новую категорию' ),

        'new_item_name' => __( 'Новая категория' ),

    );

    register_taxonomy('adscategory', 'ads', array(

        'public' => true,

        'hierarchical' => true,

        'labels' => $labelsAdsCat,

        'query_var' => 'adscategory',

        'show_ui' => true,

        'rewrite' => array( 'slug' => 'adscategory', 'with_front' => false )

    ));



    $labelsCatalogCat = array(

        'name' => _x( 'Разделы справочника', 'taxonomy general name' ),

        'singular_name' => _x( 'Раздел', 'taxonomy singular name' ),

        'search_items' =>  __( 'Поиск разделов' ),

        'all_items' => __( 'Все разделы' ),

        'parent_item' => __( 'Родительский раздел' ),

        'parent_item_colon' => __( 'Родительский раздел:' ),

        'edit_item' => __( 'Редактировать раздел' ),

        'update_item' => __( 'Обновить раздел' ),

        'add_new_item' => __( 'Добавить новый раздел' ),

        'new_item_name' => __( 'Новый раздел' ),

    );

    register_taxonomy('catcategory', 'catalog', array(

        'public' => true,

        'hierarchical' => true,

        'labels' => $labelsCatalogCat,

        'query_var' => 'catcategory',

        'show_ui' => true,

        'rewrite' => array( 'slug' => 'catcategory', 'with_front' => false )

    ));



    $labelsMedicalNewsCat = array(

        'name' => _x( 'Тип', 'taxonomy general name' ),

        'singular_name' => _x( 'Тип', 'taxonomy singular name' ),

        'search_items' =>  __( 'Поиск типов' ),

        'all_items' => __( 'Все типы' ),

        'parent_item' => __( 'Родительский пункт' ),

        'parent_item_colon' => __( 'Родительский пункт:' ),

        'edit_item' => __( 'Редактировать' ),

        'update_item' => __( 'Обновить' ),

        'add_new_item' => __( 'Добавить новый' ),

        'new_item_name' => __( 'Новый' ),

    );

    register_taxonomy('medcat', 'medicalnews', array(

        'public' => true,

        'hierarchical' => true,

        'show_in_nav_menus' => false,

        'labels' => $labelsMedicalNewsCat,

        'query_var' => 'medcat',

        'show_ui' => true,

        'rewrite' => array( 'slug' => 'medcat', 'with_front' => false )

    ));





   
	
	$labelsSomCat = array(        
	'name' => _x( 'Разделы', 'taxonomy general name' ),        
	'singular_name' => _x( 'Раздел', 'taxonomy singular name' ),        
	'search_items' =>  __( 'Поиск разделов' ),        
	'all_items' => __( 'Все разделы' ),        
	'parent_item' => __( 'Родительский пункт' ),        
	'parent_item_colon' => __( 'Родительский пункт:' ),        
	'edit_item' => __( 'Редактировать' ),        
	'update_item' => __( 'Обновить' ),        
	'add_new_item' => __( 'Добавить новый' ),        
	'new_item_name' => __( 'Новый' ),    
	);    
	
	register_taxonomy('somcat', 'som', array(        
	'public' => true,        
	'hierarchical' => true,        
	'show_in_nav_menus' => false,        
	'labels' => $labelsSomCat,        
	'query_var' => 'somcat',        
	'show_ui' => true,        
	'rewrite' => array( 'slug' => 'somcat', 'with_front' => false )    
	));
	

}

add_action('init', 'register_custom_post_types');