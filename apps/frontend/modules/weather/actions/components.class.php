<?php
 
 
class weatherComponents extends sfComponents
{

  public function executeForecast($request)
  {
    $cache_key = 'weather';
    if (magicCache::has('static_content_'.$cache_key) && sfConfig::get('sf_cache'))
    {
      $this->weather_data  = magicCache::get('static_content_'.$cache_key);
    }
    else
    {
      $this->weather_data = parse_weather();
      magicCache::set('static_content_'.$cache_key, $this->weather_data);
    }
	}

}