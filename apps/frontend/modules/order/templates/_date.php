<?php if ($order->getAdditionalInformation()): ?>
  <span class="TipsyTooltip OrderDateTooltip" title="<?php echo nl2br($order->getAdditionalInformation()) ?>"><?php echo format_date($order->getDate(), 'd.MM.yyyy') ?></span>
<?php else: ?>
  <?php echo format_date($order->getDate(), 'd.MM.yyyy') ?>
<?php endif ?>