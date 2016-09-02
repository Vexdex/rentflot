<?php

/**
 * sfWidgetFormDependentSelect represents an select widget rendered by
 *
 * @package    symfony
 * @subpackage widget
 * @author
 */
class sfWidgetFormDependentSelect extends sfWidgetFormChoice
{
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->setOption('choices', array());
    $this->addRequiredOption('depends');
    $this->addRequiredOption('config_name');
    $this->addOption('url', function_exists('url_for') ?  url_for('sf_dependent_select_ajax', array(), true) : '/sf_dependent_select');
    $this->addOption('add_empty', false);
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $select = parent::render($name, null, $attributes);
    $javascript = $this->renderJavascript($name, $value);

    return $select . $javascript;
  }

  protected function renderJavascript($name, $value)
  {
    $javascriptData = array(
      '%depends%' => $this->getOption('depends') instanceof sfFormField ? $this->getOption('depends')->renderId() : (string)$this->getOption('depends'),
      '%config_name%' => $this->getOption('config_name'),
      '%url%' => $this->getOption('url'),
      '%add_empty%' => is_bool($this->getOption('add_empty')) ? self::boolToString($this->getOption('add_empty')) : "'" . $this->getOption('add_empty') . "'",
      '%field_name%' => $name,
      '%field_id%' => $this->generateId($name),
      '%field_id_camelized%' => sfInflector::camelize($this->generateId($name)),
      '%selected_value%' => $value
    );

    return strtr($this->getJavascriptTemplate(), $javascriptData);
  }

  protected static function boolToString($string)
  {
    return is_bool($string) ? ($string ? 'true' : 'false') : $string;
  }

  protected function getJavascriptTemplate()
  {
    $javascriptTemplate = "
      <script type=\"text/javascript\">

        jQuery(document).ready(function () {
          update%field_id_camelized%();

          jQuery('#%depends%').change(function () {
            update%field_id_camelized%();
          });
        });

        function update%field_id_camelized%()
        {
          var inputData = get%field_id_camelized%InputData();
          if (inputData['value'])
          {
            send%field_id_camelized%Data('%url%', 'POST', inputData, 'render%field_id_camelized%');
          }
          else
          {
            clear%field_id_camelized%();
          }
        }

        function clear%field_id_camelized%()
        {
          jQuery('#%field_id%').empty();
        }

        function get%field_id_camelized%InputData()
        {
          var inputData = { config_name : '%config_name%', value : jQuery('#%depends%').val() };
          return inputData;
        }

        function send%field_id_camelized%Data(url, method, inputData, callbackOnSuccess)
        {
          jQuery.ajax({
            type: method,
            dataType: 'json',
            url: url,
            data: inputData,
            success:
              function(outputData, textStatus)
              {
                window[callbackOnSuccess](outputData);
              },
            async: true
            //error: function (e) {alert(e.status);}
          });
        }

        function render%field_id_camelized%(data)
        {
          var addEmpty = %add_empty%;
          var selectedValue = '%selected_value%';
          var i = 1;

          clear%field_id_camelized%();

          if (addEmpty)
          {
            var emptyText = addEmpty === true ? '' : addEmpty;
            jQuery('#%field_id%').append('<option>' + emptyText + '</option>');
          }

          jQuery.each(data, function(key, value) {
            key = key.replace('key_', '');
            jQuery('#%field_id%').append(jQuery('<option></option>', {
              value: key,
              text: value
            }));
            i++;
          });

          jQuery('#%field_id%').val(selectedValue);
        }
      </script>";

    return $javascriptTemplate;
  }
}