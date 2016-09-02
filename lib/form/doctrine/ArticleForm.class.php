<?php

/**
 * Article form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArticleForm extends BaseArticleForm
{
  public function configure()
  {
    parent::configure();
    
    $cultures = sfConfig::get('app_cultures_enabled');
    
    foreach($cultures as $culture => $text)
    {
      $this->widgetSchema[$culture]['content'] = new magicWidgetFormTinyMCE();      
    }
    
  }
}
