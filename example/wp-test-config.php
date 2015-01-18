<?php

define('WP_TESTS_DOMAIN', 'example.jp');
$wp_dir = '/var/www/example.jp/wordpress';
$lib_dir = '/home/you/git/hykw-wp-easyUnitTest';

##################################################

require_once $wp_dir . '/wp-load.php';
require_once $lib_dir . '/includes/bootstrap.php';

