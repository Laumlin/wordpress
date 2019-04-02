<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'wordpress');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', '');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

define("FS_METHOD", "direct");  

define("FS_CHMOD_DIR", 0777);  

define("FS_CHMOD_FILE", 0777);  

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$wBH~MRUpOU,pJPL9$T_VfK4%B8o<2Dh/5~ABr3dmbs/9x@}5N)S8Bm2.Z}UPe[#');
define('SECURE_AUTH_KEY',  'YF1~#.oCh9OHl]9#z~U^fHr=f%1q(I!uRZz7l#Mbd@87~&WrJ6`)xG<xPk_|T{n*');
define('LOGGED_IN_KEY',    'q#9kEC!&2_RwrV4SWdc2K4,3]HM,2t5R-GOwQzRUcWD@v}3N90%<Y2@zxrfI9C)*');
define('NONCE_KEY',        '&R1P/-ydA#Fhg=5Pb>qlGqe~=xu,ys(vG.AU2L(!d50b#XOs7pC/FLtcw%tb0oZ$');
define('AUTH_SALT',        'OF;,1<yap7VkTQ/jnmfY>R=W}F+$oiv!yTjZtH`tI/:Hn *!y5A1ny86L,A(~SZ|');
define('SECURE_AUTH_SALT', '2EPnE33pDfCta1M9)1 K9&k7sko5oMaC$7`()WFK#oi++e)+Khd21Ky>a+TQU4zW');
define('LOGGED_IN_SALT',   'Z.&wC4wmz#.-)yIXE5wm:IJG!AjA:fmY+b(L84qS(SEY8*Q:a6@<vH!9h$Ok2l%?');
define('NONCE_SALT',       'r_cQFHyH7G:4rGju~;;bQ!Ol=|gp.P~U*?cAXzejV2%x|h3Nf%W+m?1;%]}m*3l<');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
