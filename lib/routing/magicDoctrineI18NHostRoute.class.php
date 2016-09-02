<?php

/**
 * Based on magick class magickRequestI18NHostRoute.
 *
 * @package    symfony
 * @subpackage routing
 * @author     Dmitriy Scherbina <ds@infosoft.ua>
 * @version    SVN: $Id: magickDoctrineI18NHostRoute.class.php  $
 */
class magicDoctrineI18NHostRoute extends sfDoctrineRoute
{
  public function generate($params, $context = array(), $absolute = false)
  {
    // by Dmitriy
    if ('object' == $this->options['type'])
    {
      $params = $this->convertObjectToArray($params);
    }
    // by Dmitriy
  
    if (!$this->compiled)
    {
      $this->compile();
    }

    $url = $this->pattern;

    $defaults = $this->mergeArrays($this->getDefaultParameters(), $this->defaults);
    $tparams = $this->mergeArrays($defaults, $params);

    // by Dmitriy
    if (sfConfig::get('sf_default_culture') && sfConfig::get('sf_default_culture') == $tparams['sf_culture'])
    {
      preg_match('/'.$this->options['variable_prefix_regex'].'sf_culture/', $url, $culture_match);
      if (!empty($culture_match) && false !== strpos($url, $culture_match[0])) {
        // remove sf_culture from url 
        $url = str_replace($culture_match[0], '', $url);
      }
    }
    // by Dmitriy
    
    // all params must be given
    if ($diff = array_diff_key($this->variables, $tparams))
    {
      throw new InvalidArgumentException(sprintf('The "%s" route has some missing mandatory parameters (%s).', $this->pattern, implode(', ', $diff)));
    }

    if ($this->options['generate_shortest_url'] || $this->customToken)
    {
      $url = $this->generateWithTokens($tparams);
    }
    else
    {
      // replace variables
      $variables = $this->variables;
      uasort($variables, create_function('$a, $b', 'return strlen($a) < strlen($b);'));
      foreach ($variables as $variable => $value)
      {
        $url = str_replace($value, urlencode($tparams[$variable]), $url);
      }

      if(!in_array($this->suffix, $this->options['segment_separators']))
      {
        $url .= $this->suffix;
      }
    }

    // replace extra parameters if the route contains *
    $url = $this->generateStarParameter($url, $defaults, $tparams);

    // by Dmitriy
    // adding trailing slash
    if (substr($url, -1) !== '/')
    {
      $url .= '/';
    }
    //vardump($this->options);
    /*if (!empty($tparams['no_trailing_slash']))
    {
//echo 1;
      $url = rtrim($url, '/');
    }*/
    // by Dmitriy
    
    
    if ($this->options['extra_parameters_as_query_string'] && !$this->hasStarParameter())
    {
      // add a query string if needed
      if ($extra = array_diff_key($params, $this->variables, $defaults))
      {
        $url .= '?'.http_build_query($extra);
      }
    }

    // by Dmitriy
    $url = $this->normalizeUrl($url);
    // by Dmitriy
    
    return $url;
  }
  
  
  protected function generateWithTokens($parameters)
  {
    $url = array();
    $optional = $this->options['generate_shortest_url'];
    $first = true;
    $tokens = array_reverse($this->tokens);
    // by Dmitriy
    $sf_format = false;
    // by Dmitriy
    foreach ($tokens as $token)
    {
      switch ($token[0])
      {
        case 'variable':
          // by Dmitriy
          if ($token[3] == 'sf_culture' && sfConfig::get('sf_default_culture') && sfConfig::get('sf_default_culture') == $parameters['sf_culture'])
          {
            break;
          }
          // by Dmitriy          
          if (!$optional || !isset($this->defaults[$token[3]]) || $parameters[$token[3]] != $this->defaults[$token[3]])
          {
            $url[] = urlencode($parameters[$token[3]]);
            $optional = false;
            // by Dmitriy
            if ($token[3] == 'sf_format')
            {
              $sf_format = true;
            }
            // by Dmitriy
          }
          break;
        case 'text':
          $url[] = $token[2];
          $optional = false;
          break;
        case 'separator':
          if (false === $optional || $first)
          {
            $url[] = $token[2];
          }
          break;
        default:
          // handle custom tokens
          if ($segment = call_user_func_array(array($this, 'generateFor'.ucfirst(array_shift($token))), array_merge(array($optional, $parameters), $token)))
          {
            $url[] = $segment;
            $optional = false;
          }
          break;
      }

      $first = false;
    }

    $url = implode('', array_reverse($url));
    if (!$url)
    {
      $url = '/';
    }
    // by Dmitriy
    /*else
    {
      if (!$sf_format)
      {
        $url .= '/';
      }
      $url = $this->normalizeUrl($url);
    }*/
    // by Dmitriy
    return $url;
  }

  
  protected function normalizeUrl($url)
  {
    // an URL should start with a '/', mod_rewrite doesn't respect that, but no-mod_rewrite version does.
    if ('/' != substr($url, 0, 1))
    {
      $url = '/'.$url;
    }

    // remove multiple /
    $url = preg_replace('#/+#', '/', $url);

    return $url;
  }
}
