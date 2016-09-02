<?php

class sfDependentSelectHelper
{
  static public function getConfig($configName)
  {
    $configDefaults = sfConfig::get('app_magicDependentSelectPlugin_defaults', array());
    $config = sfConfig::get('app_magicDependentSelectPlugin_' . $configName, array());

    if (!$config)
    {
      return array();
    }

    return sfToolkit::arrayDeepMerge($configDefaults, $config);
  }

  static public function getChoices($value, $configName, $keyPrefix = 'key_')
  {
    $choices = array();
    $config = self::getConfig($configName);

    if (!$config)
    {
      return array();
    }

    $valueMethod = $config['value_method'];
    $keyMethod = $config['key_method'];

    $rootAlias = 'r';
    $query = Doctrine::getTable($config['model'])->createQuery($rootAlias);

    if ($config['related_column'])
    {
      $query->where($rootAlias . '.' . $config['related_column'] . ' = ?', $value);
    }

    if ($config['order_by'])
    {
      foreach ((array)$config['order_by'] as $column => $direction)
      {
        if (!in_array($direction, array('asc', 'desc')))
        {
          $direction = 'asc';
        }

        $query->addOrderBy($rootAlias . '.' . $column . ' ' . $direction);
      }
    }

    $objects = $query->execute();

    if ($objects)
    {
      foreach ($objects as $object)
      {
        $choices[$keyPrefix . $object->$keyMethod()] = $object->$valueMethod();
      }
    }

    return $choices;
  }
}