<?php

### http://develop.svn.wordpress.org/trunk/tests/phpunit/includes/bootstrap.php

/*
 * Globalize some WordPress variables, because PHPUnit loads this file inside a function
 * See: https://github.com/sebastianbergmann/phpunit/issues/325
 */
global $wpdb, $current_site, $current_blog, $wp_rewrite, $shortcode_tags, $wp, $phpmailer;


// Cron tries to make an HTTP request to the blog, which always fails, because tests are run in CLI mode only
define( 'DISABLE_WP_CRON', true );


$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
$_SERVER['HTTP_HOST'] = WP_TESTS_DOMAIN;
$PHP_SELF = $GLOBALS['PHP_SELF'] = $_SERVER['PHP_SELF'] = '/index.php';

$_SERVER['SERVER_NAME'] = WP_TESTS_DOMAIN;

// Load WordPress
require_once ABSPATH . '/wp-settings.php';

require dirname( __FILE__ ) . '/testcase.php';
require dirname( __FILE__ ) . '/utils.php';

