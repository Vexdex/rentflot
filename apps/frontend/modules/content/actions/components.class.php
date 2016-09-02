<?php

/**
 * content components.
 *
 * @package    Rentflot
 * @subpackage content
 * @author     Infosoft
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contentComponents extends sfComponents
{
  public function executeLanguageSelection(sfWebRequest $request)
  {
    $this->langs = sfConfig::get('app_cultures_enabled');
    $this->switch_to_lang = $this->getUser()->getCulture() == 'uk' ? 'ru' : 'uk';
  }
  public function executeAlternate(sfWebRequest $request)
  {
    
  }  
}
