<?php

/**
 * News form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NewsForm extends BaseNewsForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);

    $cultures = sfConfig::get('app_cultures_enabled', array());
    foreach($cultures as $culture => $text)
    {
      $this->widgetSchema[$culture]['text'] = new magicWidgetFormTinyMCE();
    }
  }
}
