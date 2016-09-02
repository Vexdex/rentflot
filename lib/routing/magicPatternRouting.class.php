<?php

class magicPatternRouting extends sfPatternRouting 
{
  public function parse($url) 
  {
    
    //vardump($url);

		$params = explode('/', $url);
		//vardump($params);		
		
		
		if (!$params[1] || strlen($params[1]) != 2) {
      $url = '/'.sfConfig::get('sf_default_culture').$url;
		}
		//echo $url;
		
    $url = $this->normalizeUrl(rtrim($url, '/')); # trim trailing slashes before actual routing    
    //echo $url;
		return parent::parse($url);
  }  
}