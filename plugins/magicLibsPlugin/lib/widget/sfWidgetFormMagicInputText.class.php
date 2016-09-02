<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormInput represents an HTML text input tag.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormInputText.class.php 30762 2010-08-25 12:33:33Z fabien $
 */
class sfWidgetFormMagicInputText extends sfWidgetFormInputText
{
  /**
   * Configures the current widget.
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    $this->addOption('decorator', 'widget_decorator_float');
    $this->addOption('readonly', false);
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $decorator = $this->getOption('decorator');
    
    if ($decorator && function_exists($decorator))
    {
      $value = call_user_func($decorator, $value);
    }

    if ($this->getOption('readonly'))
    {
      return $this->renderAsReadonly($name, $value, $attributes, $errors);
    }

    
    return parent::render($name, $value, $attributes, $errors);
  }

  public function renderAsReadonly($name, $value = null, $attributes = array(), $errors = array())
  {
    $textField = $this->renderContentTag('span', $value, array_merge(array('id' => $this->generateId($name . '_readonly'), 'class' => 'Frozen'), $attributes));
    $hiddenField = $this->renderTag('input', array('type' => 'hidden', 'id' => $this->generateId($name), 'name' => $name, 'value' => $value));

    return $textField . $hiddenField;
  }
  
}
