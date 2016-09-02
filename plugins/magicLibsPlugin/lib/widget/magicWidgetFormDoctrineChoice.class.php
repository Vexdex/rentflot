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
 * sfWidgetFormDoctrineChoice represents a choice widget for a model.
 *
 * @package    symfony
 * @subpackage doctrine
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: sfWidgetFormDoctrineChoice.class.php 29679 2010-05-30 14:46:03Z Kris.Wallsmith $
 */
class magicWidgetFormDoctrineChoice extends sfWidgetFormDoctrineChoice
{
  
  protected function configure($options = array(), $attributes = array())
  {
    /*
    $this->addRequiredOption('model');
    $this->addOption('add_empty', false);
    $this->addOption('method', '__toString');
    $this->addOption('key_method', 'getPrimaryKey');
    $this->addOption('order_by', null);
    $this->addOption('query', null);
    $this->addOption('multiple', false);
    $this->addOption('table_method', null);    
    */    
    $this->addOption('template', '%text% %input%');
    parent::configure($options, $attributes);
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $choices = $this->getChoices();
    //$this->setOption('choices', array($value => $choices[$value]));
    return strtr($this->getOption('template'), array(
      '%input_id%'  => $this->generateId($name),
      '%text%'      => !empty($choices[$value]) ? $choices[$value] : '',
      '%input%'     => $this->renderTag('input', array_merge(array('type' => 'hidden', 'id' => $this->generateId($name), 'name' => $name, 'value' => $value), $attributes)),
    ));
    //$choices = $this->getChoices();
    //return (!empty($choices[$value]) ? $choices[$value] : '')."\n".$this->renderTag('input', array_merge(array('type' => 'hidden', 'id' => $this->generateId($name), 'name' => $name, 'value' => $value), $attributes));
  }  

}