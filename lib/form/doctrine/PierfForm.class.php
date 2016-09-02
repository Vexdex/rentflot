<?php

/**
 * Pierf form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PierfForm extends BasePierfForm
{
  public function configure()
  {
	$this->widgetSchema['link'] = new sfWidgetFormInputFile();
	
	$this->validatorSchema['link'] = new sfValidatorFile(array(
	'required'   => false,
	'path'       => sfConfig::get('app_pier_file_folder')
	));
	
	$this->widgetSchema['link_english'] = new sfWidgetFormInputFile();
	
	$this->validatorSchema['link_english'] = new sfValidatorFile(array(
	'required'   => false,
	'path'       => sfConfig::get('app_pier_file_folder')
	));
  }
  public function generateLinkFilename(sfValidatedFile $file)
 {
    return $file->getOriginalName();
 }
   public function generateLinkEnglishFilename(sfValidatedFile $file)
 {
    return $file->getOriginalName();
 }
}
