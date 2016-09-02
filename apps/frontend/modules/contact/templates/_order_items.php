<?php //echo substr($client_contact->getOrder()->getDate(),0,10) ?>
<?php echo date('d.m.y',strtotime($client_contact->getOrder()->getDate())) ?>
<br/>
<?php echo substr($client_contact->getOrder()->getTimeFrom(),0,5) ?> - <?php echo substr($client_contact->getOrder()->getTimeTo(),0,5) ?><br/>
<?php $order_items = $client_contact->getOrder()->getOrderItems(); foreach ($order_items as $order_item): ?>
  <nobr><a href="<?php echo url_for('item_show', array('id' => $order_item->getItem()->getId())) ?>"><?php echo $order_item->getItem()->getInternalName() ?></a></nobr><br />
<?php endforeach ?>