<?php

/**
 * ClientContact filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClientContactFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
        // 2016/09/03 vexdex before
        // 'contact_date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
        // 2016/09/03 vexdex after [
        'contact_date'        => new sfWidgetFormFilterDate(array(    'from_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),                                                                            
                                                                            'config' => '{changeYear: true, changeMonth: true}',
                                                                            'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                    'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),                                                                            
                                                                            'config' => '{changeYear: true, changeMonth: true}',
                                                                            'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                    'with_empty' => false)),
        // 2016/09/03 vexdex after ]
      'contact_time'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comment'           => new sfWidgetFormFilterInput(),
      'order_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Order'), 'add_empty' => true)),
      'contact_status_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContactStatus'), 'add_empty' => true)),
        // 2016/09/03 vexdex before
        // 'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),                
        // 'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
        // 2016/09/03 vexdex after [
        'created_at'        => new sfWidgetFormFilterDate(array(    'from_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),                                                                            
                                                                            'config' => '{changeYear: true, changeMonth: true}',
                                                                            'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                    'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),                                                                            
                                                                            'config' => '{changeYear: true, changeMonth: true}',
                                                                            'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                    'with_empty' => false)), 
        'updated_at'        => new sfWidgetFormFilterDate(array(    'from_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),                                                                            
                                                                            'config' => '{changeYear: true, changeMonth: true}',
                                                                            'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                    'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),                                                                            
                                                                            'config' => '{changeYear: true, changeMonth: true}',
                                                                            'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                    'with_empty' => false)), 
        
        // 2016/09/03 vexdex after ]
      'created_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'updated_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'contact_date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'contact_time'      => new sfValidatorPass(array('required' => false)),
      'comment'           => new sfValidatorPass(array('required' => false)),
      'order_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Order'), 'column' => 'id')),
      'contact_status_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ContactStatus'), 'column' => 'id')),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'updated_by'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Updator'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('client_contact_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClientContact';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'contact_date'      => 'Date',
      'contact_time'      => 'Text',
      'comment'           => 'Text',
      'order_id'          => 'ForeignKey',
      'contact_status_id' => 'ForeignKey',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'created_by'        => 'ForeignKey',
      'updated_by'        => 'ForeignKey',
    );
  }
}
