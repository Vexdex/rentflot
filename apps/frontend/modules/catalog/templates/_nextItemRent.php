<p>
  <?php if ($next_order_items_rent->count()): ?>

    <?php foreach ($next_order_items_rent as $order_item): ?>
      <?php $order = $order_item->getOrder() ?>

      <?php echo link_to_if($sf_user->hasCredential('order'), format_date($order->getDate(), 'dd.MM.yyyy') . ', ' . format_date($order->getTimeFrom(), 'HH:mm') . '-' . format_date($order->getTimeTo(), 'HH:mm'), 'order_show', array('id' => $order->getId()), array('class' => 'ScheduleOrder' . $order_item->getStatusId())) ?>
        <?php if($order->getClientInformation()) { ?>
              <p><?php echo $order->getClientInformation() ?></p>
        <?php } ?>
          <br />

    <?php endforeach ?>

  <?php else: ?>
    Свободен
  <?php endif ?>
</p>