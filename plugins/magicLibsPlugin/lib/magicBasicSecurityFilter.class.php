<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004-2006 Sean Kerr <sean@code-box.org>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfBasicSecurityFilter checks security by calling the getCredential() method
 * of the action. Once the credential has been acquired, sfBasicSecurityFilter
 * verifies the user has the same credential by calling the hasCredential()
 * method of SecurityUser.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Sean Kerr <sean@code-box.org>
 * @version    SVN: $Id: sfBasicSecurityFilter.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class magicBasicSecurityFilter extends sfBasicSecurityFilter
{
  
  /**
   * Forwards the current request to the secure action.
   *
   * @throws sfStopException
   */
  protected function forwardToSecureAction()
  {       
    $params = array();
    if (sfConfig::get('sf_secure_route'))
    {
      if ($this->getContext()->getRouting()->getCurrentRouteName() != 'sf_guard_signout')
      {
        $params = array('continue' =>  $this->getContext()->getRequest()->getUri());
      }    
      $this->redirect($this->getContext()->getRouting()->generate(sfConfig::get('sf_secure_route'), $params, true));
    }
    else
    {
      $this->context->getController()->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }
    
    throw new sfStopException();
  }

  /**
   * Forwards the current request to the login action.
   *
   * @throws sfStopException
   */
  protected function forwardToLoginAction()
  {
    if (sfConfig::get('sf_login_route'))
    {
      $params = array();
      if ($this->getContext()->getRouting()->getCurrentRouteName() != 'sf_guard_signout')
      {
        $params = array('continue' =>  $this->getContext()->getRequest()->getUri());
      }      
      $this->getContext()->getController()->redirect($this->getContext()->getRouting()->generate(sfConfig::get('sf_login_route'), $params, true));
    }
    else
    {
      $this->context->getController()->forward(sfConfig::get('sf_login_module'), sfConfig::get('sf_login_action'));
    }
    
    throw new sfStopException();
  }

}
