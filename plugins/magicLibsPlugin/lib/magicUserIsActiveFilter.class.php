<?php


class magicUserIsActiveFilter extends sfFilter
{
  /**
   * Executes the filter chain.
   *
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
    if ($this->context->getUser()->isAuthenticated() && !$this->context->getUser()->getGuardUser()->getIsActive())
    {
      $this->context->getController()->redirect('sf_guard_signout');  
    }    
    $filterChain->execute();
  }
  
}

