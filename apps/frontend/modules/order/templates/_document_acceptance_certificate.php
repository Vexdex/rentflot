<p style="text-align: center"><img src="/images/documents/invoice_head.jpg" /></p>

<table style="width: 100%">
  <tr>
    <td style="width: 50%"><strong>ВИКОНАВЕЦЬ</strong></td>
    <td style="width: 50%"><strong>ЗАМОВНИК</strong></td>
  </tr>
  <tr>
    <td><?php echo nl2br($order->getSpd()->getSpdName(ESC_RAW)) ?> <br /></td>
    <td><?php echo $order->getClient()->getOrgName() ? $order->getClient()->getOrgName() : '___________________________________' ?></td>
  </tr>  
  <tr>
    <td></td>
    <td></td>
  </tr>    
</table>

<p style="text-align: center"><strong>АКТ</strong></p>
<p style="text-align: center">здачі-прийомки виконаних робіт №_________ від <?php echo date('d.m.Y') ?></p>
<p>
Ми, що нижче підписалися, від Виконавця <?php echo $order->getSpd()->getSpdNameGenitive() ?><br />
та Замовника <?php echo $order->getClient()->getOrgName() ? $order->getClient()->getOrgName() : '___________________________________' ?><br />
склали цей акт про те, що Виконавець виконав для Замовника наступні послуги <br />
згідно рахунку-фактурі № <?php echo $order->getId() ?> від ______________
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

<p>Взаєморозрахунки узгоджено, сторони взаємних притензій не мають.</p>

<br />
<br />

<table style="width: 100%">
  <tr>
    <td style="width: 50%">Від Виконавця</td>
    <td style="width: 50%">Від Замовника</td>
  </tr>
  <tr>
    <td style="width: 50%"><strong><?php echo $order->getSpd()->getName() ?></strong></td>
    <td style="width: 50%"></td>
  </tr>  
</table>
