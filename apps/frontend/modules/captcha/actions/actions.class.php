<?php

/**
 * captcha actions.
 *
 * @package    megapolis
 * @subpackage captcha
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class captchaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    include(sfConfig::get('sf_lib_dir').'/vendor/kcaptcha/kcaptcha.php');
		$captcha = new KCAPTCHA();
		//vardump($captcha->getKeyString().'111');
		$this->getUser()->setAttribute('keystring', $captcha->getKeyString());

    $response = $this->getResponse();
    $response->addMeta('description', "Rentflot");
    $response->addMeta('keywords', "Rentflot");
    $response->setTitle("Rentflot");
    $this->getContext()->setH1("Rentflot");
  }
}
