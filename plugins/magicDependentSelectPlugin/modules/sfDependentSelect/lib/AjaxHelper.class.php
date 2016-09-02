<?php

class AjaxHelper
{

  public function getChoices($value, $config)
  {
    $choices = array();
    $rootAlias = 'r';

    $query = Doctrine::getTable($config['model'])->createQuery($rootAlias);

    if ($config['related_column'])
    {
      $query->where($rootAlias . '.' . $config['related_column'] . ' = ?', $value);
    }

    if ($config['order_by'] && is_array($config['order_by']))
    {
      foreach ($config['order_by'] as $column => $direction)
      {
        $query->addOrderBy($rootAlias . '.' . $column . ' ' . $direction);
      }
    }

    $objects = $query->execute();

    $valueMethod = $config['value_method'];
    $keyMethod = $config['key_method'];

    if ($objects)
    {
      foreach ($objects as $object)
      {
        $choices['key_' . $object->$keyMethod()] = $object->$valueMethod();
      }
    }

    return $choices;
  }

}