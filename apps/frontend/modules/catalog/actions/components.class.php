<?php
 
class catalogComponents extends sfComponents
{
  public function executeNextItemRent($request)
  {    
    $this->next_order_items_rent = Doctrine_Query::create()
      ->from('OrderItem oi')
      ->innerJoin('oi.Order o')
      ->leftJoin('o.OrderItems ois')
      ->where('oi.item_id = ?', $this->item_id)
      ->andWhere('o.is_archived = ?', false)
      ->andWhereIn('ois.status_id', array(2, 3))
      ->orderBy('o.date')
      ->execute();
  }
}