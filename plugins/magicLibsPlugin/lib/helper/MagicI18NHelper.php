<?php

function lang_link_to($text, $culture)
{
  /*
  $uri = sfContext::getInstance()->getRouting()->getCurrentInternalUri(true);
	$params = sfContext::getInstance()->getRequest()->getGetParameters();
	unset($params['sf_culture']);
	if (!empty($params)) {$params = '&'.http_build_query($params);} else {$params = '';}
	//vardump($params);
  */
	return link_to($text, lang_url_for($culture));
}
	

function lang_url_for($culture)
{
  $uri = sfContext::getInstance()->getRouting()->getCurrentInternalUri(true);
  
  // Фикс проблемы с неправильным URLом при ошибках в форме фильтров
  if (strpos(sfContext::getInstance()->getRouting()->getCurrentRouteName(), '_collection') !== false && sfContext::getInstance()->getRequest()->getParameter('action') == 'filter')
  {
    // Убираем _collection и получаем ссылку на list
    $uri = str_replace('_collection', '', $uri);
  }
  // Фикс проблемы с update URL в форме
  elseif (strrpos(sfContext::getInstance()->getRouting()->getCurrentRouteName(), '_update') == strlen(sfContext::getInstance()->getRouting()->getCurrentRouteName()) - 7)
  {
    // Убираем _update и получаем ссылку на edit
    $uri = str_replace('_update', '_edit', $uri);
  }
  
  // Случай, например, для ошибки 404, когда getCurrentInternalUri() возвращает пустую строку
  if (!$uri)
  {
    $uri = '@homepage';
  }
  
  //$current_route = sfContext::getInstance()->getRouting()->getCurrentRouteName();
	//vardump(sfContext::getInstance()->getRouting()->getCurrentInternalUri(true));
	$params = sfContext::getInstance()->getRequest()->getGetParameters();
	$params['sf_culture'] = $culture;  
	if (!empty($params))
  {
    $params = (strpos($uri, '?') === false ? '?' : '&').http_build_query($params, '', '&');
    //$params = '&' . http_build_query($params, '', '&');
  }
  else
  {
    $params = '';
  }  
  //vardump($params);      
  //echo sfContext::getInstance()->getRouting()->generate($current_route, array('p' => 2));  
  //return sfContext::getInstance()->getController()->genUrl($current_route, $params);
  //echo $uri.$params;
  return url_for($uri.$params);    
}
