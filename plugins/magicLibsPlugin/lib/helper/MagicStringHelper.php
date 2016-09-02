<?php

//function mb_trim($string, $chars = "", $chars_array = array())

/**
 * Trim characters from either (or both) ends of a string in a way that is
 * multibyte-friendly.
 *
 * Mostly, this behaves exactly like trim() would: for example supplying 'abc' as
 * the charlist will trim all 'a', 'b' and 'c' chars from the string, with, of
 * course, the added bonus that you can put unicode characters in the charlist.
 *
 * We are using a PCRE character-class to do the trimming in a unicode-aware
 * way, so we must escape ^, \, - and ] which have special meanings here.
 * As you would expect, a single \ in the charlist is interpretted as
 * "trim backslashes" (and duly escaped into a double-\ ). Under most circumstances
 * you can ignore this detail.
 *
 * As a bonus, however, we also allow PCRE special character-classes (such as '\s')
 * because they can be extremely useful when dealing with UCS. '\pZ', for example,
 * matches every 'separator' character defined in Unicode, including non-breaking
 * and zero-width spaces.
 *
 * It doesn't make sense to have two or more of the same character in a character
 * class, therefore we interpret a double \ in the character list to mean a
 * single \ in the regex, allowing you to safely mix normal characters with PCRE
 * special classes.
 *
 * *Be careful* when using this bonus feature, as PHP also interprets backslashes
 * as escape characters before they are even seen by the regex. Therefore, to
 * specify '\\s' in the regex (which will be converted to the special character
 * class '\s' for trimming), you will usually have to put *4* backslashes in the
 * PHP code - as you can see from the default value of $charlist.
 *
 * @param string
 * @param charlist list of characters to remove from the ends of this string.
 * @param boolean trim the left?
 * @param boolean trim the right?
 * @return String
 */
function mb_trim($string, $charlist = '\\\\s', $ltrim = true, $rtrim = true)
{
  $both_ends = $ltrim && $rtrim;

  $char_class_inner = preg_replace(array('/[\^\-\]\\\]/S', '/\\\{4}/S'), array('\\\\\\0', '\\'), $charlist);

  $work_horse = '[' . $char_class_inner . ']+';
  $ltrim && $left_pattern = '^' . $work_horse;
  $rtrim && $right_pattern = $work_horse . '$';

  if ($both_ends)
  {
    $pattern_middle = $left_pattern . '|' . $right_pattern;
  }
  elseif ($ltrim)
  {
    $pattern_middle = $left_pattern;
  }
  else
  {
    $pattern_middle = $right_pattern;
  }

  return preg_replace("/$pattern_middle/usSD", '', $string);
}

function utf8_trim($string, $charlist = '\\\\s', $ltrim = true, $rtrim = true)
{
  return mb_trim($string, $charlist, $ltrim, $rtrim);
}

/**
 * Возвращает длину UTF-8 строки
 * @return int Длина строки
 */
function utf8_strlen($string) {
  return mb_strlen($string, 'UTF-8');
} 

/**
 * Преобразование UTF-8 строки в lower case
 * @return string Строка в lower case
 */
function utf8_strtolower($string) {
  return mb_convert_case($string, MB_CASE_LOWER, 'UTF-8');
} 

/**
 * Преобразование UTF-8 строки в upper case
 * @return string Строка в upper case
 */
function utf8_strtoupper($string) {
  return mb_convert_case($string, MB_CASE_UPPER, 'UTF-8');
}

/**
 * Преобразование первого символа UTF-8 строки в upper case
 * @return string Строка с первым символов в upper case
 */
function utf8_ucfirst($string) {
  return mb_convert_case(mb_substr($string, 0, 1, 'UTF-8'), MB_CASE_UPPER, 'UTF-8').mb_substr($string, 1, mb_strlen($string, 'UTF-8') - 1, 'UTF-8');
}

/**
 * Транслитерация строки
 * @return string Строка в транслитерации
 */  
function translit($str, $from = 'ru', $to = 'en') {
  $ru_en = array('а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ё'=>'e', 'ж'=>'zh', 'з'=>'z', 'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l',
                 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p', 'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'х'=>'h', 'ц'=>'c', 'ч'=>'ch', 'ш'=>'sh',
                 'щ'=>'sch', 'ъ'=>'', 'ы'=>'i', 'ь'=>'', 'э'=>'e', 'ю'=>'yu', 'я'=>'ya');
                 
  $direction = $from.'_'.$to;
  
  if (isset($$direction)) {
    return trim(preg_replace('~[^-a-z0-9_]+~', "_", strtr(mb_convert_case(trim($str, "_"), MB_CASE_LOWER, "UTF-8"), $$direction)), "_");
  } else {
    return $str;
  }	
}

