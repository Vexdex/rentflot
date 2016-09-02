<?php

/**
 * Cache class that stores cached content in File, APC, XCache, EAccelerator, SQLite.
 *
 * @package    symfony
 * @subpackage cache
 * @author     Igor Brovchenko [Igor.Brovchenko [at] gmail.com]
 */

/* Usage
[app.yml]
all:
  my_cache:
    class: sfFileCache
    param:
      automatic_cleaning_factor: 0
      cache_dir:                 %SF_APP_CACHE_DIR%/my
      lifetime:                  86400
      prefix:                    %SF_APP_DIR%/cache_my

<php

 if(is_null($data = myCache::get('my_data')))
 {
  myCache::set('my_data', $data);
 }

 echo $data;
?>

*/

class magicCache
{
  private static $cache = null;

  /**
   * Initializes this cache instance.
   */
  private static function getInstance()
  {
    if (is_null(self::$cache)) {
      $options = sfConfig::get('sf_magic_cache_param');
      $class = sfConfig::get('sf_magic_cache_class');

      if ('sfAPCCache' == $class && function_exists('apc_store')) {
        self::$cache = new sfAPCCache($options);
      }
      elseif ('sfXCacheCache' == $class && function_exists('xcache_set'))
      {
        self::$cache = new sfXCacheCache($options);
      }
      elseif ('sfEAcceleratorCache' == $class && function_exists('eaccelerator_put'))
      {
        self::$cache = new sfEAcceleratorCache($options);
      }
      elseif ('sfSQLiteCache' == $class && extension_loaded('SQLite'))
      {
        self::$cache = new sfSQLiteCache($options);
      }
      else
      {
        self::$cache = new sfFileCache($options);
      }
    }

    return self::$cache;
  }

  /**
   * @see sfCache
   */
  public static function get($key, $default = null)
  {
    $data = self::getInstance()->get($key);

    if ($data === null) {
      return $default;
    }

    return unserialize($data);
  }

  /**
   * @see sfCache
   */
  public static function has($key)
  {
    return self::getInstance()->has($key);
  }

  /**
   * @see sfCache
   */
  public static function set($key, $data, $lifetime = null)
  {
    $data = serialize($data);

    return self::getInstance()->set($key, $data, $lifetime);
  }

  /**
   * @see sfCache
   */
  public static function remove($key)
  {
    return self::getInstance()->remove($key);
  }

  /**
   * @see sfCache
   */
  public static function removePattern($pattern)
  {
    self::getInstance()->removePattern($pattern);
  }

  /**
   * @see sfCache
   */
  public static function clean($mode = sfCache::ALL)
  {
    return self::getInstance()->removePattern($mode);
  }

  /**
   * @see sfCache
   */
  public static function getTimeout($key)
  {
    return self::getInstance()->getTimeout($key);
  }

  /**
   * @see sfCache
   */
  public static function getLastModified($key)
  {
    return self::getInstance()->getLastModified($key);
  }

}