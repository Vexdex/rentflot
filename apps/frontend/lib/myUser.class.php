<?php

class myUser extends sfGuardSecurityUser
{
  public static $advanced_policy_defaults = array(
    'active'   =>   1,
    'settings' =>   array(
                      'deactivate_after'       =>   2592000,
                      'can_change_own_pwd'     =>   1,
                      'change_pwd_after'       =>   5184000,
                      'pwd_min_length'         =>   8,
                      'pwd_require_numbers'    =>   1,
                      'pwd_require_lowercase'  =>   1,
                      'pwd_require_uppercase'  =>   1,
                      'pwd_require_spec_chars' =>   1,
                      'pwd_history_length'     =>   4,
                      'block_attempt_count'    =>   5,
                      'block_period'           =>   300,
                      'default_pwd'            =>   1
                    )
    );
  
  public function hasCredential($credentials, $useAnd = true)
  {
    //$credentials = is_array($credentials) ? $credentials : array($credentials);
    if ($credentials == 'GOD' || (is_array($credentials) && in_array('GOD', $credentials)))
    {
      return false;
    }
    //echo 1;
    return parent::hasCredential($credentials, $useAnd);
  }
  
  public function isFirstRequest($boolean = null)
  {
    if (is_null($boolean))  {
      return $this->getAttribute('first_request', true);
    }
    $this->setAttribute('first_request', $boolean);
  }

  public function getNextRedirect($remove = true)
  {    
    return $remove ? $this->getAttributeHolder()->remove('next_redirect', '@homepage') : 
      $this->getAttribute('next_redirect', '@homepage');
  }
 
  public function setNextRedirect($route)
  {
    $this->setAttribute('next_redirect', $route);
  }
 
}
