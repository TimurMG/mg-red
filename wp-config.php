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
define('DB_NAME', 'mg');

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
define('AUTH_KEY',         ':k&[s4y>i:^9@/<&=e.&xA?,xX]>7~X($_Z5YmCC;cf{CypTt||FF)}={?@(-]tm');
define('SECURE_AUTH_KEY',  'iHs<+ g|i=L{|l$Y;wgI)W<-vm(SfenV-ue6@_p<NUmJweYcsW<C`k3+GwNGnJ7o');
define('LOGGED_IN_KEY',    'h|6G>(}.n@`vOsU1EL0HR:.*2.feRF=zVX4uotb|%Ac*t8_B=kcE%xb|o-JxTYQT');
define('NONCE_KEY',        '!{mkO{;N}>/*GgKDPgbCAGx[:s>vIYY(Fz?Xg-q|(t-)ZjYG-+QhZp~vS/}kh+ J');
define('AUTH_SALT',        ':cA@w]Bu[C{dh <sg[yzu;{?q?.lTVvW KWeBDR|}MNc]!H;+C-05]%Bx-0-N@1M');
define('SECURE_AUTH_SALT', '{zL`UziL*8XRh(Y9[jx7Y+f<kVJ{K3YSx[`2s$2u#2==h3e7;xqsym5;W@*OuG5Y');
define('LOGGED_IN_SALT',   ',G^r@]<x%d7qcOeL#dWFmy!PqDP-NpV!H<K[EhpNXnQ!}a@ZR  -zs]IjNR+S-sK');
define('NONCE_SALT',       ')E3e6eX-f3)Z-wldan`=Q`*%o2m{<l>sz1UwD^?Si)KbnQ;?GQP~X0,!*/L/.5Tr');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'red_';

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
