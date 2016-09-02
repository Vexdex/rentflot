<?php

class magicWidgetFormChoiceWithHidden extends sfWidgetFormChoice
{

  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {    
    return $this->renderTag('input', array_merge(array('type' => 'hidden', 'id' => $this->generateId($name).'_val', 'value' => $value), $attributes))."\n".parent::render($name, $value, $attributes, $errors);
  }  

}