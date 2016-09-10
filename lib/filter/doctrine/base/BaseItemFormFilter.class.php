<?php

/**
 * Item filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseItemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      // 2016 09 10 vexdex before  
      // 'is_active'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      // 'is_own'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      // 'hide_attractions'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      // 2016 09 10 vexdex after [
      'is_active'          => new sfWidgetFormChoice(array('choices' => array('' => 'да или нет', 1 => 'да', 0 => 'нет'))),
      'is_own'             => new sfWidgetFormChoice(array('choices' => array('' => 'да или нет', 1 => 'да', 0 => 'нет'))),
      'hide_attractions'   => new sfWidgetFormChoice(array('choices' => array('' => 'да или нет', 1 => 'да', 0 => 'нет'))),
      // 2016 09 10 vexdex after ]  
      'internal_name'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'doc_name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'owner_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Owner'), 'add_empty' => true)),
      'unit_type_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UnitType'), 'add_empty' => true)),
      'price_uah'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price_discount_uah' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'commission_percent' => new sfWidgetFormFilterInput(),
      'main_image_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MainImage'), 'add_empty' => true)),
      'order'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'categories_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'orders_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Order')),
    ));

    $this->setValidators(array(
      'is_active'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_own'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'hide_attractions'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'internal_name'      => new sfValidatorPass(array('required' => false)),
      'doc_name'           => new sfValidatorPass(array('required' => false)),
      'slug'               => new sfValidatorPass(array('required' => false)),
      'owner_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Owner'), 'column' => 'id')),
      'unit_type_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UnitType'), 'column' => 'id')),
      'price_uah'          => new sfValidatorPass(array('required' => false)),
      'price_discount_uah' => new sfValidatorPass(array('required' => false)),
      'commission_percent' => new sfValidatorPass(array('required' => false)),
      'main_image_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MainImage'), 'column' => 'id')),
      'order'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'categories_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'orders_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Order', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addCategoriesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('CategoryItem.category_id', $values)
    ;
  }

  public function addOrdersListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.OrderItem OrderItem')
      ->andWhereIn('OrderItem.order_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Item';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'is_active'          => 'Boolean',
      'is_own'             => 'Boolean',
      'hide_attractions'   => 'Boolean',
      'internal_name'      => 'Text',
      'doc_name'           => 'Text',
      'slug'               => 'Text',
      'owner_id'           => 'ForeignKey',
      'unit_type_id'       => 'ForeignKey',
      'price_uah'          => 'Text',
      'price_discount_uah' => 'Text',
      'commission_percent' => 'Text',
      'main_image_id'      => 'ForeignKey',
      'order'              => 'Number',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'categories_list'    => 'ManyKey',
      'orders_list'        => 'ManyKey',
    );
  }
}
