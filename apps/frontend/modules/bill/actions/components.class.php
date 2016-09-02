<?php

/**
 * content components.
 *
 * @package    Rentflot
 * @subpackage content
 * @author     Infosoft
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class billComponents extends sfComponents
{
  public function executeBalance(sfWebRequest $request)
  {
    $orders_balance = Doctrine_Query::create()
                        ->select('SUM(i.amount_payed_uah) as amount_full_payed_uah, SUM(i.amount_payed_bank_uah) as amount_full_payed_bank_uah, SUM(i.amount_costs_uah) as amount_costs_uah, SUM(i.amount_costs_payed_uah) as amount_costs_payed_uah')
                        ->from('OrderItem i')
                        // только деньги Рентфлота
                        //->innerJoin('i.Order o')
                        //->where('o.order_type_id = 1 OR o.order_type_id = 2')
                        ->fetchArray();
    
    $this->orders_balance = $orders_balance[0];       
    //vardump($orders_balance); 
    $this->orders_balance['amount_full_cash_uah'] = $this->orders_balance['amount_full_payed_uah'] - $this->orders_balance['amount_costs_payed_uah'];
    $this->orders_balance['amount_full_bank_uah'] = $this->orders_balance['amount_full_payed_bank_uah'];
    
    
    
    
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
        

    //$this->bills_balance['amount_full_cash_uah'] = $this->bills_balance[2]['amount_full_payed_uah'] - $this->bills_balance[1]['amount_full_payed_uah'];
    //$this->bills_balance['amount_full_bank_uah'] = $this->bills_balance[4]['amount_full_payed_uah'] - $this->bills_balance[3]['amount_full_payed_uah'];
    
    //vardump($this->bills_balance);
    //$this->setTemplate('d');
    
  }
  
}
