<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Doctrine filter form generator.
 *
 * This class generates a Doctrine filter forms.
 *
 * @package    symfony
 * @subpackage generator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGenerator.class.php 27842 2010-02-10 19:42:03Z Kris.Wallsmith $
 */
class sfDoctrineMagicFormFilterGenerator extends sfDoctrineFormFilterGenerator
{

  /**
   * Returns a sfWidgetForm class name for a given column.
   *
   * @param  sfDoctrineColumn $column
   * @return string    The name of a subclass of sfWidgetForm
   */
  public function getWidgetClassForColumn($column)
  {
    switch ($column->getDoctrineType())
    {
      case 'boolean':
        $name = 'Choice';
        break;
      case 'date':
      case 'datetime':
      case 'timestamp':
        $name = 'MagicDateRange';
        break;
      case 'enum':
        $name = 'Choice';
        break;
      case 'string':
        $name = 'FilterInput';
        break;
      case 'float':
      case 'double':
      case 'decimal':
      case 'integer':      
        $name = 'MagicNumberRange';
        break;
      default:
        $name = 'FilterInput';
    }

    if ($column->isForeignKey())
    {
      $name = 'DoctrineChoice';
    }

    return sprintf('sfWidgetForm%s', $name);
  }

  /**
   * Returns a PHP string representing options to pass to a widget for a given column.
   *
   * @param  sfDoctrineColumn $column
   * @return string    The options to pass to the widget as a PHP string
   */
  public function getWidgetOptionsForColumn($column)
  {
  
    $options = array();

    $withEmpty = $column->isNotNull() && !$column->isForeignKey() ? array("'with_empty' => false") : array();
    switch ($column->getDoctrineType())
    {
      case 'string':
        $options[] = "'with_empty' => false";
      break;
      case 'boolean':
        $options[] = "'choices' => array('' =>sfContext::getInstance()->getI18N()->__('not_selected', array(), 'common'), 1 => sfContext::getInstance()->getI18N()->__('yes', array(), 'common'), 0 => sfContext::getInstance()->getI18N()->__('no', array(), 'common'))";
        
        break;      
      case 'float':
      case 'double':
      case 'decimal':
      case 'integer':      
        if (!$column->isForeignKey()) {
          $options[] = "
            'from_number' => new sfWidgetFormInput(), 
            'to_number' => new sfWidgetFormInput(), 
            'with_empty' => false";
        }
        break;      
      case 'date':
      case 'datetime':
      case 'timestamp':
        //$options[] = "'from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate()";
        $options[] = "
          'from_date' => new sfWidgetFormMagicJQueryDate(array(	            
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture())),			
          'to_date' => new sfWidgetFormMagicJQueryDate(array(	  
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture()))";        
        //$options = array_merge($options, $withEmpty);
        break;
      case 'enum':
        $values = array('' => '');
        $values = array_merge($values, $column['values']);
        $values = array_combine($values, $values);
        $options[] = "'choices' => ".$this->arrayExport($values);
        break;
      default:
        $options = array_merge($options, $withEmpty);
    }

    if ($column->isForeignKey())
    {
      $options[] = sprintf('\'model\' => $this->getRelatedModelName(\'%s\'), \'add_empty\' => true', $column->getRelationKey('alias'));
    }

    return count($options) ? sprintf('array(%s)', implode(', ', $options)) : '';
  }

  /**
   * Returns a sfValidator class name for a given column.
   *
   * @param  sfDoctrineColumn $column
   * @return string    The name of a subclass of sfValidator
   */
  public function getValidatorClassForColumn($column)
  {
    switch ($column->getDoctrineType())
    {
      case 'boolean':
        $name = 'Choice';
        break;
      case 'float':
      case 'double':
      case 'decimal':
      case 'integer':
        //$name = 'Integer';
        $name = 'MagicNumberRange';
        break;  
      case 'date':
      case 'datetime':
      case 'timestamp':
        $name = 'DateRange';
        break;
      case 'enum':
        $name = 'Choice';
        break;
      default:
        $name = 'Pass';
    }

    if ($column->isPrimarykey() || $column->isForeignKey())
    {
      $name = 'DoctrineChoice';
    }

    return sprintf('sfValidator%s', $name);
  }

  /**
   * Returns a PHP string representing options to pass to a validator for a given column.
   *
   * @param  sfDoctrineColumn $column
   * @return string    The options to pass to the validator as a PHP string
   */
  public function getValidatorOptionsForColumn($column)
  {
    $options = array('\'required\' => false');

    if ($column->isForeignKey())
    {
      $columns = $column->getForeignTable()->getColumns();
      foreach ($columns as $name => $col)
      {
        if (isset($col['primary']) && $col['primary'])
        {
          break;
        }
      }

      $options[] = sprintf('\'model\' => $this->getRelatedModelName(\'%s\'), \'column\' => \'%s\'', $column->getRelationKey('alias'), $column->getForeignTable()->getFieldName($name));
    }
    else if ($column->isPrimaryKey())
    {
      $options[] = sprintf('\'model\' => \'%s\', \'column\' => \'%s\'', $this->table->getOption('name'), $column->getFieldName());
    }
    else
    {
      switch ($column->getDoctrineType())
      {
        case 'integer':
          $options[] = "'from_number' => new sfValidatorInteger(array('required' => false)), 'to_number' => new sfValidatorInteger(array('required' => false))";
          break;       
        case 'decimal':        
        case 'float':
        case 'double':
          $options[] = "'from_number' => new sfValidatorNumber(array('required' => false)), 'to_number' => new sfValidatorNumber(array('required' => false))";
          break;
      
        case 'boolean':
          $options[] = "'choices' => array('', 1, 0)";
          break;
        case 'date':
          $options[] = "'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false))";
          break;
        case 'datetime':
        case 'timestamp':
          $options[] = "'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59'))";
          break;
        case 'enum':
          $values = array_combine($column['values'], $column['values']);
          $options[] = "'choices' => ".$this->arrayExport($values);
          break;
      }
    }

    return count($options) ? sprintf('array(%s)', implode(', ', $options)) : '';
  }
  
  
  public function getType($column)
  {
    if ($column->isForeignKey())
    {
      return 'ForeignKey';
    }
  
    switch ($column->getDoctrineType())
    {
      case 'enum':
        return 'Enum';
      case 'boolean':
        return 'Boolean';
      case 'date':
      case 'datetime':
      case 'timestamp':
        return 'Date';
      case 'float':
      case 'double':
      case 'decimal':
      case 'integer':  
        return 'Number';
      default:
        return 'Text';
    }
  }  
  
}
