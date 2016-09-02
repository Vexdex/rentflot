<?php

/**
 * dynamic_map actions.
 *
 * @package    Rentflot
 * @subpackage dynamic_map
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dynamic_mapActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
   //echo "zxczxc";
    $this->forward('default', 'module');
  }
  public function executeShow(sfWebRequest $request)
  {
    //$this-> = $this->getRoute()->getObject();
  }
}
