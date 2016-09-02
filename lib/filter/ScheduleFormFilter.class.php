<?php

/**
 * CustomerSearchForm
 *
 * @package    
 * @subpackage form
 * @author     
 * @version    
 */
class ScheduleFormFilter extends sfFormFilter
{
   
  public function configure()
	{
	  //parent::configure();	
    
    $monthes = array(
      1 => sfContext::getInstance()->getI18n()->__('January', null, 'calendar'), 
      2 => sfContext::getInstance()->getI18n()->__('February', null, 'calendar'), 
      3 => sfContext::getInstance()->getI18n()->__('March', null, 'calendar'), 
      4 => sfContext::getInstance()->getI18n()->__('April', null, 'calendar'), 
      5 => sfContext::getInstance()->getI18n()->__('May', null, 'calendar'), 
      6 => sfContext::getInstance()->getI18n()->__('June', null, 'calendar'), 
      7 => sfContext::getInstance()->getI18n()->__('July', null, 'calendar'), 
      8 => sfContext::getInstance()->getI18n()->__('August', null, 'calendar'), 
      9 => sfContext::getInstance()->getI18n()->__('September', null, 'calendar'), 
      10 => sfContext::getInstance()->getI18n()->__('October', null, 'calendar'), 
      11 => sfContext::getInstance()->getI18n()->__('November', null, 'calendar'), 
      12 => sfContext::getInstance()->getI18n()->__('December', null, 'calendar')
    );
    $this->widgetSchema['month'] = new sfWidgetFormChoice(array('choices' => $monthes));
    $this->widgetSchema['month']->setDefault(date('n')); 
   
    $years = range(2011,  Date('Y') + 1);        
    $this->widgetSchema['year'] = new sfWidgetFormChoice(array('choices' => array_combine($years, $years)));
    $this->widgetSchema['year']->setDefault(date('Y')); 
    
    $this->validatorSchema['month'] = new sfValidatorChoice(array('required' => true, 'choices' => array_keys($monthes)));
    $this->validatorSchema['year'] = new sfValidatorChoice(array('required' => true, 'choices' => $years));

    $order_types = array(
      0 => sfContext::getInstance()->getI18n()->__('schedule_filter_empty_text', null, 'calendar'),
      1 => sfContext::getInstance()->getI18n()->__('schedule_filter_rentflot', null, 'calendar'),
      2 => sfContext::getInstance()->getI18n()->__('schedule_filter_other', null, 'calendar'),        
    );
    
    $this->widgetSchema['order_type_id'] = new sfWidgetFormChoice(array('choices' => $order_types));
    $this->validatorSchema['order_type_id'] = new sfValidatorChoice(array('required' => true, 'choices' => array_keys($order_types)));
    
    $this->widgetSchema->setNameFormat('sehedule_filter[%s]'); 
  }
}
