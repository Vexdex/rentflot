<?php
 
 
 function include_rentflot_environment()
  {
    echo '<script type="text/javascript">
            var CULTURE                              = "'.sfContext::getInstance()->getUser()->getCulture().'";
            var RENTFLOT_ONLINE_ORDER                = "'.url_for('online_order_form', array(), true).'";
            var RENTFLOT_PAYMENTS_GENERATE_XML_AND_SIGN = "'.url_for('payments_generate_xml_and_sign', array(), true).'";
          </script>';
  }  
 
  /**
   *  Хелпер для передачи в Javascript разных значений из PHP.
   *  Блок Javascript'a перезагружается с каждой загрузкой страницы.
  */
  function include_rentflot_backend_environment()
  {
    echo '<script type="text/javascript">
            var CURRENT_DATE                         = new Date();
            var RENTFLOT_CLIENT_SHOW_FORM            = "'.url_for('client_show_form').'";
            var RENTFLOT_CLIENT_SAVE_FORM            = "'.url_for('client_save_form').'";
            var RENTFLOT_ORDER_ITEM_SHOW_FORM        = "'.url_for('order_item_show_form').'";
            var RENTFLOT_ITEM_LIST_BY_CATEGORY       = "'.url_for('item_list_by_category').'";
            var RENTFLOT_ORDER_ITEM_ADD              = "'.url_for('order_item_add').'";
            var RENTFLOT_CATEGORY_BY_ITEM            = "'.url_for('category_by_item').'";
            var RENTFLOT_LOGOUT                      = "'.url_for('sf_guard_signout').'";
          </script>';
  }


  /**
   *  Хелпер для вывода статических пунктов главного меню
   * @param $menu_item
   * @param array $params
   * @return string
   */
  function main_menu_item($menu_item, $params = array())
  {
    if (is_array($menu_item))
    {
      $route = $menu_item['route'];
      $name = $menu_item['name'];
    }
    else
    {
      $route = $menu_item;
      $name = $menu_item;
    }
  
    //echo $params['category_slug'].'-'.sfContext::getInstance()->getRequest()->getParameter('category_slug');
    
    $td_class = 'menu_cell';
    if (check_route($route, $params))
    {
      $td_class = 'menu_cell_active';
    }
    $html = '<tr><td id="menu_'.$name.'" class="'.$td_class.'">';
    if (sfContext::getInstance()->getRouting()->getCurrentRouteName() == $route && params_match($params))
    {
      $html .= sfContext::getInstance()->getI18n()->__($name, array(), 'menu');
    }
    else
    {
      $html .= '<a href="'.url_for($route, $params).'" class="inactive">'.sfContext::getInstance()->getI18n()->__($name, array(), 'menu').'</a>';
    }
    $html .= '</td></tr>';
    
    return $html;
  }

