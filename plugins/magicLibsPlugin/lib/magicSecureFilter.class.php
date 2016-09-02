<?php

class magicSecureFilter extends sfFilter
{
  
  public function execute($filterChain)
  {       

    $module = $this->getContext()->getRequest()->getParameter('module');
    $action = $this->getContext()->getRequest()->getParameter('action');   
    $is_action_secure = $this->getContext()->getController()->getAction($module, $action)->getSecurityValue('is_ssl', false);
    $is_current_connection_secure = $this->getContext()->getRequest()->isSecure();
    $non_secure_to_http = sfConfig::get('app_non_secure_to_http', false);
        
    if ($this->getContext()->getUser()->isAuthenticated() && $is_action_secure && !$is_current_connection_secure)
    {
      $secure_url = str_replace('http', 'https', $this->getContext()->getRequest()->getUri()); 
      $this->getContext()->getController()->redirect($secure_url);
    }
    
    if ((!$is_action_secure || !$this->getContext()->getUser()->isAuthenticated()) && $is_current_connection_secure && $non_secure_to_http)
    {
      $secure_url = str_replace('https', 'http', $this->getContext()->getRequest()->getUri()); 
      $this->getContext()->getController()->redirect($secure_url);    
    }
    
    $filterChain->execute();
  }
  
}
