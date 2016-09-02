<?php

/**
 * call actions.
 *
 * @package    Rentflot
 * @subpackage call
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class advActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $slug = $request->getParameter('slug');
	$this->adv = Doctrine_Query::create()
		->from('Advertisement c')
		->leftJoin('c.Translation ct WITH ct.lang = \''.$this->getUser()->getCulture().'\'')                    
		->where('c.slug = ?', $slug)
		->fetchOne();
	$response = $this->getResponse();	
	$response->addMeta('description', $this->adv->getDescription());
    $response->addMeta('keywords', $this->adv->getKeywords());
    $response->setTitle($this->adv->getTitle());
  }
}
