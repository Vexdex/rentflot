<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'user_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'last_name'             => new sfWidgetFormInputText(),
      'first_name'            => new sfWidgetFormInputText(),
      'patronymic'            => new sfWidgetFormInputText(),
      'email'                 => new sfWidgetFormInputText(),
      'validate'              => new sfWidgetFormInputText(),
      'login_attempts'        => new sfWidgetFormInputText(),
      'blocked_at'            => new sfWidgetFormDateTime(),
      'force_change_password' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'last_name'             => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'first_name'            => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'patronymic'            => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'email'                 => new sfValidatorString(array('max_length' => 255)),
      'validate'              => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'login_attempts'        => new sfValidatorInteger(array('required' => false)),
      'blocked_at'            => new sfValidatorDateTime(array('required' => false)),
      'force_change_password' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

}
