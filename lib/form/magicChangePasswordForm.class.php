<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class magicChangePasswordForm extends sfForm
{
  /**
   * @see sfForm
   */
  //private $
  
  public function configure()
  {
    parent::configure();

    $user_options = sfContext::getInstance()->getUser()->getOptions();    
    
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();  
    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();

    // Продвинутая политика безопасности
    if (!empty($user_options['advanced_policy']['active']))
    {
      $user_advanced_policy = myUser::$advanced_policy_defaults['settings'];
      if (!empty($user_options['advanced_policy']['settings']))
      {
        $user_advanced_policy = array_merge($user_advanced_policy, $user_options['advanced_policy']['settings']);
      }                  
    
      $this->validatorSchema['password'] = new magicValidatorPassword(array(
        'max_length'          =>  128,         
        'require_numbers'     =>  $user_advanced_policy['pwd_require_numbers'],
        'require_lowercase'   =>  $user_advanced_policy['pwd_require_lowercase'],
        'require_uppercase'   =>  $user_advanced_policy['pwd_require_uppercase'],
        'require_spec_chars'  =>  $user_advanced_policy['pwd_require_spec_chars'],
        'history_length'      =>  $user_advanced_policy['pwd_history_length'],
        'default_pwd'         =>  $user_advanced_policy['default_pwd'],
        'user_id'             =>  sfContext::getInstance()->getUser()->getGuardUser()->getId(),  
        'required'            =>  true,        
      ));

      $this->validatorSchema['password_again'] = new magicValidatorPassword(array(
        'max_length'          =>  128,         
        'hide_errors'         =>  true,
        'user_id'             =>  sfContext::getInstance()->getUser()->getGuardUser()->getId(),  
        'required'            =>  true,        
      ));

      if (intval($user_advanced_policy['pwd_min_length']) > 0) 
      {
        $this->validatorSchema['password']->addOption('min_length', intval($user_advanced_policy['pwd_min_length']));
        $this->validatorSchema['password_again']->addOption('min_length', intval($user_advanced_policy['pwd_min_length']));
      }

      
      $this->mergePostValidator(new magicPasswordValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));
    }
    else
    {
      $this->validatorSchema['password'] = new sfValidatorString(array('max_length' => 128));
      $this->validatorSchema['password_again'] = new sfValidatorString(array('max_length' => 128));
      $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));
    }
    
    $this->widgetSchema->setNameFormat('sf_guard_user[%s]');
    
    //$this->validatorSchema->setPostValidator(new sfGuardValidatorUser());    
  }
	
}
