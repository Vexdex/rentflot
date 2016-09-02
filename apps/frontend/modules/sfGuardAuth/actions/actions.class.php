<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: BasesfGuardAuthActions.class.php 23800 2009-11-11 23:30:50Z Kris.Wallsmith $
 */
class sfGuardAuthActions extends sfActions
{

  // Просто скопировать эталонный метод
  public function log($data = array(), $authenticated_only = true)
  {
    $user_options = $this->getUser()->getOptions();  
    if (!empty($user_options['log_events']) && !$this->request->isXmlHttpRequest())
    {           
      $username = $this->getUser()->isAuthenticated() ? $this->getUser()->getGuardUser()->__toString() : (isset($data['username']) ? $data['username'] : 'anonymous');      
      $module = isset($data['module']) ? $data['module'] : $this->getModuleName(); 
      $action = isset($data['action']) ? $data['action'] : $this->getActionName();      
      $ids = isset($data['ids']) ? $data['ids'] : null;
      $desc = isset($data['desc']) ? $data['desc'] : null;
      
      // Отключение записи в журнал при заданных параметрах
      if ($authenticated_only && !$this->getUser()->isAuthenticated())
      {
        return false;
      }      

      $action_log = new ActionLog();      
      if ($ids)
      {        
        if (is_array($ids))
        {
          if (count($ids) > 1)
          {            
            $action = $action.'N';
            $id_text_key = 'ids';
          }
          else
          {
            $action = $action.'1';
            $id_text_key = 'id';
          }                    
          $ids = implode(', ', $ids);
        }
        $action_log->setIds($ids);
      }            
      
      if ($desc)
      {
        $action_log->setDescription($desc);
      }      
      $action_log->setModule($module);
      $action_log->setAction($action);      
      $action_log->setUsername($username);                  
      $action_log->setIp($this->request->getRemoteAddress());            
      $action_log->save();  
    }
  }
  

  public function executeCheckIsAuthenticated($request)
  {
    //$this->forward404unless($request->isXmlHttpRequest());     
    $user_options = sfContext::getInstance()->getUser()->getOptions(); 
    
    $data = array(
      'is_authenticated' => $this->getUser()->isAuthenticated(), 
      'redirect_url' => $this->getContext()->getRouting()->generate($user_options['timeout_redirect_route'], array(), true)
    );
    return $this->renderText(json_encode($data));
  }
  
  
  public function executeSignin($request)
  {
    if ($this->getUser()->getCulture() != 'ru')
    {
      $this->getUser()->setCulture('ru');
      $this->redirect('sf_guard_signin');
    }

    if ($this->getUser()->isAuthenticated())
    {
      $this->forward($this->getModuleName(), 'signinRedirect');
    }

    $this->signin_form = new sfGuardCustomFormSignin();

		// POST from another form 
    if ($request->isMethod('post') && !$request->hasParameter('signin')) 
    { 
			$this->redirect('sf_guard_signin'); 
    } 

    // Automatically redirect a user when a csrf token is detected
    $this->dispatcher->connect('form.validation_error', 'sfGuardAuthActions::csrf_fix');
    
    if ($request->isMethod('post'))
    {      
      $this->signin_form->bind($request->getParameter('signin'));
      if ($this->signin_form->isValid())
      {
        $values = $this->signin_form->getValues();
                        
        $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);
			
				$this->log(array('desc' => 'Login successfull'));
        
        $continue_url = $request->getParameter('continue');
        
        if ($continue_url)
        {
          
          preg_match('/^(http|https|ftp):\/\/([^\/]+)\/?(.*)/', $continue_url, $matches);
          
          if (isset($matches[2]) && $matches[2] == $request->getHost())
          {
            $this->redirect($continue_url);
          }          
          /*
          $continue_url_params = sfContext::getInstance()->getRouting()->parse($$continue_url);    
          $referer_module = $referer_url_params['module'];
          $referer_action = $referer_url_params['action'];          
          */
        } 
        
        $this->forward($this->getModuleName(), 'signinRedirect');

      }  
      else
      {
        $user = $this->request->getParameter('signin');
        $this->log(array('desc' => 'Login attempt', 'username' => $user['username']), false);
      }
    }
    else
    {
      if ($request->isXmlHttpRequest())
      {
        $this->getResponse()->setHeaderOnly(true);
        $this->getResponse()->setStatusCode(401);

        return sfView::NONE;
      }

      // if we have been forwarded, then the referer is the current URL
      // if not, this is the referer of the current request
      $this->getUser()->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module)
      {
        //return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
        $this->redirect($this->getContext()->getRouting()->generate(sfConfig::get('sf_login_action'), array('continue' =>  $request->getUri()), true));
      }

      $this->getResponse()->setStatusCode(401);
    }

  }

  public function executeSignout($request)
  {
		if ($this->getUser()->isAuthenticated())
    {
      $this->log();      
      $this->getUser()->signOut();
    }
    //$this->forward($this->getModuleName(), 'signoutRedirect');
    $this->signoutRedirect($request);
  }

  private function signoutRedirect($request)
  {
    $this->redirect('sf_guard_signin');              
  }
  
  
  public function executeSecure($request)
  {
    //$this->getResponse()->setStatusCode(404);
    $this->forward('content', 'error404');    
  }
  
  public function executeSigninRedirect()
  {
    if ($this->getUser()->hasCredential('order'))
    {    
      $this->redirect('order');          
    }
    
    if ($this->getUser()->hasCredential('catalog'))
    {    
      $this->redirect('item');          
    }

    if ($this->getUser()->hasCredential('catalog_show_own_items_rent_details'))
    {
      $this->redirect('catalog_own_items');
    }

    if ($this->getUser()->hasCredential('contact'))
    {
      $this->redirect('client_contact');
    }

    $this->redirect('homepage');          
  }

  /* CSRF fix */
  public static function csrf_fix(sfEvent $event) 
  {
    $form = $event->getSubject();
    $error = $event['error'];
    
    if(!$form->isCSRFProtected())
    {
      return;
    }
    
    $field_name = sfForm::getCSRFFieldName();
    
    if(isset($error[$field_name]))
    {
      if(sfContext::hasInstance())
      {
        $context = sfContext::getInstance();
        $context->getController()->redirect('@sf_guard_signin');
        $context->getUser()->setFlash('notice', 'csrf_atack');
        throw new sfStopException();
      }
    }
  }  

}
