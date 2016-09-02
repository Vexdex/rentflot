<?php

/**
 * Order filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_archived'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'client_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'pier_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pier'), 'add_empty' => true)),
      'spd_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Spd'), 'add_empty' => true)),
      'order_type_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrderType'), 'add_empty' => true)),
      'order_owner_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrderOwner'), 'add_empty' => true)),
      'date'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'time_from'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'time_to'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'people_count'           => new sfWidgetFormFilterInput(),
      'additional_information' => new sfWidgetFormFilterInput(),
      'client_information'     => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_by'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
      'updated_by'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'add_empty' => true)),
      'items_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Item')),
    ));

    $this->setValidators(array(
      'is_archived'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'client_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
      'pier_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pier'), 'column' => 'id')),
      'spd_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Spd'), 'column' => 'id')),
      'order_type_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OrderType'), 'column' => 'id')),
      'order_owner_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OrderOwner'), 'column' => 'id')),
      'date'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'time_from'              => new sfValidatorPass(array('required' => false)),
      'time_to'                => new sfValidatorPass(array('required' => false)),
      'people_count'           => new sfValidatorPass(array('required' => false)),
      'additional_information' => new sfValidatorPass(array('required' => false)),
      'client_information'     => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Creator'), 'column' => 'id')),
      'updated_by'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Updator'), 'column' => 'id')),
      'items_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Item', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addItemsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.OrderItem OrderItem')
      ->andWhereIn('OrderItem.item_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Order';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'is_archived'            => 'Boolean',
      'client_id'              => 'ForeignKey',
      'pier_id'                => 'ForeignKey',
      'spd_id'                 => 'ForeignKey',
      'order_type_id'          => 'ForeignKey',
      'order_owner_id'         => 'ForeignKey',
      'date'                   => 'Date',
      'time_from'              => 'Text',
      'time_to'                => 'Text',
      'people_count'           => 'Text',
      'additional_information' => 'Text',
      'client_information'     => 'Text',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'deleted_at'             => 'Date',
      'created_by'             => 'ForeignKey',
      'updated_by'             => 'ForeignKey',
      'items_list'             => 'ManyKey',
    );
  }
}