/**
 * Форматирование телефона
 */  
function format_phone($string)
{
  $country_code = sfConfig::get('app_phone_country_code');
  $operator_code = substr($string, strlen($country_code), strlen($string) - strlen($country_code) - 7);
  $phone = substr($string, strlen($country_code) + strlen($operator_code));
  $phone_part_1 = substr($phone, 0, 3);
  $phone_part_2 = substr($phone, 3, 2);
  $phone_part_3 = substr($phone, 5, 7);  
  return '+'.$country_code.' ('.$operator_code.') '.$phone_part_1.'-'.$phone_part_2.'-'.$phone_part_3;
}

  
/**
 * Форматирование цены с точностью до 2 знаков после запятой. Если дробная часть не задана, то она не отображается
 *
 * @param string|double $number
 * @return string Отформатированная цена вида 9 999.9
 * @example format_price(99999) -> 99 999
 * @example format_price(1234.1) -> 1 234.1
 * @example format_price(2.033) -> 2.03
 * @example format_price(2.035) -> 2.04
 */  
function format_price($number, $separator = '.', $thousand_separator = ' ')
{
  if (!is_numeric($number))
  {
	  return $number;
	}
  if ($number == 0)
  {
    return 0;
  }
  $formatted_number = (double)$number;
  $precision = strlen(fract($formatted_number));
  if ($precision > 0)
  {
    $precision = 2;
  }
  $formatted_number = number_format($formatted_number, $precision, $separator, $thousand_separator);
  return $formatted_number;
}

/**
 * Форматирование цены с точностью до 2 знаков после запятой. Дробная часть отображается всегда
 *
 * @param string|double $number
 * @return string Отформатированная цена вида 9 999.99
 * @example format_fixed_price(99999) -> 99 999.00
 * @example format_fixed_price(1234.1) -> 1 234.10
 * @example format_fixed_price(2.033) -> 2.03
 * @example format_fixed_price(2.035) -> 2.04
 */  
function format_fixed_price($number, $precision = 2, $upper = false, $separator = '.', $thousand_separator = ' ')
{
  if (!is_numeric($number))
  {
	  return $number;
	}
  if ($number == 0)
  {
    return 0;
  }
  $formatted_number = number_format($number, $precision, $separator, $thousand_separator);
  if ($upper)
  {
    return substr($formatted_number, 0, strpos($formatted_number, $separator)).' <sup><u>'.substr($formatted_number, strpos($formatted_number, $separator) + 1).'</u></sup>';
  }
  return $formatted_number;
}

function fract_to_text($number)
{
  $frac = fract($number);

  if (!$frac)
  {
    return false;
  }

  $i18n = sfContext::getInstance()->getI18N();
  $fracLen = strlen($frac);
  $fracNumber = intval($frac);
  $fracText = plural_form($fracNumber, array($i18n->__('frac_exponent_' . $fracLen . '_plural_1', array(), 'common'), $i18n->__('frac_exponent_' . $fracLen . '_plural_2', array(), 'common'), $i18n->__('frac_exponent_' . $fracLen . '_plural_3', array(), 'common')));

  return utf8_strtolower(num_to_text($fracNumber)) . ' ' . $fracText;
}

/**
 * Форматирование float
 */ 
function format_float($number, $precision = -1, $separator = '.', $thousand_separator = ' ')
{
  if (!is_numeric($number))
  {
	  return $number;
	}
  $formatted_number = (double)$number;
  if ($precision == -1)
  {
    $precision = strlen(fract($formatted_number));
  }
  $formatted_number = number_format($formatted_number, $precision, $separator, $thousand_separator);
  return $formatted_number;
}

function widget_decorator_float($number)
{
  return format_float($number, -1, '.', '');
}

//------------------------------------------Преобразование числа в текст---------------------------------------------------   
// функция возвращает необходимый индекс описаний разряда
// ('миллион', 'миллиона', 'миллионов') для числа $ins
// например для 29 вернется 2 (миллионов)
// $ins максимум два числа
function num_to_text_descr_idx($ins)
{
  if(intval($ins/10) == 1) // числа 10 - 19: 10 миллионов, 17 миллионов
  return 2;
  else
  {
    // для остальных десятков возьмем единицу
    $tmp = $ins%10;
    if($tmp == 1) // 1: 21 миллион, 1 миллион
    return 0;
    else if($tmp >= 2 && $tmp <= 4)
    return 1; // 2-4: 62 миллиона
    else
    return 2; // 5-9 48 миллионов
  }
}

