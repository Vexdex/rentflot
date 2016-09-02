<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'last_name'             => new sfWidgetFormFilterInput(),
      'first_name'            => new sfWidgetFormFilterInput(),
      'patronymic'            => new sfWidgetFormFilterInput(),
      'email'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'validate'              => new sfWidgetFormFilterInput(),
      'login_attempts'        => new sfWidgetFormFilterInput(),
      'blocked_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'force_change_password' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'user_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'last_name'             => new sfValidatorPass(array('required' => false)),
      'first_name'            => new sfValidatorPass(array('required' => false)),
      'patronymic'            => new sfValidatorPass(array('required' => false)),
      'email'                 => new sfValidatorPass(array('required' => false)),
      'validate'              => new sfValidatorPass(array('required' => false)),
      'login_attempts'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'blocked_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'force_change_password' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'user_id'               => 'ForeignKey',
      'last_name'             => 'Text',
      'first_name'            => 'Text',
      'patronymic'            => 'Text',
      'email'                 => 'Text',
      'validate'              => 'Text',
      'login_attempts'        => 'Number',
      'blocked_at'            => 'Date',
      'force_change_password' => 'Boolean',
    );
  }
}
