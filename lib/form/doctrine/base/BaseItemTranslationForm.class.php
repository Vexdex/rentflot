<?php

/**
 * ItemTranslation form base class.
 *
 * @method ItemTranslation getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseItemTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'title'               => new sfWidgetFormInputText(),
      'html_description'    => new sfWidgetFormTextarea(),
      'html_keywords'       => new sfWidgetFormTextarea(),
      'main_image_title'    => new sfWidgetFormTextarea(),
      'main_image_alt'      => new sfWidgetFormTextarea(),
      'listing_text'        => new sfWidgetFormTextarea(),
      'h1'                  => new sfWidgetFormInputText(),
      'short_description'   => new sfWidgetFormTextarea(),
      'description'         => new sfWidgetFormTextarea(),
      'target_use'          => new sfWidgetFormTextarea(),
      'passenger_capacity'  => new sfWidgetFormTextarea(),
      'basic_info'          => new sfWidgetFormTextarea(),
      'equipment'           => new sfWidgetFormTextarea(),
      'crew'                => new sfWidgetFormTextarea(),
      'passenger_insurance' => new sfWidgetFormTextarea(),
      'price'               => new sfWidgetFormTextarea(),
      'additional_info'     => new sfWidgetFormTextarea(),
      'in_sight'            => new sfWidgetFormTextarea(),
      'catering'            => new sfWidgetFormTextarea(),
      'info_value1'         => new sfWidgetFormInputText(),
      'info_text1'          => new sfWidgetFormInputText(),
      'info_value2'         => new sfWidgetFormInputText(),
      'info_text2'          => new sfWidgetFormInputText(),
      'info_value3'         => new sfWidgetFormInputText(),
      'info_text3'          => new sfWidgetFormInputText(),
      'price_value1'        => new sfWidgetFormInputText(),
      'price_text1'         => new sfWidgetFormInputText(),
      'price_value2'        => new sfWidgetFormInputText(),
      'price_text2'         => new sfWidgetFormInputText(),
      'price_value3'        => new sfWidgetFormInputText(),
      'price_text3'         => new sfWidgetFormInputText(),
      'lang'                => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 255)),
      'title'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'html_description'    => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'html_keywords'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'main_image_title'    => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'main_image_alt'      => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'listing_text'        => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'h1'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'short_description'   => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'description'         => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'target_use'          => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'passenger_capacity'  => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'basic_info'          => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'equipment'           => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'crew'                => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'passenger_insurance' => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'price'               => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'additional_info'     => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'in_sight'            => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'catering'            => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'info_value1'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'info_text1'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'info_value2'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'info_text2'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'info_value3'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'info_text3'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'price_value1'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'price_text1'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'price_value2'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'price_text2'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'price_value3'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'price_text3'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lang'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemTranslation';
  }

}
