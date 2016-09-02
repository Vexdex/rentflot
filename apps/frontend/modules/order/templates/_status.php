<?php $order_status_id = $order->getStatusId() ?>
<span class="OrderItemStatus<?php echo $order_status_id ?> <?php if ($order->getItems()->count()): ?>TipsyTooltip<?php endif ?> OrderStatus"
      <?php if (!$order->getItems()->count()): ?>style="cursor: default"<?php endif ?>
      title="<?php echo nl2br($order->getOrderItemsStatusesInfo()) ?>"><?php if ($order_status_id != 1): ?><?php echo $order->getStatus() ?><?php endif ?><?php if ($order->getOrderOwnerId() == 1): ?><?php if ($order_status_id != 1): ?>&nbsp;<?php endif ?>РФ<?php endif ?></span>


