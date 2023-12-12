<?php

/**
 * This is a sample config for local development. wp-config.php will
 * load this file if you're not in a Pantheon environment. Simply edit/copy
 * as needed and rename to wp-config-local.php.
 *
 * Be sure to replace YOUR LOCAL DOMAIN below too.
 */

define('DB_NAME', 'wcu_wp');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');
define('DB_HOST', 'db:3306');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY', 'put your unique phrase here');
define('SECURE_AUTH_KEY', 'put your unique phrase here');
define('LOGGED_IN_KEY', 'put your unique phrase here');
define('NONCE_KEY', 'put your unique phrase here');
define('AUTH_SALT', 'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT', 'put your unique phrase here');
define('NONCE_SALT', 'put your unique phrase here');

define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);


// Identify the relevant protocol for the current request
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";

// Set SITEURL and HOME using a dynamic protocol.
define('WP_SITEURL', $protocol . '://' . $_SERVER['HTTP_HOST']);
define('WP_HOME', $protocol . '://' . $_SERVER['HTTP_HOST']);

define('WP_AUTO_UPDATE_CORE', false);
