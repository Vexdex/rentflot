<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardValidatorUser.class.php 25546 2009-12-17 23:27:55Z Jonathan.Wage $
 */
class magicValidatorUser extends sfValidatorBase
{
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('username_field', 'username');
    $this->addOption('password_field', 'password');
    $this->addOption('throw_global_error', false);
        
    $this->addRequiredOption('change_pwd_after');
    //$this->addRequiredOption('default_pwd');
    $this->addRequiredOption('deactivate_after');
    $this->addRequiredOption('block_attempt_count');    
    $this->addRequiredOption('block_period');
    
    $this->setMessage('invalid', 'The username and/or password is invalid.');
    
    $this->addMessage('blocked', 'error_blocked');
    $this->addMessage('deactivated', 'error_deactivated');    
  }

  protected function doClean($values)
  {
    
    $username = isset($values[$this->getOption('username_field')]) ? $values[$this->getOption('username_field')] : '';
    $password = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';
    
    $allowEmail = sfConfig::get('app_sf_guard_plugin_allow_login_with_email', true);
    $method = $allowEmail ? 'retrieveByUsernameOrEmailAddress' : 'retrieveByUsername';

    $deactivate_after = intval($this->getOption('deactivate_after'));
    $change_pwd_after = intval($this->getOption('change_pwd_after'));
    //$password_default = $this->getOption('default_pwd');
    $block_attempt_count = intval($this->getOption('block_attempt_count'));    
    $block_period = intval($this->getOption('block_period'));
    
    
    
    // don't allow to sign in with an empty username
    if ($username)
    {
      if ($callable = sfConfig::get('app_sf_guard_plugin_retrieve_by_username_callable'))
      {
        $user = call_user_func_array($callable, array($username));
      } 
      else 
      {
        // Чтобы работала проверка на активность, должен быть метод retrieveByUsername в модели sfGuardUserTable
        $user = $this->getTable()->retrieveAnyByUsername($username);
      }
       
      // user exists?
      if($user)
      {         
        //echo $deactivate_after;
        //echo strtotime($user->getLastLogin()) + $deactivate_after;
        if ($user->getIsActive())
        {
          // Дективация с ошибкой валидации, если не пользовались аккаунтом некоторе время          
          if ($deactivate_after > 0 && $user->getLastLogin() && time() > strtotime($user->getLastLogin()) + $deactivate_after)
          {
            $user->setIsActive(false);
            $user->getProfile()->setForceChangePassword(true);
            $user->save();
            throw new sfValidatorError($this, 'deactivated');
          }
        }
        else        
        {
          // Ошибка валидации, если аккаунт неактивный
          //throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'deactivated')));
          throw new sfValidatorError($this, 'deactivated');
        }
                
        $user_profile = $user->getProfile();
        
        if ($block_period > 0 && $user_profile->getBlockedAt() && time() -  strtotime($user_profile->getBlockedAt()) < $this->getOption('block_period'))
        {
          throw new sfValidatorError($this, 'blocked');
        }

        $login_attempts = $user_profile->getLoginAttempts() + 1;
                              
        if ($block_attempt_count > 0 && $login_attempts > $block_attempt_count)
        {
          $user_profile->setLoginAttempts(0);
          $user_profile->setBlockedAt(date('Y-m-d H:i:s'));
          $user_profile->setForceChangePassword(true);
          $user_profile->save();
          throw new sfValidatorError($this, 'blocked');
        }
        else
        {
          $user_profile->setLoginAttempts($login_attempts);
          $user_profile->save();          
        }
               
        if ($user->checkPassword($password))
        {                                       
          // Если все хорошо, снимаем блок и обнуляем попытки входа
          $user_profile->setLoginAttempts(0);
          $user_profile->setBlockedAt(null);
          $user_profile->save();                        
          
          // Проверка срока годности пароля
          /*
          if ($change_pwd_after > 0)
          {
            sfContext::getInstance()->getUser()->setAttribute('check_password_expired', true);
          }
          */
          
          sfContext::getInstance()->getUser()->getAttributeHolder()->remove('change_password');
          
          sfContext::getInstance()->getUser()->setAttribute('check_change_password', true);

          /*
          if ($password_default !== false && $password_default == $password)
          {
            //sfContext::getInstance()->getUser()->setFlash('error', 'flash_password_change_default');
            //sfContext::getInstance()->getUser()->setAttribute('change_password', true);
            $user_profile->setForceChangePassword
          }
          */
          
          return array_merge($values, array('user' => $user));
        }
      }
    }

    if ($this->getOption('throw_global_error'))
    {
      throw new sfValidatorError($this, 'invalid');
    }

    throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));
  }

  protected function getTable()
  {
    return Doctrine::getTable('sfGuardUser');
  }
}
