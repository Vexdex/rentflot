<?php


/**
 * array_key_relative - Returns a key in an associative array relative to another key without using foreach. Very useful for finding previous key or finding next key in array, etc
 * 
 * @param        string                                 $start  00:00
 * @param        string                                 $end    12:12 
 * @return       array
 */
function array_key_relative($array, $current_key, $offset = 1) 
{
  // create key map
  $keys = array_keys($array);
  // find current key
  $current_key_index = array_search($current_key, $keys);
  // return desired offset, if in array, or false if not
  if (isset($keys[$current_key_index + $offset])) 
  {
    return $keys[$current_key_index + $offset];
  }
  
  return false;
}

function date_range($date, $period = 'm') 
{
  $interval = false;
  
  switch ($period)
  {
    case 'd': 
      $interval = array(
        'from' => date('Y-m-d 00:00:00', strtotime($date)),
        'to' => date('Y-m-d 23:59:59', strtotime($date))
      );
    break;        
    case 'w': 
      $interval = array(
        'from' => date('Y-m-d 00:00:00', strtotime($date)),
        'to' => date('Y-m-d 23:59:59', strtotime($date.' +6 day'))
      );
    break;
    case 'm': 
      $interval = array(
        'from' => date('Y-m-d 00:00:00', strtotime($date)),
        'to' => date('Y-m-t 23:59:59', strtotime($date))
      );
    break;          
  }
  
  return $interval;
}

function date_intervals($from, $to, $period = 'm')
{
  $range = false;
  
  $start = strtotime($from);
  $end = strtotime($to);
  
  switch ($period)
  {
    case 'd':
      $offset = '1 day';
    break;
    case 'w':
      if (date('w', strtotime($from)) != 1)
      {          
        $start = strtotime($from.' last Monday');
      }        
      $offset = '7 day';
    break;
    case 'm':
      $start = strtotime(date('Y-m-01', strtotime($from)));
      $offset = '1 month';
    break;
  }
  
  while($start <= $end) 
  {
    $range[] = date('Y-m-d', $start);
    $start = strtotime('+ '.$offset, $start);
  }
  
  return $range;
}


/**
 * Function to calculate date or time difference.
 * 
 * @param        string                                 $start  00:00
 * @param        string                                 $end    12:12 
 * @return       array
 */
