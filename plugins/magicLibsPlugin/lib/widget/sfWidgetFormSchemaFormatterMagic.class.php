<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormSchemaFormatter allows to format a form schema with HTML formats.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormSchemaFormatter.class.php 21908 2009-09-11 12:06:21Z fabien $
 */
class sfWidgetFormSchemaFormatterMagic extends sfWidgetFormSchemaFormatterTable
{

  public function __construct(sfWidgetFormSchema $widgetSchema)
  {

    $this->rowFormat       = "<tr>\n  <th>form_%label%</th>\n  <td>%error%%field%%help%%hidden_fields%</td>\n</tr>\n";
    $this->errorRowFormat  = "<tr><td colspan=\"2\">\n%errors%</td></tr>\n";
    $this->helpFormat      = '<br />%help%';
    $this->decoratorFormat = "<table>\n  %content%</table>";

    parent::__construct($widgetSchema);
  }  

/**
   * Generates the label name for the given field name.
   *
   * @param  string $name  The field name
   *
   * @return string The label name
   */
  public function generateLabelName($name)
  {
    $label = $this->widgetSchema->getLabel($name);
   
    //echo $this->widgetSchema->getGeneretedId();
    
    if (!$label && false !== $label)
    {
      //$label = str_replace('_', ' ', ucfirst('_id' == substr($name, -3) ? substr($name, 0, -3) : $name));
      $label = $name; 
    }

    return $this->translate($label);
  }
}
