<?php

/**
 * calendar actions.
 *
 * @package    Rentflot
 * @subpackage calendar
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
 
class calendarActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
  
  public function executeSchedule(sfWebRequest $request)
  {
    $this->schedule_form_filter = new ScheduleFormFilter();
    
    $year = date('Y');
    $month = date('n');
    if ($request->isMethod('post'))
    {
      $this->schedule_form_filter->bind($request->getParameter('sehedule_filter')); 
      if ($this->schedule_form_filter->isValid()) 
      {
        $month = $this->schedule_form_filter->getValue('month');
        $year = $this->schedule_form_filter->getValue('year');
        $order_owner_id = $this->schedule_form_filter->getValue('order_type_id');
        /*switch ($this->schedule_form_filter->getValue('order_type_id'))
        {
          case 1:
            $order_type_id = array(1, 2);
          break;
          case 2:
            $order_type_id = array(3, 4);
          break;
          default:
            $order_type_id = null;
          break;
        }*/
      }
    }
    
    $data = calendar(1, array('year' => $year, 'mon' => $month, 'mday' => date('j')), true);
    
    //echo $month;
    //echo date("Y-m-d", mktime(0, 0, 0, date("m"), $month , date("Y")));
    $date_from =  date("Y-m-d", strtotime($month.'/01/'.date('Y').' -6 day 00:00:00'));
    $date_to = date("Y-m-d", strtotime('-1 second', strtotime('+1 month',strtotime($month.'/01/'.date('Y').' +6 day 00:00:00'))));
    $days = $data['calendar_data'][0]['days'];
    //vardump($days);
    
    // Получаем список заказов за выбранный месяц
    $orders = Doctrine_Query::create()
                ->from('Order o')
                ->where('o.date BETWEEN ? AND ?', array($date_from, $date_to))
                ->orderBy('o.time_from')
                ->leftJoin('o.Items i')
                ->leftJoin('o.Client c')                
                //->leftJoin('i.Translation it WITH it.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\'')
                ->leftJoin('o.OrderItems oi')
                ->leftJoin('oi.Item ii')
                ->leftJoin('ii.Translation iit WITH iit.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\'')
                ->leftJoin('i.Categories ic')
                ->where('o.is_archived = ?', false);
                
    if (!empty($order_owner_id))
    {
//      $orders->andWhereIn('o.order_type_id', $order_type_id);
      $orders->andWhere('o.order_owner_id = ?', $order_owner_id);
    }
    $orders = $orders->execute();
    
    //vardump($days);
    
    foreach ($orders as $order)
    {    
      $order_items = $order->getOrderItems();
      $items = array();
      $order_title = '';
      
      // В какой из дней добавить заказ
      //vardump($days);
      //echo date('Y-m-d', strtotime($order->getDate()));
      foreach ($days as $key => $day)
      {        
        
        // Проверка, что день совпадает с днем заказа
        if (date('Y-m-d', strtotime($order->getDate())) != date('Y-m-d', strtotime($day['year'].'-'.$day['month'].'-'.$day['day'])))
        {   
          continue;
        }        
        foreach ($order_items as $order_item)
        {
          $item = $order_item->getItem();
          $items[] = array(
            'name' => $item->getName(),
            'internal_name' => $item->getInternalName(),
            'amount_uah' => $order_item->getAmountUah()
          );
        
          // Формирование title заказа - ищем первый теплоход
          if (!$order_title)
          {
//            foreach ($order_items as $order_item)
//            {
//              if ($order_title)
//              {
//                break;
//              }
              $order_item_categories = $item->getCategories();
              foreach ($order_item_categories as $order_item_category)
              {
                if (in_array($order_item_category->getId(), sfConfig::get('app_category_motor_ships')))
                {
                  $order_title = $item->getInternalName();
                }
                if ($order_title)
                {
                  break;
                }
              }
//            }
          }
        }
        
        $data['calendar_data'][0]['days'][$key]['order_data'][] = array(            
          'title' => $order_title ? $order_title : $order->getClient()->getFullName(), 
          'order' => $order, 
          'amount_info' => $order->getAmountInfo(),              
          'items' => $items
        );
      }
    }
     
    //vardump($calendar_data);
    //vardump($data);
    $this->calendar_data = $data['calendar_data'];
    $this->days_data = $data['days_data'];
  }

  
 
  
}