// IN: $in - число,
// $raz - разряд числа - 1, 1000, 1000000 и т.д.
// внутри функции число $in меняется
// $ar_descr - массив описаний разряда ('миллион', 'миллиона', 'миллионов') и т.д.
// $fem - признак женского рода разряда числа (true для тысячи)
function num_to_text_descr_sot(&$in, $raz, $ar_descr, $fem = false)
{
  $ret = '';
  
  $conv = intval($in / $raz);
  $in %= $raz;
  
  $descr = $ar_descr[ num_to_text_descr_idx($conv%100) ];
  
  if($conv >= 100)
  {
    $Sot = array(
      sfContext::getInstance()->getI18n()->__('one_hundred', null, 'common'),
      sfContext::getInstance()->getI18n()->__('two_hundred', null, 'common'),
      sfContext::getInstance()->getI18n()->__('three_hundred', null, 'common'),
      sfContext::getInstance()->getI18n()->__('four_hundred', null, 'common'),
      sfContext::getInstance()->getI18n()->__('five_hundred', null, 'common'),
      sfContext::getInstance()->getI18n()->__('six_hundred', null, 'common'),
      sfContext::getInstance()->getI18n()->__('seven_hundred', null, 'common'),
      sfContext::getInstance()->getI18n()->__('eight_hundred', null, 'common'),
      sfContext::getInstance()->getI18n()->__('nine_hundred', null, 'common')
    );
    $ret = $Sot[intval($conv/100) - 1] . ' ';
    $conv %= 100;
  }
  
  if($conv >= 10)
  {
    $i = intval($conv / 10);
    if($i == 1)
    {    
      $DesEd = array(          
        sfContext::getInstance()->getI18n()->__('ten', null, 'common'),
        sfContext::getInstance()->getI18n()->__('eleven', null, 'common'),
        sfContext::getInstance()->getI18n()->__('twelve', null, 'common'),
        sfContext::getInstance()->getI18n()->__('thirteen', null, 'common'),
        sfContext::getInstance()->getI18n()->__('fourteen', null, 'common'),
        sfContext::getInstance()->getI18n()->__('fifteen', null, 'common'),
        sfContext::getInstance()->getI18n()->__('sixteen', null, 'common'),
        sfContext::getInstance()->getI18n()->__('seventeen', null, 'common'),
        sfContext::getInstance()->getI18n()->__('eighteen', null, 'common'),
        sfContext::getInstance()->getI18n()->__('nineteen', null, 'common')          
      );
      $ret .= $DesEd[ $conv - 10 ] . ' ';
      $ret .= $descr;
      // возвращаемся здесь
      return $ret;
    }      
    $Des = array(
      sfContext::getInstance()->getI18n()->__('twenty', null, 'common'),
      sfContext::getInstance()->getI18n()->__('thirty', null, 'common'),
      sfContext::getInstance()->getI18n()->__('forty', null, 'common'),
      sfContext::getInstance()->getI18n()->__('fifty', null, 'common'),
      sfContext::getInstance()->getI18n()->__('sixty', null, 'common'),
      sfContext::getInstance()->getI18n()->__('seventy', null, 'common'),
      sfContext::getInstance()->getI18n()->__('eighty', null, 'common'),
      sfContext::getInstance()->getI18n()->__('ninety', null, 'common')       
    );
    $ret .= $Des[$i - 2] . ' ';
  }
  
  $i = $conv % 10;
  if($i > 0)
  {
    if( $fem && ($i==1 || $i==2) )
    {
      // для женского рода (сто одна тысяча)
      $Ed = array(sfContext::getInstance()->getI18n()->__('one_female', null, 'common'), sfContext::getInstance()->getI18n()->__('two_female', null, 'common'));
      $ret .= $Ed[$i - 1] . ' ';
    }
    else
    {        
      $Ed = array(          
        sfContext::getInstance()->getI18n()->__('one', null, 'common'),
        sfContext::getInstance()->getI18n()->__('two', null, 'common'),
        sfContext::getInstance()->getI18n()->__('three', null, 'common'),
        sfContext::getInstance()->getI18n()->__('four', null, 'common'),
        sfContext::getInstance()->getI18n()->__('five', null, 'common'),
        sfContext::getInstance()->getI18n()->__('six', null, 'common'),
        sfContext::getInstance()->getI18n()->__('seven', null, 'common'),
        sfContext::getInstance()->getI18n()->__('eight', null, 'common'),
        sfContext::getInstance()->getI18n()->__('nine', null, 'common'),                  
      );
      $ret .= $Ed[$i - 1] . ' ';
    }
  }
  $ret .= $descr;
  return $ret;
} 

