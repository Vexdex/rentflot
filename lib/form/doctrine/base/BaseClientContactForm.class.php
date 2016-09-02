<?php

/**
 * ClientContact form base class.
 *
 * @method ClientContact getObject() Returns the current form's model object
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClientContactForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'contact_date'      => new sfWidgetFormDateTime(),
      'contact_time'      => new sfWidgetFormTime(),
      'comment'           => new sfWidgetFormTextarea(),
      'order_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Order'), 'add_empty' => false)),
      'contact_status_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContactStatus'), 'add_empty' => false)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'created_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'updated_by'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'contact_date'      => new sfValidatorDateTime(),
      'contact_time'      => new sfValidatorTime(),
      'comment'           => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      'order_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Order'))),
      'contact_status_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContactStatus'))),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'created_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'updated_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('client_contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClientContact';
  }

}
