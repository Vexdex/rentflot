<?php

/**
 * Owner form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OwnerForm extends BaseOwnerForm
{
  public function configure()
  {
    parent::configure();
    //$this->embedRelation('Items');
    //$this->widgetSchema['item_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'expanded' => true, 'model' => 'Item'));    
    //$this->validatorSchema['item_list'] = new sfValidatorPass(array('required' => false));     
  }
}
