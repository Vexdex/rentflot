<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorString validates a string. It also converts the input value to a string.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorString.class.php 12641 2008-11-04 18:22:00Z fabien $
 */
class magicValidatorPassword extends sfValidatorBase
{
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * max_length: The maximum length of the string
   *  * min_length: The minimum length of the string
   *
   * Available error codes:
   *
   *  * max_length
   *  * min_length
   *
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorBase
   */
  
  const LOWERCASE_CHARS  =   'абвгґдеёєжзиіїйклмнопрстуфхцчшщыъьэюяabcdefghijklmnopqrstuvwxyz';
  const UPPERCASE_CHARS  =   'АБВГҐДЕЁЄЖЗИІЇЙКЛМНОПРСТУФХЦЧШЩЫЪЬЭЮЯABCDEFGHIJKLMNOPQRSTUVWXYZ';
  const SPECIAL_CHARS    =   '~!@#$%^&*()_+=`[]{}|\/?,.<>:;\'"';
  const NUMBERS          =   '0123456789';
  
  
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('max_length', '"%value%" is too long (%max_length% %characters% max).');
    $this->addMessage('min_length', '"%value%" is too short (%min_length% %characters% min).');
    $this->addMessage('unique', 'error_unique');
    $this->addMessage('complex', 'error_complex');    
    $this->addMessage('password_default', 'error_password_default');
    
    
    $this->addOption('max_length');
    $this->addOption('min_length');
    
    $this->addOption('require_lowercase');         
    $this->addOption('require_uppercase');         
    $this->addOption('require_spec_chars');         
    $this->addOption('require_numbers');         
    $this->addOption('default_pwd');     
    $this->addOption('history_length');     

    
    //$this->addOption('unique', false);
    $this->addOption('user_id', false);
    $this->addOption('hide_errors', false);

    $this->setOption('empty_value', '');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {    
    $user_id = $this->getOption('user_id');
    $history_length = intval($this->getOption('history_length'));     
    $password_default = $this->getOption('default_pwd');     
    $require_lowercase = $this->getOption('require_lowercase');
    $require_uppercase = $this->getOption('require_uppercase');
    $require_spec_chars = $this->getOption('require_spec_chars');
    $require_numbers = $this->getOption('require_numbers');
    
    //$clean = parent::doClean($value);
    
    $clean = (string) $value;

    // Проверка пароля на дефолтность
    if ($password_default !== false && $password_default == $clean)
    {
      throw new sfValidatorError($this, 'password_default', array('value' => $value));
    }
    
    // Проверка пароля на максимальную и минимальную длину
    $length = function_exists('mb_strlen') ? mb_strlen($clean, $this->getCharset()) : strlen($clean);
    if ($this->hasOption('max_length') && $length > $this->getOption('max_length') && !$this->getOption('hide_errors'))
    {
      throw new sfValidatorError($this, 'max_length', array('value' => $value, 'max_length' => $this->getOption('max_length'), 'characters' => plural_form($this->getOption('max_length'), array(sfContext::getInstance()->getI18n()->__('characters_plural_1', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_2', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_3', null, 'grid')))));
    }
    if ($this->hasOption('min_length') && $length < $this->getOption('min_length') && !$this->getOption('hide_errors'))
    {
      throw new sfValidatorError($this, 'min_length', array('value' => $value, 'min_length' => $this->getOption('min_length'), 'characters' => plural_form($this->getOption('min_length'), array(sfContext::getInstance()->getI18n()->__('characters_plural_1', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_2', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_3', null, 'grid')))));
    }    
    
    // Проверка пароля на уникальность
    if ($history_length > 0 && $user_id)
    {    
      $guard_user = Doctrine::getTable('sfGuardUser')->findOneById($user_id);            
      $algorithm = $guard_user->getAlgorithm();
      $salt = $guard_user->getSalt();                        
        
      //echo $salt;
      $passwort_crypt = call_user_func_array($algorithm, array($salt.$clean));
        
      $passwords_history_count = Doctrine_Query::create()
                                   ->from('sfGuardUserPasswordHistory h')
                                   ->where('h.user_id = ?', $user_id)
                                   ->andWhere('h.password = ?', $passwort_crypt)
                                   ->orderBy('h.created_at desc')
                                   ->limit($history_length)
                                   ->count();


      if ($passwords_history_count > 0)
      {
        if (!$this->getOption('hide_errors'))
        {
          throw new sfValidatorError($this, 'unique');
        }
        else
        {
          return ;
        }
      }
    }
        
    // Проверка пароля на сложность
    $password_length = strlen($clean);        
    $has_lowercase_chars = false;
    $has_uppercase_chars = false;
    $has_special_chars = false;
    $has_numbers = false;
    
    for($i=0; $i<$password_length; $i++)
    {
      if (!$has_lowercase_chars && strpos(self::LOWERCASE_CHARS, $clean[$i]) !== false) 
      {
        $has_lowercase_chars = true;
      }
      
      if (!$has_uppercase_chars && strpos(self::UPPERCASE_CHARS, $clean[$i]) !== false) 
      {
        $has_uppercase_chars = true;
      }
      
      if (!$has_special_chars && strpos(self::SPECIAL_CHARS, $clean[$i]) !== false) 
      {
        $has_special_chars = true;
      }
      
      if (!$has_numbers && strpos(self::NUMBERS, $clean[$i]) !== false) 
      {
        $has_numbers = true;
      }
    }
      
    if ((($require_lowercase && !$has_lowercase_chars) || 
        ($require_uppercase && !$has_uppercase_chars) ||
        ($require_spec_chars && !$has_special_chars) ||
        ($require_numbers && !$has_numbers)) && !$this->getOption('hide_errors'))
    {
      
      // Формирование текста ошибки на сложность пароля
      $complex_rules = array();
      if ($require_lowercase)
      {
        $complex_rules[] = sfContext::getInstance()->getI18n()->__('require_lowercase_text', null, 'auth');
      }
      
      if ($require_uppercase)
      {
        $complex_rules[] = sfContext::getInstance()->getI18n()->__('require_uppercase_text', null, 'auth');
      }
      
      if ($require_spec_chars)
      {
        $complex_rules[] = sfContext::getInstance()->getI18n()->__('require_spec_chars_text', null, 'auth');
      }

      if ($require_numbers)
      {
        $complex_rules[] = sfContext::getInstance()->getI18n()->__('require_numbers_text', null, 'auth');
      }
      
      $complex_rules_text = implode(', ', $complex_rules);
      
      throw new sfValidatorError($this, 'complex', array('complex_rules_text' => $complex_rules_text));
    }    
    
    return $clean;
  }
}
