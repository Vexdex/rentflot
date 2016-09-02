<?php

/**
 * Category form base class.
 *
 * @method Category getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'is_hidden'           => new sfWidgetFormInputCheckbox(),
      'parent_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentCategory'), 'add_empty' => true)),
      'slug'                => new sfWidgetFormInputText(),
      'category_template'   => new sfWidgetFormInputText(),
      'product_template'    => new sfWidgetFormInputText(),
      'order'               => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'items_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Item')),
      'advertisements_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Advertisement')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'is_hidden'           => new sfValidatorBoolean(array('required' => false)),
      'parent_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ParentCategory'), 'required' => false)),
      'slug'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'category_template'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'product_template'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'order'               => new sfValidatorInteger(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'items_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Item', 'required' => false)),
      'advertisements_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Advertisement', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Category', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['items_list']))
    {
      $this->setDefault('items_list', $this->object->Items->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['advertisements_list']))
    {
      $this->setDefault('advertisements_list', $this->object->Advertisements->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveItemsList($con);
    $this->saveAdvertisementsList($con);

    parent::doSave($con);
  }

  public function saveItemsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['items_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Items->getPrimaryKeys();
    $values = $this->getValue('items_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Items', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Items', array_values($link));
    }
  }

  public function saveAdvertisementsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['advertisements_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Advertisements->getPrimaryKeys();
    $values = $this->getValue('advertisements_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Advertisements', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Advertisements', array_values($link));
    }
  }

}
