<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardCustomFormSignin extends sfGuardFormSignin
{
  public function configure()
	{
    parent::configure();
		
		$this->setWidget('username', new sfWidgetFormInput(array(), array('maxlength' => 255, 'class' => 'InputText')));
		$this->setWidget('password', new sfWidgetFormInputPassword(array(), array('maxlength' => 128, 'class' => 'InputText')));
		
    
    // Продвинутая политика безопасности
    $user_options = sfContext::getInstance()->getUser()->getOptions();
    
    if (!empty($user_options['advanced_policy']['active']))
    {
      $user_advanced_policy = myUser::$advanced_policy_defaults['settings'];
      if (!empty($user_options['advanced_policy']['settings']))
      {
        $user_advanced_policy = array_merge($user_advanced_policy, $user_options['advanced_policy']['settings']);
      }
      
      $this->validatorSchema->setPostValidator(new magicValidatorUser(array(
        'change_pwd_after'    =>  $user_advanced_policy['change_pwd_after'],
        //'default_pwd'         =>  $user_advanced_policy['default_pwd'],
        'deactivate_after'    =>  $user_advanced_policy['deactivate_after'],
        'block_attempt_count' =>  $user_advanced_policy['block_attempt_count'],        
        'block_period'        =>  $user_advanced_policy['block_period'],
      )));
    }
        
    $this->widgetSchema['use_my_site'] = new sfWidgetFormInputCheckbox(array('default' => true));
        
    $this->validatorSchema['use_my_site'] = new sfValidatorBoolean();
   
  }
}
