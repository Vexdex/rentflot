<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorDate validates a date. It also converts the input value to a valid date.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorDate.class.php 28959 2010-04-01 14:10:24Z fabien $
 */
class sfValidatorMagicDate extends sfValidatorDate
{
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * date_format:             A regular expression that dates must match
   *                             Note that the regular expression must use named subpatterns like (?P<year>)
   *                             Working example: ~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~
   *  * with_time:               true if the validator must return a time, false otherwise
   *  * date_output:             The format to use when returning a date (default to Y-m-d)
   *  * datetime_output:         The format to use when returning a date with time (default to Y-m-d H:i:s)
   *  * date_format_error:       The date format to use when displaying an error for a bad_format error (use date_format if not provided)
   *  * max:                     The maximum date allowed (as a timestamp or accecpted date() format)
   *  * min:                     The minimum date allowed (as a timestamp or accecpted date() format)
   *  * date_format_range_error: The date format to use when displaying an error for min/max (default to d/m/Y H:i:s)
   *
   * Available error codes:
   *
   *  * bad_format
   *  * min
   *  * max
   *
   * @param array $options    An array of options
   * @param array $messages   An array of error messages
   *
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
    parent::configure();
    $this->addOption('min_age');
    $this->addOption('max_age');
    
    $this->addMessage('max_age', 'max_age');
    $this->addMessage('min_age', 'min_age');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    // check date format
    if (is_string($value) && $regex = $this->getOption('date_format'))
    {
      if (!preg_match($regex, $value, $match))
      {
        throw new sfValidatorError($this, 'bad_format', array('value' => $value, 'date_format' => $this->getOption('date_format_error') ? $this->getOption('date_format_error') : $this->getOption('date_format')));
      }

      $value = $match;
    }

    // convert array to date string
    if (is_array($value))
    {
      $value = $this->convertDateArrayToString($value);
    }

    // convert timestamp to date number format
    if (is_numeric($value))
    {
      $cleanTime = (integer) $value;
      $clean     = date('YmdHis', $cleanTime);
    }
    // convert string to date number format
    else
    {
      try
      {
        $date = new DateTime($value);
        $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
        $clean = $date->format('YmdHis');
      }
      catch (Exception $e)
      {
        throw new sfValidatorError($this, 'invalid', array('value' => $value));
      }
    }
    
    // by Andrey, check min, max age
    $min_date = null; 
    $max_date = null;
    if ($this->getOption('max_age'))
    {
      $min_date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') - intval($this->getOption('max_age'))));
    }
    
    if ($this->getOption('min_age'))
    {
      $max_date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') - intval($this->getOption('min_age'))));
    }
        
    $this->checkMinMaxCondition($value, $clean, $min_date, $max_date, array('min_age', 'max_age'));        
    
    
    // check min, max date
    $this->checkMinMaxCondition($value, $clean, $this->getOption('min'), $this->getOption('max'));

    if ($clean === $this->getEmptyValue())
    {
      return $cleanTime;
    }

    $format = $this->getOption('with_time') ? $this->getOption('datetime_output') : $this->getOption('date_output');

    return isset($date) ? $date->format($format) : date($format, $cleanTime);
  }

  
  public function checkMinMaxCondition($value, $clean, $min , $max, $error_code = array('min', 'max'))
  {
    // check max
    if ($max)
    {
      // convert timestamp to date number format
      if (is_numeric($max))
      {
        $maxError = date($this->getOption('date_format_range_error'), $max);
        $max      = date('YmdHis', $max);
      }
      // convert string to date number
      else
      {
        $dateMax  = new DateTime($max);
        $max      = $dateMax->format('YmdHis');
        $maxError = $dateMax->format($this->getOption('date_format_range_error'));
      }

      if ($clean > $max)
      {
        throw new sfValidatorError($this, $error_code[0], array('value' => $value, 'max' => $maxError, 'min_age' => $this->getOption('min_age'), 'years' => plural_form($this->getOption('min_age'), array(sfContext::getInstance()->getI18n()->__('years_plural_1', null, 'grid'), sfContext::getInstance()->getI18n()->__('years_plural_2', null, 'grid'), sfContext::getInstance()->getI18n()->__('years_plural_3', null, 'grid')))));
      }
    }

    // check min
    if ($min)
    {
      // convert timestamp to date number
      if (is_numeric($min))
      {
        $minError = date($this->getOption('date_format_range_error'), $min);
        $min      = date('YmdHis', $min);
      }
      // convert string to date number
      else
      {
        $dateMin  = new DateTime($min);
        $min      = $dateMin->format('YmdHis');
        $minError = $dateMin->format($this->getOption('date_format_range_error'));
      }

      if ($clean < $min)
      {        
        throw new sfValidatorError($this, $error_code[1], array('value' => $value, 'min' => $minError, 'max_age' => $this->getOption('max_age'), 'years' => plural_form($this->getOption('max_age'), array(sfContext::getInstance()->getI18n()->__('years_plural_1', null, 'grid'), sfContext::getInstance()->getI18n()->__('years_plural_2', null, 'grid'), sfContext::getInstance()->getI18n()->__('years_plural_3', null, 'grid')))));
      }
    }  
    
  }
  
  
}
