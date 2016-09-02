<?php

/**
 * Owner form base class.
 *
 * @method Owner getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOwnerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'user_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'org_name'               => new sfWidgetFormInputText(),
      'name'                   => new sfWidgetFormInputText(),
      'address'                => new sfWidgetFormTextarea(),
      'phones'                 => new sfWidgetFormTextarea(),
      'email'                  => new sfWidgetFormInputText(),
      'additional_information' => new sfWidgetFormTextarea(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'org_name'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 255)),
      'address'                => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      'phones'                 => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      'email'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'additional_information' => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('owner[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Owner';
  }

}
