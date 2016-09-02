<a href="<?php echo url_for('client_edit', array('id' => $order->getClient()->getId())) ?>" <?php if ($order->getClient()->getContactInfo()): ?>class="TipsyTooltip" title="<?php echo nl2br($order->getClient()->getContactInfo(ESC_RAW)) ?><?php endif ?>"><?php echo $order->getClient()->getFullName2(ESC_RAW) ?></a>

