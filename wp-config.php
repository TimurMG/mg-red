<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'mg_red');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'l[4Ju~l+!n$iVh>57e+1xYoQo2-p+<oB1YakO+In]5X9VH3!X1b=Td`D{OaA2sdG');
define('SECURE_AUTH_KEY',  'Iih@99UBiiCGvz3xsv_J+4/G7jz;J{MgpjXUnxcuZYQd/ja]N?@cR!}u@ktme3hw');
define('LOGGED_IN_KEY',    'c}QbLE3[T*v/*$edLR;QRyw{:l#++Z>+r`O0&A%%vN{I6X%B@kY!!1.bolcSM{Sd');
define('NONCE_KEY',        'sMo>w{uU}|t0sBLsr[.y.<{5`%F%&U(Q]{>>cxG3pj$u wZo[%~|nYEx.vwre^>|');
define('AUTH_SALT',        'xb&19VYV||0QW0%g20h+Z<G2;i@!CV|KAfr{GX5!a_#>=Qw+e(F}c=7TdhP8eohu');
define('SECURE_AUTH_SALT', '<7]NE/ydCnjJBt;[D2.W8l8I>Gz.z/_P#:/F@~<{p~ ! P&|8*k5r%|IR#yI[tfP');
define('LOGGED_IN_SALT',   '[*-rlpDzSIuC:ZX92p_E|m7}Cx+|)Mn3/5gWgS#Inz&|u,u.WjmT1 uo8:OEJ@2U');
define('NONCE_SALT',       'ANt~i M-~gum8:wXh~`<J{^V18}6,4 D=e+w:uH-DDC+C7d7{C[ flQDWo?,+.6<');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'mt_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
