<?php

/**
 * ItemTranslation filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseItemTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'               => new sfWidgetFormFilterInput(),
      'html_description'    => new sfWidgetFormFilterInput(),
      'html_keywords'       => new sfWidgetFormFilterInput(),
      'main_image_title'    => new sfWidgetFormFilterInput(),
      'main_image_alt'      => new sfWidgetFormFilterInput(),
      'listing_text'        => new sfWidgetFormFilterInput(),
      'h1'                  => new sfWidgetFormFilterInput(),
      'short_description'   => new sfWidgetFormFilterInput(),
      'description'         => new sfWidgetFormFilterInput(),
      'target_use'          => new sfWidgetFormFilterInput(),
      'passenger_capacity'  => new sfWidgetFormFilterInput(),
      'basic_info'          => new sfWidgetFormFilterInput(),
      'equipment'           => new sfWidgetFormFilterInput(),
      'crew'                => new sfWidgetFormFilterInput(),
      'passenger_insurance' => new sfWidgetFormFilterInput(),
      'price'               => new sfWidgetFormFilterInput(),
      'additional_info'     => new sfWidgetFormFilterInput(),
      'in_sight'            => new sfWidgetFormFilterInput(),
      'catering'            => new sfWidgetFormFilterInput(),
      'info_value1'         => new sfWidgetFormFilterInput(),
      'info_text1'          => new sfWidgetFormFilterInput(),
      'info_value2'         => new sfWidgetFormFilterInput(),
      'info_text2'          => new sfWidgetFormFilterInput(),
      'info_value3'         => new sfWidgetFormFilterInput(),
      'info_text3'          => new sfWidgetFormFilterInput(),
      'price_value1'        => new sfWidgetFormFilterInput(),
      'price_text1'         => new sfWidgetFormFilterInput(),
      'price_value2'        => new sfWidgetFormFilterInput(),
      'price_text2'         => new sfWidgetFormFilterInput(),
      'price_value3'        => new sfWidgetFormFilterInput(),
      'price_text3'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'                => new sfValidatorPass(array('required' => false)),
      'title'               => new sfValidatorPass(array('required' => false)),
      'html_description'    => new sfValidatorPass(array('required' => false)),
      'html_keywords'       => new sfValidatorPass(array('required' => false)),
      'main_image_title'    => new sfValidatorPass(array('required' => false)),
      'main_image_alt'      => new sfValidatorPass(array('required' => false)),
      'listing_text'        => new sfValidatorPass(array('required' => false)),
      'h1'                  => new sfValidatorPass(array('required' => false)),
      'short_description'   => new sfValidatorPass(array('required' => false)),
      'description'         => new sfValidatorPass(array('required' => false)),
      'target_use'          => new sfValidatorPass(array('required' => false)),
      'passenger_capacity'  => new sfValidatorPass(array('required' => false)),
      'basic_info'          => new sfValidatorPass(array('required' => false)),
      'equipment'           => new sfValidatorPass(array('required' => false)),
      'crew'                => new sfValidatorPass(array('required' => false)),
      'passenger_insurance' => new sfValidatorPass(array('required' => false)),
      'price'               => new sfValidatorPass(array('required' => false)),
      'additional_info'     => new sfValidatorPass(array('required' => false)),
      'in_sight'            => new sfValidatorPass(array('required' => false)),
      'catering'            => new sfValidatorPass(array('required' => false)),
      'info_value1'         => new sfValidatorPass(array('required' => false)),
      'info_text1'          => new sfValidatorPass(array('required' => false)),
      'info_value2'         => new sfValidatorPass(array('required' => false)),
      'info_text2'          => new sfValidatorPass(array('required' => false)),
      'info_value3'         => new sfValidatorPass(array('required' => false)),
      'info_text3'          => new sfValidatorPass(array('required' => false)),
      'price_value1'        => new sfValidatorPass(array('required' => false)),
      'price_text1'         => new sfValidatorPass(array('required' => false)),
      'price_value2'        => new sfValidatorPass(array('required' => false)),
      'price_text2'         => new sfValidatorPass(array('required' => false)),
      'price_value3'        => new sfValidatorPass(array('required' => false)),
      'price_text3'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemTranslation';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'name'                => 'Text',
      'title'               => 'Text',
      'html_description'    => 'Text',
      'html_keywords'       => 'Text',
      'main_image_title'    => 'Text',
      'main_image_alt'      => 'Text',
      'listing_text'        => 'Text',
      'h1'                  => 'Text',
      'short_description'   => 'Text',
      'description'         => 'Text',
      'target_use'          => 'Text',
      'passenger_capacity'  => 'Text',
      'basic_info'          => 'Text',
      'equipment'           => 'Text',
      'crew'                => 'Text',
      'passenger_insurance' => 'Text',
      'price'               => 'Text',
      'additional_info'     => 'Text',
      'in_sight'            => 'Text',
      'catering'            => 'Text',
      'info_value1'         => 'Text',
      'info_text1'          => 'Text',
      'info_value2'         => 'Text',
      'info_text2'          => 'Text',
      'info_value3'         => 'Text',
      'info_text3'          => 'Text',
      'price_value1'        => 'Text',
      'price_text1'         => 'Text',
      'price_value2'        => 'Text',
      'price_text2'         => 'Text',
      'price_value3'        => 'Text',
      'price_text3'         => 'Text',
      'lang'                => 'Text',
    );
  }
}
