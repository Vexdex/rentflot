<?php

/**
 * OrderItem form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ItemByCategoryForm extends sfForm
{
  public function configure()
  {

    $this->widgetSchema['category_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'Category',
      'query' => Doctrine::getTable('Category')->createQuery('c')
        ->leftJoin('c.Translation t WITH t.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\'')
        ->orderBy('c.order')
    ));

    $this->widgetSchema['item_id'] = new sfWidgetFormChoice(array('choices' => array()));

    $this->widgetSchema->setNameFormat('dialog[%s]');
  }
}
