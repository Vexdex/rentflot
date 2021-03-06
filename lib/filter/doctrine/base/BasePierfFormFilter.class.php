<?php

/**
 * Pierf filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePierfFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'         => new sfWidgetFormFilterInput(),
      'link'         => new sfWidgetFormFilterInput(),
      'name_english' => new sfWidgetFormFilterInput(),
      'link_english' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'         => new sfValidatorPass(array('required' => false)),
      'link'         => new sfValidatorPass(array('required' => false)),
      'name_english' => new sfValidatorPass(array('required' => false)),
      'link_english' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pierf_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pierf';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'name'         => 'Text',
      'link'         => 'Text',
      'name_english' => 'Text',
      'link_english' => 'Text',
    );
  }
}
