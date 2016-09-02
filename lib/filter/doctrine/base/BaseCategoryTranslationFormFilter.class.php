<?php

/**
 * CategoryTranslation filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategoryTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(),
      'title'            => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'keywords'         => new sfWidgetFormFilterInput(),
      'seo_short_text'   => new sfWidgetFormFilterInput(),
      'seo_full_text'    => new sfWidgetFormFilterInput(),
      'h1'               => new sfWidgetFormFilterInput(),
      'item_title'       => new sfWidgetFormFilterInput(),
      'item_description' => new sfWidgetFormFilterInput(),
      'item_keywords'    => new sfWidgetFormFilterInput(),
      'item_h1'          => new sfWidgetFormFilterInput(),
      'item_contacts'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'title'            => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'keywords'         => new sfValidatorPass(array('required' => false)),
      'seo_short_text'   => new sfValidatorPass(array('required' => false)),
      'seo_full_text'    => new sfValidatorPass(array('required' => false)),
      'h1'               => new sfValidatorPass(array('required' => false)),
      'item_title'       => new sfValidatorPass(array('required' => false)),
      'item_description' => new sfValidatorPass(array('required' => false)),
      'item_keywords'    => new sfValidatorPass(array('required' => false)),
      'item_h1'          => new sfValidatorPass(array('required' => false)),
      'item_contacts'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CategoryTranslation';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'title'            => 'Text',
      'description'      => 'Text',
      'keywords'         => 'Text',
      'seo_short_text'   => 'Text',
      'seo_full_text'    => 'Text',
      'h1'               => 'Text',
      'item_title'       => 'Text',
      'item_description' => 'Text',
      'item_keywords'    => 'Text',
      'item_h1'          => 'Text',
      'item_contacts'    => 'Text',
      'lang'             => 'Text',
    );
  }
}
