<?php

/**
 * Category filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_hidden'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'parent_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentCategory'), 'add_empty' => true)),
      'slug'                => new sfWidgetFormFilterInput(),
      'category_template'   => new sfWidgetFormFilterInput(),
      'product_template'    => new sfWidgetFormFilterInput(),
      'order'               => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'items_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Item')),
      'advertisements_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Advertisement')),
    ));

    $this->setValidators(array(
      'is_hidden'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'parent_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ParentCategory'), 'column' => 'id')),
      'slug'                => new sfValidatorPass(array('required' => false)),
      'category_template'   => new sfValidatorPass(array('required' => false)),
      'product_template'    => new sfValidatorPass(array('required' => false)),
      'order'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'items_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Item', 'required' => false)),
      'advertisements_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Advertisement', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addItemsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.CategoryItem CategoryItem')
      ->andWhereIn('CategoryItem.item_id', $values)
    ;
  }

  public function addAdvertisementsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.CategoryAdvertisement CategoryAdvertisement')
      ->andWhereIn('CategoryAdvertisement.advertisement_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'is_hidden'           => 'Boolean',
      'parent_id'           => 'ForeignKey',
      'slug'                => 'Text',
      'category_template'   => 'Text',
      'product_template'    => 'Text',
      'order'               => 'Number',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'items_list'          => 'ManyKey',
      'advertisements_list' => 'ManyKey',
    );
  }
}
