<?php

/**
 * Item form base class.
 *
 * @method Item getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'is_active'          => new sfWidgetFormInputCheckbox(),
      'is_own'             => new sfWidgetFormInputCheckbox(),
      'hide_attractions'   => new sfWidgetFormInputCheckbox(),
      'internal_name'      => new sfWidgetFormInputText(),
      'doc_name'           => new sfWidgetFormInputText(),
      'slug'               => new sfWidgetFormInputText(),
      'owner_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Owner'), 'add_empty' => true)),
      'unit_type_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UnitType'), 'add_empty' => false)),
      'price_uah'          => new sfWidgetFormInputText(),
      'price_discount_uah' => new sfWidgetFormInputText(),
      'commission_percent' => new sfWidgetFormInputText(),
      'main_image_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MainImage'), 'add_empty' => true)),
      'order'              => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'categories_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
      'orders_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Order')),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'is_active'          => new sfValidatorBoolean(array('required' => false)),
      'is_own'             => new sfValidatorBoolean(array('required' => false)),
      'hide_attractions'   => new sfValidatorBoolean(array('required' => false)),
      'internal_name'      => new sfValidatorString(array('max_length' => 255)),
      'doc_name'           => new sfValidatorString(array('max_length' => 255)),
      'slug'               => new sfValidatorString(array('max_length' => 255)),
      'owner_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Owner'), 'required' => false)),
      'unit_type_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UnitType'))),
      'price_uah'          => new sfValidatorPass(),
      'price_discount_uah' => new sfValidatorPass(),
      'commission_percent' => new sfValidatorPass(array('required' => false)),
      'main_image_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MainImage'), 'required' => false)),
      'order'              => new sfValidatorInteger(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'categories_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'orders_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Order', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Item', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['categories_list']))
    {
      $this->setDefault('categories_list', $this->object->Categories->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['orders_list']))
    {
      $this->setDefault('orders_list', $this->object->Orders->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCategoriesList($con);
    $this->saveOrdersList($con);

    parent::doSave($con);
  }

  public function saveCategoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['categories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Categories->getPrimaryKeys();
    $values = $this->getValue('categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Categories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Categories', array_values($link));
    }
  }

  public function saveOrdersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['orders_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Orders->getPrimaryKeys();
    $values = $this->getValue('orders_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Orders', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Orders', array_values($link));
    }
  }

}
