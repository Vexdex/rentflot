<?php

class magicValidatorReadOnly extends sfValidatorBase
{
  /**
   * Configures the current validator
   * 
   * Available options (required):
   *
   *  * object: The current form object
   *  * field:  The current form field
   *
   * Available error codes:
   *
   * * changed
   *
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorBase
   **/
  protected function configure($options = array(), $messages = array())
  {
    $this->addRequiredOption('object');
    $this->addRequiredOption('field');
 
    $this->addMessage('changed', 'readonly_field');
  }
 
  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    // Ok, we could just reset the value, but it's so more fun this way
    $object = $this->getOption('object');
    if ($value != $object->get($this->getOption('field')))
    {
      throw new sfValidatorError($this, 'changed');
    }
 
    return (string) $value;
  }
}
