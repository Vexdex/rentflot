<?php

/**
  * Frontend to Minify
  *
  * @version 1.2
  * @author Dmitriy Scherbina <ds@infosoft.ua>
  * @author Gordon Franke
  */


/**
 * Add the location of Minify's "lib" directory to the include_path. In
 * production this could be done via .htaccess or some other method.
 */
ini_set('include_path', dirname(__FILE__) . '/../../plugins/magicLibsPlugin/lib/vendor/minify/lib' . PATH_SEPARATOR . ini_get('include_path'));

/**
 * The Files controller only "knows" HTML, CSS, and JS files. Other files
 * would only be trim()ed and sent as plain/text.
 */
$serveExtensions = array('css', 'js');

// serve
if (isset($_GET['f']))
{
  $filenamePattern = '/(' . implode('|', $serveExtensions).   ')$/';
  if(preg_match($filenamePattern, $_GET['f'], $matches))
  {
    $files = explode(',', $_GET['f']);
    $error = false;

    foreach($files as $key => $file)
    {
      if (!file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $file))
      {
        $error = true;
      }
      else
      {
        $files[$key] = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $file;
      }
    }

    if(!$error)
    {
      require 'Minify.php';

      /**
       * Set $minifyCachePath to a PHP-writeable path to enable server-side caching
       * in all examples and tests.  
       */
      $minifyCachePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'minify';
      if(!is_dir($minifyCachePath))
      {
         mkdir($minifyCachePath);
      }
      Minify::setCache($minifyCachePath);
      Minify::serve('Files', array('files' => $files, 'encodeOutput' => false, 'maxAge' => 3600));
      exit();
    }
  }
}


