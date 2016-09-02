<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormFilterInput represents an HTML input tag used for filtering text.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormFilterInput.class.php 24015 2009-11-16 13:33:34Z bschussek $
 */
class sfWidgetFormMagicCaptcha extends sfWidgetForm
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * with_empty:  Whether to add the empty checkbox (true by default)
   *  * empty_label: The label to use when using an empty checkbox
   *  * template:    The template to use to render the widget
   *                 Available placeholders: %input%, %empty_checkbox%, %empty_label%
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('template', '<table cellspacing="0" id="captcha-container"><tr><td>%image%</td><td>%input%<br/>%reset%</td></tr></table>');
  }
  
  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $values = array_merge(array('text' => '', 'cptch' => '', 'is_empty' => false), is_array($value) ? $value : array());

    return strtr($this->getOption('template'), array(
      '%image%'    =>   $this->renderTag('img', array_merge(array('id' => 'captcha', 'src' => url_for('captcha'))), $attributes),                                 
      '%input%'    =>   $this->renderTag('input', array_merge(array('type' => 'text', 'id' => $this->generateId($name.'_cptch'), 'name' => $name, 'value' => $values['cptch']), $attributes)),
      '%reset%'    =>   '<span id="captcha-reload" onclick="$(\'#captcha\').attr(\'src\', \''.url_for('@captcha?magic_id='.time()).'\');">'.sfContext::getInstance()->getI18n()->__('reset', null, 'captcha').'</span>'
    ));
  }
}
