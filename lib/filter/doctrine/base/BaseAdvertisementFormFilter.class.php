<?php

/**
 * Advertisement filter form base class.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdvertisementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'slug'            => new sfWidgetFormFilterInput(),
        // 2016 09 10 vexdex before 
        // 'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
        // 'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
        // 2016 09 10 vexdex after [
        'created_at'      => new sfWidgetFormFilterDate(array(  'from_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                    'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
                                                                    'config' => '{changeYear: true, changeMonth: true}',
                                                                    'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                    'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
                                                                    'config' => '{changeYear: true, changeMonth: true}',
                                                                    'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                'with_empty' => false)),
        'updated_at'      => new sfWidgetFormFilterDate(array(  'from_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                    'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
                                                                    'config' => '{changeYear: true, changeMonth: true}',
                                                                    'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
                                                                    'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
                                                                    'config' => '{changeYear: true, changeMonth: true}',
                                                                    'culture' => sfContext::getInstance()->getUser()->getCulture())), 
                                                                'with_empty' => false)),
        // 2016 09 10 vexdex after ]
      'categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Category')),
    ));

    $this->setValidators(array(
      'slug'            => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('advertisement_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.CategoryAdvertisement CategoryAdvertisement')
      ->andWhereIn('CategoryAdvertisement.category_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Advertisement';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'slug'            => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'categories_list' => 'ManyKey',
    );
  }
}
