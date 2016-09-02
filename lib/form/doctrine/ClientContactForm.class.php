<?php

/**
 * ClientContact form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClientContactForm extends BaseClientContactForm
{
  public function configure()
  {
	unset(
      $this['updated_at'],$this['updated_by'],$this['created_at'],$this['created_by']
    );
	
	$minutes = range(0, 59, 5);
    $minute_keys = array();
    foreach ($minutes as $minute)
    {
      $minute_keys[] = sprintf("%02d", $minute);
    }

    $this->widgetSchema['contact_time'] = new sfWidgetFormTime(array('can_be_empty' => false, 'format_without_seconds' => '%hour% : %minute%', 'minutes' => array_combine($minutes, $minute_keys)));
    $this->validatorSchema['contact_time'] = new sfValidatorTime(array());
	
	    $this->widgetSchema['order_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => $this->getRelatedModelName('Order'), 
      'query' => Doctrine_Query::create()
        ->from('Order o')
        ->orderBy('o.id'),
        //->addOrderBy('c.name'),
      'add_empty' => true
    ));
        
    $this->setDefault('contact_time', '14:00');
    $this->validatorSchema['order_id'] = new sfValidatorInteger(array('required' => true));
	//$this->widgetSchema['created_at'] = new sfWidgetFormInput(array(), array('readonly'=>'readonly'));
	//$this->widgetSchema['created_by']->setAttributes(array('readonly'=>'readonly'));
  }
}
