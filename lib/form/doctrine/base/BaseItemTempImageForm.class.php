<?php

/**
 * ItemTempImage form base class.
 *
 * @method ItemTempImage getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseItemTempImageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'object_id'  => new sfWidgetFormInputText(),
      'filename'   => new sfWidgetFormInputText(),
      'order'      => new sfWidgetFormInputText(),
      'alt'        => new sfWidgetFormInputText(),
      'title'      => new sfWidgetFormInputText(),
      'alt_en'     => new sfWidgetFormInputText(),
      'title_en'   => new sfWidgetFormInputText(),
      'width'      => new sfWidgetFormInputText(),
      'height'     => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'object_id'  => new sfValidatorString(array('max_length' => 32)),
      'filename'   => new sfValidatorString(array('max_length' => 150)),
      'order'      => new sfValidatorInteger(array('required' => false)),
      'alt'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'alt_en'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'title_en'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'width'      => new sfValidatorInteger(array('required' => false)),
      'height'     => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('item_temp_image[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemTempImage';
  }

}