/*
  function main_menu_item_button($menuItem, $params = array())
  {
    $html = '<tr><td>';
    $html = '<a class="left_ships_menu left_ships_menu_' . $menuItem . (check_route($menuItem) ? 'left_ships_menu_' . $menuItem . 'active' : '' ) . '" href="">
    <div><span>Теплоходы</span></div></a>
    </td></tr>'';
    sfContext::getInstance()->getI18n()->__($name, array(), 'menu')
    return $html;
  }
*/


  /**
   * Хелпер для вывода drop-down пунктов главного меню
   *
   * @param string $menu_item
   * @param array $params
   * @return string
   */
  function dropdown_menu_item($menu_item, $params = array())
  {
    if (is_array($menu_item))
    {
      $route = $menu_item['route'];
      $name = $menu_item['name'];
    }
    else
    {
      $route = $menu_item;
      $name = $menu_item;
    } 
    
    $current_route = sfContext::getInstance()->getRouting()->getCurrentRouteName();
    $a_class = '';
    if ($current_route == $route && params_match($params))
    {
      $a_class = 'menu_cell_active_a';
    }
    $html = '<a href="'.url_for($route, $params).'" class="'.$a_class.'">'.sfContext::getInstance()->getI18n()->__($name, array(), 'menu').'</a>';
    
    return $html;
  }

  function main_menu_item_title($menu_item, $params = array(), $title)
    {
        if (is_array($menu_item))
            {
                  $route = $menu_item['route'];
                        $name = $menu_item['name'];
                            }
                                else
                                    {
                                          $route = $menu_item;
                                                $name = $menu_item;
                                                    }
                                                      
                                                          //echo $params['category_slug'].'-'.sfContext::getInstance()->getRequest()->getParameter('category_slug');
                                                              
                                                                  $td_class = 'menu_cell';
                                                                      if (check_route($route, $params))
                                                                          {
                                                                                $td_class = 'menu_cell_active';
                                                                                    }
                                                                                        $html = '<tr><td id="menu_'.$name.'" class="'.$td_class.'">';
                                                                                            if (sfContext::getInstance()->getRouting()->getCurrentRouteName() == $route && params_match($params))
                                                                                                {
                                                                                                      $html .= sfContext::getInstance()->getI18n()->__($name, array(), 'menu');
                                                                                                          }
                                                                                                              else
                                                                                                                  {
                                                                                                                        $html .= '<a href="'.url_for($route, $params).'" class="inactive" title="'.$title.'">'.sfContext::getInstance()->getI18n()->__($name, array(), 'menu').'</a>';
                                                                                                                            }
                                                                                                                                $html .= '</td></tr>';
                                                                                                                                    
                                                                                                                                        return $html;
                                                                                                                                          }
  
  function check_route($route, $params = array())
  {
    $currentRoute = sfContext::getInstance()->getRouting()->getCurrentRouteName();
    $categorySlug = sfContext::getInstance()->getRequest()->getParameter('category_slug');
    
    if (($currentRoute == $route && params_match($params)) ||
        (
          ($currentRoute == 'catalog_category' || $currentRoute == 'catalog_item') &&
          (($route == 'motor_ships' && ($categorySlug == 'motor_ships_15' || $categorySlug == 'motor_ships_25' || $categorySlug == 'motor_ships_50' || $categorySlug == 'motor_ships_100' || $categorySlug == 'motor_ships_150' || $categorySlug == 'motor_ships_151')) ||
          ($route == 'yachts' && ($categorySlug == 'motor_yachts' || $categorySlug == 'sailing_yachts')) ||
          ($route == 'odessa_yachts' && ($categorySlug == 'odessa_motor_yachts' || $categorySlug == 'odessa_sailing_yachts' || $categorySlug == 'odessa_motor_ships')) ||
          ($route == 'croatia_yachts' && ($categorySlug == 'croatia_motor_yachts' || $categorySlug == 'croatia_sailing_yachts')) ||
          ($route == 'greece_yachts' && ($categorySlug == 'greece_motor_yachts' || $categorySlug == 'greece_sailing_yachts')))
        ) ||
        ($currentRoute == 'map_velikiy' && $route == 'map') ||
        ($currentRoute == 'map_olgin' && $route == 'map') ||
        ($currentRoute == 'feedback' && $route == 'contacts'))
    {
      return true;
    }

    return false;
  }


  /**
   * @param $text
   * @param $module_name
   * @param string $params
   * @return string
   */
  function admin_menu_item($text, $module_name, $params = '')
  {
    $module_names = array();
    if ($module_name[0] == '@')
    {
      $module_name = substr($module_name, 1);
    }
    $route = '@'.$module_name;
    
    switch ($module_name)
    {
      case 'calendar_schedule':
        $module_names[] = 'calendar';
        break;
      case 'sf_guard_user':
        $module_names[] = 'sfGuardUser';
        break;
      case 'settings':
        $module_names[] = 'sfGuardGroup';
        $module_names[] = 'category';
        $module_names[] = 'billIndex';
        $module_names[] = 'menu';
        $module_names[] = 'spd';
        break;
      case 'order_new':
        //$route .= '?date='.date('Y-m-d');
        if (sfContext::getInstance()->getRouting()->getCurrentRouteName() == 'order_new')
        {
          $module_names[] = 'order';
        }
        break; 
      default:
        $module_names[] = $module_name;
        break;
    }
    return link_to($text, $route, (in_array(sfContext::getInstance()->getModuleName(), $module_names) ? 'class="strong"' : '').' '.$params);
  }
  
  /**
   * Функция для проверки параметров роута
   */
  function params_match($params)
  {
    if (!empty($params) && is_array($params))
    {
      foreach ($params as $param_name => $param)
      {
        if (sfContext::getInstance()->getRequest()->getParameter($param_name) != $param)
        {
          return false;
        }
      }
    }
    return true;
  }


  function parse_weather()
  {
    $months = array('Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'May' => '05', 'Jun' => '06', 'Jul' => '07', 'Aug' => '08', 'Sep' => '09', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12');
    $days = array(1 => 'Mo', 2 => 'Tu', 3 => 'We', 4 => 'Th', 5 => 'Fr', 6 => 'Sa', 0 => 'Su');

    $b = new sfWebBrowser(array(), 'sfFopenAdapter', array('timeout' => '10'));

    $weather = array();
    try
    {
      if (!$b->get('http://www.weather.com/weather/print/UPXX0016')->responseIsError())
      {
        $w_source1 = $b->getResponseText();

        $w_mask1 = '/\<B\>High \/\<BR\> Low \(&deg;([C,F])[^\a]*\<\!-- begin loop --\>([^\a]*)\<\!-- end loop --\>[^\a]*/';
        preg_match_all($w_mask1, $w_source1, $w_data1);

        $w_mask2='/(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec) (\d{1,2})[^\a]*?\<IMG SRC=\"http:\/\/image\.weather\.com\/web\/common\/wxicons\/31\/([\d]{1,2})\.gif[^\a]*?\<\/TD\>[^\a]*?\<\/TD\>[^\a]*?\<B\>([^\a]*?)\&deg;[\/]?([^\a]*?)?(\&deg;)?\<\/B\>/';
        $w_source2 = $w_data1[2][0];

        $t_scale = $w_data1[1][0];

        preg_match_all($w_mask2, $w_source2, $w_data);
        unset($w_data[0]);
        unset($w_data[6]);


        $date = getdate();
        for ($i = 0; $i < 7; $i++)
        {
          switch ($w_data[3][$i])
          {
            case '32':
            case '36':
              $w_icon = '1'; break;

            case '28':
            case '30':
            case '34':
              $w_icon = '2'; break;

            case '37':
            case '38':
            case '39':
            case '41':
            case '48':
              $w_icon = '2-2'; break;

            case '23':
            case '24':
            case '27':
              $w_icon = '3'; break;

            case '29':
            case '33':
            case '26':
              $w_icon = '4'; break;

            case '1':
            case '2':
            case '3':
            case '4':
            case '6':
            case '8':
            case '10':
            case '11':
            case '12':
            case '17':
            case '35':
            case '40':
            case '45':
            case '47':
              $w_icon = '6'; break;

            case '5':
            case '7':
            case '9':
            case '13':
            case '14':
              $w_icon = '7'; break;

            case '15':
            case '16':
            case '18':
            case '42':
            case '43':
            case '46':
              $w_icon = '8'; break;

            default: $w_icon = 'n-a'; break;
          }

          if ($t_scale == 'F')
          {
            $w_data[4][$i] = intval(ceil(($w_data[4][$i] - 32)*(5/9)));
            if (!empty($w_data[5][$i]))
            {
              $w_data[5][$i] = ceil(($w_data[5][$i] - 32)*(5/9));
            }
            else
            {
              $w_data[5][$i] = '-200';
            }
          }

          $weather[] = array(
            'day' => $w_data[2][$i].'.'.$months[$w_data[1][$i]],
            'day_of_weak' => $days[(($date['wday']+$i)%7)],
            't_from' => $w_data[5][$i] ? sprintf('%+2d', $w_data[5][$i]) : 0,            //!empty($w_data[5][$i]) ? sprintf('%+2d', $w_data[5][$i]) : '',
            't_to' => $w_data[4][$i] ? sprintf('%+2d', $w_data[4][$i]) : 0,
            'icon' => $w_icon
          );

        }
      }
    }
    catch (Exception $e)
    {
      // Adapter error (eg. Host not found)
    }
    $weather=array();
    for($i=0;$i<7;$i++)
    {
      $date_text=date("d.m",strtotime("+$i days"));
      $day_of_week = date('N',strtotime("+$i days"));
      $weather[] = array(
        'day' => $date_text,
        'day_of_weak' => $days[$day_of_week%7],
        't_from' => "-8",            //!empty($w_data[5][$i]) ? sprintf('%+2d', $w_data[5][$i]) : '',
        't_to' => "-3",
        'icon' => 5
      );
    }

    return $weather;
  }

  function rf_lang_url_for($culture)
  {
    $uri = sfContext::getInstance()->getRouting()->getCurrentInternalUri(true);
    if($uri==false)
	return false;
    return url_for($uri . '&sf_culture=' . $culture, true);
  }