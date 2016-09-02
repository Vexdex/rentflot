<?php $order_items = $order->getOrderItems(); foreach ($order_items as $order_item): ?>
  <nobr><a href="<?php echo url_for('item_show', array('id' => $order_item->getItem()->getId())) ?>"><?php echo $order_item->getItem()->getInternalName() ?></a></nobr><br />
<?php endforeach ?>