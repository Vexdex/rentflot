<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) Jonathan H. Wage <jonwage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Doctrine form generator.
 *
 * This class generates a Doctrine forms.
 *
 * @package    symfony
 * @subpackage generator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGenerator.class.php 29661 2010-05-28 16:56:42Z Kris.Wallsmith $
 */
class sfDoctrineMagicFormGenerator extends sfDoctrineFormGenerator
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
      case 'string':
        $widgetSubclass = null === $column->getLength() || $column->getLength() > 255 ? 'Textarea' : 'InputText';
        break;
      case 'boolean':
        $widgetSubclass = 'InputCheckbox';
        break;
      case 'blob':
      case 'clob':
        $widgetSubclass = 'Textarea';
        break;
      
      case 'time':
      case 'timestamp':
      case 'date':
        $widgetSubclass = 'MagicJQueryDate';
        break;
      /*
      case 'time':
        $widgetSubclass = 'Time';
        break;
      case 'timestamp':
        $widgetSubclass = 'DateTime';
        break;
      */ 
      case 'enum':
        $widgetSubclass = 'Choice';
        break;       
        
      case 'float':
      case 'decimal':
      case 'double':
        $widgetSubclass = 'MagicInputText';
        break;
        
      default:
        $widgetSubclass = 'InputText';
    }

    if ($column->isPrimaryKey())
    {
      $widgetSubclass = 'InputHidden';
    }
    else if ($column->isForeignKey())
    {
      $widgetSubclass = 'DoctrineChoice';
    }

    return sprintf('sfWidgetForm%s', $widgetSubclass);
  }

  /**
   * Returns a PHP string representing options to pass to a widget for a given column.
   *
   * @param sfDoctrineColumn $column
   * 
   * @return string The options to pass to the widget as a PHP string
   */
  public function getWidgetOptionsForColumn($column)
  {
    $options = array();

    if ($column->isForeignKey())
    {
      $options[] = sprintf('\'model\' => $this->getRelatedModelName(\'%s\'), \'add_empty\' => %s', $column->getRelationKey('alias'), $column->isNotNull() ? 'false' : 'true');
    }
    else if ('enum' == $column->getDoctrineType() && is_subclass_of($this->getWidgetClassForColumn($column), 'sfWidgetFormChoiceBase'))
    {
      $options[] = '\'choices\' => '.$this->arrayExport(array_combine($column['values'], $column['values']));
    }

    switch ($column->getDoctrineType())
    {
      case 'date':
      case 'datetime':
      case 'timestamp':
			$options[] = "
        'date_widget' => new sfWidgetFormMagicDate(),
        'config' => '{changeYear: true, changeMonth: true}',
        'culture' => sfContext::getInstance()->getUser()->getCulture()";      
      break;
    }
    
    return count($options) ? sprintf('array(%s)', implode(', ', $options)) : '';
  }

  /**
   * Returns a sfValidator class name for a given column.
   *
   * @param sfDoctrineColumn $column
   * @return string    The name of a subclass of sfValidator
   */
  public function getValidatorClassForColumn($column)
  {
    switch ($column->getDoctrineType())
    {
      case 'boolean':
        $validatorSubclass = 'Boolean';
        break;
      case 'string':
    		if ($column->getDefinitionKey('email'))
    		{
    		  $validatorSubclass = 'Email';
    		}
    		else if ($column->getDefinitionKey('regexp'))
    		{
    		  $validatorSubclass = 'Regex';
    		}
    		else
    		{
    		  $validatorSubclass = 'MagicString';
    		}
        break;
      case 'clob':
      case 'blob':
        $validatorSubclass = 'MagicString';
        break;
      case 'float':
      case 'decimal':
      case 'double':
        $validatorSubclass = 'Number';
        break;
      case 'integer':
        $validatorSubclass = 'Integer';
        break;
      case 'date':
        $validatorSubclass = 'Date';
        break;
      case 'time':
        $validatorSubclass = 'Time';
        break;
      case 'timestamp':
        $validatorSubclass = 'DateTime';
        break;
      case 'enum':
        $validatorSubclass = 'Choice';
        break;
      default:
        $validatorSubclass = 'Pass';
    }

    if ($column->isForeignKey())
    {
      $validatorSubclass = 'DoctrineChoice';
    }
    else if ($column->isPrimaryKey())
    {
      $validatorSubclass = 'Choice';
    }

    return sprintf('sfValidator%s', $validatorSubclass);
  }

  /**
   * Returns a PHP string representing options to pass to a validator for a given column.
   *
   * @param sfDoctrineColumn $column
   * @return string    The options to pass to the validator as a PHP string
   */
  public function getValidatorOptionsForColumn($column)
  {
    $options = array();

    if ($column->isForeignKey())
    {
      $options[] = sprintf('\'model\' => $this->getRelatedModelName(\'%s\')', $column->getRelationKey('alias'));
    }
    else if ($column->isPrimaryKey())
    {
      $options[] = sprintf('\'choices\' => array($this->getObject()->get(\'%s\')), \'empty_value\' => $this->getObject()->get(\'%1$s\')', $column->getFieldName());
    }
    else
    {
      switch ($column->getDoctrineType())
      {
        case 'string':
          if ($column['length'])
          {
            $options[] = sprintf('\'max_length\' => %s', $column['length']);
          }
          if (isset($column['minlength']))
          {
            $options[] = sprintf('\'min_length\' => %s', $column['minlength']);
          }
          if (isset($column['regexp']))
          {
            $options[] = sprintf('\'pattern\' => \'%s\'', $column['regexp']);
          }
          break;
        case 'enum':
          $options[] = '\'choices\' => '.$this->arrayExport($column['values']);
          break;
      }
    }

    // If notnull = false, is a primary or the column has a default value then
    // make the widget not required
    if (!$column->isNotNull() || $column->isPrimaryKey() || $column->hasDefinitionKey('default'))
    {
      $options[] = '\'required\' => false';
    }

    return count($options) ? sprintf('array(%s)', implode(', ', $options)) : '';
  }

}
