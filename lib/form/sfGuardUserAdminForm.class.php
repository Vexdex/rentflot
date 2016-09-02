<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */

  public function configure()
  {
		parent::configure();

    unset($this['email_address'], $this['first_name'], $this['last_name']);
        
    $user = sfContext::getInstance()->getUser();
    $user_options = $user->getOptions();    
 
    $validator_username = new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username')));
    $validator_username->setMessage('invalid', 'Username is already exist.');
    $this->validatorSchema->setPostValidator($validator_username);    

    if (!$user->getGuardUser()->getIsSuperAdmin())
    {
      unset($this['is_super_admin']);
    }
    
    $this->profile_form = new sfGuardUserProfileForm($this->getObject()->getProfile());
       
    $this->profile_form->validatorSchema['email'] = new magicValidatorEmail(array('required' => true));
    
    unset($this->profile_form['user_id'], $this->profile_form['sf_guard_user_id'], $this->profile_form['validate'], $this->profile_form['force_change_password']);
    $this->embedForm('Profile', $this->profile_form);

    $this->widgetSchema['groups_list'] = new sfWidgetFormDoctrineChoice(array(
		  'model' => 'sfGuardGroup',
			'query' => Doctrine::getTable('sfGuardGroup')->createQuery('g'),
      'add_empty' => true      
    ));		

    $this->widgetSchema['permissions_list'] = new sfWidgetFormDoctrineChoice(array(
		  'model' => 'sfGuardPermission',
      'multiple' => true,
      'expanded' => true,
			'query' => Doctrine::getTable('sfGuardPermission')->createQuery('o'))
		);		
  
    
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
        'required'            =>  false,        
      ));

      
      $this->validatorSchema['password_again'] = new magicValidatorPassword(array(
        //'min_length'          => $user_advanced_policy['pwd_min_length'],
        'max_length'          => 128,         
        'hide_errors'         => true,
        'required'            => false
      ));

      if (intval($user_advanced_policy['pwd_min_length']) > 0) 
      {
        $this->validatorSchema['password']->addOption('min_length', intval($user_advanced_policy['pwd_min_length']));
        $this->validatorSchema['password_again']->addOption('min_length', intval($user_advanced_policy['pwd_min_length']));
      }
      
      if (!$this->isNew())
      {
        $this->validatorSchema['password']->addOption('history_length', $user_advanced_policy['pwd_history_length']);      
        $this->validatorSchema['password']->addOption('user_id', $this->getObject()->getId());      
        
        $this->validatorSchema['password_again']->addOption('history_length', $user_advanced_policy['pwd_history_length']);      
        $this->validatorSchema['password_again']->addOption('user_id', $this->getObject()->getId()); 
      }

      $this->mergePostValidator(new magicPasswordValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));      
    }
    else
    {
      $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));
    }
    
    //$this->validatorSchema->setPostValidator(new sfGuardValidatorUser());    
  }
	

  public function save($con = null)
	{
    $user = sfContext::getInstance()->getUser();
    $user_options = $user->getOptions();    
          
    $user = parent::save($con);
    
    if (!empty($user_options['advanced_policy']['active']))
    {
      $user_advanced_policy = myUser::$advanced_policy_defaults['settings'];
      if (!empty($user_options['advanced_policy']['settings']))
      {
        $user_advanced_policy = array_merge($user_advanced_policy, $user_options['advanced_policy']['settings']);
      }
      
      if ($this->isNew() || !$user->getIsActive())
      {
        $user_profile = $user->getProfile();
        $user_profile->setForceChangePassword(true);
        $user_profile->save();
      }
            
      if ($user_advanced_policy['default_pwd'] !== false && !$user->getPassword())
      {
        $user->setPassword($user_advanced_policy['default_pwd']);
        $user->save();
      }
      
      $password = $this->getValue('password');
      if ((intval($user_advanced_policy['pwd_history_length']) > 0 || intval($user_advanced_policy['change_pwd_after']) > 0) && $password)
      {
        $algorithm = $user->getAlgorithm();
        $salt = $user->getSalt();                
        $passwort_crypt = call_user_func_array($algorithm, array($salt.$password));
        
        $user_pwd_history = new sfGuardUserPasswordHistory();
        $user_pwd_history->setUserId($user->getId());
        $user_pwd_history->setPassword($passwort_crypt);
        $user_pwd_history->save();      
      }
    }
    return $user;
  }
	
}
