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
class sfValidatorCaptcha extends sfValidatorBase
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
    $this->setOption('required', false);
    $this->setOption('empty_value', false);
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {

    //vardump($value);
		if (sfContext::getInstance()->getUser()->getAttribute('keystring') &&  sfContext::getInstance()->getUser()->getAttribute('keystring') == $value)	{
			return true;
		} else {
				throw new sfValidatorError($this, 'invalid', array('value' => $value));
				return false;
			}
  }
}
