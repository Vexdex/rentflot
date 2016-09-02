<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorString validates a string. It also converts the input value to a string.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorString.class.php 12641 2008-11-04 18:22:00Z fabien $
 */
class rfValidatorCrossTimeItems extends sfValidatorBase
{
  
  protected function configure($options = array(), $messages = array())
  {
    //$this->addMessage('max_length', '"%value%" is too long (%max_length% %characters% max).');
    $this->addRequiredOption('order_id');
  }

  protected function doClean($values)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Partial', 'Url', 'Tag'));
    
    $items_exists_data = !empty($values['order_item']) ? $values['order_item'] : array();
    $items_new_data = !empty($values['order_item_new']) ? $values['order_item_new'] : array();
    $current_order_period = $this->make_period($values['date'], isset($values['time_from'])?$values['time_from']:null, isset($values['time_to'])?$values['time_to']:null);
    $items_data = $this->merge_order_items_data($items_exists_data, $items_new_data);

    /* @var Item $item  */
    $crossTimeItems = array();
    foreach ($items_data as $item_data)
    {
      /* @var Item $item */
      $item = Doctrine::getTable('Item')->findOneById($item_data['item_id']);

      $orders = Doctrine_Query::create()
                  ->from('Order o')
                  ->innerJoin('o.OrderItems oi')
                  ->innerJoin('oi.Item i')
                  ->where('i.id = ?', $item->getId())
                  ->andWhere('oi.status_id > ?', 1)
                  ->execute();

      $category_ids = array();
      foreach ($item->getCategories()->toArray() as $category)
      {
        $category_ids[] = $category['id'];
      }

      if ($item_data['status_id'] == 1 || $item_data['delete'] || !array_intersect($category_ids, sfConfig::get('app_category_motor_ships')))
      {
        continue;
      }

      foreach ($orders as $order)
      {
        if ($this->getOption('order_id') && $order->getId() == $this->getOption('order_id'))
        {
          continue;
        }

        $order_period = $this->make_period($order->getDate(), $order->getTimeFrom(), $order->getTimeTo());

        if ($current_order_period['start'] < $order_period['end'] && $current_order_period['end'] > $order_period['start'])
        {
          $crossTimeItems[] = $item->getFullName().
                              '. '.link_to('Заказ №'.$order->getId(), 'order_show', array('id' => $order->getId())).
                              ' ('.date('j.m.Y, H:i', $order_period['start']).' &mdash; '.date('j.m.Y, H:i', $order_period['end']).')';
        }
      }
    }

    if ($crossTimeItems)
    {
      throw new sfValidatorError($this, get_partial('order/form_cross_time_errors', array('crossTimeItems' => $crossTimeItems)));
    }

    return $values;
  }

  protected function merge_order_items_data($a, $b)
  {
    foreach ($b as $v)
    {
      $a[] = $v;
    }

    return $a;
  }

  protected function make_period($date, $time_from, $time_to)
  {
    $duration = time_diff($time_from, $time_to);

    $start_date = date('Y-m-d', strtotime($date)).' '.$time_from;
    $end_date = date('Y-m-d H:i:s', strtotime($start_date.' +'.$duration['hours'].' hours +'.$duration['minutes'].' minutes'));

    $dates = array(
      'start' => strtotime($start_date),
      'end' => strtotime($end_date)
    );

    return $dates;
  }

}
