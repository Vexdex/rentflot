<?php

/**
 * Category form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoryForm extends BaseCategoryForm
{
  public function configure()
  {
    parent::configure();

    $cultures = sfConfig::get('app_cultures_enabled', array());

    foreach($cultures as $culture => $text)
    {
      $this->widgetSchema[$culture]['item_contacts'] = new magicWidgetFormTinyMCE();
    }

    unset($this['items_list']);
    unset($this['advertisements_list']);
  }
}
