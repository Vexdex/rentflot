<?php

/**
 * sfWidgetFormJQueryDate represents a date widget rendered by JQuery UI.

 */
class magicWidgetFormJQueryDateTime extends sfWidgetForm
{
  /**
   * Configures the current widget.
   *
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('culture', sfContext::getInstance()->getUser()->getCulture());
    $this->addOption('date', array());
    $this->addOption('time', array());

    parent::configure($options, $attributes);
  }


  /**
   * @param  string $name        The element name
   * @param  string $value       The date displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $date = $this->parseDate($value);
    $dateOptions = $this->getDateOptions();
    $datepickerOptions = $this->getDatepickerOptions($dateOptions);
    $timeOptions = $this->getTimeOptions();
    $fieldsIds = $this->generateFieldsIds($name, $dateOptions);
    $html = array();

    if ($dateOptions)
    {
      $html['date_field'] = $dateOptions['date_widget'] ? $this->getWidgetFor('date', $dateOptions)->render($this->getDateFieldName($name, $dateOptions), $date['date'], $attributes, $errors) : '';
      $html['day_field'] = $dateOptions['day_widget'] ?  $this->getWidgetFor('day', $dateOptions)->render($this->getDayFieldName($name), $date['day']) : '';
      $html['month_field'] = $dateOptions['month_widget'] ? $this->getWidgetFor('month', $dateOptions)->render($this->getMonthFieldName($name), $date['month']) : '';
      $html['year_field'] = $dateOptions['year_widget'] ? $this->getWidgetFor('year', $dateOptions)->render($this->getYearFieldName($name), $date['year']) : '';
    }

    if ($datepickerOptions)
    {
      $data = array('culture' => $this->getOption('culture')) + $fieldsIds + $datepickerOptions;
      $html['jquery_control_hidden_field'] = $this->renderTag('input', array('type' => 'hidden', 'id' => $fieldsIds['jquery_control_hidden_field_Id'], 'disabled' => 'disabled'));
      $html['javascript'] = $this->renderJavascript($this->getJavascriptTemplate($datepickerOptions), $data);
    }

    if ($timeOptions)
    {
      $html['time_field'] = $timeOptions['time_widget'] ? $this->getWidgetFor('time', $timeOptions)->render($name, $date['time']) : '';
    }

    return implode('', $html);
  }

  protected function getWidgetFor($name, $options)
  {
    $widget = $options[$name . '_widget'];

    if (isset($options[$name . '_widget_options']) && is_array($options[$name . '_widget_options']))
    {
      foreach ($options[$name . '_widget_options'] as $optionName => $optionValue)
      {
        $widget->setOption($optionName, $optionValue);
      }
    }

    if (isset($options[$name . '_widget_attributes']) && is_array($options[$name . '_widget_attributes']))
    {
      $widget->setAttributes($options[$name . '_widget_attributes']);
    }

    return $widget;
  }

  protected function parseDate($value)
  {
    if (is_array($value))
    {
      $date = isset($value['date']) ? $value['date'] : null;
      $day = isset($value['day']) ? $value['day'] : null;
      $month = isset($value['month']) ? $value['month'] : null;
      $year = isset($value['year']) ? $value['year'] : null;
      $hour = isset($value['hour']) ? $value['hour'] : null;
      $minute = isset($value['minute']) ? $value['minute'] : null;
      $second = isset($value['second']) ? $value['second'] : null;
    }
    else
    {
      $timestamp = strtotime($value);
      $date = $timestamp ? date('Y-m-d', $timestamp) : null;
      $day = $timestamp ? date('j', $timestamp) : null;
      $month = $timestamp ? date('n', $timestamp) : null;
      $year = $timestamp ? date('Y', $timestamp) : null;
      $hour = $timestamp ? date('G', $timestamp) : null;
      $minute = $timestamp ? (int)date('i', $timestamp) : null;
      $second = $timestamp ? (int)date('s', $timestamp) : null;
    }

    $time = array('hour' => $hour, 'minute' => $minute, 'second' => $second);

    $data = array(
      'date' => $date,
      'day' => $day,
      'month' => $month,
      'year' => $year,
      'time' => $time,
      'hour' => $hour,
      'minute' => $minute,
      'second' => $second
    );

    return $data;
  }

  protected function generateFieldsIds($name, $dateOptions)
  {
    $ids = array(
      'field_id' => $this->generateId($name),
      'field_date_id' => $this->generateId($this->getDateFieldName($name, $dateOptions)),
      'jquery_control_hidden_field_Id' =>  $this->generateId($this->getDateFieldName($name, $dateOptions)).'_jquery_control'
    );

    return $ids;
  }

  protected function renderJavascript($template, $data)
  {
    $keys = array_map('quote_string', array_keys($data), array_fill(0, count($data), '%'));
    $values = array_map('bool_to_string', array_values($data));
    $javascript = strtr($template, array_combine($keys, $values));

    return $javascript;
  }

  protected function getJavascriptTemplate($datepickerOptions)
  {
    return is_string($datepickerOptions['template']) && $datepickerOptions['template'] ? $datepickerOptions['template'] : $this->getDefaultJavascriptTemplate();
  }

  protected function getDefaultJavascriptTemplate()
  {
    $javascriptTemplate = "
      <script type=\"text/javascript\">

        jQuery('#%field_date_id%').bind('focus', function() {
          jQuery('#%jquery_control_hidden_field_Id%').datepicker('show');
        });

        jQuery('#%field_date_id%').bind('change', function() {
          read_%jquery_control_hidden_field_Id%();
          var jQueryControlDate = jQuery('#%jquery_control_hidden_field_Id%').val();
          update_%field_date_id%(jQueryControlDate);
        });

        function read_%jquery_control_hidden_field_Id%()
        {
          var date = jQuery('#%field_date_id%').val();
          if (date)
          {
            var formattedDate = format_%field_date_id%('%dateFormat%', 'yy-mm-dd', date);

            if (formattedDate)
            {
              jQuery('#%jquery_control_hidden_field_Id%').val(formattedDate);
            }
            else
            {
              jQuery('#%field_id%_day').val('invalid');
              jQuery('#%field_id%_month').val('invalid');
              jQuery('#%field_id%_year').val('invalid');
            }
          }
          else
          {
            jQuery('#%jquery_control_hidden_field_Id%').val('');
            jQuery('#%field_id%_day').val('');
            jQuery('#%field_id%_month').val('');
            jQuery('#%field_id%_year').val('');
          }
        }

        function update_%field_date_id%(jQueryControlDate)
        {
          var formattedDate = format_%field_date_id%('yy-mm-dd', '%dateFormat%', jQueryControlDate);

          if (formattedDate)
          {
            jQuery('#%field_date_id%').val(formattedDate);
            var dateObject = jQuery.datepicker.parseDate('yy-mm-dd', jQueryControlDate);

            var year = dateObject.getFullYear();
            var month = dateObject.getMonth() + 1;
            var day = dateObject.getDate();
            jQuery('#%field_id%_day').val(day);
            jQuery('#%field_id%_month').val(month);
            jQuery('#%field_id%_year').val(year);
          }
        }

         function fill_%field_id%()
         {
           var day = parseInt(jQuery('#%field_id%_day').val(), 10);
           var month = parseInt(jQuery('#%field_id%_month').val(), 10);
           var year = parseInt(jQuery('#%field_id%_year').val(), 10);

           if (!isNaN(day) && !isNaN(month) && !isNaN(year))
           {
             formattedDate = jQuery.datepicker.formatDate('%dateFormat%', new Date(year, month - 1, day));
             jQuery('#%field_date_id%').val(formattedDate);
             read_%jquery_control_hidden_field_Id%();
           }
         }

         function format_%field_date_id%(inputFormat, outputFormat, date)
         {
           var formattedDate = false;

           try
           {
             formattedDate = jQuery.datepicker.formatDate(outputFormat, jQuery.datepicker.parseDate(inputFormat, date));
           }
           catch (e)
           {
             formattedDate = false;
           }

           return formattedDate;
         }

        jQuery(document).ready(function() {
          fill_%field_id%();

          jQuery('#%jquery_control_hidden_field_Id%').datepicker(jQuery.extend({}, {
            beforeShow: read_%jquery_control_hidden_field_Id%,
            onSelect: update_%field_date_id%,
            minDate: new Date(%minYear%, 1 - 1, 1),
            maxDate: new Date(%maxYear%, 12 - 1, 31),
            showOn: '%showOn%',
            buttonText: '%buttonText%',
            buttonImage: '%buttonImage%',
            buttonImageOnly: %buttonImageOnly%
          }, jQuery.datepicker.regional['%culture%'], {changeYear: %changeYear%, changeMonth: %changeMonth%}, {dateFormat: 'yy-mm-dd'}));
        });
      </script>";

    return $javascriptTemplate;
  }

  protected function getDateOptions()
  {
    if ($this->getOption('date') === false)
    {
      return false;
    }

    if (!is_array($this->getOption('date')))
    {
      return $this->getDefaultDateOptions();
    }

    return sfToolkit::arrayDeepMerge($this->getDefaultDateOptions(), $this->getOption('date'));
  }

  protected function getDatepickerOptions($dateOptions)
  {
    if ($dateOptions['datepicker'] === false)
    {
      return false;
    }

    if (!is_array($dateOptions['datepicker']))
    {
      return $this->getDefaultDatepickerOptions();
    }

    return $dateOptions['datepicker'];
  }

  protected function getTimeOptions()
  {
    if ($this->getOption('time') === false)
    {
      return false;
    }

    if (!is_array($this->getOption('time')))
    {
      return $this->getDefaultDateOptions();
    }

    return sfToolkit::arrayDeepMerge($this->getDefaultTimeOptions(), $this->getOption('time'));
  }

  protected function getDefaultDateOptions()
  {
    $default = array(
      'date_widget' => new sfWidgetFormInputText(),
      'date_widget_attributes' => array('class' => 'Date'),
      'day_widget' => new sfWidgetFormInputHidden(),
      'month_widget' => new sfWidgetFormInputHidden(),
      'year_widget' => new sfWidgetFormInputHidden(),
      'datepicker' => $this->getDefaultDatepickerOptions()
    );

    return $default;
  }

  protected function getDefaultDatepickerOptions()
  {
    $defaultOptions = array(
      'template' => false, // @see magicWidgetFromJQueryDateTime::getJavascriptTemplate
      'minYear' => date('Y') - 5,
      'maxYear' => date('Y') + 5,
      'changeMonth' => true,
      'changeYear' => true,
      'dateFormat' => 'd.mm.yy',
      'showOn' => 'button',
      'buttonText' => sfContext::getInstance()->getI18N()->__('choose_date', array(), 'grid'),
      'buttonImage' => '/magicLibsPlugin/images/datepicker.png',
      'buttonImageOnly' => true
    );

    return $defaultOptions;
  }

  protected function getDefaultTimeOptions()
  {
    $default = array(
      'time_widget' => new sfWidgetFormTime()
    );

    return $default;
  }

  protected function getDateFieldName($name, $dateOptions)
  {
    return $name . '[date]';
  }

  protected function getDayFieldName($name)
  {
    return $name . '[day]';
  }

  protected function getMonthFieldName($name)
  {
    return $name . '[month]';
  }

  protected function getYearFieldName($name)
  {
    return $name . '[year]';
  }
}
