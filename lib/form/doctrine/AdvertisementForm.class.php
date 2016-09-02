<?php

/**
 * Advertisement form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdvertisementForm extends BaseAdvertisementForm
{
  public function configure()
  {
    parent::configure();

    $cultures = sfConfig::get('app_cultures_enabled', array());

    foreach($cultures as $culture => $text)
    {
      $this->widgetSchema[$culture]['text'] = new magicWidgetFormTinyMCE();
    }

    $this->widgetSchema['categories_list'] = new sfWidgetFormDoctrineChoice(array(
      'multiple' => true,
      'expanded' => true,
      'model' => 'Category',
      'query' => Doctrine_Query::create()
                 ->from('Category c')
                 ->leftJoin('c.Translation t WITH t.lang = \''.sfContext::getInstance()->getUSer()->getCulture().'\'')
                 ->orderBy('c.order')
    ));



  }
}
