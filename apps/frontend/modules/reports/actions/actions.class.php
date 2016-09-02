<?php

/**
 * reports actions.
 *
 * @property   mixed orders_balance
 * @property   mixed bills_balance
 * @property   mixed data
 * @property   mixed amount_info
 * @property   mixed values
 * @property   mixed filter_print_values
 * @property   array reports_form_filter_values
 * @property   string print_type
 * @property   string excel_filename
 * @property   ReportsFormFilter reports_form_filter
 * @package    Rentflot
 * @subpackage reports
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportsActions extends sfActions
{

  /**
   * @return void
   */
  public function preExecute()
  {
    $this->data = null;
    $this->amount_info = array();
    $this->print_type = sfContext::getInstance()->getRequest()->getParameter('print');

    $this->reports_form_filter_values = $this->request->getParameter('reports_filter');
    $this->reports_form_filter = new ReportsFormFilter();
    $this->reports_form_filter->bind($this->reports_form_filter_values);

    $this->filter_print_values = array();
  }


  /**
   * Вывод списка доступных отчетов
   *
   * @param sfWebRequest $request
   * @return void
   */
  public function executeIndex(sfWebRequest $request)
  {
  }

  /**
   * Отчет "Свободные средства"
   *
   * @param sfWebRequest $request
   * @return void
   */
  public function executeBalance(sfWebRequest $request)
  {
    $this->excel_filename = 'Svobodnye-sredstva';
    $this->data = array();
    $orders_balance = Doctrine_Query::create()
      ->select('SUM(i.amount_payed_uah) as amount_full_payed_uah,
                SUM(i.amount_payed_bank_uah) as amount_full_payed_bank_uah,
                SUM(i.amount_costs_uah) as amount_costs_uah,
                SUM(i.amount_costs_payed_uah) as amount_costs_payed_uah,
                SUM(i.price_uah * i.count - i.amount_payed_uah - i.amount_payed_bank_uah) as amount_full_left_uah,
                SUM(i.amount_costs_uah - i.amount_costs_payed_uah) as amount_full_costs_left_uah')
      ->from('OrderItem i')
      // Только 100%
      ->andWhere('i.status_id = 3')
      ->fetchArray();
    
    $this->orders_balance = $orders_balance[0];    
    $this->orders_balance['amount_full_cash_uah'] = round($this->orders_balance['amount_full_payed_uah'] - $this->orders_balance['amount_costs_payed_uah'], 2);
    $this->orders_balance['amount_full_bank_uah'] = round($this->orders_balance['amount_full_payed_bank_uah'], 2);
    
    $bills_balance_temp = Doctrine_Query::create()
      ->select('SUM(b.amount_uah) as amount_full_uah, SUM(b.amount_payed_uah) as amount_full_payed_uah, b.type_id')
      ->from('Bill b')
      //->where('b.order_type_id = 1')
      ->groupBy('b.type_id')
      ->fetchArray();
    
    $this->bills_balance = array('amount_full_cash_uah' => 0, 'amount_full_bank_uah' => 0);
    foreach ($bills_balance_temp as $bill_balance)
    {
      switch ($bill_balance['type_id'])
      {
        case 1:
        case '1':
          $this->bills_balance['amount_full_cash_uah'] -= $bill_balance['amount_full_payed_uah'];
          break;
        
        case 2:
        case '2':
          $this->bills_balance['amount_full_cash_uah'] += $bill_balance['amount_full_payed_uah'];
          break;
          
        case 3:
        case '3':
          $this->bills_balance['amount_full_bank_uah'] -= $bill_balance['amount_full_payed_uah'];
          break;
          
        case 4:
        case '4':
          $this->bills_balance['amount_full_bank_uah'] += $bill_balance['amount_full_payed_uah'];
          break;
          
        default:
          break;
      }
    }
  }

  /**
   * Отчет по категориям
   *
   * @param sfWebRequest $request
   * @return void
   */
  public function executeCategories(sfWebRequest $request)
  {
    $this->excel_filename = 'Po-kategoriyam';

    if ($this->reports_form_filter->isValid())
    {
      $this->data = array();
      $this->values = $this->reports_form_filter->getValues();
      
      $data_query = Doctrine_Query::create()                  
        ->select('DISTINCT ci.category_id, t.*, c.*, ci.*, i.id, o.id, oi.id, SUM(oi.count * price_uah) as amount_full_uah, SUM(oi.amount_costs_uah) as amount_full_costs_uah, SUM(amount_payed_uah + amount_payed_bank_uah) as amount_full_payed_uah, SUM(oi.amount_costs_payed_uah) as amount_full_costs_payed_uah')
        ->from('OrderItem oi')
        ->innerJoin('oi.Item i')
        ->leftJoin('i.CategoryItem ci')
        ->leftJoin('ci.Category c')
        ->leftJoin('c.Translation t')
        ->leftJoin('oi.Order o')
        ->groupBy('ci.category_id');
        //->groupBy('c.id');
        //->execute(null, Doctrine::HYDRATE_SCALAR);

      // Дата
      if (!empty($this->values['date']['from']))
      {
        $data_query->andWhere('o.date >= ?', $this->values['date']['from']);
      }

      if (!empty($this->values['date']['to']))
      {
        $data_query->andWhere('o.date <= ?', $this->values['date']['to']);        
      }
      
      //$this->data = $data_query->fetchArray();
      $data_tmp = $data_query->execute(array(), Doctrine::HYDRATE_SCALAR);
      

      if (!empty($data_tmp))
      {
        $categories = Doctrine_Query::create()                  
          ->from('Category c')
          ->leftJoin('c.Translation t')
          //->fetchArray();
          ->execute(array(), Doctrine::HYDRATE_SCALAR);
        
        $this->amount_info['amount_total_uah'] = 0;
        $this->amount_info['amount_total_costs_uah'] = 0;
        $this->amount_info['amount_total_payed_uah'] = 0;
        $this->amount_info['amount_total_costs_payed_uah'] = 0;          
        $this->amount_info['profitability_total'] = 0;        
        $this->amount_info['profitability_avg'] = 0;        
        
        foreach ($categories as $category)
        {
          $this->data[$category['c_id']]['category'] = $category['t_name'];
          $this->data[$category['c_id']]['amount_full_uah'] = 0;
          $this->data[$category['c_id']]['amount_full_costs_uah'] = 0;
          $this->data[$category['c_id']]['amount_full_payed_uah'] = 0;
          $this->data[$category['c_id']]['amount_full_costs_payed_uah'] = 0;          
          $this->data[$category['c_id']]['profitability'] = 0;        
        }
              
        foreach ($data_tmp as $item)
        {
          foreach ($categories as $category)
          {
            if ($category['c_id'] == $item['ci_category_id'])
            {
              $this->data[$category['c_id']]['category'] = $item['t_name'];
              $this->data[$category['c_id']]['amount_full_uah'] = $item['oi_amount_full_uah'];
              $this->data[$category['c_id']]['amount_full_costs_uah'] = $item['oi_amount_full_costs_uah'];
              $this->data[$category['c_id']]['amount_full_payed_uah'] = $item['oi_amount_full_payed_uah'];
              $this->data[$category['c_id']]['amount_full_costs_payed_uah'] = $item['oi_amount_full_costs_payed_uah'];
              $this->data[$category['c_id']]['profitability'] = $item['oi_amount_full_costs_uah'] != 0 ? ((($item['oi_amount_full_uah'] - $item['oi_amount_full_costs_uah']) / $item['oi_amount_full_costs_uah']) * 100) : 0;
            
              $this->amount_info['amount_total_uah'] += $item['oi_amount_full_uah'];
              $this->amount_info['amount_total_costs_uah'] += $item['oi_amount_full_costs_uah'];
              $this->amount_info['amount_total_payed_uah'] += $item['oi_amount_full_payed_uah'];
              $this->amount_info['amount_total_costs_payed_uah'] += $item['oi_amount_full_costs_payed_uah'];          
              $this->amount_info['profitability_total'] += $this->data[$category['c_id']]['profitability'];                  
            }          
          }
        }
        
        foreach ($this->data as $id => $data_tmp)
        {          
          if (($data_tmp['amount_full_uah']) == 0)
          {
            unset($this->data[$id]);
          }
        }
        
        $this->amount_info['profitability_avg'] = $this->amount_info['profitability_total'] / count($this->data);
      }
    }
  }

  /**
   * Отчет "Затраты по индексам"
   *
   * @param sfWebRequest $request
   * @return void
   */
  public function executeBills(sfWebRequest $request)
  {
    $this->excel_filename = 'Zatraty';

    if ($this->reports_form_filter->isValid())
    {
      $this->data = array();
      $this->values = $this->reports_form_filter->getValues();

      $data_bill_query = Doctrine_Query::create()
        ->select('i.*, b.*, t.*, SUM(b.amount_payed_uah) as amount_payed_uah')
        ->from('Bill b')
        ->leftJoin('b.Index i')
        ->leftJoin('b.Type t')
        ->groupBy('b.index_id')
        ->addGroupBy('b.type_id');
        //->execute(null, Doctrine::HYDRATE_SCALAR);

      // Дата
      if (!empty($this->values['date']['from']))
      {
        $data_bill_query->andWhere('b.created_at >= ?', $this->values['date']['from']);
      }

      if (!empty($this->values['date']['to']))
      {
        $data_bill_query->andWhere('b.created_at <= ?', $this->values['date']['to']);        
      }
      
      $data_bill = $data_bill_query->fetchArray();
      

      $data_bill_index = Doctrine_Query::create()                  
        ->from('BillIndex')
        ->fetchArray();

      $data_bill_type = Doctrine_Query::create()                  
        ->from('BillType bt')
        ->orderBy('bt.order')
        ->fetchArray();
                                
      if (!empty($data_bill))
      {
        foreach ($data_bill_index as $bill_index)
        {
          $this->data[$bill_index['id']]['name'] = $bill_index['name'];
          foreach ($data_bill_type as $bill_type)
          {
            $this->data[$bill_index['id']]['Type'][$bill_type['id']] = 0;
          }
        }
        
        foreach ($this->data as $id => $item)
        {
          foreach ($data_bill as $bill)
          {
            if ($id == $bill['index_id'])
            {
              $this->data[$id]['Type'][$bill['Type']['id']] = $bill['amount_payed_uah'];                    
              $this->amount_info[$bill['Type']['id']] = (isset($this->amount_info[$bill['Type']['id']]) ? $this->amount_info[$bill['Type']['id']] : 0) + $bill['amount_payed_uah'];
            }       
          }
        }
      }
    }
  }
  
  /**
   * Отчет "Взаиморасчеты по теплоходу"
   *
   * @param sfWebRequest $request
   * @return void
   */
  public function executeMotorShipBills(sfWebRequest $request)
  {
    $this->excel_filename = 'Vzaimoraschety';

    if ($this->reports_form_filter->isValid() && !empty($this->reports_form_filter_values))
    {
      $this->data = array();
      $this->values = $this->reports_form_filter->getValues();
      
      $data_query = Doctrine_Query::create()                  
        ->select('oi.*, o.*, i.*, (oi.price_uah * oi.count) as amount_uah, (oi.amount_payed_uah) as amount_payed_uah, (oi.amount_payed_bank_uah) as amount_payed_bank_uah, (oi.amount_costs_uah - oi.amount_costs_payed_uah) as amount_costs_left_uah, (oi.price_uah * oi.count - oi.amount_payed_uah - oi.amount_payed_bank_uah) as amount_left_uah')
        ->from('OrderItem oi')
        ->innerJoin('oi.Order o')
        ->innerJoin('oi.Item i')
        ->leftJoin('i.CategoryItem ci')
        ->leftJoin('i.Owner io')
        ->groupBy('oi.id')
        ->orderBy('o.date');

      // Дата
      if (!empty($this->values['date']['from']))
      {
        $data_query->andWhere('o.date >= ?', $this->values['date']['from']);
      }

      if (!empty($this->values['date']['to']))
      {
        $data_query->andWhere('o.date <= ?', $this->values['date']['to']);
      }

      if (!empty($this->values['item_id']))
      {
        $data_query->andWhereIn('i.id', $this->values['item_id']);
      }

      if (!empty($this->values['owner_id']))
      {
        $data_query->andWhereIn('i.owner_id', $this->values['owner_id']);
      }

      // Кухня
      if (!empty($this->values['catering_type']))
      {
        switch ($this->values['catering_type'])
        {
          case 1:
            $data_query->andWhere('ci.category_id = 15');
            $data_query->andWhere('i.is_own = ?', true);
          break;

          case 2:
            $data_query->andWhere('ci.category_id = 15');        
            $data_query->andWhere('i.is_own = ?', false);        
          break;

          default:
          break;          
        }
      }

      // Статус
      if (!empty($this->values['order_type_id']))
      {
        // $data_query->andWhere('o.order_type_id = ?', $this->values['order_type_id']);
        $order_type_id = $this->values['order_type_id'];
        if ($order_type_id == 1 || $order_type_id == 2)
        {
          $data_query->andWhere('o.order_owner_id = ?', 1);
        }
          // Другие
        elseif ($order_type_id == 3 || $order_type_id == 4)
        {
          $data_query->andWhere('o.order_owner_id = ?', 2);
        }

        // 100%
        if ($order_type_id == 1 || $order_type_id == 3)
        {
          $data_query->andWhere('oi.status_id = ?', 3);
        }

        // 50%
        if ($order_type_id == 2 || $order_type_id == 4)
        {
          $data_query->andWhere('oi.status_id = ?', 2);
        }

        // 0%
        if ($order_type_id == 5)
        {
          $data_query->andWhere('oi.status_id = ?', 1);
        }
      }

      if (!empty($this->values['is_motor_ship']))
      {
        $data_query->andWhereIn('ci.category_id', sfConfig::get('app_category_motor_ships'));
      }
      
      if (!empty($this->values['is_amount_costs_left_uah']))
      {
        $data_query->andWhere('(oi.amount_costs_uah - oi.amount_costs_payed_uah) > 0');
      }
      
      if (!empty($this->values['is_amount_left_uah']))
      {
        $data_query->andWhere('(oi.price_uah * oi.count - oi.amount_payed_uah - oi.amount_payed_bank_uah) > 0');
      }

      $this->data = $data_query->fetchArray();
      $data_query = null;

      $this->amount_info = array();
      $this->amount_info['amount_left_uah'] = 0;
      $this->amount_info['amount_costs_left_uah'] = 0;

      foreach ($this->data as $data)
      {
        $this->amount_info['amount_left_uah'] += $data['amount_left_uah'];
        $this->amount_info['amount_costs_left_uah'] += $data['amount_costs_left_uah'];
      }
    }
  }

  /**
   * @return void
   */
  public function postExecute()
  {
    if ($this->print_type)
    {
      $this->setLayout('layout_document');

      if ($this->print_type == 'excel')
      {
        $this->getResponse()->setContentType('application/ms-excel');
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="RF_'.$this->excel_filename.date('_Y-m-d_H-i').'.xls"');
      }
    }
    else
    {
      if (!empty($this->values))
      {
        foreach ($this->values as $key => $value)
        {
          $this->filter_print_values['reports_filter['.$key.']'] = $value;
        }
      }
    }
  }
}


