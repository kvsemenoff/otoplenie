<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'WPCACHEHOME', '/var/www/' ); //Added by WP-Cache Manager
define('DB_NAME', 'otoplenie');

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

define( 'WP_CACHE', true );

define( 'DISALLOW_FILE_EDIT', false );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'O!#oG>b`vGCD(Q_-|RWI+VP%OByg$:XV9CZy`(w/Lq-o<xicVOqO:ZI_K)DGo_Gx');
define('SECURE_AUTH_KEY',  '9AO+2}>lXtfJy<m+0S|;Dh*-7H)w;HJt8 n!eU]O?G[ Xkd8r|PId7Sio3ys~y+*');
define('LOGGED_IN_KEY',    'ANH<n8i:enpWsVU^=X&H854T!1~!&<XAHjv5$`wm5|.|(d+)pOj%-=rheXF,R~V4');
define('NONCE_KEY',        'czCv,V)lihW_GJ]Xd~/+42f-u+c*<U:j+a!9`QQ-c>;`I`qJ=(@ZP=U8>cM>#oml');
define('AUTH_SALT',        'aMr8oaIm^O~kaWDT^UQK2~Hcz-TG(jH&H:Wz{-yJ+yajHACp?m<N~ BSyt0+V5Zz');
define('SECURE_AUTH_SALT', 'DHt+GC-IePCYv^o ?Kqx^?uu%~vh>] xbamhh=%,2<m4&glyaR[Xz>IFj!!n|T~T');
define('LOGGED_IN_SALT',   '7kN.Pio.7Hc9|4-mG,$-y*+U2,8mQK(/nA4rU/;9H`4Sh#a&6`fq#dF%],OxUUh]');
define('NONCE_SALT',       '0>J?sHr)4+}JIR)=[{g-7L-^_iT(+Ll9L/ExM7x>RD}i*s1mF$*mpFU2Ix3|g}ee');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'od_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