// $sum - число, например 1256.18
// TODO is_female для копеек
function num_to_text($sum, $Mant = null, $Expon = null, $culture = null, $is_female = null)
{
  // Установка культуры для правильного вывода названия валюты
  if (!empty($culture))
  {
    $real_culture = sfContext::getInstance()->getUser()->getCulture();
    sfContext::getInstance()->getUser()->setCulture($culture);
  }
  //echo $is_female;
  if (is_null($is_female))
  {
    // Какие из языков имеют валюту женского рода
    $culture_female = array('uk' => true, 'ru' => false, 'en' => false);
    $is_female = $culture_female[sfContext::getInstance()->getUser()->getCulture()];
  }
  
  $ret = '';  
  // имена данных перменных остались от предыдущей версии
  // когда скрипт конвертировал только денежные суммы
  $Kop = 0;
  $Rub = 0;
  
  $sum = trim($sum);
  // удалим пробелы внутри числа
  $sum = str_replace(' ', '', $sum);
  
  // флаг отрицательного числа
  $sign = false;
  if($sum[0] == '-')
  {
    $sum = substr($sum, 1);
    $sign = true;
  }
  
  // заменим запятую на точку, если она есть
  $sum = str_replace(',', '.', $sum);
  
  $Rub = intval($sum);
  $Kop = round($sum*100 - $Rub*100);
  
  //echo $Kop;
  
  if($Rub)
  {
    // значение $Rub изменяется внутри функции num_to_text_descr_sot
    // новое значение: $Rub %= 1000000000 для миллиарда
    
   
    if($Rub >= 1000000000)
    $ret .= num_to_text_descr_sot($Rub, 1000000000, array(sfContext::getInstance()->getI18n()->__('billion_plural_1', null, 'common'), sfContext::getInstance()->getI18n()->__('billion_plural_2', null, 'common'), sfContext::getInstance()->getI18n()->__('billion_plural_3', null, 'common'))) . ' ';
    
    if($Rub >= 1000000)
    $ret .= num_to_text_descr_sot($Rub, 1000000, array(sfContext::getInstance()->getI18n()->__('milion_plural_1', null, 'common'), sfContext::getInstance()->getI18n()->__('milion_plural_2', null, 'common'), sfContext::getInstance()->getI18n()->__('milion_plural_3', null, 'common'))) . ' ';
    
    if($Rub >= 1000)
    $ret .= num_to_text_descr_sot($Rub, 1000, array(sfContext::getInstance()->getI18n()->__('thousand_plural_1', null, 'common'), sfContext::getInstance()->getI18n()->__('thousand_plural_2', null, 'common'), sfContext::getInstance()->getI18n()->__('thousand_plural_3', null, 'common')), true) . ' ';
  
    $ret .= num_to_text_descr_sot($Rub, 1, $Mant, $is_female) . ' ';
  
    // если необходимо поднимем регистр первой буквы
    //$ret[0] = chr( ord($ret[0]) + ord('A') - ord('a') );
    // для корректно локализованных систем можно закрыть верхнюю строку
    // и раскомментировать следующую (для легкости сопровождения)
    // $ret[0] = strtoupper($ret[0]);
  }
  if (!empty($Expon))
  {
    if($Kop < 10)
    $ret .= '0';
    $ret .= $Kop . ' ' . $Expon[ num_to_text_descr_idx($Kop) ];
  }
  
  // если число было отрицательным добавим минус
  if($sign)
  $ret = '-' . $ret;
  
  if (!empty($culture))
  {
    sfContext::getInstance()->getUser()->setCulture($real_culture);
  }
  
  return utf8_ucfirst(trim($ret));
}

function quote_string($var, $leftQuote = "'", $rightQuote = null)
{
  if (is_string($var))
  {
    $var = $leftQuote . $var . ($rightQuote ? $rightQuote : $leftQuote);
  }

  return bool_to_string($var);
}

function bool_to_string($var)
{
  return is_bool($var) ? ($var ? 'true' : 'false') : $var;
}