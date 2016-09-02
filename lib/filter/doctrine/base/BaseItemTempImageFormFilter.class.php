<?php

/**
 * ItemTempImage filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseItemTempImageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'object_id'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'filename'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'order'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'alt'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'alt_en'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title_en'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'width'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'height'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'object_id'  => new sfValidatorPass(array('required' => false)),
      'filename'   => new sfValidatorPass(array('required' => false)),
      'order'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'alt'        => new sfValidatorPass(array('required' => false)),
      'title'      => new sfValidatorPass(array('required' => false)),
      'alt_en'     => new sfValidatorPass(array('required' => false)),
      'title_en'   => new sfValidatorPass(array('required' => false)),
      'width'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('item_temp_image_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemTempImage';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'object_id'  => 'Text',
      'filename'   => 'Text',
      'order'      => 'Number',
      'alt'        => 'Text',
      'title'      => 'Text',
      'alt_en'     => 'Text',
      'title_en'   => 'Text',
      'width'      => 'Number',
      'height'     => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
