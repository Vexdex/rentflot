<?php

/**
 * Project form base class.
 *
 * @package    MagicLibsPlugin
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseMagicFormDoctrine extends sfFormDoctrine
{
  protected $languages;

  public function setup()
  {
    parent::setup();

    unset($this['created_at'],
          $this['updated_at'],
          $this['deleted_at'],
          $this['created_by'],
          $this['updated_by']);
    
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
