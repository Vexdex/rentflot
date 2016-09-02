<p><br />Штамп підприємства<br /><br /></p>

<h2 style="text-align: center">ТОВАРНИЙ ЧЕК № <?php echo $order->getId() ?> від <?php echo date('d.m.Y') ?></h2>

<p>
  <table class="Bordered">
    <tr>
      <th style="width: 3%">№</th>
      <th style="width: 49%">Найменування</th>
      <th style="width: 12%">Од. вим.</th>
      <th style="width: 12%">К-сть</th>
      <th style="width: 12%">Ціна, грн.</th>
      <th style="width: 12%">Сума, грн.</th>
    </tr>
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
  </table>
</p>

<p>
Всього на суму: <?php $amount_info = $order->getAmountInfo(); echo format_price($amount_info['amount_uah']) ?> грн. (<?php echo utf8_strtolower(num_to_text($amount_info['amount_uah'], array('грн.', 'грн.', 'грн.'), array('коп.', 'коп.', 'коп.'), 'uk',  true)) ?>)
</p>

<p>
Товар відпустив ________________________________________________________
</p>

<br />
<br />

<p>
В разі відмови від оренди плавзасобу, 50-ти процентна оплата від загальної вартості оренди плавзасобу не повертається.  
</p>