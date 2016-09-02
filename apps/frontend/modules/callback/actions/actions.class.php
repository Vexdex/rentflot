<?php

/**
 * call actions.
 *
 * @package    Rentflot
 * @subpackage call
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class callbackActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new CallForm();
  }

  public function executeSubmit(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

	$c=new Callback();
	$c->phone=$request->getParameter('phone');
	$c->save();
  }
  
  public function executeShow(sfWebRequest $request)
  {
	$this->call=Doctrine_Core::getTable('Callback')->findOneById($request->getParameter('id'));
	//Doctrine_Core::getTable('callback')->findById($request->getParameter('id'));
  }
  
  public function executeDone(sfWebRequest $request)
  {
	$call=Doctrine_Core::getTable('Callback')->findOneById($request->getParameter('id'));
	$call->delete();
	$this->redirect('order');
	//Doctrine_Core::getTable('callback')->findById($request->getParameter('id'));
  }  
}
