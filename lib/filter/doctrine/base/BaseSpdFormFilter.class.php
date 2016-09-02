<?php

/**
 * Spd filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSpdFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'spd_name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'spd_name_genitive' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'details'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'spd_name'          => new sfValidatorPass(array('required' => false)),
      'spd_name_genitive' => new sfValidatorPass(array('required' => false)),
      'details'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('spd_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Spd';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'name'              => 'Text',
      'spd_name'          => 'Text',
      'spd_name_genitive' => 'Text',
      'details'           => 'Text',
    );
  }
}
