<?php

class magicPatternRouting extends sfPatternRouting 
{
  public function parse($url) 
  {
		$params = explode('/', $url);
		
    if (!$params[1] || strlen($params[1]) != 2) {
      $url = '/'.sfConfig::get('sf_default_culture').$url;
		}
    
    $url = $this->normalizeUrl(rtrim($url, '/')); # trim trailing slashes before actual routing    
		return parent::parse($url);
  }  
}