<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorCSRFToken checks that the token is valid.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorCSRFToken.class.php 7902 2008-03-15 13:17:33Z fabien $
 */
class sfValidatorDPToken extends sfValidatorBase
{
  /**
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
    $this->setOption('required', true);
    $this->addRequiredOption('name');
    $this->addMessage('dp_attack', 'Double post detected.');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    $token = sfContext::getInstance()->getUser()->getAttribute($this->getOption('name'));
    sfContext::getInstance()->getUser()->getAttributeHolder()->remove($this->getOption('name'));
    /*vardump($token);
    vardump($value);
    vardump($this->getOption('name'));*/
    if ($value != $token)
    {
      throw new sfValidatorError($this, 'dp_attack');
    }

    return $value;
  }
}
