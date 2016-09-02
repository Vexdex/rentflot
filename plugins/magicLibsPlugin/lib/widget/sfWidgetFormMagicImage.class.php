<?php

class sfWidgetFormMagicImage extends sfWidgetForm
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
    $this->addRequiredOption('image_model');
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
    $object_id = $this->getOption('object_id'); 
    $foreign_key = $this->getOption('foreign_key');
    $model = $this->getOption('model');   
    $image_model = $this->getOption('image_model');   
            
    //sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
    $image_data = array();
    if ($object_id)
    {
      $image_data = Doctrine_Query::create()
                            ->from($image_model.' p')
                            ->where('p.object_id = ?', $object_id)
                            ->orderBy('p.order')
                            ->fetchArray();    
    }

    return get_partial('form_image', array('image_data' => $image_data, 'model' => $model,  'image_model' => $image_model, 'object_id' => $object_id));  
  }
}