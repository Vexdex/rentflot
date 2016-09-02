<?php

/**
 * Project form base class.
 *
 * @package    CA Web
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  protected $languages;

  public function setup()
  {
    parent::setup();
    
    if ($this->isI18n())
    {
      $this->languages = sfConfig::get('app_cultures_enabled');   
      $langs = array_keys($this->languages);   
      $this->embedI18n($langs);
      foreach($this->languages as $lang => $label)
      {
        $this->widgetSchema[$lang]->setLabel($label);
      }    
    }
  }
}
