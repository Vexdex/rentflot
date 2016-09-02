<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorEmail validates emails.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorEmail.class.php 22149 2009-09-18 14:09:53Z Kris.Wallsmith $
 */
class magicValidatorEmail extends sfValidatorRegex
{
  //const REGEX_EMAIL = '/^([^@\s]+)@(([-а-яa-z0-9]+\.)+[а-яa-z]{2,})$/iu';
  const REGEX_EMAIL = '/^([а-я\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[а-я\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([а-яa-z0-9]{1}[а-яa-z0-9\-]{0,62}[а-яa-z0-9]{1})|[а-яa-z])\.)+[а-яa-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/iu';
  /**
   * @see sfValidatorRegex
   */
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);

    $this->setOption('pattern', self::REGEX_EMAIL);
  }
}
