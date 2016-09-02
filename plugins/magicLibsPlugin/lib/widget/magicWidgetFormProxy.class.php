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
class magicWidgetFormProxy extends sfWidgetForm
{
  
  protected function configure($options = array(), $attributes = array())
  {    
    $this->addRequiredOption('form');
    $this->addRequiredOption('fields');
    $this->addRequiredOption('proxy_field');
    $this->addRequiredOption('partial');
    
    parent::configure($options, $attributes);
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return get_partial($this->getOption('partial'), array('form' => $this->getOption('form'), 'fields' => $this->getOption('fields'), 'proxy_field' => $this->getOption('proxy_field')));  
  }  

}