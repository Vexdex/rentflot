<?php

/**
 * OrderItem form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrderItemForm extends BaseOrderItemForm
{
  public function configure()
  {
    parent::configure();
    unset($this['order_id']);
    
    $this->widgetSchema['item_id'] = new magicWidgetFormDoctrineChoice(array(
      'model' => 'Item',
      'query' => Doctrine::getTable('Item')->createQuery('i')
                  ->leftJoin('i.Translation t WITH t.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\''),            
      'template' => '<span class="order_item_name" id="%input_id%_text">%text%</span> %input%'
    ));
    
    //echo 1;
    //$this->widgetSchema['amount_costs_uah']->setDefault(1);
    
    $this->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['delete']= new sfValidatorInteger(array('required' => false));

    $this->widgetSchema['status_id']->setOption('add_empty', false);

    //$this->widgetSchema['category_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Category'));
    //$this->widgetSchema['item_id'] = new sfWidgetFormChoice(array('choices' => array()));
  }
}
