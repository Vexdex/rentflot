<?php

require_once dirname(__FILE__).'/../lib/pierfGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pierfGeneratorHelper.class.php';

/**
 * pierf actions.
 *
 * @package    Rentflot
 * @subpackage pierf
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pierfActions extends autoPierfActions
{
	
	function executeUpdate(sfWebRequest $request)
	{	
		
		$files = $request->getFiles();
		if($files["pierf"]["link"]["error"]==0)
		{
			$folder = sfConfig::get('app_pier_file_folder');
			$pierf=$this->getRoute()->getObject(); 
			$filename = $files["pierf"]["link"]["name"];
			rename($files["pierf"]["link"]["tmp_name"],$folder.$filename);
			
			//$pierf->setLink($filename);
			//$pierf->save();
		}
		if($files["pierf"]["link_english"]["error"]==0)
		{
			$folder = sfConfig::get('app_pier_file_folder');
			$pierf=$this->getRoute()->getObject(); 
			$filename = $files["pierf"]["link_english"]["name"];
			//echo $folder.$filename;die;
			rename($files["pierf"]["link_english"]["tmp_name"],$folder.$filename);
			
			//$pierf->setLink($filename);
			//$pierf->save();
		}
		parent::executeUpdate($request);
	}
}
