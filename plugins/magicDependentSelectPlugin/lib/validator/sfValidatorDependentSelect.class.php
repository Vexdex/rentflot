<?php

/*
 * Post validator
 *
 *  Example:
 *
 *
 *  $validator1 = new sfValidatorDependentSelect(array(
      'field' => $this['department_id'],
      'depends' => $this['direction_id'],
      'config_name' => 'direction_departments',
    ));

    $this->mergePostValidator(new sfValidatorAnd(array($validator1, $validator2, $validatorN)));
 */


class sfValidatorDependentSelect extends sfValidatorBase
{

  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);

    $this->addRequiredOption('config_name');
    $this->addRequiredOption('field');
    $this->addRequiredOption('depends');
  }
   
  protected function doClean($values)
  {
    $dependsFieldName = $this->getOption('depends') instanceof sfFormField ? $this->getOption('depends')->getName() : (string)$this->getOption('depends');
    $fieldName = $this->getOption('field') instanceof sfFormField ? $this->getOption('field')->getName() : (string)$this->getOption('field');

    if ($this->getOption('required') === false && (empty($values[$dependsFieldName]) || empty($values[$fieldName])))
    {
      return $values;
    }

    if (!isset($values[$dependsFieldName]) || !isset($values[$fieldName]))
    {
      throw new sfValidatorErrorSchema($this, array($fieldName => new sfValidatorError($this, 'invalid', array())));
    }

    $ids = array_keys(sfDependentSelectHelper::getChoices($values[$dependsFieldName], $this->getOption('config_name'), false));

    if (!in_array($values[$fieldName], $ids))
    {
      throw new sfValidatorErrorSchema($this, array($fieldName => new sfValidatorError($this, 'invalid', array())));
    }

    return $values;
  }

}
