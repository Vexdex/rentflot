<?php

 /*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormFilterNumber represents a number filter widget.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormFilterNumber.class.php 11672 2008-09-19 14:08:37Z fabien $
 */
class sfWidgetFormFilterMagicNumber extends sfWidgetFormFilterMagicNumberRange
{
  /**
   * Configures the current widget.
   *
   * Available options:
   *
   *  * with_empty:      Whether to add the empty checkbox (true by default)
   *  * empty_label:     The label to use when using an empty checkbox
   *  * filter_template: The template to use to render the widget
   *                     Available placeholders: %number_range%, %empty_checkbox%, %empty_label%
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->addOption('with_empty', true);
    $this->addOption('empty_label', 'пусто');
    //$this->addOption('template', sfContext::getInstance()->getI18N()->__('from', array(), 'common').' %from_number%<br />'.sfContext::getInstance()->getI18N()->__('to', array(), 'common').' %to_number%');
    $this->addOption('filter_template', '%number_range% %empty_checkbox% %empty_label%');
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The number displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */

  
   
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $values = array_merge(array('is_empty' => ''), is_array($value) ? $value : array());
    
    //vardump($attributes);
    
    if (!empty($attributes['type']) && $attributes['type'] == 'from' ) {
      return strtr($this->getOption('filter_template'), array(
        '%number_range%'     => parent::renderFrom($name, $value, $attributes, $errors),
        '%empty_checkbox%' => $this->getOption('with_empty') ? $this->renderTag('input', array('type' => 'checkbox', 'name' => $name.'[is_empty]', 'checked' => $values['is_empty'] ? 'checked' : '')) : '',
        '%empty_label%'    => $this->getOption('with_empty') ? $this->renderContentTag('label', $this->getOption('empty_label'), array('for' => $this->generateId($name.'[is_empty]'))) : '',
      ));
    }

    if (!empty($attributes['type']) && $attributes['type'] == 'to') {
      return strtr($this->getOption('filter_template'), array(
        '%number_range%'     => parent::renderTo($name, $value, $attributes, $errors),
        '%empty_checkbox%' => $this->getOption('with_empty') ? $this->renderTag('input', array('type' => 'checkbox', 'name' => $name.'[is_empty]', 'checked' => $values['is_empty'] ? 'checked' : '')) : '',
        '%empty_label%'    => $this->getOption('with_empty') ? $this->renderContentTag('label', $this->getOption('empty_label'), array('for' => $this->generateId($name.'[is_empty]'))) : '',
      ));            
    }
    
    return strtr($this->getOption('filter_template'), array(
      '%number_range%'     => parent::render($name, $value, $attributes, $errors),
      '%empty_checkbox%' => $this->getOption('with_empty') ? $this->renderTag('input', array('type' => 'checkbox', 'name' => $name.'[is_empty]', 'checked' => $values['is_empty'] ? 'checked' : '')) : '',
      '%empty_label%'    => $this->getOption('with_empty') ? $this->renderContentTag('label', $this->getOption('empty_label'), array('for' => $this->generateId($name.'[is_empty]'))) : '',
    ));
  }
}
