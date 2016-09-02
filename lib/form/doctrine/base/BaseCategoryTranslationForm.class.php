<?php

/**
 * CategoryTranslation form base class.
 *
 * @method CategoryTranslation getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCategoryTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'title'            => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormTextarea(),
      'keywords'         => new sfWidgetFormTextarea(),
      'seo_short_text'   => new sfWidgetFormTextarea(),
      'seo_full_text'    => new sfWidgetFormTextarea(),
      'h1'               => new sfWidgetFormInputText(),
      'item_title'       => new sfWidgetFormInputText(),
      'item_description' => new sfWidgetFormTextarea(),
      'item_keywords'    => new sfWidgetFormTextarea(),
      'item_h1'          => new sfWidgetFormInputText(),
      'item_contacts'    => new sfWidgetFormTextarea(),
      'lang'             => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'title'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'      => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'keywords'         => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'seo_short_text'   => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'seo_full_text'    => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'h1'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'item_title'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'item_description' => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'item_keywords'    => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'item_h1'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'item_contacts'    => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'lang'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CategoryTranslation';
  }

}
