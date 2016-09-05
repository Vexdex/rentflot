<?php

/**
 * OrderItem filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrderItemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'order_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Order'), 'add_empty' => true)),
      'item_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Item'), 'add_empty' => true)),
      'status_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'count'                  => new sfWidgetFormMagicNumberRange(array(
            'from_number' => new sfWidgetFormInput(), 
            'to_number' => new sfWidgetFormInput(), 
            'with_empty' => false)),
      'price_uah'              => new sfWidgetFormMagicNumberRange(array(
            'from_number' => new sfWidgetFormInput(), 
            'to_number' => new sfWidgetFormInput(), 
            'with_empty' => false)),
      'amount_payed_uah'       => new sfWidgetFormMagicNumberRange(array(
            'from_number' => new sfWidgetFormInput(), 
            'to_number' => new sfWidgetFormInput(), 
            'with_empty' => false)),
      'amount_payed_bank_uah'  => new sfWidgetFormMagicNumberRange(array(
            'from_number' => new sfWidgetFormInput(), 
            'to_number' => new sfWidgetFormInput(), 
            'with_empty' => false)),
      'amount_costs_uah'       => new sfWidgetFormMagicNumberRange(array(
            'from_number' => new sfWidgetFormInput(), 
            'to_number' => new sfWidgetFormInput(), 
            'with_empty' => false)),
      'amount_costs_payed_uah' => new sfWidgetFormMagicNumberRange(array(
            'from_number' => new sfWidgetFormInput(), 
            'to_number' => new sfWidgetFormInput(), 
            'with_empty' => false)),
      'created_at'             => new sfWidgetFormMagicDateRange(array(
          'from_date' => new sfWidgetFormMagicJQueryDate(array(	            
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture())),			
          'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture())))),
      'updated_at'             => new sfWidgetFormMagicDateRange(array(
          'from_date' => new sfWidgetFormMagicJQueryDate(array(	            
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture())),			
          'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture())))),
      'deleted_at'             => new sfWidgetFormMagicDateRange(array(
          'from_date' => new sfWidgetFormMagicJQueryDate(array(	            
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture())),			
          'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture())))),
    ));

    $this->setValidators(array(
      'order_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Order'), 'column' => 'id')),
      'item_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Item'), 'column' => 'id')),
      'status_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Status'), 'column' => 'id')),
      'count'                  => new sfValidatorMagicNumberRange(array('required' => false, 'from_number' => new sfValidatorNumber(array('required' => false)), 'to_number' => new sfValidatorNumber(array('required' => false)))),
      'price_uah'              => new sfValidatorMagicNumberRange(array('required' => false, 'from_number' => new sfValidatorNumber(array('required' => false)), 'to_number' => new sfValidatorNumber(array('required' => false)))),
      'amount_payed_uah'       => new sfValidatorMagicNumberRange(array('required' => false, 'from_number' => new sfValidatorNumber(array('required' => false)), 'to_number' => new sfValidatorNumber(array('required' => false)))),
      'amount_payed_bank_uah'  => new sfValidatorMagicNumberRange(array('required' => false, 'from_number' => new sfValidatorNumber(array('required' => false)), 'to_number' => new sfValidatorNumber(array('required' => false)))),
      'amount_costs_uah'       => new sfValidatorMagicNumberRange(array('required' => false, 'from_number' => new sfValidatorNumber(array('required' => false)), 'to_number' => new sfValidatorNumber(array('required' => false)))),
      'amount_costs_payed_uah' => new sfValidatorMagicNumberRange(array('required' => false, 'from_number' => new sfValidatorNumber(array('required' => false)), 'to_number' => new sfValidatorNumber(array('required' => false)))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('order_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderItem';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'order_id'               => 'ForeignKey',
      'item_id'                => 'ForeignKey',
      'status_id'              => 'ForeignKey',
      'count'                  => 'Number',
      'price_uah'              => 'Number',
      'amount_payed_uah'       => 'Number',
      'amount_payed_bank_uah'  => 'Number',
      'amount_costs_uah'       => 'Number',
      'amount_costs_payed_uah' => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'deleted_at'             => 'Date',
    );
  }
}
