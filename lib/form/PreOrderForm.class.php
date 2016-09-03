<?php

/**
 * Order form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PreOrderForm extends OrderForm
{
    public function configure()
    {
        parent::configure();

            /*
        $this->widgetSchema['contact_name'] = new sfWidgetFormInput();
        $this->validatorSchema['contact_name'] = new sfValidatorString(array('required' => true));

        $this->widgetSchema['contact_email'] = new sfWidgetFormInput();
        $this->validatorSchema['contact_email'] = new magicValidatorEmail(array('required' => false));*/

        $this->widgetSchema['contact_phone'] = new sfWidgetFormInput();
        $this->validatorSchema['contact_phone'] = new sfValidatorString(array('required' => true));

        //$this->useFields(array('contact_name', 'contact_email', 'contact_phone', 'date', 'time_from', 'time_to', 'people_count', 'additional_information'));

        $this->useFields(array('contact_phone', 'date', 'additional_information'));

        // vexdex 03/09/2016 before
        // $this->widgetSchema['date']->setDefault("");

        // vexdex 03/09/2016 after [
        $this->widgetSchema['date'] = new sfWidgetFormMagicJQueryDate(array(	  
                'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
                'config' => '{changeYear: true, changeMonth: true}',
                'culture' => sfContext::getInstance()->getUser()->getCulture())); 

        $this->validatorSchema['date'] = new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d', 'required' => true)); 
        // vexdex 03/09/2016 after ]

        if ($dirh) {
            while (($dirElement = readdir($dirh)) !== false) {                
            }
            closedir($dirh);
        }

        unset($this['contact_name'], $this['contact_email'], $this['time_from'], $this['time_to'], $this['people_count']);	    

        $this->widgetSchema->setNameFormat('order[%s]');
    }
}
