<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorNumber validates a number (integer or float). It also converts the input value to a float.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorNumber.class.php 22018 2009-09-14 16:56:28Z fabien $
 */
class magicValidatorInteger extends sfValidatorInteger
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

  /**
   * @see sfValidatorBase
   */
  
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);
    
    $this->addOption('greater_than');
    $this->addOption('less_than');
    
    $this->addMessage('greater_than', 'Value must be greater than %greater_than%.');
    $this->addMessage('less_than', 'Value must be less than %less_than%.');
    
  }
    
  protected function doClean($value)
  {   
    $clean = parent::doClean($value);
    
    
    if ($this->hasOption('greater_than') && $clean <= $this->getOption('greater_than'))
    {
      throw new sfValidatorError($this, 'greater_than', array('value' => $value, 'greater_than' => $this->getOption('greater_than')));
    }

    if ($this->hasOption('less_than') && $clean >= $this->getOption('less_than'))
    {
      throw new sfValidatorError($this, 'less_than', array('value' => $value, 'less_than' => $this->getOption('less_than')));
    }

    return $clean;
  }
  
}
