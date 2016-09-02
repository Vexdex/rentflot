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
class sfValidatorMagicString extends sfValidatorString
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
  protected function configure($options = array(), $messages = array())
  {
    parent::configure();

    $this->addMessage('allow_chars', 'Chars are not allowed.');
    $this->addOption('allow_chars');
    $this->addOption('exact_length');
    
    
    $this->addMessage('max_length', '"%value%" is too long (%max_length% %characters% max).');
    $this->addMessage('min_length', '"%value%" is too short (%min_length% %characters% min).');
    
    $this->addMessage('exact_length', 'exact_length');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {    
    // Надстройка для валидатора. Если валидатор установлен для фильтров  - в этом случае $value приходит массивом и должно возвращатся тоже массивом.
    $return_array = false;
    if (is_array($value) && isset($value['text']))
    {
      $value = $value['text'];
      $return_array = true;
    }
    // --------------------------
    
    $clean = (string) $value;
    
    $length = function_exists('mb_strlen') ? mb_strlen($clean, $this->getCharset()) : strlen($clean);
    
    $exact_length = $this->getOption('exact_length');
    
    if ($exact_length && $length != $exact_length)
    {
      throw new sfValidatorError($this, 'exact_length', array('value' => $value, 'exact_length' => $this->getOption('exact_length'), 'characters' => plural_form($this->getOption('exact_length'), array(sfContext::getInstance()->getI18n()->__('characters_plural_1', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_2', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_3', null, 'grid')))));
    }
    

    if ($this->hasOption('max_length') && $length > $this->getOption('max_length'))
    {
      throw new sfValidatorError($this, 'max_length', array('value' => $value, 'max_length' => $this->getOption('max_length'), 'characters' => plural_form($this->getOption('max_length'), array(sfContext::getInstance()->getI18n()->__('characters_plural_1', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_2', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_3', null, 'grid')))));
    }

        
    if ($this->hasOption('min_length') && $length < $this->getOption('min_length'))
    {
      throw new sfValidatorError($this, 'min_length', array('value' => $value, 'min_length' => $this->getOption('min_length') , 'characters' => plural_form($this->getOption('min_length'), array(sfContext::getInstance()->getI18n()->__('characters_plural_1', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_2', null, 'grid'), sfContext::getInstance()->getI18n()->__('characters_plural_3', null, 'grid')))));
    }

    $allow_chars = $this->getOption('allow_chars');
        
    if (!empty($allow_chars))
    {       
       for($i=0; $i<$length; $i++)
       {
          if (strpos($allow_chars, $clean[$i]) === false)
          {
            //echo $clean[$i];
            throw new sfValidatorError($this, 'allow_chars');
          }        
       }      
    }    
    
    return $return_array ? array('text' => $clean) : $clean;
  }
}
