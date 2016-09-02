<?php

/**
 * Item filter form.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ItemFormFilter extends BaseItemFormFilter
{
  public function configure()
  {
    parent::configure();

    $categoriesQuery = Doctrine_Query::create()
      ->from('Category c')
      ->leftJoin('c.Translation t WITH t.lang = \'' . sfContext::getInstance()->getUser()->getCulture() . '\'');

    $this->widgetSchema['categories_list']->setOption('query', $categoriesQuery);

    $this->widgetSchema['owner_id']->setOption('order_by', array('org_name', 'asc'));

    $this->widgetSchema['name_i18n'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['name_i18n']  = new sfValidatorPass(array('required' => false));    
  }
  
  
  public function addNameI18nColumnQuery(Doctrine_Query $q, $field, $value)
  {    
    if (!empty($value['text']))
    {
      $q->andWhere('t.name LIKE ?', '%'.$value['text'].'%');
    }    
    return $q;    
  }  
}
