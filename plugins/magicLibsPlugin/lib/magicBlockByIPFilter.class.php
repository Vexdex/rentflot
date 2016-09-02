<?php

class magicBlockByIPFilter extends sfFilter
{
  /**
   * Executes the filter chain.
   *
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
    
    $user_options = $this->context->getUser()->getOptions();          
    
    // Проверяем ограничение по IP
    if (($this->context->getRouting()->getCurrentRouteName() == 'sf_guard_signin' || $this->context->getUser()->isAuthenticated()) &&
        ($this->context->getActionName() != 'error404' && $this->context->getModuleName() != 'content') &&
        !empty($user_options['advanced_policy']['active']) &&
        !empty($user_options['advanced_policy']['settings']['ip']) &&
        !empty($user_options['advanced_policy']['settings']['mask']) &&
        ((ip2long($this->context->getRequest()->getRemoteAddress ()) & ip2long($user_options['advanced_policy']['settings']['mask'])) !== (ip2long($user_options['advanced_policy']['settings']['ip']) & ip2long($user_options['advanced_policy']['settings']['mask'])))
        )
    {
      // Выбрасываем ошибку 404
      $this->context->getController()->forward('content', 'error404');
    }
    
    $filterChain->execute();
  }
  
}

