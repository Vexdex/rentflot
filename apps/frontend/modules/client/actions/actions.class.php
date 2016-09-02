<?php

require_once dirname(__FILE__).'/../lib/clientGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/clientGeneratorHelper.class.php';

/**
 * client actions.
 *
 * @package    Rentflot
 * @subpackage client
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clientActions extends autoClientActions
{
//Not needed custom form processing, because it was made custom for contact functionality, which no more required in client module
/*
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'create_successfull' : 'update_successfull';

      try {
        $client = $form->save();
		if(
			$request->getPostParameter("client[make_contact]") || 
			$request->getPostParameter("client[contact_date]")!="" ||
			$request->getPostParameter("client[comment]")!=""
		)
		{
			$contact = new ClientContact();
			$contact->setClientId($client->getId());

			if($request->getPostParameter("client[contact_date]")!="")
			{
				$dateTime = strtotime($request->getPostParameter("client[contact_date]"));
			}
			else
			{
				$dateTime = time();
			}
			//echo ;die;

			$contact->setContactDate(date('Y.m.d 00:00:00', $dateTime));
			$contact->setComment($request->getPostParameter("client[comment]"));
			$contact->setContactStatusId(1);
			$contact->save();
		}
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        //$this->getUser()->getFlash('notice');
        //$this->getUser()->getFlash('custom_notice');
        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $client)));
      
      // -- Log 
      $this->log(array('ids' => $client->getId()));     
      
      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.'_and_add');

        $this->redirect('@client_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'client', 'sf_subject' => $client));
      }
    }
    else
    {
      //$this->getUser()->getFlash('notice');
      //$this->getUser()->getFlash('custom_notice');
      $this->getUser()->setFlash('error', 'save_error', false);
    }
  }*/
	/*
	function executeUpdate(sfWebRequest $request)
	{
		if($request->getPostParameter("client[make_contact]"))
		{
			$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
			if ($form->isValid())
			{
				$contact = new ClientContact();
				$contact->setClientId($request->getPostParameter("client[id]"));
				$contact->setContactStatusId(1);
				$contact->save();
			}
		}
		parent::executeUpdate($request);
	}*/
	
	/*
	public function executeNew(sfWebRequest $request)
	{
		parent::executeNew($request);
		echo $this->form->getObject()->getId(); die;
	}*/
	/*
	function execute($request)
	{
		if($request->getPostParameter("client[make_contact]"))
		{
			$contact = new ClientContact();
			$contact->setClientId($request->getPostParameter("client[id]"));
			$contact->setContactStatusId(1);
			$contact->save();
		}

		parent::execute($request);
	}
	
	function executeCreate(sfWebRequest $request)
	{
		parent::executeCreate($request);
	}
	
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		parent::processForm($request, $form);
		echo $this->form->getObject()->getId(); die;
	}*/
	/*
	public function postExecute()
	{
		//echo $this->getActionName();die;
		//echo $this->form->getObject()->getId(); die;
	}*/

	/*
	function executeNewSuccess(sfWebRequest $request)
	{
		echo 2;
		die;
		parent::executeNew($request);
	}*/		
}