function time_diff($start, $end)
{
  $start = is_null($start) ? '00:00' : $start;
  $end = is_null($end) ? '00:00' : $end;
  
  if (strtotime($start) && strtotime($end))
  {
    $time_from = date('G', strtotime($start)) * 60 + date('i', strtotime($start));
    $time_to = (date('G', strtotime($end)) || !date('G', strtotime($start)) ? date('G', strtotime($end)) : 24) * 60 + date('i', strtotime($end));
        
    $diff = ($time_to - $time_from > 0) ? $time_to - $time_from : 24 * 60 - ($time_from - $time_to);
    
    $diff_hours = floor($diff / 60);
    $diff_minutes = $diff - $diff_hours * 60;
      
    return array('hours' => $diff_hours, 'minutes' => $diff_minutes);  
  }
  
  return false;
  
  
  //echo strtotime($end);
  /*
  if (!empty($start) && !empty($end))
  {
    $uts['start'] = strtotime($start);
    $uts['end'] = strtotime($end);
    
    
    if ($uts['start']!==-1 && $uts['end']!==-1)
    {
      //if($uts['end'] >= $uts['start'])
      //{
                
        $diff = abs($uts['end'] - $uts['start']);
        if ($days=intval((floor($diff/86400))))
        {
          $diff = $diff % 86400;
        }
        if ($hours=intval((floor($diff/3600))))
        {
          $diff = $diff % 3600;
        }
        if ($minutes=intval((floor($diff/60))))
        {
          $diff = $diff % 60;
        }
        $diff = intval($diff);            
        
        return array('days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $diff);
      //}
    }  
  }
  return false;
  */
}

  function calendar_transp($data)
  {
    for ($i = 0; $i < 7; ++$i)
    {       
      for ($j = 0; $j < count($data); ++$j)
      {
        if ($j % 7 == $i)
        {
          $transp[] = $data[$j];
        }
      }      
    }          
    return $transp;
  }

  
  function calendar_prev_month($month, $year) 
  {
    if ($month == 1) {
      return array('month' => 12, 'year' => --$year);
    } 
    else 
    {
      return array('month' => --$month, 'year' => $year);
    }
  }
  
  function calendar_next_month($month, $year) 
  {
    if ($month == 12) 
    {
      return array('month' => 1, 'year' => ++$year);
    } 
    else 
    {
      return array('month' => ++$month, 'year' => $year);
    }
  }     
  
  function calendar($calendar_months_to_process, $mcurr, $is_transp = false)
  {    
 	
		/*
		 * format:
		 * 
		 * array('0' => 
		 * 		array('0' => array('num' => <some num>, 'class' = <css class name>),
		 * 			  '1' => ...),
		 * 
		 * 		 '1' =>
		 * 		array('0' => array('num' => <some num>, 'class' = <css class name>),
		 * 			  '1' => ...), ....);
		 * 
		 */
     		
		//$mcurr = getdate();
    //vardump($mcurr);
    
		/*
    $monthes = array('ru' => array(1 => '������', 2 => '�������', 3 => '����', 4 => '������', 5 => '���', 6 => '����', 7 => '����', 8 => '������', 9 => '��������', 10 => '�������', 11 => '������', 12 => '�������'),
						 'en' => array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => '������', 12 => 'December'));
		*/
    $monthes = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
		/*
    $days = array('ru' => array(1 => '��', 2 => '��', 3 => '��', 4 => '��', 5 => '��', 6 => '��', 0 => '��'),
					  'en' => array(1 => 'Mo', 2 => 'Tu', 3 => 'We', 4 => 'Th', 5 => 'Fr', 6 => 'Sa', 0 => 'Su'));
		*/
    
    $days = array('Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su');
    
		$calendar_data = array();
    //$months = $monthes[$getUser()->getCulture()];
		
		for ($j = 0; $j < $calendar_months_to_process; $j++) 
    {
			
			$mcurr_count = cal_Days_in_month(CAL_GREGORIAN, $mcurr['mon'], $mcurr['year']);
			$mcurr_last = getdate(mktime(0, 0, 0, $mcurr['mon'], $mcurr_count, $mcurr['year']));
			$mcurr_first = getdate(mktime(0, 0, 0, $mcurr['mon'], 1, $mcurr['year']));
			
			$calendar_prev_month = calendar_prev_month($mcurr['mon'], $mcurr['year']);
      $calendar_next_month = calendar_next_month($mcurr['mon'], $mcurr['year']);
			$mprev_count = cal_Days_in_month(CAL_GREGORIAN, $calendar_prev_month['month'], $calendar_prev_month['year']);
			
			$calendar_data[$j]['year'] = $mcurr['year'];
			$calendar_data[$j]['month'] = $monthes[$mcurr['mon']];
			
			for ($i = ($mcurr_first['wday'] == 0?7:$mcurr_first['wday']) - 1; $i > 0; $i--) 
      {
				$calendar_data[$j]['days'][] = array('day' => $mprev_count - $i + 1, 'month' => $calendar_prev_month['month'], 'year' => $calendar_prev_month['year'], 'class' => 'ddayn');
			}
			
			for ($i = 0; $i < $mcurr_count; $i++) 
      {
				$calendar_data[$j]['days'][] = array('day' => $i + 1, 'month' => $mcurr['mon'], 'year' => $mcurr['year'], 'class' => ($j == 0 && $mcurr['mday'] == $i + 1 && intval($mcurr['mon']) == intval(date('m')) ?'ddaya':'dday'));
			}
      
			for ($i = 1; $i < 7 - ($mcurr_last['wday'] == 0?7:$mcurr_last['wday']) + 1; $i++) 
      {
				$calendar_data[$j]['days'][] = array('day' => $i, 'month' => $calendar_next_month['month'], 'year' => $calendar_next_month['year'], 'class' => 'ddayn');
			}
			
			$mcurr = getdate(mktime(0, 0, 0, $calendar_next_month['month'], 1, $calendar_next_month['year']));
		}
		
		//$days_data = $days;
		//$calendar_data = $calendar_data;  
    
    if ($is_transp)
    {
      $transp = calendar_transp($calendar_data[0]['days']);    
      $calendar_data[0]['days'] = $transp;
      //echo 1;
    }
    //vardump($transp);
    //vardump($calendar_data[0]['days']);
    
    
    
    return array('calendar_data' => $calendar_data, 'days_data' => $days);
    
  }


  /**
   * Draw a watermark over an image (the watermark position is
   * selected automatically) and returns true. If the watermark
   * is bigger than the image, this method returns false.
   *
   * @param IMagick $image
   * @param IMagick $watermark
   * @param int $padding
   * @return bool
   */
  function draw_watermark($image, $watermark, $padding = 0)
  {
    // Check if the watermark is bigger than the image
    $image_width 		= $image->getImageWidth();
    $image_height 		= $image->getImageHeight();
    $watermark_width 	= $watermark->getImageWidth();
    $watermark_height 	= $watermark->getImageHeight();

    /*
    if ($image_width < $watermark_width + $padding || $image_height < $watermark_height + $padding) 
    {
      return false;
    }

    // Calculate each position
    $positions = array();
    $positions[] = array(0 + $padding, 0 + $padding);
    $positions[] = array($image_width - $watermark_width - $padding, 0 + $padding);
    $positions[] = array($image_width - $watermark_width - $padding, $image_height - $watermark_height - $padding);
    $positions[] = array(0 + $padding, $image_height - $watermark_height - $padding);

    // Initialization
    $min 		= null;
    $min_colors = 0;

    // Calculate the number of colors inside each region
    // and retrieve the minimum
    foreach($positions as $position)
    {
      $colors = $image->getImageRegion($watermark_width, $watermark_height, $position[0], $position[1])->getImageColors();

      if ($min === null || $colors <= $min_colors)
      {
        $min = $position;
        $min_colors = $colors;
      }
    }
    */

    // Draw the watermark
    //$image->compositeImage($watermark, Imagick::COMPOSITE_OVER, $min[0], $min[1]);
    
    $xp = round(($image_width - $watermark_width)/2);
    $yp = round($image_height - $watermark_height - $image_height*0.06);
    
    $image->compositeImage($watermark, Imagick::COMPOSITE_OVER, $xp, $yp);
    
    return $image;
  }


  /**
   *  ��������, ���� �� � ����� ������� �����
   *  (�) http://text.md/php-drobnaya-chast-chisla/
   *  (c) Dmitriy Scherbina
   */
  function fract($num = 0)
  {
    if(!is_double($num) || strpos($num, '.') === false)
    {
      return false;
    }
    $out = explode('.', $num);
    return $out[1];
  }

 function create_guid()
 {
    $guid = "";
    // This was 16 before, which produced a string twice as
    // long as desired. I could change the schema instead
    // to accommodate a validation code twice as big, but
    // that is completely unnecessary and would break 
    // the code of anyone upgrading from the 1.0 version.
    // Ridiculously unpasteable validation URLs are a 
    // pet peeve of mine anyway.
    for ($i = 0; ($i < 16); $i++) {
      $guid .= sprintf("%02x", mt_rand(0, 255));
    }
    return $guid;
  }
 
  function plural_form($n, $forms) 
  {
    $culture = sfContext::getInstance()->getUser()->getCulture();
    switch ($culture)
    {
      case 'uk': 
      case 'ru': 
        $plural = $n%10==1&&$n%100!=11?$forms[0]:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$forms[1]:$forms[2]);
      break;
      case 'en': 
        $plural = $n!=1?$forms[1]:$forms[0];
      break;
      default:
        $plural = '';
    }
    return $plural;
  }    
  
  function is_ie6()
	{
		return (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== false);
  }
  
   function partial_exists($partial_name) 
   {
      $directory = sfContext::getInstance()->getModuleDirectory();
      if (is_readable($directory . DIRECTORY_SEPARATOR ."templates". DIRECTORY_SEPARATOR ."_". $partial_name .".php")) 
      {
         return true;
      } 
      else 
      {
         return false;
      }
   }   
  
    function days_in_year($year) 
  {
    return date('z', mktime(0, 0, 0, 12, 31, $year)) + 1;
  }


/**
 * Dates must be in yyyy-mm-dd format
 *
 * @param $startDate
 * @param $endDate
 * @return int
 */
function days_diff($startDate, $endDate)
{
  //explode the date by "-" and storing to array
  $date_parts1 = explode("-", $startDate);
  $date_parts2 = explode("-", $endDate);
  //gregoriantojd() Converts a Gregorian date to Julian Day Count
  $start_date = gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
  $end_date = gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
  return $end_date - $start_date;
}