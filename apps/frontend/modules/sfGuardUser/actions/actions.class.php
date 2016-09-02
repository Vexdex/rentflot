<?php

require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorHelper.class.php';

/**
 * sfGuardUser actions.
 *
 * @package    Companion Finance
 * @subpackage sfGuardUser
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserActions extends autoSfGuardUserActions
{
  

  public function preExecute()
  {
    parent::preExecute();
    
    $action_name = $this->getActionName();
    $batch_action_name = $this->getRequest()->getParameter('batch_action');
    
    // Проверка на невозможность удаления и деактивирования самого себя
    switch ($action_name)
    {
      case 'delete':
      case 'activate':
      case 'deactivate':
        // При дективации устанавливаем force_change_password
        if ($action_name == 'deactivate')
        {
          $user_profile = $this->getRoute()->getObject()->getProfile();
          $user_profile->setForceChangePassword(true);
          $user_profile->save();
        }
        // Редирект если идет попытка удаления или дективирования самого себя                
        if ($this->getUser()->getGuardUser()->getId() == $this->getRoute()->getObject()->getId())
        {
          $this->getUser()->setFlash('custom_error', 'flash_'.$action_name.'_self_error');
          $this->redirect('sf_guard_user');
        }
      break;
      case 'batch':
        $ids = $this->getRequest()->getParameter('ids');
        // При дективации устанавливаем force_change_password
        if ($batch_action_name == 'batchDeactivate')
        {
          foreach ($ids as $id)
          {
            $user = Doctrine::getTable('sfGuardUser')->findOneById($id);
            if ($user)
            {
              $user_profile = $user->getProfile();
              $user_profile->setForceChangePassword(true);
              $user_profile->save();
            }
          }      
        }
        // Редирект если идет попытка удаления или дективирования самого себя        
        if (in_array($this->getUser()->getGuardUser()->getId(), $ids))
        {
          $this->getUser()->setFlash('custom_error', 'flash_'.$action_name.'_self_error');
          $this->redirect('sf_guard_user');
        }
      break;
      default:
      break;      
    }
  }

  public function executeResetPassword($request)
  {  
    $user_options = $this->getUser()->getOptions(); 
    // Продвинутая политика безопасности
    if (!empty($user_options['advanced_policy']['active']))
    {                        
      $user_advanced_policy = myUser::$advanced_policy_defaults['settings'];
      if (!empty($user_options['advanced_policy']['settings']))
      {
        $user_advanced_policy = array_merge($user_advanced_policy, $user_options['advanced_policy']['settings']);
      }
            
      $user_id = $request->getParameter('id');
      $this->forward404Unless($user_id);
      
      $user = Doctrine::getTable('sfGuardUser')->findOneById($user_id);
      $this->forward404Unless($user);
      
      $user->setPassword($user_advanced_policy['default_pwd']);
      
      // Установка в профайл значения об изменении пароля
      $user->getProfile()->setForceChangePassword(true);
            
      $user->save();  
            
      // Отправка письма с уведомлением о сбросе пароля
      $from = sfConfig::get('app_default_contact_email');
      $to = $user->getProfile()->getEmail();           
      $subj = $this->getContext()->getI18n()->__('email_subj_reset_password', null, 'auth');
      $partial = 'letter_reset_password.'.sfContext::getInstance()->getUser()->getCulture();
      $username = $user->getUsername();
      $default_pwd = $user_advanced_policy['default_pwd'];      
      $this->sendEmail($from, $to, $subj, $partial, $username, $default_pwd);
            
      $this->getUser()->setFlash('custom_notice', 'flash_password_reset');
    }
    else
    {
      $this->getUser()->setFlash('custom_error', 'flash_error_reset_password');
    }
    $this->redirect('@sf_guard_user');
  }
    
  public function sendEmail($from, $to, $subj, $partial, $username, $default_pwd)
  {    
    $message = $this->getMailer()->compose();
    $message->setSubject($subj);
    $message->setTo($to);
    $message->setFrom($from);    
    $body = $this->getPartial($partial, array('username' => $username, 'default_pwd' => $default_pwd));        
    $message->setBody($body, 'text/html');    
    $this->getMailer()->send($message);
  }  

  public function executeChangePassword($request)
  {  
    $user_options = $this->getUser()->getOptions(); 
    // Если пользователь авторизировался и может изменять пароль
    if ($this->getUser()->isAuthenticated() && !empty($user_options['can_change_own_pwd']))
    {
      //$user_id = $this->getUser()->getGuardUser()->getId();      
      $this->change_user_password_form = new magicChangePasswordForm();
      if ($request->isMethod('post'))
      {      
        $this->change_user_password_form->bind($request->getParameter($this->change_user_password_form->getName()));    
        if ($this->change_user_password_form->isValid())
        {
          // Получение объекта пользователя
          $user = $this->getUser()->getGuardUser(); //Doctrine::getTable('sfGuardUser')->findOneById($user_id);
          //$algorithm = $user->getAlgorithm();
          //$salt = $user->getSalt();                      
          $password = $this->change_user_password_form->getValue('password');
          //$passwort_crypt = call_user_func_array($algorithm, array($salt.$password));          
          
          
          // Сохраненме нового пароля в БД          
          $user->setPassword($password);
          $user->save();
          
          // Продвинутая политика безопасности
          if (!empty($user_options['advanced_policy']['active']))
          {                                    
            // Убираем из профайла запись об изменении пароля
            $user_profile = $user->getProfile();
            $user_profile->setForceChangePassword(false);
            $user_profile->save();
            
            // Удаление из сессии параметра для фильтра на изменение пароля
            if (sfContext::getInstance()->getUser()->hasAttribute('change_password'))
            {
              sfContext::getInstance()->getUser()->getAttributeHolder()->remove('change_password');
            }
                        
            // Сохранение уникального пароля в БД
            $user_pwd_history = new sfGuardUserPasswordHistory();
            $user_pwd_history->setUserId($user->getId());
            $user_pwd_history->setPassword($user->getPassword());
            $user_pwd_history->save();                                  
          }                      
          // Установка сообщения и редирект на главную страницу
          $this->getUser()->setFlash('notice', 'flash_password_changed');
          $this->redirect('homepage');
        }      
      }
    }
    else
    {
      //$this->forward404();    
      $this->setTemplate('showError');
    }    
  }

}
