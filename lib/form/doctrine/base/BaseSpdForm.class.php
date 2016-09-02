<?php

/**
 * Spd form base class.
 *
 * @method Spd getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSpdForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'spd_name'          => new sfWidgetFormTextarea(),
      'spd_name_genitive' => new sfWidgetFormTextarea(),
      'details'           => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255)),
      'spd_name'          => new sfValidatorString(array('max_length' => 500)),
      'spd_name_genitive' => new sfValidatorString(array('max_length' => 500)),
      'details'           => new sfValidatorString(array('max_length' => 5000)),
    ));

    $this->widgetSchema->setNameFormat('spd[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Spd';
  }

}
