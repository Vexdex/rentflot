<?php

/**
 * Bill form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BillForm extends BaseBillForm
{
  public function configure()
  {
    parent::configure();    
    $this->validatorSchema['amount_uah']->setOption('required', true);
    $this->validatorSchema['amount_payed_uah']->setOption('required', true);    

    $this->widgetSchema['create_cash_income'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['create_cash_income'] = new sfValidatorBoolean(array('required' => false));  
        
    $this->useFields(array('type_id', 'index_id', 'name', 'description', 'amount_uah', 'amount_payed_uah', 'create_cash_income'));
    
    if (!$this->isNew())
    {      
      unset($this['create_cash_income']);    
    }
    
    
  }
  
  /*
  public function updateObject($values = null)
  {
		$bill = parent::updateObject($values);  
    
    if ($this->isNew() &&  $bill->getTypeId() == 3 && $this->getValue('create_cash_income'))
    {
      $new_bill = clone $bill;
      $new_bill->setTypeId(2);
      $new_bill->save();
    }
    
    return $bill;
  }
  */
  
  
  public function updateAmountUahColumn($value)
  {    
    return abs($value);
  }
  
  public function updateAmountPayedUahColumn($value)
  {    
    return abs($value);
  }
  
  
}
