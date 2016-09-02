<?php

/**
 * ActionLog form base class.
 *
 * @method ActionLog getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActionLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'username'    => new sfWidgetFormInputText(),
      'module'      => new sfWidgetFormInputText(),
      'action'      => new sfWidgetFormInputText(),
      'ip'          => new sfWidgetFormInputText(),
      'ids'         => new sfWidgetFormTextarea(),
      'description' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'username'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'module'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'action'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ip'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ids'         => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('action_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ActionLog';
  }

}
