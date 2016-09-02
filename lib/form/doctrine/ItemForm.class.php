<?php

/**
 * Item form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ItemForm extends BaseItemForm
{
  public function configure()
  {
    parent::configure();

    // Чтобы не убивались записи в заказах
    unset($this['orders_list']);

    $this->widgetSchema['main_image_id'] = new sfWidgetFormMagicImage(array(
      'image_model' => $this->isNew() ? 'ItemTempImage' : 'ItemImage',
      'model' => 'Item',
      //'foreign_key' => 'object_id',
      'object_id' => !$this->isNew() ? sfContext::getInstance()->getRequest()->getParameter('id') : (sfContext::getInstance()->getRequest()->getParameter('idh') ? sfContext::getInstance()->getRequest()->getParameter('idh') : md5('sdsdsd'.(time()-333)))
    ));
    
    
    $this->widgetSchema['price1'] = new magicWidgetFormProxy(array(
      'form' => $this,
      'partial' => 'field_dual',
      'fields' => array('price_value1', 'price_text1'),
      'proxy_field' => 'price1'
    ));    

    $this->widgetSchema['price2'] = new magicWidgetFormProxy(array(
      'form' => $this,
      'partial' => 'field_dual',
      'fields' => array('price_value2', 'price_text2'),
      'proxy_field' => 'price2'
    ));    

    $this->widgetSchema['price3'] = new magicWidgetFormProxy(array(
      'form' => $this,
      'partial' => 'field_dual',
      'fields' => array('price_value3', 'price_text3'),
      'proxy_field' => 'price3'
    ));    
    

    $this->widgetSchema['info1'] = new magicWidgetFormProxy(array(
      'form' => $this,
      'partial' => 'field_dual',
      'fields' => array('info_value1', 'info_text1'),
      'proxy_field' => 'info1'
    ));    

    $this->widgetSchema['info2'] = new magicWidgetFormProxy(array(
      'form' => $this,
      'partial' => 'field_dual',
      'fields' => array('info_value2', 'info_text2'),
      'proxy_field' => 'info2'
    ));    

    $this->widgetSchema['info3'] = new magicWidgetFormProxy(array(
      'form' => $this,
      'partial' => 'field_dual',
      'fields' => array('info_value3', 'info_text3'),
      'proxy_field' => 'info3'
    ));      
    
    $this->validatorSchema['price1'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['price2'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['price3'] = new sfValidatorPass(array('required' => false));

    $this->validatorSchema['info1'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['info2'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['info3'] = new sfValidatorPass(array('required' => false));
    

    
    $this->widgetSchema['categories_list'] = new sfWidgetFormDoctrineChoice(array(
      'multiple' => true, 
      'expanded' => true, 
      'model' => 'Category',
      'query' => Doctrine_Query::create()
         ->from('Category c')
         ->leftJoin('c.Translation t WITH t.lang = \''.sfContext::getInstance()->getUSer()->getCulture().'\'')
         ->orderBy('c.order'),
      //'method' => 'getCategoryName1' 
      //'order_by' => array('order', 'asc')
    ));

    $this->widgetSchema['owner_id']->setOption('order_by', array('org_name', 'asc'));

    $cultures = sfConfig::get('app_cultures_enabled');
    
    foreach($cultures as $culture => $text)
    {
      $this->widgetSchema[$culture]['target_use'] = new magicWidgetFormTinyMCE();      
      $this->widgetSchema[$culture]['description'] = new magicWidgetFormTinyMCE();      
      $this->widgetSchema[$culture]['short_description'] = new magicWidgetFormTinyMCE();      
      $this->widgetSchema[$culture]['passenger_capacity'] = new magicWidgetFormTinyMCE();      
      $this->widgetSchema[$culture]['basic_info'] = new magicWidgetFormTinyMCE();      
      $this->widgetSchema[$culture]['equipment'] = new magicWidgetFormTinyMCE();      
      $this->widgetSchema[$culture]['crew'] = new magicWidgetFormTinyMCE();      
      $this->widgetSchema[$culture]['passenger_insurance'] = new magicWidgetFormTinyMCE();
      $this->widgetSchema[$culture]['price'] = new magicWidgetFormTinyMCE();
      $this->widgetSchema[$culture]['additional_info'] = new magicWidgetFormTinyMCE();      
      $this->widgetSchema[$culture]['in_sight'] = new magicWidgetFormTinyMCE();      
      $this->widgetSchema[$culture]['catering'] = new magicWidgetFormTinyMCE();
    }

    // Slug
    $this->validatorSchema['slug'] = new sfValidatorRegex(array('required' => true, 'pattern' => '/^[a-zA-Z0-9\_\-]+$/ui'));
  }


  public function updateObject($values = null)
  {
		$item = parent::updateObject($values);
    
    $itemTranslation = $item->getTranslation();
    
    $i18nFields = sfConfig::get('app_google_translate_fields', array());
    $gt = new Gtranslate();
    $gt->setRequestType('curl');
    
    foreach ($i18nFields as $i18nField)
    {
      if ($itemTranslation['ru'][$i18nField] && !$itemTranslation['en'][$i18nField])
      {
        try
        {          
          $itemTranslation['en'][$i18nField] = $gt->ru_to_en($itemTranslation['ru'][$i18nField]);
        } 
        catch (GTranslateException $ge)
        {
          //echo $ge->getMessage();
        }
      }
    }
    
    return $item;
  }
}