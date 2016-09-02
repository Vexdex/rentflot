<?php

/**
  * Filter redirects all requests except home page (/) with 'en' culture to its equivalent without '/en' in url
  * For CPFinance
  *
  */
class magicBlockEnCultureFilter extends sfFilter
{
  
  public function execute($filterChain)
  {    
    
    if ($this->getContext()->getRequest()->getParameter('sf_culture') == 'en' && $this->getContext()->getRouting()->getCurrentRouteName() != 'homepage')
    {
      return $this->getContext()->getController()->redirect(str_replace('/en', '', $this->getContext()->getRequest()->getUri()));
    }
    else
    {
      $filterChain->execute();
    }
  }
  
}
