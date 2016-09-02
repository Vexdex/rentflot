<?php

/**
 * Client form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClientForm extends BaseClientForm
{
  public function configure()
  {
    parent::configure();

    $this->validatorSchema['name'] = new sfValidatorCallback(array('required' => true, 'callback' => array($this, 'cleanName')));
	
	//adding CRM functionality

	$this->widgetSchema['make_contact'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['make_contact'] = new sfValidatorBoolean(array('required' => false));
	
	//No next contact time required
	//$minutes = range(0, 59, 10);
    //$minute_keys = array();
    //foreach ($minutes as $minute)
    //{
    //  $minute_keys[] = sprintf("%02d", $minute);
    //}	
	//$minutes = range(0, 59, 10);
    //$minute_keys = array();
    //foreach ($minutes as $minute)
    //{
    //    $minute_keys[] = sprintf("%02d", $minute);
    //}
	//$this->widgetSchema['contact_time'] = new sfWidgetFormTime(array('can_be_empty' => false, 'format_without_seconds' => '%hour% : %minute%', 'minutes' => array_combine($minutes, $minute_keys)));
    //$this->validatorSchema['contact_time'] = new sfValidatorTime(array('required' => false));
	
	//No contact required for client module, because contact related to Order
	/*
	$this->widgetSchema['contact_date'] = new sfWidgetFormMagicJQueryDate(array(	  
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture()));
	$this->validatorSchema['contact_date'] = new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00'));
	$this->widgetSchema['comment'] = new sfWidgetFormTextarea();
    $this->validatorSchema['comment'] = new sfValidatorString(array('required' => false, 'max_length' => 4000));
	*/
  }

  public function cleanName($validator, $value)
  {
    $clean = utf8_trim($value);

    if ($clean == '')
    {
      throw new sfValidatorError($validator, 'required');
    }

    return $clean;
  }
}
