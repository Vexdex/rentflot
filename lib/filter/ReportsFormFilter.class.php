<?php

/**
 * CustomerSearchForm
 *
 * @package    
 * @subpackage form
 * @author     
 * @version    
 */
class ReportsFormFilter extends sfFormFilter
{
  public function configure()
	{
    $this->disableLocalCSRFProtection();
    
  $this->widgetSchema['date'] = new sfWidgetFormMagicDateRange(array(
                                        'from_date' => new sfWidgetFormMagicJQueryDate(array(	
                                          'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
                                          'config' => '{changeYear: true, changeMonth: true}',
                                          'culture' => sfContext::getInstance()->getUser()->getCulture())),			
                                        'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                          'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
                                          'config' => '{changeYear: true, changeMonth: true}',
                                          'culture' => sfContext::getInstance()->getUser()->getCulture()))
                                      ));
    
    $this->validatorSchema['date'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59'))));
    
    $this->widgetSchema['order_type_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'OrderType', 'add_empty' => true));    
    $this->validatorSchema['order_type_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'OrderType', 'column' => 'id'));

    $this->widgetSchema['owner_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Owner', 'order_by' => array('org_name', 'asc'), 'add_empty' => true));
    $this->validatorSchema['owner_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Owner', 'column' => 'id'));

    // Кухня
    $catering_types = array(null, 1 => 'Наша', 2 => 'Чужая');
    $this->widgetSchema['catering_type'] = new sfWidgetFormChoice(array('choices' => $catering_types));    
    $this->validatorSchema['catering_type'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys($catering_types)));
    
    // Ееще отдать
    $this->widgetSchema['is_amount_costs_left_uah'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['is_amount_costs_left_uah'] = new sfValidatorBoolean(array('required' => false));

    // Ееще получим
    $this->widgetSchema['is_amount_left_uah'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['is_amount_left_uah'] = new sfValidatorBoolean(array('required' => false));

    $this->widgetSchema['is_motor_ship'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['is_motor_ship'] = new sfValidatorBoolean(array('required' => false));
        
    
    $this->widgetSchema['item_id'] = new sfWidgetFormDoctrineChoice(array(
      'add_empty' => false,
      'multiple' => true,
      'method' => 'getItemWithCategory', 
      'model' => 'Item',
      'query' => Doctrine::getTable('Item')
                  ->createQuery('i')
                  ->leftJoin('i.Translation it WITH it.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\'')
                  ->leftJoin('i.Categories c')
                  ->leftJoin('c.Translation ct WITH ct.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\'')
                  //->leftJoin('ic.Category c')
                  //->leftJoin('c.Translation ct WITH ct.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\'')
                  ->orderBy('c.order, ct.name, it.name'),
      
    ));
    $this->validatorSchema['item_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Item', 'column' => 'id', 'multiple' => true));
    
    $this->widgetSchema->setNameFormat('reports_filter[%s]');
  }
}
