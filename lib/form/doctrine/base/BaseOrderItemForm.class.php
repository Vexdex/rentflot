<?php

/**
 * OrderItem form base class.
 *
 * @method OrderItem getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrderItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'order_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Order'), 'add_empty' => false)),
      'item_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Item'), 'add_empty' => false)),
      'status_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => false)),
      'count'                  => new sfWidgetFormInputText(),
      'price_uah'              => new sfWidgetFormInputText(),
      'amount_payed_uah'       => new sfWidgetFormInputText(),
      'amount_payed_bank_uah'  => new sfWidgetFormInputText(),
      'amount_costs_uah'       => new sfWidgetFormInputText(),
      'amount_costs_payed_uah' => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'deleted_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'order_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Order'))),
      'item_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Item'))),
      'status_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'required' => false)),
      'count'                  => new sfValidatorPass(),
      'price_uah'              => new sfValidatorPass(array('required' => false)),
      'amount_payed_uah'       => new sfValidatorPass(array('required' => false)),
      'amount_payed_bank_uah'  => new sfValidatorPass(array('required' => false)),
      'amount_costs_uah'       => new sfValidatorPass(array('required' => false)),
      'amount_costs_payed_uah' => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
      'deleted_at'             => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderItem';
  }

}
