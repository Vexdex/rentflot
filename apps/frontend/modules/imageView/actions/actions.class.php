<?php

/**
 * imageView actions.
 *
 * @package    Rentflot
 * @subpackage imageView
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class imageViewActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->slug = $request->getParameter('slug');
    $image_data = sfConfig::get('app_image_view_data');    
    $this->forward404If(empty($image_data[$this->slug]));
    $this->image_src = $image_data[$this->slug];
  }
}
