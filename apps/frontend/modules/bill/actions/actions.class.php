<?php

require_once dirname(__FILE__).'/../lib/billGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/billGeneratorHelper.class.php';

/**
 * bill actions.
 *
 * @package    Rentflot
 * @subpackage bill
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class billActions extends autoBillActions
{

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'create_successfull' : 'update_successfull';

      try {
        
        $bill = $form->save();
        
        if ($form->isNew() &&  $bill->getTypeId() == 3 && $form->getValue('create_cash_income'))
        {
          $new_bill = new Bill();          
          $new_bill->setTypeId(2);
          $new_bill->setIndexId($bill->getIndexId());          
          $new_bill->setName($bill->getName());
          $new_bill->setDescription($bill->getDescription());
          $new_bill->setAmountUah($bill->getAmountUah());   
          $new_bill->setAmountPayedUah($bill->getAmountPayedUah());   

          $new_bill->save();
        }
        
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $bill)));
      
      // -- Log 
      $this->log(array('ids' => $bill->getId()));     
      
      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.'_and_add');

        $this->redirect('@bill_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'bill', 'sf_subject' => $bill));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'save_error', false);
    }
  }



}
