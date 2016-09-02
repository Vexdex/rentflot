<p style="text-align: center"><img src="/images/documents/invoice_head.jpg" /></p>

<p>
Постачальник
<div style="padding-left: 20px;">
<?php echo $order->getSpd()->getSpdName() ?> <br />
<?php echo nl2br($order->getSpd()->getDetails(ESC_RAW)) ?>
</div>
</p>

<p>Одержувач <?php echo $order->getClient()->getOrgName() ? $order->getClient()->getOrgName() : '___________________________________' ?></p>

<p>Платник <?php echo $order->getClient()->getOrgName() ? $order->getClient()->getOrgName() : '___________________________________' ?></p>

<p>
Рахунок-фактура № <?php echo $order->getId() ?> від <?php echo date('d.m.Y') ?>
</p>

<p>
  <table class="Bordered">
    <tr>
      <th style="width: 3%">№</th>
      <th style="width: 49%">Товар</th>
      <th style="width: 12%">Один. вимір.</th>
      <th style="width: 12%">Кількість</th>
      <th style="width: 12%">Ціна без ПДВ, грн.</th>
      <th style="width: 12%">Сума без ПДВ, грн.</th>
    </tr>
    <?php $amount_info = $order->getAmountInfo(); ?>
    <?php $order_items = $order->getOrderItems(); foreach ($order_items as $i => $order_item): ?>
      <tr>
        <?php $item = $order_item->getItem() ?>
        <td><?php echo ($i+1) ?></td>
        <td style="text-align: left; padding-left: 3px;"><?php echo $item->getDocName() ?> <?php echo format_date($order->getDate(), 'dd.MM.yyyy') ?> з  <?php echo format_date($order->getTimeFrom(), 'HH:mm') ?> до <?php echo format_date($order->getTimeTo(), 'HH:mm') ?> год</td>
        <td><?php echo $item->getUnitType()->getDocName() ?></td>
        <td><?php echo format_price($order_item->getCount()) ?></td>
        <td><?php echo format_price($order_item->getPriceUah()) ?></td>
        <td><?php echo format_price($order_item->getAmountUah()) ?></td>
      </tr>
    <?php endforeach ?>
      <tr>
        <td style="text-align: right" colspan="5">
          Всього без ПДВ (0%)
        </td>
        <td>
          <?php echo format_price($amount_info['amount_uah']) ?>
        </td>
      </tr>    
  </table>
</p>

<p>
Всього на суму: <?php echo format_price($amount_info['amount_uah']) ?> грн. (<?php echo utf8_strtolower(num_to_text($amount_info['amount_uah'], array('грн.', 'грн.', 'грн.'), array('коп.', 'коп.', 'коп.'), 'uk',  true)) ?>)
</p>

<p>
Підпис ___________________________________________
</p>

<br />

<p>
В разі відмови від оренди плавзасобу, 50-ти процентна оплата від загальної вартості оренди плавзасобу не повертається.  
</p>