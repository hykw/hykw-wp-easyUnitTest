<?php

### http://develop.svn.wordpress.org/trunk/tests/phpunit/includes/testcase.php

class hykwEasyUT extends PHPUnit_Framework_TestCase {

  function go_to( $url ) {
    // note: the WP and WP_Query classes like to silently fetch parameters
    // from all over the place (globals, GET, etc), which makes it tricky
    // to run them more than once without very carefully clearing everything
    $_GET = $_POST = array();
    foreach (array('query_string', 'id', 'postdata', 'authordata', 'day', 'currentmonth', 'page', 'pages', 'multipage', 'more', 'numpages', 'pagenow') as $v) {
      if ( isset( $GLOBALS[$v] ) ) unset( $GLOBALS[$v] );
    }
    $parts = parse_url($url);
    if (isset($parts['scheme'])) {
      $req = $parts['path'];
      if (isset($parts['query'])) {
        $req .= '?' . $parts['query'];
        // parse the url query vars into $_GET
        parse_str($parts['query'], $_GET);
      }
    } else {
      $req = $url;
    }
    if ( ! isset( $parts['query'] ) ) {
      $parts['query'] = '';
    }

    $_SERVER['REQUEST_URI'] = $req;
    unset($_SERVER['PATH_INFO']);

    $this->flush_cache();
    unset($GLOBALS['wp_query'], $GLOBALS['wp_the_query']);
    $GLOBALS['wp_the_query'] = new WP_Query();
    $GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];
    $GLOBALS['wp'] = new WP();
    _cleanup_query_vars();

    $GLOBALS['wp']->main($parts['query']);
  }

  function flush_cache() {
    global $wp_object_cache;
    $wp_object_cache->group_ops = array();
    $wp_object_cache->stats = array();
    $wp_object_cache->memcache_debug = array();
    $wp_object_cache->cache = array();
    if ( method_exists( $wp_object_cache, '__remoteset' ) ) {
      $wp_object_cache->__remoteset();
    }
    wp_cache_flush();
    wp_cache_add_global_groups( array( 'users', 'userlogins', 'usermeta', 'user_meta', 'site-transient', 'site-options', 'site-lookup', 'blog-lookup', 'blog-details', 'rss', 'global-posts', 'blog-id-cache' ) );
    wp_cache_add_non_persistent_groups( array( 'comment', 'counts', 'plugins' ) );
  }

}

