<?php

/**
 * Client filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClientFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'org_name'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'address'                => new sfWidgetFormFilterInput(),
      'phones'                 => new sfWidgetFormFilterInput(),
      'email'                  => new sfWidgetFormFilterInput(),
      'additional_information' => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'org_name'               => new sfValidatorPass(array('required' => false)),
      'name'                   => new sfValidatorPass(array('required' => false)),
      'address'                => new sfValidatorPass(array('required' => false)),
      'phones'                 => new sfValidatorPass(array('required' => false)),
      'email'                  => new sfValidatorPass(array('required' => false)),
      'additional_information' => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('client_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Client';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'org_name'               => 'Text',
      'name'                   => 'Text',
      'address'                => 'Text',
      'phones'                 => 'Text',
      'email'                  => 'Text',
      'additional_information' => 'Text',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
