<?php

class sfWidgetFormMagicPhoto extends sfWidgetForm
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * type: The widget type
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('model');
    $this->addRequiredOption('foreign_key');
    $this->addRequiredOption('object_id');
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
    $id = $this->getOption('object_id'); 
    //$this->forward404Unless($id);
    $foreign_key = $this->getOption('foreign_key');
    $model = $this->getOption('model');    
            
    //sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
    
    $photo_data = array();
    if ($id)
    {
      $photo_data = Doctrine_Query::create()
                            ->from($model.' p')
                            ->where('p.'.$foreign_key.' = ?', $id)
                            ->orderBy('p.order')
                            ->fetchArray();    
    }

    return get_partial('form_photo', array('object_id' => $id, 'photo_data' => $photo_data));  
  }
}