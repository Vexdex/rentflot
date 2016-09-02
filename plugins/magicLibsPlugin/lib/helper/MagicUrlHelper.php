<?php

function clean_continue_url($url)
{
  $request = sfContext::getInstance()->getRequest();
  if ($url)
  {
    preg_match('/^(http|https|ftp):\/\/([^\/]+)\/?(.*)/', $url, $matches);
    if (isset($matches[2]) && $matches[2] == $request->getHost())
    {
      return $url;
    }
  }
  return false;
}