<?php

/**
 * Order form base class.
 *
 * @method Order getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'is_archived'            => new sfWidgetFormInputCheckbox(),
      'client_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => false)),
      'pier_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pier'), 'add_empty' => true)),
      'spd_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Spd'), 'add_empty' => true)),
      'order_type_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrderType'), 'add_empty' => true)),
      'order_owner_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrderOwner'), 'add_empty' => false)),
      'date'                   => new sfWidgetFormDateTime(),
      'time_from'              => new sfWidgetFormTime(),
      'time_to'                => new sfWidgetFormTime(),
      'people_count'           => new sfWidgetFormInputText(),
      'additional_information' => new sfWidgetFormTextarea(),
      'client_information'     => new sfWidgetFormTextarea(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'deleted_at'             => new sfWidgetFormDateTime(),
      'created_by'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
      'updated_by'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'add_empty' => true)),
      'items_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Item')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'is_archived'            => new sfValidatorBoolean(array('required' => false)),
      'client_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'))),
      'pier_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pier'), 'required' => false)),
      'spd_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Spd'), 'required' => false)),
      'order_type_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OrderType'), 'required' => false)),
      'order_owner_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OrderOwner'), 'required' => false)),
      'date'                   => new sfValidatorDateTime(),
      'time_from'              => new sfValidatorTime(),
      'time_to'                => new sfValidatorTime(),
      'people_count'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'additional_information' => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      'client_information'     => new sfValidatorString(array('required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
      'deleted_at'             => new sfValidatorDateTime(array('required' => false)),
      'created_by'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
      'updated_by'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'required' => false)),
      'items_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Item', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Order';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['items_list']))
    {
      $this->setDefault('items_list', $this->object->Items->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveItemsList($con);

    parent::doSave($con);
  }

  public function saveItemsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['items_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Items->getPrimaryKeys();
    $values = $this->getValue('items_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Items', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Items', array_values($link));
    }
  }

}
