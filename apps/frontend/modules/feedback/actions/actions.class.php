<?php

/**
 * feedback actions.
 *
 * @package    Rentflot
 * @subpackage feedback
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class feedbackActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
  public function setMeta()
  {  
    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();    
    $response = $this->getResponse();
    $response->addMeta('description', $this->getContext()->getI18n()->__($current_route.'_description', null, 'meta'));
    $response->addMeta('keywords', $this->getContext()->getI18n()->__($current_route.'_keywords', null, 'meta'));
    $response->setTitle($this->getContext()->getI18n()->__($current_route.'_title', null, 'meta'));  
    $this->getContext()->setH1($this->getContext()->getI18n()->__($current_route.'_h1', null, 'meta'));
  }  
  
  
  public function executeResult(sfWebRequest $request)
  {
    if (!$this->getUser()->hasFlash('msg_result'))
    {
      $this->redirect('feedback');
    }
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->feedback_form = new FeedbackForm();
    if ($request->isMethod('post'))
    {
      $this->feedback_form->bind($request->getParameter('feedback_form'));
      if ($this->feedback_form->isValid()) 
      {
        $this->getUser()->getAttributeHolder()->remove('keystring');
		    $subject = Doctrine_Query::create()
                    ->from('FeedbackSubject s')								  
                    ->leftJoin('s.Translation t WITH t.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\'')
                    ->where('s.id = ?', $this->feedback_form->getValue('subject_id'))
                    ->fetchOne();
                  				
        // Send email here
        try 
        {
          $to = sfConfig::get('app_contact_email');
          $this->getMailer()->composeAndSend($this->feedback_form->getValue('email'), $to, $subject->getName(), htmlspecialchars($this->feedback_form->getValue('message')));
          $this->getUser()->setFlash('msg_result', true);
          
        } catch (Exception $e) 
        {
  				$this->getUser()->setFlash('msg_result', false);
  			}
        $this->redirect('feedback_result');				
      }
		}
    
    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();        
    $this->getContext()->set('breadcrumbs', array(
      array(
        'text' => $this->getContext()->getI18n()->__('contacts', null, 'menu'), 
        'url' => $this->getContext()->getRouting()->generate('contacts', array(), true)
      ),          
      array(
        'text' => $this->getContext()->getI18n()->__($current_route, null, 'menu'), 
        'url' => $this->getContext()->getRouting()->generate($current_route, array(), true)
      )      
    ));
  
    $this->setMeta();
  }
}
