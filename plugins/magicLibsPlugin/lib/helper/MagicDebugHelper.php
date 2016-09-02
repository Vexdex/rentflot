<?php

// deprecated
//function vardump($var, $color = '#000000', $escape_html_chars = false, $die = false)

/**
 * @param  $var
 * @param bool $escape_html_chars
 * @return void
 */
function vardump($var, $escape_html_chars = false)
{
  if (sfConfig::get('sf_environment') == 'dev' || sfConfig::get('sf_environment') == 'cache')
  {
    echo '<pre style="color:navy">';
    if ($escape_html_chars)
    {
      ob_start('htmlspecialchars');
      print_r($var);
      ob_end_flush();
    }
    else
    {
       print_r($var);
    }
    echo '</pre><hr style="color:navy"/>'."\n\n";
  }
}