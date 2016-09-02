<?php

class magicChangePasswordFilter extends sfFilter
{
  /**
   * Executes the filter chain.
   *
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
    if ($this->context->getUser()->isAuthenticated())
    {      
      // Продвинутая политика безопасности
      $user_options = $this->context->getUser()->getOptions();          
      if (!empty($user_options['advanced_policy']['active']))
      {
        $user_advanced_policy = myUser::$advanced_policy_defaults['settings'];
        if (!empty($user_options['advanced_policy']['settings']))
        {
          $user_advanced_policy = array_merge($user_advanced_policy, $user_options['advanced_policy']['settings']);
        } 
                
        if ($this->context->getUser()->getAttribute('check_change_password'))
        {
          if ($this->getContext()->getUser()->getProfile()->getForceChangePassword())
          {
            $password_default = $user_advanced_policy['default_pwd'];
            if ($password_default !== false && $this->context->getUser()->getGuardUser()->checkPassword($password_default))
            {
              $flash = 'flash_password_change_default';
            }
            else
            {
              $flash = 'flash_force_change_password';
            }
            $this->context->getUser()->setFlash('error', $flash);
            $this->context->getUser()->setAttribute('change_password', true);
          }
          else
          {            
            // Проверка срока годности пароля и его дефолтности
            $change_pwd_after = intval($user_advanced_policy['change_pwd_after']);
            if (!empty($change_pwd_after))
            {
              $passwords_history = Doctrine_Query::create()
                                    ->select('h.password, h.created_at, h.id')
                                    ->from('sfGuardUserPasswordHistory h')
                                    ->where('h.user_id = ?', $this->context->getUser()->getGuardUser()->getId())
                                    ->orderBy('h.created_at desc')
                                    ->limit(1)
                                    ->execute();
              
              // Дата создания последнего пароля в истории
              $password_created_at = $passwords_history[0]->getCreatedAt() ? strtotime($passwords_history[0]->getCreatedAt()) : strtotime($this->context->getUser()->getGuardUser()->getCreatedAt());
              $user_last_login = strtotime($this->context->getUser()->getGuardUser()->getLastLogin());

              if ($user_last_login - $password_created_at > $change_pwd_after)
              {
                $this->context->getUser()->setFlash('error', 'flash_password_expired');
                $this->context->getUser()->setAttribute('change_password', true);
                //$this->context->getController()->redirect('sf_guard_change_password');                
              }
            }
          }
          
          $this->context->getUser()->getAttributeHolder()->remove('check_change_password');
        }

        // Редирект на форму изменения пароля
        if ($this->context->getUser()->hasAttribute('change_password'))
        {
          if ($this->context->getRouting()->getCurrentRouteName() != 'sf_guard_change_password' && $this->context->getRouting()->getCurrentRouteName() != 'sf_guard_signout') 
          {                
            // Переустанавливаем флаш, если он пришел с валидатора
            /*
            if ($this->context->getUser()->hasFlash('error'))
            {
              $this->context->getUser()->setFlash('error', $this->context->getUser()->getFlash('error'));
            } 
            */
            $this->context->getUser()->getAttributeHolder()->remove('check_change_password');
            $this->context->getController()->redirect('sf_guard_change_password');                
          }
        }        
        
      }
    }
    $filterChain->execute();
  }
  
}

