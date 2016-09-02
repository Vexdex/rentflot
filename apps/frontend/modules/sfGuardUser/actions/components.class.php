<?php
 
class sfGuardUserComponents extends sfComponents
{
 
  public function executeUserProfile($request)
  {		
		//$this->profile_form = new sfGuardUserAdminForm();
		//unset($this->form['user_id'], $this->form['sf_guard_user_id'], $this->form['validate']);
  }

  public function executePasswordComplexity($request)
  {		
    $user = sfContext::getInstance()->getUser();
    $user_options = $user->getOptions(); 
    // Продвинутая политика безопасности
    $this->password_complexity = array();
    if (!empty($user_options['advanced_policy']['active']))
    {
      $user_advanced_policy = myUser::$advanced_policy_defaults['settings'];
      if (!empty($user_options['advanced_policy']['settings']))
      {
        $user_advanced_policy = array_merge($user_advanced_policy, $user_options['advanced_policy']['settings']);
      }
    
      $this->password_complexity = array(  
        'require_numbers'     =>  $user_advanced_policy['pwd_require_numbers'],
        'require_lowercase'   =>  $user_advanced_policy['pwd_require_lowercase'],
        'require_uppercase'   =>  $user_advanced_policy['pwd_require_uppercase'],
        'require_spec_chars'  =>  $user_advanced_policy['pwd_require_spec_chars'],
        'history_length'      =>  $user_advanced_policy['pwd_history_length'],
        'pwd_min_length'      => $user_advanced_policy['pwd_min_length']
      );
    }    
  }
}