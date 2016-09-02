<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorInteger validates an integer. It also converts the input value to an integer.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorInteger.class.php 22018 2009-09-14 16:56:28Z fabien $
 */
class sfValidatorMagicCaptcha extends sfValidatorBase
{
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * max: The maximum value allowed
   *  * min: The minimum value allowed
   *
   * Available error codes:
   *
   *  * max
   *  * min
   *
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);
    $this->addMessage('invalid_captcha', 'Invalid captcha.');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {   
    $captcha = sfContext::getInstance()->getUser()->getAttribute('keystring');
		if ($captcha && $captcha == $value)	
    {
			sfContext::getInstance()->getUser()->setAttribute('keystring', null);
      return $value;
		} 
    else 
    {
      throw new sfValidatorError($this, 'invalid_captcha', array('value' => $value));
		}
  }
}
