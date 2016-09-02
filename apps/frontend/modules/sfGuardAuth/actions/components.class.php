<?php
 
class sfGuardAuthComponents extends sfComponents
{
 
  public function executeHomePageSigninForm($request)
  {
    $this->home_page_signin_form = new sfGuardCustomFormSignin();   
	}
}